<?php

namespace app\controllers\auth;

use app\controllers\Controller;
use app\controllers\auth\LoginController as session;
use app\classes\Render;
use app\models\user;
use app\classes\Redirect;


class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($params = null)
    {
        $response = [
            'ua' => session::sessionValidate() ?? ['sv' => false],
            'title' => "Account – Stockfull",
            'code' => 200
        ];
        Render::view('home/login', $response);
    }

    public function login()
    {
        $data = filter_input_array(sanitizeString(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS));
        $user = new user;

        if (!empty($data['email']) && !empty($data['password'])) {
            $stmt = $user
                ->select(['a.*, b.*'])
                ->join('userinfo b', 'a.id=b.userId')
                ->where([["a.email", $data['email']]])
                ->get();
            $userData = json_decode($stmt);

            if (count($userData) > 0) {
                if (password_verify($data['password'], $userData[0]->password)) {
                    echo $this->sessionStart($userData);
                } else {
                    self::sessionDestroy();
                }
            } else {
                self::sessionDestroy();
            }
        } else {
            self::sessionDestroy();
        }
    }

    private function sessionStart($data)
    {
        session_start();
        $_SESSION['sv'] = true;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['id'] = $data[0]->id;
        $_SESSION['account'] = $data[0]->account;
        $_SESSION['username'] = $data[0]->username;
        $_SESSION['email'] = $data[0]->email;
        $_SESSION['role'] = $data[0]->role;
        $_SESSION['profilePic'] = $data[0]->profilePic;
        session_write_close();
        return json_encode(["r" => true]);
    }

    public static function sessionValidate()
    {
        $user = new user;
        session_start();
        if (isset($_SESSION['sv']) && $_SESSION['sv'] == true) {
            $data = $_SESSION;
            $stmt = $user->where([["id", $data['id']]])
                ->get();
            if (count(json_decode($stmt)) > 0 && $data['ip'] == $_SERVER['REMOTE_ADDR']) {
                session_write_close();
                return ['sv' => $data['sv'], 'id' => $data['id'], 'account' => $data['account'], 'username' => $data['username'], 'email' => $data['email'], 'role' => $data['role'], 'profilePic' => $data['profilePic']];
            } else {
                session_write_close();
                self::sessionDestroy();
                return null;
            }
        }
        session_write_close();
        self::sessionDestroy();
        return null;
    }

    private static function sessionDestroy()
    {
        session_start();
        $_SESSION = [];
        $_SESSION['sv'] = false;
        session_destroy();
        session_write_close();
        return;
    }

    public function logout()
    {
        $this->sessionDestroy();
        Redirect::to('login');
        exit();
    }
}
