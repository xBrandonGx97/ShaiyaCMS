<?php
use Classes\Utils\Auth;
use Classes\Utils\Data;
use Classes\Utils\Session;
use Classes\Utils\User;
use Illuminate\Database\Capsule\Manager as Eloquent;

class Auth_Controller extends CoreController
{
    /* Get Methods */

    public static function logout()
    {
        $data = [
            'pageData' => [
                'index' => 'index',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true
            ],
        ];
        Auth::logout();
    }

    /* Post Methods */

    public static function login()
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
                        $fet = Eloquent::table(table('WEB_PRESENCE') . ' as Web')
                            ->select(['[User].UserUID', 'Web.UserID', 'Web.Pw', 'Web.Email', '[User].Status'])
                            ->join(table('SH_USERDATA') . ' as  [User]', '[User].UserID', '=', 'Web.UserID')
                            ->where('Web.UserID', $UserName)
                            ->orWhere('Web.Email', $UserName)
                            ->get();
                        if ($fet) {
                            foreach ($fet as $userInfo) {
                                if (password_verify($Password, $userInfo->Pw)) {
                                    if ($userInfo->Status == 0 || $userInfo->Status == 16 || $userInfo->Status == 32 || $userInfo->Status == 48 || $userInfo->Status == 64 || $userInfo->Status == 80 || $userInfo->Status == 128) {
                                        Session::put('User', 'UserUID', $userInfo->UserUID);
                                        Session::put('User', 'UserID', $userInfo->UserID);
                                        Session::put('User', 'Status', $userInfo->Status);
                                        User::updateLoginStatus(1);
                                        $arr['errors'][] .= 'Login successful.<br>Loading your homepage now...';
                                        $LastPage = $_SERVER['HTTP_REFERER'];
                                        $arr['finished'] .= 'true';
                                    } else {
                                        $arr['errors'][] .= '6';
                                    }
                                } else {
                                    $arr['errors'][] .= '4';
                                }
                            }
                        } else {
                            $arr['errors'][] .= '5';
                        }
                    }
                    echo json_encode($arr);
                }
            }
        }
    }
}
