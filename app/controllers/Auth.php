<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use Classes\Utils as Utils;
use Illuminate\Database\Capsule\Manager as Eloquent;
use Spatie\UrlSigner\MD5UrlSigner;

class Auth extends Controller
{
    private $arr = [];
    private $expiration = null;

    public function __construct(Utils\User $user, Utils\Session $session)
    {
        $this->session = $session;
        $this->auth = new Utils\Auth($this->session);
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
                $userName = isset($decoded['user']) ? $this->data->do('escData', trim($decoded['user'])) : false;
                $Password = isset($decoded['pw']) ? $this->data->do('escData', trim($decoded['pw'])) : false;
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
                        $fet = Eloquent::table(table('WEB_PRESENCE') . ' as Web')
                            ->select(['[User].UserUID', 'Web.UserID', 'Web.Pw', 'Web.Email', '[User].Status', 'Web.RestrictIP'])
                            ->join(table('SH_USERDATA') . ' as  [User]', '[User].UserID', '=', 'Web.UserID')
                            ->where('Web.UserID', $userName)
                            ->orWhere('Web.Email', $userName)
                            ->get();
                        if ($fet) {
                            foreach ($fet as $userInfo) {
                                if (password_verify($Password, $userInfo->Pw)) {
                                    if (!isset($_COOKIE['ua'])) {
                                        $this->arr['newDevice'] .= 'true';
                                        $mail = new \Classes\Sys\MailSys('gmail');
                                        $mail->addMailAddress('brandonjm033@gmail.com');
                                        $mail->sendMail('verifyNewDevice', 'xx');
                                    } else {
                                        if ($userInfo->RestrictIP !== null) {
                                            if ($userInfo->RestrictIP === $this->browser->IP) {
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

    public function signUrl()
    {
        $urlSigner = new MD5UrlSigner('random_monkey');
        $expiration = (new \DateTime)->modify('1 minute');
        $signedUrl = $urlSigner->sign('http://shaiyacms.local/auth/newDevice/verify/12', $expiration);
        $this->session->put('expiration', $signedUrl);
    }

    public function verifyNewDevice()
    {
        if (isset($_GET)) {
            if ($_GET['url']) {
                $this->signUrl();
                $expiration = $this->session->get('expiration');
                $urlSigner = new MD5UrlSigner('random_monkey');
                if ($urlSigner->validate($expiration)) {
                    // Set UA Cookie
                    $hour = time() + 10 * 365 * 24 * 60 * 60;
                    setcookie('ua', $this->browser->UA, $hour, '/', null, null, true);
                    echo 'new Device verified.';
                    //redirect('/', 2);
                } else {
                    echo 'This activation key has expired.';
                }
            }
        }
    }
}
