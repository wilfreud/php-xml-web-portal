<?php
// session_start();

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Simple authentication check (replace with your logic)
            if ($username === 'admin' && $password === 'admin') {
                $_SESSION['logged_in'] = true;
                ViewRenderer::render('index');
                return;
                // exit;
            } else {
                // Handle login failure
                ViewRenderer::render('login', ['error' => 'Invalid username or password']);
            }
        }
    }

    public function home()
    {
        ViewRenderer::render('index');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /tp-portail/login');
        exit;
    }
}
