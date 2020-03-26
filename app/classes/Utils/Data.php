<?php

namespace Classes\Utils;

use HTMLPurifier;

class Data
{
    protected $config;

    public function __construct()
    {
        $this->config = \HTMLPurifier_Config::createDefault();
    }

    public function purify(string $html): string
    {
        $purifier = new HTMLPurifier($this->config);
        return $purifier->purify($html);
    }

    public function isAjax(): string
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }


    public function xmlParser(string $data): string
    {
        // $data = str_replace(array("\r","\n") , "<br>", $data);
        $data = str_replace("\t", '&#09;', $data);

        return $data;
    }

    public function getDateDiff($date1)
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

    public function setPriorityLevel(int $data): string
    {
        switch ($data) {
            case 4:
                return '<span class="label label-info">';
                break;
            case 3:
                return '<span class="label label-success">';
                break;
            case 2:
                return '<span class="label label-warning">';
                break;
            case 1:
                return '<span class="label label-important">';
                break;
        }
    }

    public function setPriority(int $data): string
    {
        // Ticket Priority Level Switch
        switch ($data) {
            case 1:
                return 'Critical';
            case 2:
                return 'High';
            case 3:
                return 'Normal';
            case 4:
                return 'Low';
            default:
                return $data;
        }
    }

    public function messageStatus(string $data): string
    {
        switch ($data) {
            case 'Open':
                return '<span class="label label-important tac">Open';
                break;
            case 'Pending':
                return '<span class="label label-success">Pending';
                break;
            case 'Close':
                return '<span class="label label-info tac">Closed';
                break;
            case 'Spam':
                return '<span class="label label-default tac">Spam';
                break;
            default:
                return $data;
                break;
        }
    }

    public function formatPhone($data, $country)
    {
        $function = 'formatPhone' . $country;
        if (function_exists($function)) {
            return $function($data);
        }

        return $data;
    }

    private function formatPhoneUs($data)
    {
        // note: making sure we have something
        if (!isset($data[3])) {
            return '';
        }
        // note: strip out everything but numbers
        $data = preg_replace('/[^0-9]-/', '', $data);
        $length = strlen($data);
        switch ($length) {
            case 7:
                return preg_replace('/([0-9]{3})([0-9]{4})/', '$1 - $2', $data);
            case 10:
                return preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2 - $3', $data);
            case 11:
                return preg_replace('/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/', '$1($2) $3 - $4', $data);
            default:
                return $data;
        }
    }

    public function urlSafeB64Encode(string $string): string
    {
        $data = base64_encode($string);
        $data = str_replace(['+', '/', '='], ['-', '_', ''], $data);

        return $data;
    }

    public function urlSafeB64Decode(string $string): string
    {
        $data = str_replace(['-', '_'], ['+', '/'], $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function convertMonthToText(int $data): string
    {
        switch ($data) {
            case 01:
                return 'January';
            case 02:
                return 'February';
            case 03:
                return 'March';
            case 04:
                return 'April';
            case 05:
                return 'May';
            case 06:
                return 'June';
            case 07:
                return 'July';
            case 8:
                return 'August';
            case 9:
                return 'September';
            case 10:
                return 'October';
            case 11:
                return 'November';
            case 12:
                return 'December';
        }

        return $data;
    }

    public function randStr(int $length = 64): string
    {
        $alpha_num = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = []; //remember to declare $pass as an array
        $alpha_num_length = strlen($alpha_num) - 1; //put the length -1 in cache

        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alpha_num_length);
            $pass[] = $alpha_num[$n];
        }

        return implode($pass); //turn the array into a string
    }

    public function randMemerId(): string
    {
        $random_string = rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
            rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
            rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
            rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' .
            rand(0, 9) . rand(0, 9) . rand(0, 9);

        return $random_string;
    }

    public function bitToTextInt(int $data): string
    {
        switch ($data) {
            case 1:
                return '<badge class="badge badge-success m_t_2">Yes</badge>';
            case 0:
                return '<badge class="badge badge-danger m_t_2">No</badge>';
            default:
                return $data;
        }
    }

    public function bitToTextString(bool $data): string
    {
        switch ($data) {
            case true:
                return 'Yes';
            case false:
                return 'No';
            default:
                return $data;
        }
    }

    public function enable(bool $data): string
    {
        switch ($data) {
            case 1:
                return 'Enabled';
            case 0:
                return 'Disabled';
            case true:
                return 'Enabled';
            case false:
                return 'Disabled';
            default:
                return $data;
        }
    }

    public function msgToText(int $data): string
    {
        switch ($data) {
            case 0:
                return 'data-toggle="tooltip" data-placement="bottom" title="Hooray!"';
        }
    }

    public function chatColor(int $num): string
    {
        switch ($num) {
            case 1:
                return 'normal';
            case 2:
                return 'whisper';
            case 3:
                return 'guild';
            case 4:
                return 'party';
            case 5:
                return 'trade';
            case 6:
                return 'yelling';
            case 7:
                return 'area';
        }
    }

    public function statusToText(int $status): string
    {
        switch ($status) {
            case 0:
                return 'Guest';
            case 1:
                return '<span class="sky-blue">SEO</span>';
            case 2:
                return '<span class="green">Add Later</span>';
            case 3:
                return '<span class="gold">Administrator</span>';
            case 4:
                return '<span class="red">Developer</span>';
        }
    }

    public function onlineStatusToText(int $data): string
    {
        switch ($data) {
            case 0:
                return '<span class=\'badge badge-pill badge-danger m_t_3\'>Offline</span>';
            case 1:
                return '<span class=\'badge badge-pill badge-success m_t_3\'>Online</span>';
        }
    }

    public function tracker(int $status): string
    {
        // Issue Tracker Functions
        switch ($status) {
            case 0:
                return 'Status: New';
            case 1:
                return 'Status: Updated';
            case 2:
                return 'Status: Closed';
            case 3:
                return 'Status: Undefined';
        }
    }

    public function dept(int $dept): string
    {
        switch ($dept) {
            case 0:
                return 'Accounting';
            case 1:
                return 'Billing';
            case 2:
                return 'Graphics';
            case 3:
                return 'General';
            case 4:
                return 'Suggestions';
        }
    }

    public function messagesArr(string $data): string
    {
        switch ($data) {
                // SITE-WIDE MESSAGES
            case 'ERR-0x01':
                return 'The page you are looking for either doesn\'t exist or has been moved.';
                // LOGIN MSGS - STANDARD
            case 'L-0x01':
                return 'A Username or Email is required. How else would you be able to log in?';
            case 'L-0x02':
                return 'Your UserID must be between 3 and 16 characters in length.';
            case 'L-0x03':
                return 'Your UserID must consist of numbers and letters only.<br>Special characters are not allowed.';
            case 'L-0x04':
                return 'A password is required for all accounts.<br>Please provide a password.';
            case 'L-0x05':
                return 'Your password must be between 3 and 16 characters in length.';
            case 'L-0x06':
                return 'Your password must consist of numbers and letters only.<br>Special characters are not allowed.';
            case 'L-0x08':
                return 'Login successful.<br>Loading your homepage now...';
            case 'L-0x09':
                return 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.';
                // LOGIN MSGS - SHAIYA
            case 'L-0x07':
                return 'Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.';

                // Registration Messages
                // Username
            case 'R-0x01':
                return 'Please provide a Username.';
            case 'R-0x02':
                return 'Username must be between 3 and 16 characters in length.';
            case 'R-0x03':
                return 'Username must consist of numbers and letters only.';
            case 'R-0x04':
                return 'Username already exists, please choose a different Username.';
                // DisplayName
            case 'R-0x05':
                return 'Please provide a Display name.';
            case 'R-0x24':
                return 'Display name must consist of numbers and letters only.';
            case 'R-0x25':
                return 'Display name already exists. please choose a different display name.';
                // Password
            case 'R-0x06':
                return 'Please provide a password.';
            case 'R-0x07':
                return 'Password must be between 8 and 16 characters in length.';
            case 'R-0x08':
                return 'Passwords do not match.';
                // Pin
            case 'R-0x28':
                return 'Please provide a pin.';
            case 'R-0x29':
                return 'Pin must be between 4-6 characters.';
            case 'R-0x30':
                return 'Pin must be numeric.';
                // Date of Birth
            case 'R-0x09':
                return 'Please provide a Date of birth.';
                // Gender
            case 'R-0x10':
                return 'Please provide your Gender.';
                // E-Mail
            case 'R-0x11':
                return 'Please provide your e-mail.';
            case 'R-0x12':
                return 'Invalid e-mail format';
            case 'R-0x13':
                return 'The e-mail address provided has already been used. Please choose a different e-mail address.';
                // Referer
            case 'R-0x26':
                return 'Please provide a Referer. If none then choose none.';
                // Google Recaptcha
            case 'R-0x27':
                return 'Google Recaptcha Verification Failed, Please Try Again!';
                // Security Q & A
            case 'R-0x14':
                return 'Please provide a Security Question.';
            case 'R-0x15':
                return 'Please provide a Security Answer.';
                // ToS
            case 'R-0x16':
                return 'You must agree to our Terms Of Use to register.';
                // Validation - User
            case 'R-0x17':
                return 'Game account creation has failed. Please contact an admin for assistance.';
            case 'R-0x18':
                return 'Your account, <font class="b_i">' . $_SESSION['REG_TEXT'][1] . ',</font> has been successfully created!';
                // Validation - Web
            case 'R-0x19':
                return 'Web account creation has failed. Please contact an admin for assistance.';
            case 'R-0x20':
                return 'Your web account, <font class="b_i">' . $_SESSION['REG_TEXT'][0] . ' for ' . $_SESSION['REG_TEXT'][1] . ',</font> has been successfully created!';
                // Validation - Email
            case 'R-0x21':
                return 'Verification e-mail failed to send to the e-mail that you provided. Please contact an administrator for further assistance.';
            case 'R-0x22':
                return 'A verification email has been sent to <font class="b_i">' . $_SESSION['REG_TEXT'][9] . '</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.';
                // Resend
            case 'R-0x23':
                return 'A verification email has been resent to <font class="b_i">' . $_SESSION['REG_TEXT'][9] . '</font> with an activation key for the account <font class="b_i">' . $_SESSION['REG_TEXT'][1] . '</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>Still didn\'t receive the e-mail? Contact an administrator for further assistance.';
                // Validations
            case 'R-0x31':
                return 'Password must include at least one uppercase letter.';
            case 'R-0x32':
                return 'Password must include at least one number.';
            case 'R-0x33':
                return 'Password must include at least one special character.';
                // Misc
                //case 'M-0x01': return 'I see that you\'re new here. You must <strong>Register</strong> in order to view the rest of <font class="b_i">My Domain</font>.<br>If you already have an account, you can update it by clicking <strong><a href="javascript:;" class="open_acct_reset_modal" data-id="UserIP~'.$this->Browser->UserIP.'" data-target="#acct_reset_modal" data-toggle="modal">here</a></strong>'; break;
                //case 'M-0x02': return 'Welcome back, <strong>'.$this->User->UserID.'</strong>.<br>Please <strong>Log In</strong> and enjoy your stay here at <font class="b_i">'.Settings::SiteTitle().'</font>.'; break;
                // Direct Messages
            case 'DM-0x01':
                return 'Please enter a Character Name to send the message to.';
            case 'DM-0x02':
                return 'Please enter a Subject for the message.';
            case 'DM-0x03':
                return 'Please enter a Message.';
        }
    }

    // MISC
    private function props()
    {
        echo '<div class="col-md-12">';
        echo '<b>Properties for class (' . get_class($this) . '):</b><br>';
        echo '<pre>';
            print_r(get_object_vars($this));
        echo '</pre>';
        echo '</div>';
        exit();
    }

    private function methods()
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
