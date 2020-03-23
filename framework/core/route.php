<?php

namespace Framework\Core;

    class Route
    {
        protected $base_path;
        protected $request_uri;
        protected $request_method;
        protected $http_methods = ['get', 'post', 'put', 'patch', 'delete'];
        protected $wild_cards = ['int' => '/^[0-9]+$/', 'any' => '/^[0-9A-Za-z]+$/'];
        public $Routes = [];
        public $Params = [];

        public function run($base_path = '')
        {
            $this->base_path = $base_path;

            // Remove query string and trim trailing slash
            $this->request_uri = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
            $this->request_method = $this->_determine_http_method();
        }

        private function _determine_http_method()
        {
            $method = strtolower($_SERVER['REQUEST_METHOD']);

            if (in_array($method, $this->http_methods)) {
                return $method;
            }
            return 'get';
        }

        public function respond($method, $route, $callable)
        {
            $method = strtolower($method);

            if ($route == '/') {
                $route = $this->base_path;
            } else {
                $route = $this->base_path . $route;
            }

            $matches = $this->_match_wild_cards($route);

            if (!isset($_GET['url'])) {
                $server = $_SERVER['REQUEST_URI'];
                if (($pos = strpos($server, '?')) !== false) {
                    $server = substr($server, 0, $pos);
                }
                if ($server == '/') {
                    //$url	=	explode('/',filter_var(rtrim($_SERVER['REQUEST_URI'],'/'),FILTER_SANITIZE_URL));
                    $url = explode('?', $_SERVER['REQUEST_URI'], 2);
                    if (is_array($matches) && $method == $this->request_method) {
                        // Routes match and request method matches
                        $this->Routes[] = $route;
                        call_user_func_array($callable, $matches);
                    }
                }
            } else {
                $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
                if (is_array($matches) && $method == $this->request_method) {
                    //var_dump(self::$Params);
                    // Routes match and request method matches
                    $this->Routes[] = $route;
                    call_user_func_array($callable, $matches);
                }
            }
        }

        private function _match_wild_cards($route)
        {
            $variables = [];

            $exp_request = explode('/', $this->request_uri);
            $exp_route = explode('/', $route);

            if (count($exp_request) == count($exp_route)) {
                foreach ($exp_route as $key => $value) {
                    if ($value == $exp_request[$key]) {
                        continue;   // So far the routes are matching
                    } elseif ($value[0] == '(' && substr($value, -1) == ')') {
                        $strip = str_replace(['(', ')'], '', $value);
                        $exp = explode(':', $strip);

                        if (array_key_exists($exp[0], $this->wild_cards)) {
                            $pattern = $this->wild_cards[$exp[0]];

                            if (preg_match($pattern, $exp_request[$key])) {
                                if (isset($exp[1])) {
                                    $variables[$exp[1]] = $exp_request[$key];
                                }
                                continue;   // We have a matching pattern
                            }
                        }
                    }
                    return false;  // There is a mis-match
                }
                $this->Params = $variables;
                return $variables;   // All segments match
            }
            return false;  // Catch anything else
        }

        public function get_query_string()
        {
            echo '1';
            $arr = explode('?', $_SERVER['REQUEST_URI']);
            if (count($arr) == 2) {
                echo  '?' . end($arr) . '<br>';
            }
        }

        public function checkRoute()
        {
            $uri = $_SERVER['REQUEST_URI'];
            $uri = rtrim($uri, '/');
            /*for($i = 0; $i < count($url); $i++) {
                if (strpos($url[$i], '?') !== false) {
                       // you found your item, use the $i index and break the loop
                     echo 'yes i found';
                }
            }*/
            //$query = parse_url($uri, PHP_URL_QUERY);
            /*parse_str($query, $params);
            $test = $params['test'];
            echo $query;*/
            //self::get_query_string();
            /*if( ($pos = strpos($uri, '?')) !== false) {
                $uri = substr($uri, 0, $pos);
                echo 'uri: '.$uri;
            }*/
            //$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
            //var_dump($uri_parts);
            //echo 'Routes:';
            //var_dump(self::$Routes);
            if ($this->Params) {
                $url = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
                $keys = array_search($this->Params['id'], $url);
                if ($this->Params['id'] !== $url[$keys]) {
                    // id not found
                    //abort(404);
                    //die("Invalid route.");
                }
            } else {
                if (!in_array(explode('?', $uri)[0], $this->Routes)) {
                    //var_dump($_GET);
                    //abort(404);
                    //die("Invalid route.");
                }
            }
        }

        public function urlToArray($url1, $url2)
        {
            //convert route and requested url to an array
            //remove empty values caused by slashes
            //and refresh the indexes of the array
            $a = array_values(array_filter(explode('/', $url1), function ($val) {
                return $val !== '';
            }));
            $b = array_values(array_filter(explode('/', $url2), function ($val) {
                return $val !== '';
            }));
        }

        public function checkStructure($url1, $url2)
        {
            list($a, $b) = $this->urlToArray($url1, $url2);
        }

        public function getUrlQuery($key)
        {
            $uri = $_SERVER['REQUEST_URI'];
            $query = parse_url($uri, PHP_URL_QUERY);
            if (isset($query)) {
                parse_str($query, $params);
                return $params[$key];
            }
            return null;
        }

        public function _Props($file = false, $line = false)
        {
            echo '<!DOCTYPE html>';
            echo '<html lang="en">';
            echo '<head>';
            echo '<title>' . get_called_class() . 'Props</title>';

            echo '<link rel="stylesheet" type="text/css" href="Resources/jQuery/Addons/Bootstrap/v4.3.1/css/bootstrap.css" media="all">';
            echo '<link rel="stylesheet" type="text/css" href="Resources/Styles/Standard/CSS/master.css" media="all">';
            echo '</head>';

            echo '<body style="background-color:#000;">';
            echo '<div class="container text-white">';

            echo '<div class="row" style="background-color:#0094ff;">';
            echo '<div class="col-md-12 tac f_26 b_i">';
            echo '<b>Properties for class (' . get_called_class() . ')</b><br>';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-md-12" style="background-color:#797676;">';
            echo '<div class="badge bg-dark w_100_p b_i f_20 tac b_i">Error Info</div>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-sm text-white bg-black">';
            echo '<tr>';
            echo '<td class="col-2">Request Date/Time:</td>';
            echo '<td>' . date('m/d/Y') . ' - ' . date('H:i:s') . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">File:</td>';
            if (!$file) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $file . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Line:</td>';
            if (!$line) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . $line . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Request URI:</td>';
            if (!isset($_SERVER['REQUEST_URI'])) {
                echo '<td>N/A</td>';
            } else {
                echo '<td>' . ($_SERVER['REQUEST_URI']) . '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td class="col-2">Referer:</td>';
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
            echo '<pre>';
            print_r(get_class_vars(get_called_class()));
            echo '</pre>';
            echo '</div>';
            echo '<div class="separator_15"></div>';
            echo '</div>';
            echo '</div>';

            echo '</div>';
            echo '</body>';
            echo '</html>';
            exit;
        }
    }
