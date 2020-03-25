<?php

   namespace Classes\Utils;

    class Data
    {
        private $output;
        private $cnt;
        public static $config;
        public static $purifier;

        // Public Methods
        public function do($method_name, $data = null, $page = null, $line = null)
        {
            $method = '_' . $method_name;

            if (method_exists(__CLASS__, $method)) {
                $bla = __CLASS__;
                return $bla::$method($data);
            }

            echo '<b>ERROR: Class (' . get_called_class() . '):</b><br>';
            echo 'Defined method (' . $method . ') not found!<br>';
            if ($page == null) {
                echo 'Page: N/A<br>';
            } else {
                echo 'Page: ' . $page . '<br>';
            }
            if ($line == null) {
                echo 'Line: N/A<br><br>';
            } else {
                echo 'Line: ' . $line . '<br><br>';
            }
        }

        // Private Methods
        private function _is_ajax()
        {
            return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        }

        private function _load_purifier()
        {
            self::$config = \HTMLPurifier_Config::createDefault();
            self::$purifier = new \HTMLPurifier(self::$config);
        }

        private function _escData($data)
        {
            if (!isset($data) or empty($data)) {
                return '';
            }

            if (is_numeric($data)) {
                return $data;
            }

            $non_displayables = [
                '/%0[0-8bcef]/',
                '/%1[0-9a-f]/',
                '/[\x00-\x08]/',
                '/\x0b/',
                '/\x0c/',
                '/[\x0e-\x1f]/'
                //										'/<p\b[^>]*>(.*?)<\/p>/i'
            ];

            foreach ($non_displayables as $regex) {
                $data = preg_replace($regex, '', $data);
                $data = str_replace("'", "''", $data);
            }
            // Remove any indentations
            $data = str_replace('	', '&#09;', $data);
            $data = str_replace('		', '&#09;&#09;', $data);
            //$data = str_replace("     ","&nbsp;&nbsp;",$data);
            $data = str_replace("\t", '&#09;', $data);
            $data = str_replace("\t\t", '&#09;&#09;', $data);
            // Next replace unify all new-lines into unix LF
            $data = str_replace("\r", "\n", $data);
            $data = str_replace("\n\n", "\n", $data);
            // Replace all new lines with the unicode
            $data = str_replace("\n", '<br>', $data);
            // Replace any new line entities between >< with a new line
            $data = str_replace('>&#10;<', ">\n<", $data);

            return $data;
        }

        private function _xml_parser($data)
        {
            //	$data = str_replace(array("\r","\n") , "<br>", $data);
            $data = str_replace("\t", '&#09;', $data);

            return $data;
        }

        private function _getDateDiff($date1)
        {
            // Time Difference
            $return = '~ ';
            $date1 = new \DateTime($date1);
            $date2 = new \DateTime(strtotime(time()));
            $diff = $date1->diff($date2);

            if ($diff->y != 0) {
                $diff->y == 1 ? $return .= '1y ' : $return .= $diff->y . 'y ';
            }
            if ($diff->m != 0) {
                $diff->m == 1 ? $return .= '1m ' : $return .= $diff->m . 'm ';
            }
            if ($diff->y != 0) {
                return $return . '';
            }
            if ($diff->d != 0) {
                $diff->d == 1 ? $return .= '1d ' : $return .= $diff->d . 'd ';
            }
            if ($diff->m != 0) {
                return $return . '';
            }
            if ($diff->h != 0) {
                $diff->h == 1 ? $return .= '1h ' : $return .= $diff->h . 'h ';
            }
            if ($diff->y == 0 && $diff->m == 0 && $diff->d != 0) {
                return $return . '';
            }
            if ($diff->i != 0) {
                $diff->i == 1 ? $return .= '1m ' : $return .= $diff->i . 'm ';
            }
            if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h != 0) {
                return $return . '';
            }
            if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i != 0) {
                return $return . '';
            }
            if ($diff->s != 0) {
                $diff->s == 1 ? $return .= '1s ' : $return .= $diff->s . 's ';
            }
            return $return . '';
        }

        private function _setPriorityLevel($data)
        {
            switch ($data) {
                case 4:
                    echo '<span class="label label-info">';
                break;
                case 3:
                    echo '<span class="label label-success">';
                break;
                case 2:
                    echo '<span class="label label-warning">';
                break;
                case 1:
                    echo '<span class="label label-important">';
                break;
            }
        }

        private function _setPriority($data)
        {
            // Ticket Priority Level Switch
            switch ($data) {
                case 1:	return 'Critical';	break;
                case 2:	return 'High';		break;
                case 3:	return 'Normal';	break;
                case 4:	return 'Low';		break;
                default:	return $data;		break;
            }
        }

        private function _messageStatus($data)
        {
            switch ($data) {
                case 'Open':	echo '<span class="label label-important tac">Open';	break;
                case 'Pending':	echo '<span class="label label-success">Pending';		break;
                case 'Close':	echo '<span class="label label-info tac">Closed';		break;
                case 'Spam':	echo '<span class="label label-default tac">Spam';		break;
                default:	echo $data;												break;
            }
        }

        private function _format_phone($data, $country)
        {
            $function = 'format_phone_' . $country;
            if (function_exists($function)) {
                return $function($data);
            }

            return $data;
        }

        private function _format_phone_us($data)
        {
            // note: making sure we have something
            if (!isset($data[3])) {
                return '';
            }
            // note: strip out everything but numbers
            $data = preg_replace('/[^0-9]-/', '', $data);
            $length = strlen($data);
            switch ($length) {
                case 7: return preg_replace('/([0-9]{3})([0-9]{4})/', '$1 - $2', $data);break;
                case 10: return preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2 - $3', $data);break;
                case 11: return preg_replace('/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/', '$1($2) $3 - $4', $data);break;
                default: return $data;break;
            }
        }

        private function _urlsafe_b64encode($string)
        {
            $data = base64_encode($string);
            $data = str_replace(['+', '/', '='], ['-', '_', ''], $data);

            return $data;
        }

        private function _urlsafe_b64decode($string)
        {
            $data = str_replace(['-', '_'], ['+', '/'], $string);
            $mod4 = strlen($data) % 4;
            if ($mod4) {
                $data .= substr('====', $mod4);
            }
            return base64_decode($data);
        }

        private function _conv_mnth_2_txt($data)
        {
            switch ($data) {
                case	'01':	return 'January';	break;
                case	'02':	return 'February';	break;
                case	'03':	return 'March';		break;
                case	'04':	return 'April';		break;
                case	'05':	return 'May';		break;
                case	'06':	return 'June';		break;
                case	'07':	return 'July';		break;
                case	'08':	return 'August';	break;
                case	'09':	return 'September';	break;
                case	'10':	return 'October';	break;
                case	'11':	return 'November';	break;
                case	'12':	return 'December';	break;
            }

            return $data;
        }

        private function _conv_site_type($data)
        {
            switch ($data) {
                case 0: return 'Standard';		break;
                case 1: return 'BDSM';			break;
                case 2: return 'Music Host';	break;
                case 3: return 'Shaiya';		break;
                case 4: return 'Forte';			break;
            }
        }

        private function _rand_str($length)
        {
            $alpha_num = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = []; //remember to declare $pass as an array
            $alpha_num_length = strlen($alpha_num) - 1; //put the length -1 in cache

            for ($i = 0; $i < $length;$i++) {
                $n = rand(0, $alpha_num_length);
                $pass[] = $alpha_num[$n];
            }

            return implode($pass); //turn the array into a string
        }

        private function _member_id_rand()
        {
            $random_string = rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
                                rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
                                rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
                                rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
                                rand(0, 9) . rand(0, 9) . rand(0, 9);

            return $random_string;
            //return $this->verify_member_id_rand($random_string);
        }

        private function _bit_2_text_int($data)
        {
            switch ($data) {
                case '1':	return '<badge class="badge badge-success m_t_2">Yes</badge>';	break;
                case '0':	return '<badge class="badge badge-danger m_t_2">No</badge>';	break;
                default:	return $data;
            }
        }

        private function _bit_2_text_string($data)
        {
            switch ($data) {
                case 'true':	return 'Yes';	break;
                case 'false':	return 'No';	break;
                default:	return $data;
            }
        }

        private function _ENABLE($data)
        {
            switch ($data) {
                case '1':	return 'Enabled';	break;
                case '0':	return 'Disabled';	break;
                case 'true':	return 'Enabled';	break;
                case 'false':	return 'Disabled';	break;
                default:	return $data;
            }
        }

        private function _msg_2_text($data)
        {
            switch ($data) {
                case	'0':	return 'data-toggle="tooltip" data-placement="bottom" title="Hooray!"';
            }
        }

        private function _gen_blog_post_id($len)
        {
            $string = '';
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            for ($i = 0;$i < $len;$i++) {
                $string .= substr($chars, rand(0, strlen($chars)), 1);
            }

            return $string;
        }

        private function _chat_color($num)
        {
            switch ($num) {
                case 1:		return 'normal';	break;
                case 2:		return 'whisper';	break;
                case 3:		return 'guild';		break;
                case 4:		return 'party';		break;
                case 5:		return 'trade';		break;
                case 6:		return 'yelling';	break;
                case 7:		return 'area';		break;
            }
        }

        private function _status_2_text($status)
        {
            switch ($status) {
                case 0:	return 'Guest';										break;
                case 1:	return '<span class="sky-blue">SEO</span>';			break;
                case 2:	return '<span class="green">Add Later</span>';		break;
                case 3:	return '<span class="gold">Administrator</span>';	break;
                case 4:	return '<span class="red">Developer</span>';		break;
            }
        }

        private function _online_status_2_text($data)
        {
            switch ($data) {
                case 0: return '<span class=\'badge badge-pill badge-danger m_t_3\'>Offline</span>';break;
                case 1: return '<span class=\'badge badge-pill badge-success m_t_3\'>Online</span>';break;
            }
        }

        private function _tracker($Status)
        {
            // Issue Tracker Functions
            switch ($Status) {
                case 0:	return 'Status: New';		break;
                case 1:	return 'Status: Updated';	break;
                case 2:	return 'Status: Closed';	break;
                case 3:	return 'Status: Undefined';	break;
            }
        }

        private function _dept($Dept)
        {
            switch ($Dept) {
                case 0:		return 'Accounting';	break;
                case 1:		return 'Billing';		break;
                case 2:		return 'Graphics';		break;
                case 3:		return 'General';		break;
                case 4:		return 'Suggestions';	break;
            }
        }

        private function _object2array($object)
        {
            $return = null;

            if (is_array($object)) {
                foreach ($object as $key => $value) {
                    $return[$key] = self::object2array($value);
                }
            } else {
                $var = get_object_vars($object);

                if ($var) {
                    foreach ($var as $key => $value) {
                        $return[$key] = ($key && !$value) ? null : self::object2array($value);
                    }
                } else {
                    return $object;
                }
            }

            return $return;
        }

        public function pagination($page, $max_page, $url = '', $number = 4, $get_name = 'page')
        {
            $a = '';
            $b = '';
            $return = '';
            $sheet = '';
            // function for showing next pages
            if (preg_match("/\?/", $url)) {
                $appendix = '&amp;';
            } else {
                $appendix = '?';
            }

            if (substr($url, -1, 1) == '&') {
                $url = substr_replace($url, '', -1, 1);
            } elseif (substr($url, -1, 1) == '?') {
                $appendix = '?';
                $url = substr_replace($url, '', -1, 1);
            }

            if ($number % 2 != 0) {
                $number++;
                $a = $page - ($number / 2);
                $b = 0;
                $sheet = [];
            }

            while ($b <= $number) {
                if ($a > 0 && $a <= $max_page) {
                    $sheet[] = $a;
                    $b++;
                } elseif ($a > $max_page && ($a - $number - 2) >= 0) {
                    $sheet = [];
                    $a -= ($number + 2);
                    $b = 0;
                } elseif ($a > $max_page && ($a - $number - 2) < 0) {
                    break;
                }
                $a++;
            }

            if (!in_array(1, $sheet) && count($sheet) > 1) {
                if (!in_array(2, $sheet)) {
                    $this->output .= '<li class="page-item">';
                    $this->output .= '<a class="page-link" href="' . $url . $appendix . $get_name . '=1">';
                    $this->output .= '<img src="left.png" alt="">';
                    $this->output .= '</a>';
                    $this->output .= '</li>';
                } else {
                    $this->output .= '<li class="page-item">';
                    $this->output .= '<a class="page-link" href="' . $url . $appendix . $get_name . '=1">1</a>';
                    $this->output .= '</li>';
                }
            }
            foreach ($sheet as $sheets) {
                if ($sheets == $page) {
                    $return .= '<li class="page-item">' . $sheets . '</li>';
                } else {
                    $return .= '<li class="page-item">';
                    $this->output .= '<a class="page-link" href="' . $url . $appendix . $get_name . '=' . $sheets . '">' . $sheets . '</a>';
                    $this->output .= '</li>';
                }
            }
            if (!in_array($max_page, $sheet) && count($sheet) > 1) {
                if (!in_array(($max_page - 1), $sheet)) {
                    $this->output .= '<li class="page-item">';
                    $this->output .= '<a class="page-link" href="' . $url . $appendix . $get_name . '=' . $max_page . '">';
                    $this->output .= '<img src="next.png" alt="">';
                    $this->output .= '</a>';
                    $this->output .= '</li>';
                } else {
                    $this->output .= '<li class="page-item">';
                    $this->output .= '<a class="page-link" href="' . $url . $appendix . $get_name . '=' . $max_page . '">';
                    $this->output .= $max_page;
                    $this->output .= '</a>';
                    $this->output .= '</li>';
                }
            }
            if (empty($return)) {
                return '<li class="page-item">1</li>';
            } else {
                return $return;
            }
        }

        private function _dir_lister_data($data)
        {
            $dirArray = $this->DirLister->listDirectory($data);

            echo '<div class="table-responsive-sm">';
            echo '<table class="table table-sm table-dark">';
            echo '<thead>';
            echo '<tr>';
            echo '<th class="tac">File Type</th>';
            echo '<th class="b_i tac">File/Folder Name</th>';
            echo '<th class="b_i tac">Size</th>';
            echo '<th class="b_i tac">Last Mod. Date</th>';
            echo '<th class="b_i tac">Checksums</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($dirArray as $name => $fileInfo) {
                echo '<tr>';
                echo '<td class="tac"><i class="fa ' . $fileInfo['icon_class'] . ' fa-fw"></i></td>';
                echo '<td>';
                if (in_array($fileInfo['icon_class'], $this->DirLister->_open_new_tab)) {
                    if ($fileInfo['icon_class'] == 'fa-youtube-play') {
                        list($dir, $filename) = explode('/', $fileInfo['file_path']);
                        $Video_URI = 'Video.php?GUID=';
                        echo '<a href="' . $Video_URI . $Data->urlsafe_b64encode($fileInfo['file_path']) . '" class="tac" data-name="' . $name . '" target="_blank">' . $name . '</a>';
                    } else {
                        echo '<a href="' . $fileInfo['url_path'] . '" class="tac" data-name="' . $name . '">' . $name . '</a>';
                    }
                } else {
                    echo '<a href="' . $fileInfo['url_path'] . '" class="tac" data-name="' . $name . '" target="_blank">' . $name . '</a>';
                }
                echo '</td>';
                echo '<td class="tac">' . $fileInfo['file_size'] . '</td>';
                echo '<td class="tac">' . $fileInfo['mod_time'] . '</td>';
                if (is_file($fileInfo['file_path'])) {
                    echo '<td class="tac">';
                    echo '<button class="badge badge-info open_checksums_modal" data-target="#file_info_modal" data-name="' . $name . '" data-href="' . $fileInfo['url_path'] . '" data-size="' . $fileInfo['file_size'] . '" data-toggle="modal">';
                    echo '<i class="fa fa-info-circle"></i>';
                    echo '</button>';
                    echo '</td>';
                } else {
                    echo '<td></td>';
                }
                echo '</tr>';
                //	echo '<pre>';
                    //		var_dump($fileInfo);
                    //	echo '</pre>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }

        private function _site_type_2_text($data)
        {
            switch ($data) {
                case	'0':	return 'Standard';		break;
                case	'1':	return 'BDSM';			break;
                case	'2':	return 'Music Host';	break;
                case	'3':	return 'Music Host';	break;
                case	'4':	return 'Forte';			break;
            }
        }

        private function _text_conv($type, $data, $cycle = false)
        {
            list($value, $trash) = explode('_', $data);

            if ($type == 'some') {
                switch ($value) {
                    case	0:	$this->some_func;	break;
                    case	1:	$this->some_func;	break;
                    case	2:	$this->some_func;	break;
                    default:	return $value;		break;
                }
            } elseif ($type == 'some') {
                switch ($value) {
                    case	0:	$this->some_func;	break;
                    case	1:	$this->some_func;	break;
                    case	2:	$this->some_func;	break;
                    default:	return $value;		break;
                }
            } else {
            }
        }

        private function _MessagesArr($data)
        {
            switch ($data) {
                // SITE-WIDE MESSAGES
                case 'ERR-0x01': return 'The page you are looking for either doesn\'t exist or has been moved.'; break;
                // LOGIN MSGS - STANDARD
                case 'L-0x01': return 'A Username or Email is required. How else would you be able to log in?'; break;
                case 'L-0x02': return 'Your UserID must be between 3 and 16 characters in length.'; break;
                case 'L-0x03': return 'Your UserID must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
                case 'L-0x04': return 'A password is required for all accounts.<br>Please provide a password.'; break;
                case 'L-0x05': return 'Your password must be between 3 and 16 characters in length.'; break;
                case 'L-0x06': return 'Your password must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
                case 'L-0x08': return 'Login successful.<br>Loading your homepage now...'; break;
                case 'L-0x09': return 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.'; break;
                // LOGIN MSGS - SHAIYA
                case 'L-0x07': return 'Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.'; break;

                // Registration Messages
                // Username
                case 'R-0x01': return 'Please provide a Username.'; break;
                case 'R-0x02': return 'Username must be between 3 and 16 characters in length.'; break;
                case 'R-0x03': return 'Username must consist of numbers and letters only.'; break;
                case 'R-0x04': return 'Username already exists, please choose a different Username.'; break;
                // DisplayName
                case 'R-0x05': return 'Please provide a Display name.'; break;
                case 'R-0x24': return 'Display name must consist of numbers and letters only.'; break;
                case 'R-0x25': return 'Display name already exists. please choose a different display name.'; break;
                // Password
                case 'R-0x06': return 'Please provide a password.'; break;
                case 'R-0x07': return 'Password must be between 8 and 16 characters in length.'; break;
                case 'R-0x08': return 'Passwords do not match.'; break;
                // Pin
                case 'R-0x28': return 'Please provide a pin.'; break;
                case 'R-0x29': return 'Pin must be between 4-6 characters.'; break;
                case 'R-0x30': return 'Pin must be numeric.'; break;
                // Date of Birth
                case 'R-0x09': return 'Please provide a Date of birth.'; break;
                // Gender
                case 'R-0x10': return 'Please provide your Gender.'; break;
                // E-Mail
                case 'R-0x11': return 'Please provide your e-mail.'; break;
                case 'R-0x12': return 'Invalid e-mail format'; break;
                case 'R-0x13': return 'The e-mail address provided has already been used. Please choose a different e-mail address.'; break;
                // Referer
                case 'R-0x26': return 'Please provide a Referer. If none then choose none.'; break;
                // Google Recaptcha
                case 'R-0x27': return 'Google Recaptcha Verification Failed, Please Try Again!'; break;
                // Security Q & A
                case 'R-0x14': return 'Please provide a Security Question.'; break;
                case 'R-0x15': return 'Please provide a Security Answer.'; break;
                // ToS
                case 'R-0x16': return 'You must agree to our Terms Of Use to register.'; break;
                // Validation - User
                case 'R-0x17': return 'Game account creation has failed. Please contact an admin for assistance.'; break;
                case 'R-0x18': return 'Your account, <font class="b_i">' . $_SESSION['REG_TEXT'][1] . ',</font> has been successfully created!'; break;
                // Validation - Web
                case 'R-0x19': return 'Web account creation has failed. Please contact an admin for assistance.'; break;
                case 'R-0x20': return 'Your web account, <font class="b_i">' . $_SESSION['REG_TEXT'][0] . ' for ' . $_SESSION['REG_TEXT'][1] . ',</font> has been successfully created!'; break;
                // Validation - Email
                case 'R-0x21': return 'Verification e-mail failed to send to the e-mail that you provided. Please contact an administrator for further assistance.'; break;
                case 'R-0x22': return 'A verification email has been sent to <font class="b_i">' . $_SESSION['REG_TEXT'][9] . '</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.'; break;
                // Resend
                case 'R-0x23': return 'A verification email has been resent to <font class="b_i">' . $_SESSION['REG_TEXT'][9] . '</font> with an activation key for the account <font class="b_i">' . $_SESSION['REG_TEXT'][1] . '</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>Still didn\'t receive the e-mail? Contact an administrator for further assistance.'; break;
                // Validations
                case 'R-0x31': return 'Password must include at least one uppercase letter.'; break;
                case 'R-0x32': return 'Password must include at least one number.'; break;
                case 'R-0x33': return 'Password must include at least one special character.'; break;
                // Misc
                //case 'M-0x01': return 'I see that you\'re new here. You must <strong>Register</strong> in order to view the rest of <font class="b_i">My Domain</font>.<br>If you already have an account, you can update it by clicking <strong><a href="javascript:;" class="open_acct_reset_modal" data-id="UserIP~'.$this->Browser->UserIP.'" data-target="#acct_reset_modal" data-toggle="modal">here</a></strong>'; break;
                //case 'M-0x02': return 'Welcome back, <strong>'.$this->User->UserID.'</strong>.<br>Please <strong>Log In</strong> and enjoy your stay here at <font class="b_i">'.Settings::SiteTitle().'</font>.'; break;
                // Direct Messages
                case 'DM-0x01': return 'Please enter a Character Name to send the message to.'; break;
                case 'DM-0x02': return 'Please enter a Subject for the message.'; break;
                case 'DM-0x03': return 'Please enter a Message.'; break;
            }
        }

        // MISC
        private function _Props()
        {
            echo '<div class="col-md-12">';
            echo '<b>Properties for class (' . get_class($this) . '):</b><br>';
            echo '<pre>';
            echo print_r(get_object_vars($this));
            echo '</pre>';
            echo '</div>';
            exit();
        }

        private function _Mthds()
        {
            $class_methods = get_class_methods($this);
            echo '<div class="col-md-12">';
            echo '<b>Class (' . get_class($this) . ') Methods:</b> <br>';
            echo '<pre>';
            foreach ($class_methods as $method_name) {
                echo $method_name . '<br>';
            }
            echo '</pre>';
            echo '</div>';
            exit();
        }
    }
