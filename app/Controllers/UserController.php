<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /blog2/public/');
            exit;
        }
        
        $this->view('login', [
            'title' => 'Login',
            'user' => null,
            'error' => $_SESSION['error'] ?? null
        ]);
        
        unset($_SESSION['error']);
    }
    public function loginPost()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Find user
        $user = User::findByEmail($email);
        
        if (!$user) {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: /blog2/public/login');
            exit;
        }
        
        $hash = $user['user_password'] ?? '';
        $isValid = password_verify($password, $hash);
        
        if (!$isValid) {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: /blog2/public/login');
            exit;
        }
        
        // Set session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['user_role'];
        
        header('Location: /blog2/public/');
        exit;
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /blog2/public/login');
        exit;
    }
    





}