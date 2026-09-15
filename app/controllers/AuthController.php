<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function before_action()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function login()
    {
        if (!empty($_SESSION['authenticated'])) {
            redirect('products');
            return;
        }

        $message = $_SESSION['auth_message'] ?? null;
        unset($_SESSION['auth_message']);
        $this->call->view('login', ['message' => $message]);
    }

    public function authenticate()
    {
        $username = trim($_POST['username'] ?? '');
        $password = (string) ($_POST['password'] ?? '');
        $configured_username = getenv('ADMIN_USERNAME') ?: 'admin';
        $configured_hash = getenv('ADMIN_PASSWORD_HASH');
        $configured_password = getenv('ADMIN_PASSWORD');
        $valid_password = $configured_hash
            ? password_verify($password, $configured_hash)
            : ($configured_password !== false && $configured_password !== '' && hash_equals($configured_password, $password));

        if (hash_equals($configured_username, $username) && $valid_password) {
            session_regenerate_id(true);
            $_SESSION['authenticated'] = true;
            $_SESSION['auth_user'] = $username;
            redirect('products');
            return;
        }

        $_SESSION['auth_message'] = 'Invalid username or password.';
        redirect('login');
    }

    public function logout()
    {
        $_SESSION = [];
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        redirect('login');
    }
}
