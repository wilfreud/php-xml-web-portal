<?php
// session_start();

class AuthController
{
    public function login()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Simple authentication check (replace with your logic)
            if ($username === 'admin' && $password === 'admin') {
                $_SESSION['logged_in'] = true;
                header('Location: /tp-portail/');
                // ViewRenderer::render('index', ['username' => $username]);
                return;
                // exit;
            } else {
                $error = 'Invalid username or password';
            }
        }
        // Handle login failure
        ViewRenderer::render('login', ['error' => $error]);
    }

    public function home()
    {
        // header('Location: /tp-portail/');
        ViewRenderer::render('index');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /tp-portail/login');
        exit;
    }
}
