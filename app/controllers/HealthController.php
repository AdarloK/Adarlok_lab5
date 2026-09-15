<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class HealthController extends Controller
{
    public function index()
    {
        header('Content-Type: text/plain; charset=utf-8');

        try {
            $this->call->database();
            $this->call->db->raw('SELECT 1');
            echo "OK\n";
            echo 'database=' . (getenv('DB_NAME') ?: 'defaultdb') . "\n";
        } catch (Throwable $exception) {
            http_response_code(500);
            echo "DATABASE ERROR\n";
            echo $exception->getMessage() . "\n";
        }
    }
}