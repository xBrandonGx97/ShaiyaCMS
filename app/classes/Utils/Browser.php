<?php

   namespace Classes\Utils;

    class Browser
    {
        public $OS;
        public $Browser;
        public $UA;
        public $IP;
        public $IPv4;
        public $IPv6;
        public $data;

        // PUBLIC
        public function __construct()
        {
            $this->_UA();
            $this->_OS();
            $this->_Browser();
            $this->_IP();
        }

        public function _get_browser_info($data)
        {
            return $this->data;
        }

        // PRIVATE
        private function _UA()
        {
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $this->UA = $_SERVER['HTTP_USER_AGENT'];
            }
        }

        private function _OS()
        {
            $OS_Platform = 'Unknown OS Platform';
            $OS_Arr = [
                '/windows nt 10/i' => 'Windows 10',
                '/windows nt 6.3/i' => 'Windows 8.1',
                '/windows nt 6.2/i' => 'Windows 8',
                '/windows nt 6.1/i' => 'Windows 7',
                '/windows nt 6.0/i' => 'Windows Vista',
                '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
                '/windows nt 5.1/i' => 'Windows XP',
                '/windows xp/i' => 'Windows XP',
                '/windows nt 5.0/i' => 'Windows 2000',
                '/windows me/i' => 'Windows ME',
                '/win98/i' => 'Windows 98',
                '/win95/i' => 'Windows 95',
                '/win16/i' => 'Windows 3.11',
                '/macintosh|mac os x/i' => 'Mac OS X',
                '/mac_powerpc/i' => 'Mac OS 9',
                '/linux/i' => 'Linux',
                '/ubuntu/i' => 'Ubuntu',
                '/iphone/i' => 'iPhone',
                '/ipod/i' => 'iPod',
                '/ipad/i' => 'iPad',
                '/android/i' => 'Android',
                '/blackberry/i' => 'BlackBerry',
                '/webos/i' => 'Mobile',
                '/x11/i' => 'ChromeOS'
            ];

            foreach ($OS_Arr as $RegEx => $Value) {
                if (preg_match($RegEx, $this->UA)) {
                    $this->OS = $Value;
                }
            }
        }

        private function _Browser()
        {
            $Browser = 'Unknown Browser';
            $Browser_Arr = [
                '/msie/i' => 'Internet Explorer',
                '/firefox/i' => 'Firefox',
                '/safari/i' => 'Safari',
                '/chrome/i' => 'Chrome',
                '/edge/i' => 'Edge',
                '/opera/i' => 'Opera',
                '/netscape/i' => 'Netscape',
                '/maxthon/i' => 'Maxthon',
                '/konqueror/i' => 'Konqueror',
                '/mobile/i' => 'Handheld/Mobile Browser'
            ];

            foreach ($Browser_Arr as $RegEx => $Value) {
                if (preg_match($RegEx, $this->UA)) {
                    $this->Browser = $Value;
                }
            }
        }

        private function _IP()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $this->IP = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $this->IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (!empty($_SERVER['REMOTE_HOST'])) {
                $this->IP = $_SERVER['REMOTE_HOST'];
            } else {
                $this->IP = $_SERVER['REMOTE_ADDR'];
            }
        }

        public function _ipv4_ipv6($ipaddr)
        {
            $value = '';
            $mask = '';

            // Strip out the netmask, if there is one.
            $cx = strpos($ipaddr, '/');
            if ($cx) {
                $subnet = (int)(substr($ipaddr, $cx + 1));
                $ipaddr = substr($ipaddr, 0, $cx);
            } else {
                $subnet = null; // No netmask present
            }

            // Convert address to packed format
            $addr = inet_pton($ipaddr);

            // Let's display it as hexadecimal format
            foreach (str_split($addr) as $char) {
                $value .= str_pad(dechex(ord($char)), 2, '0', STR_PAD_LEFT) . ':';
            }

            // Convert the netmask
            if (is_integer($subnet)) {
                // Maximum netmask length = same as packed address
                $len = 8 * strlen($addr);
                if ($subnet > $len) {
                    $subnet = $len;
                }

                // Create a hex expression of the subnet mask
                $mask = str_repeat('f', $subnet >> 2);

                switch ($subnet & 3) {
                    case 3:$mask .= 'e';break;
                    case 2:$mask .= 'c';break;
                    case 1:$mask .= '8';break;
                }
                $mask = str_pad($mask, $len >> 2, '0');

                // Packed representation of netmask
                $mask = pack('H*', $mask);
            }

            // Display the netmask as hexadecimal
            foreach (str_split($mask)as$char) {
                $value .= str_pad(dechex(ord($char)), 2, '0', STR_PAD_LEFT);
            }

            return $value;
        }

        public function ipaddress_to_ipnumber($ipaddress)
        {
            $pton = @inet_pton($ipaddress);
            if (!$pton) {
                return false;
            }

            $number = '';
            foreach (unpack('C*', $pton)as$byte) {
                $number .= str_pad(decbin($byte), 8, '0', STR_PAD_LEFT);
            }

            return base_convert(ltrim($number, '0'), 2, 10);
        }

        // MISC
        public function _Props()
        {
            echo '<b>Browser Class => Display Properties:</b>';
            echo '<pre>';
            print_r(get_object_vars(__CLASS__));
            echo '</pre>';
        }
    }
