<?php

   namespace Classes\Exception;

    use Classes\Utils\Parser as Parser;

    //	set_error_handler('exception_error_handler');

    class SystemException extends \ErrorException
    {
        private $trace;
        private $codename = APP['title'];
        private $version = APP['version'];

        public function __construct($message = '', $code = 0, $severity = 100, $filename = '', $lineno = 0)
        {
            parent::__construct($message, $code, $severity, $filename, $lineno);
            $this->parser = new Parser;
        }

        public function getStacktrace()
        {
            $this->trace = $this->getTraceAsString();

            return preg_replace('/\n/', '<br>', $this->trace);
        }

        public function __toString()
        {
            echo '<!DOCTYPE html>';
            echo '<html lang="en">';
            echo '<head>';
            echo '<title>'.$this->title.'</title>';

            echo '<link rel="stylesheet" type="text/css" href="/Resources/jQuery/Addons/Bootstrap/v4.3.1/css/bootstrap.css" media="all">';
            echo '<link rel="stylesheet" type="text/css" href="/Resources/Styles/Standard/CSS/master.css" media="all">';
            echo '</head>';

            echo '<body style="background-color:#000;">';
            echo '<div class="container text-white">';
            echo '<div class="row" style="background-color:#ff0000;">';
            echo '<div class="col-md-12 tac f_26 b_i">Fatal Error!</div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-md-12" style="background-color:#797676;">';
            echo '<div class="separator_15"></div>';
            echo '<div class="badge bg-dark w_100_p b_i f_20 tac b_i">CMS Info</div>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-sm text-white bg-black">';
            echo '<tr>';
            echo '<td class="col-2">PHP Version:</td>';
            echo '<td>' . PHP_VERSION . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">CMS CodeName:</td>';
            echo '<td>' . $this->codename . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">CMS Version:</td>';
            echo '<td>' . $this->version . '</td>';
            echo '</tr>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-md-12" style="background-color:#797676;">';
            echo '<div class="badge bg-dark w_100_p b_i f_20 tac b_i">Error Info</div>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-sm text-white bg-black">';
            echo '<tr>';
            echo '<td class="col-2">Error Date:</td>';
            echo '<td>' . $this->parser->do_date(time()) . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td class="col-2">Error Message:</td>';
            if (!$this->getMessage()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $this->getMessage() . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">File:</td>';
            if (!$this->getFile()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $this->getFile() . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Line:</td>';
            if (!$this->getLine()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $this->getLine() . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Severity Level:</td>';
            if (!$this->getSeverity()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $this->getSeverity() . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Request URI: </td>';
            if (!isset($_SERVER['REQUEST_URI'])) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . ($_SERVER['REQUEST_URI']) . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Referer: </td>';
            if (!isset($_SERVER['HTTP_REFERER'])) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $_SERVER['HTTP_REFERER'] . '</td>';
            }
            echo '</tr>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-md-12" style="background-color:#797676;">';
            echo '<div class="badge bg-dark w_100_p b_i f_20 tac b_i">Stack Trace</div>';
            echo '<div class="bg-black">';
            echo $this->getStacktrace();
            echo '</div>';
            echo '<div class="separator_15"></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</body>';
            echo '</html>';

            //	error_log("Error: [$errno] $errstr",1,"admin@ndf-innovations.net","From: support@ndf-innovations.net");
            exit;
        }

        public function do_SendMail($errno, $errstr)
        {
            error_log("Error: [$errno] $errstr", 1, 'admin@ndf-innovations.net', 'From: support@ndf-innovations.net');
        }

        public function Props()
        {
            echo '<b>Class=>Display Properties:</b> ';
            echo '<pre>';
            print_r(object_vars($this));
            echo '</pre>';
        }
    }
    function exception_error_handler($errno, $errstr, $errfile, $errline)
    {
        throw new SystemException($errstr, 0, $errno, $errfile, $errline);
    }
