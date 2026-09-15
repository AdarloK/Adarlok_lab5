<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware extends Middleware
{
    public function handle($next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['authenticated'])) {
            return $next();
        }

        $_SESSION['auth_message'] = 'Please sign in to manage products.';
        redirect('login');
        exit;
    }
}
