<?php

namespace app\classes;

class Csrf
{
    private $length = 32;
    private $token;
    private $expiration_time = 3600;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token']) || $this->is_token_expired()) {
            $this->generate();
            $_SESSION['csrf_token'] = [
                'token' => $this->token,
                'expiration' => time() + $this->expiration_time
            ];
        } else {
            $this->token = $_SESSION['csrf_token']['token'];
        }

        session_write_close();
    }

    private function generate()
    {
        $this->token = bin2hex(random_bytes($this->length));
    }

    private function is_token_expired()
    {
        return isset($_SESSION['csrf_token']['expiration']) && $_SESSION['csrf_token']['expiration'] < time();
    }

    public static function validate($csrf_token)
    {
        $self = new self();

        if ($csrf_token !== $self->get_token()) {
            return false;
        }

        $self->generate();
        $_SESSION['csrf_token'] = [
            'token' => $self->token,
            'expiration' => time() + $self->expiration_time
        ];
        session_write_close();

        return true;
    }

    public function get_token()
    {
        return $this->token;
    }
}
