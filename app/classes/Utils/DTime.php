<?php

namespace Classes\Utils;

class DTime
{
    private $ctime;
    private $input;
    public $output;

    public function __construct()
    {
        $this->currTime();
    }

    public function classInfo($level = false)
    {
        switch ($level) {
            case 1:
                return $this->props($level);
                break;
            case 2:
                return $this->methods($level);
                break;
        }
    }

    private function currTime()
    {
        $this->ctime = time();
    }

    public function time($time = false, $limiter = false)
    {
        if (empty($time)) {
            $this->input = $this->ctime;
            $limiter = '0';
        } else {
            $this->input = $time;
        }

        switch ($limiter) {
            case '0':
                return $this->timeToDateTime();
                break;
            case '1':
                return $this->timeToSeconds();
                break;
        }

        return $this->output;
    }

    public function timeToDateTime()
    {
        $this->timeToSeconds();
        $this->output = date('Y-m-d H:i:s', $this->output);
    }

    public function timeToSeconds()
    {
        $this->output = $this->input / 1000;
    }

    // Debugging
    public function props()
    {
        echo '<div class="col-md-12">';
        echo '<b>Properties for class (' . get_class($this) . '):</b><br>';
        echo '<pre>';
            print_r(get_object_vars($this));
        echo '</pre>';
        echo '</div>';
        exit();
    }

    public function methods()
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
