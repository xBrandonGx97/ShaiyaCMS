<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use Classes\Utils as Utils;
use Illuminate\Database\Capsule\Manager as Eloquent;

class Auth extends Controller
{
    private $arr = [];

    public function __construct(Utils\User $user, Utils\Session $session)
    {
        $this->session = $session;
        $this->auth = new Utils\Auth($this->session);
        $this->data = new Utils\Data;
        $this->browser = new Utils\Browser;
        $this->data = new Utils\Data;
        $this->user = $user;
    }

    /* Get Methods */

    public function logout()
    {
        /* $data = [
            'pageData' => [
                'index' => 'index',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true
            ],
        ];
        Auth::logout(); */

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $arr = [
                    'loggedOut' => true
                ];

                $this->auth->logout();
            }
            echo json_encode($arr);
        }
    }

    /* Post Methods */

    public function login()
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
                $userName = isset($decoded['user']) ? $this->data->purify(trim($decoded['user'])) : false;
                $Password = isset($decoded['pw']) ? $this->data->purify(trim($decoded['pw'])) : false;
                $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
                // Error Checking
                $this->arr = [
                    'finished' => '',
                    'newDevice' => '',
                    'errors' => []
                ];
                if (isset($decoded['login'])) {
                    // Validate Username
                    if (empty($userName)) {
                        $this->arr['errors'][] .= '1';
                    }
                    // Validate Password
                    if (empty($Password)) {
                        $this->arr['errors'][] .= '2';
                    } elseif (strlen($Password) < 3 || strlen($Password) > 16) {
                        $this->arr['errors'][] .= '3';
                    }
                    // If No Errors Continue
                    if (count($this->arr['errors']) == 0) {
                        $fet = Eloquent::table(table('webPresence') . ' as Web')
                            ->select(['[User].UserUID', 'Web.UserID', 'Web.Pw', 'Web.Email', '[User].Status', 'Web.RestrictIP'])
                            ->join(table('shUserData') . ' as  [User]', '[User].UserID', '=', 'Web.UserID')
                            ->where('Web.UserID', $userName)
                            ->orWhere('Web.Email', $userName)
                            ->get();
                        if ($fet) {
                            foreach ($fet as $userInfo) {
                                if (password_verify($Password, $userInfo->Pw)) {
                                    if (!isset($_COOKIE['ua'])) {
                                        $this->arr['newDevice'] .= 'true';
                                        $this->sendActivationCode();
                                    } else {
                                        if ($userInfo->RestrictIP !== null) {
                                            if ($userInfo->RestrictIP === $this->browser->ip()) {
                                                // IP is same, continue
                                                $this->loginSuccess($userInfo);
                                            }
                                        } else {
                                            $this->loginSuccess($userInfo);
                                        }
                                    }
                                } else {
                                    $this->arr['errors'][] .= '4';
                                }
                            }
                        } else {
                            $this->arr['errors'][] .= '5';
                        }
                    }
                    echo json_encode($this->arr);
                }
            }
        }
    }

    public function loginSuccess($userInfo)
    {
        if ($userInfo->Status == 0 || $userInfo->Status == 16 || $userInfo->Status == 32 || $userInfo->Status == 48 || $userInfo->Status == 64 || $userInfo->Status == 80 || $userInfo->Status == 128) {
            $this->session->put('User', $userInfo->UserUID, 'UserUID');
            $this->session->put('User', $userInfo->UserID, 'UserID');
            $this->session->put('User', $userInfo->Status, 'Status');
            $this->user->updateLoginStatus(1);
            $this->arr['errors'][] .= 'Login successful.<br>Loading your homepage now...';
            $LastPage = $_SERVER['HTTP_REFERER'];
            $this->arr['finished'] .= 'true';
        /* // Set UA Cookie
        $hour = time() + 10 * 365 * 24 * 60 * 60;
        setcookie("ua", $this->browser->UA, $hour, "/", null, null, true); */
        } else {
            $this->arr['errors'][] .= '6';
        }
    }

    public function sendActivationCode()
    {
        $activationCode = $this->data->randStr('64');

        $query = Eloquent::table('ShaiyaCMS.dbo.ACTIVATION_CODES')
            ->insert([
                'ActivationCode' => $activationCode
            ]);

        $mail = new \Classes\Sys\MailSys('gmail');
        $mail->addMailAddress('brandonjm033@gmail.com');
        $mail->sendMail('verifyNewDevice', $activationCode);
    }

    public function verifyNewDevice()
    {
        $url = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
        $query = Eloquent::table('ShaiyaCMS.dbo.ACTIVATION_CODES')
                        ->select('ActivationCode', 'Date', 'Used')
                        ->where('ActivationCode', $url[4])
                        ->limit(1)
                        ->get();
        if (count($query) > 0) {
            foreach ($query as $verify) {
                $activationCode = $verify->ActivationCode;
                $date = $verify->Date;
                $used = $verify->Used;
                date_default_timezone_set('America/Chicago');
                $currentDate = new \Datetime('now');
                $dateToCheck = new \Datetime($date);
                $twelveHoursAgo = (new \Datetime("now"))->modify("-2 hour");
                if ($dateToCheck < $twelveHoursAgo) {
                    echo 'Activation Code has expired.';
                } else {
                    if ($used === '1') {
                        echo 'Activation Code has expired.';
                    } else {
                        // Set UA Cookie
                        $hour = time() + 10 * 365 * 24 * 60 * 60;
                        setcookie('ua', $this->browser->userAgent(), $hour, '/', null, null, true);
                        $updateActivation = Eloquent::table('ShaiyaCMS.dbo.ACTIVATION_CODES')
                        ->where('ActivationCode', $activationCode)
                        ->update(['Used' => 1]);
                        redirect('/', 3);
                        echo 'new Device verified.<br>';
                        echo 'Redirecting you in 3 seconds.';
                    }
                }
            }
        } else {
            echo 'Activation Code doesn\'t exist.';
        }
    }
}
