<?php
use Classes\Utils\Browser;
use Classes\Utils\Data;
use Classes\DB\MSSQL;
use Classes\Utils\Session;
use Classes\Utils\User;

class User_Controller extends CoreController
{
    /* Get Methods */

    public static function donate()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/donate', $data);
    }

    public static function donate_complete()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/donate_complete', $data);
    }

    public static function donate_process()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/donate_process', $data);
    }

    public static function friends()
    {
        $Friends = self::model('Friends');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'friends',
            'title' => 'Friends',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'Friends' => $Friends
        ];
        self::view('pages/cms/user/friends', $data);
    }

    public static function logout()
    {
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
        ];
        self::view('pages/cms/user/logout', $data);
    }

    public static function messages()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/messages', $data);
    }

    public static function profile()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/profile', $data);
    }

    public static function promotions()
    {
        $promotions = self::model('Promotions');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'promotions' => $promotions,
        ];
        self::view('pages/cms/user/promotions', $data);
    }

    public static function pvprewards()
    {
        $rewards = self::model('PvPRewards');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'Browser' => Browser::run(),
            'rewards' => $rewards,
        ];
        self::view('pages/cms/user/pvprewards', $data);
    }

    public static function referers()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/referers', $data);
    }

    public static function settings()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/settings', $data);
    }

    public static function support()
    {
        $support = self::model('Support');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'support' => $support,
        ];
        self::view('pages/cms/user/support', $data);
    }

    public static function user($id)
    {
        $userModel = self::model('User');
        $Friends = self::model('Friends');
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'userModel' => $userModel,
            'userID' => $id,
            'Friends' => $Friends
        ];
        self::view('pages/cms/user/user', $data);
    }

    public static function users()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/users', $data);
    }

    public static function vote()
    {
        $vote = self::model('Vote');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'vote' => $vote
        ];
        self::view('pages/cms/user/vote', $data);
    }

    /* Post Methods */

    public static function logoutPost()
    {
        //post to logout
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                // Declare Required Variables
                $UserName = isset($decoded['user']) ? Data::_do('escData', trim($decoded['user'])) : false;
                $Password = isset($decoded['pw']) ? Data::_do('escData', trim($decoded['pw'])) : false;
                $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
                // Error Checking
                $arr = [
                    'finished' => '',
                    'errors' => []
                ];
                if (isset($decoded['login'])) {
                    // Validate Username
                    if (empty($UserName)) {
                        $arr['errors'][] .= '1';
                    }
                    // Validate Password
                    if (empty($Password)) {
                        $arr['errors'][] .= '2';
                    } elseif (strlen($Password) < 3 || strlen($Password) > 16) {
                        $arr['errors'][] .= '3';
                    }
                    // If No Errors Continue
                    if (count($arr['errors']) == 0) {
                        // sql query
                        $userInfo = MSSQL::query()
                            ->select('[User].UserUID,Web.UserID,Web.Pw,Web.Email,[User].Status')
                            ->from('WEB_PRESENCE')
                            ->as('Web')
                            ->join('SH_USERDATA', '[User].UserID', 'Web.UserID', '[User]')
                            ->where('Web.UserID', ':userid')
                            ->where('Web.Email', ':email', 'OR')
                            ->bind(':userid', $UserName)
                            ->bind(':email', $UserName)
                            ->get('single');
                        if ($userInfo) {
                            if (password_verify($Password, $userInfo['Pw'])) {
                                if ($userInfo['Status'] == 0 || $userInfo['Status'] == 16 || $userInfo['Status'] == 32 || $userInfo['Status'] == 48 || $userInfo['Status'] == 64 || $userInfo['Status'] == 80 || $userInfo['Status'] == 128) {
                                    Session::put('User', 'UserUID', $userInfo['UserUID']);
                                    Session::put('User', 'UserID', $userInfo['UserID']);
                                    Session::put('User', 'Status', $userInfo['Status']);
                                    Session::updateLoginStatus(1);
                                    $arr['errors'][] .= 'Login successful.<br>Loading your homepage now...';
                                    $LastPage = $_SERVER['HTTP_REFERER'];
                                    $arr['finished'] .= 'true';
                                } else {
                                    $arr['errors'][] .= '6';
                                }
                            } else {
                                $arr['errors'][] .= '4';
                            }
                        } else {
                            $arr['errors'][] .= '5';
                        }
                    }
                    // Check Errors
                    if (count($arr['errors'])) {
                        //echo '<ul>';
                        foreach ($arr['errors'] as $error) {
                            //echo '<li>'.Data::_do('MessagesArr', $error).'</li><br>';
                        }
                        //echo '</ul>';
                    }
                    echo json_encode($arr);
                }
            }
        }
    }
}
