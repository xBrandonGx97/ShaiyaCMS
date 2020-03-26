<?php

namespace Classes\Exception;

use Classes\Utils\Parser as Parser;

class Exception
{
    private $codename = APP['title'];
    private $version = APP['version'];
    private $title = 'Fatal Error!';

    public function getStacktrace($exception)
    {
          $this->trace = $exception->getTraceAsString();

          return preg_replace('/\n/', '<br>', $this->trace);
    }

    public function handler($exception)
    {
        $this->parser = new Parser;
        #echo '<b>Fatal error</b>:  Uncaught exception \'' . get_class($exception) . '\' with message ';
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
            if (!$exception->getMessage()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $exception->getMessage() . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">File:</td>';
            if (!$exception->getFile()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $exception->getFile() . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Line:</td>';
            if (!$exception->getLine()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $exception->getLine() . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Severity Level:</td>';
            if (!$exception->getSeverity()) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $exception->getSeverity() . '</td>';
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
            echo $this->getStacktrace($exception);
            echo '</div>';
            echo '<div class="separator_15"></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</body>';
            echo '</html>';
    }
}
