<?php

   namespace Classes\Utils;

    class Parser
    {
        private $jahr;
        private $monat;
        private $tag;
        private $datum;
        private $tage;
        private $days;
        private $sarray;
        private $i;
        private $return;
        private $dummy;

        public function do_date($time)
        {
            $tag = date('l', $time);
            $tage = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $days = ['/Monday/', '/Tuesday/', '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/'];
            $tag = preg_replace($days, $tage, $tag);
            $date = $tag . ', ' . date('m.d.Y - H:i:sA', $time);

            return $date;
        }

        public function lapis($gem)
        {
            if (!$this->gint($gem)) {
                throw new SystemException('The lapis must be an integer.', 0, 0, __FILE__, __LINE__);
            }
            if ($gem > 255) {
                throw new SystemException('Gem can not be larger than 255 characters.', 0, 0, __FILE__, __LINE__);
            }
            if ($gem < 10) {
                return '3000' . $gem;
            } elseif ($gem < 100) {
                return '300' . $gem;
            } else {
                return '30' . $gem;
            }
        }

        public function gint($int)
        {
            if (!preg_match('#^[0-9]*$#', $int)) {
                return false;
            } else {
                return true;
            }
        }

        public function validate($data)
        {
            if (!isset($data) || empty($data)) {
                return '';
            }
            if ($this->gint($data)) {
                return $data;
            }

            $non_displayables = ['/%0[0-8bcef]/', '/%1[0-9a-f]/', '/[\x00-\x08]/', '/\x0b/', '/\x0c/', '/[\x0e-\x1f]/'];

            foreach ($non_displayables as $regex) {
                $data = preg_replace($regex, '', $data);
            }

            $data = str_replace("'", "''", $data);

            return $data;
        }

        public function specialChars($data)
        {
            return preg_replace('/จน/', '', htmlspecialchars($data));
        }

        public function zahl($zahl)
        {
            if (count(explode('.', $zahl)) == 1) {
                return number_format($zahl, 0, ',', '.');
            } else {
                return number_format($zahl, 2, ',', '.');
            }
        }

        public function divi($zahl, $zahl2)
        {
            if ($zahl2 == 0) {
                return $this->zahl($zahl);
            } else {
                return $this->zahl($zahl / $zahl2);
            }
        }

        public function Zeitspanne($i)
        {
            $minuten = (int)$i / 60; //Brechstange ;o
            $i = $i - 60 * $minuten;

            return $minuten . ' Minutes and ' . $i . ' Seconds';
        }
    }
