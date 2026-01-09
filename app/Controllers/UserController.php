<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /blog/public/');
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
            header('Location: /blog/public/login');
            exit;
        }
        
        $hash = $user['user_password'] ?? '';
        $isValid = password_verify($password, $hash);
        
        if (!$isValid) {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: /blog/public/login');
            exit;
        }
        
      
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['user_role'];
        
        header('Location: /blog/public/');
        exit;
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /blog/public/login');
        exit;
    }
    

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /blog/public/');
            exit;
        }
        
        $this->view('register', [
            'title' => 'Register',
            'user' => null,
            'error' => $_SESSION['error'] ?? null,
            'success' => $_SESSION['success'] ?? null
        ]);
        
        unset($_SESSION['error'], $_SESSION['success']);
    }
    
    public function registerPost()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /blog/public/');
            exit;
        }
        
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
       
        $errors = [];
        
        if (empty($username)) {
            $errors[] = 'Username is required';
        } elseif (strlen($username) < 3) {
            $errors[] = 'Username must be at least 3 characters';
        } else {
           
            if (User::findByUsername($username)) {
                $errors[] = 'Username already taken';
            }
        }
        
        if (empty($email)) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        } else {
            
            if (User::findByEmail($email)) {
                $errors[] = 'Email already registered';
            }
        }
        
        if (empty($password)) {
            $errors[] = 'Password is required';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }
        
        if ($password !== $confirm_password) {
            $errors[] = 'Passwords do not match';
        }
        
       
        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            $_SESSION['old'] = [
                'username' => $username,
                'email' => $email
            ];
            header('Location: /blog/public/register');
            exit;
        }
        
      
        $result = User::create([
            'username' => $username,
            'email' => $email,
            'user_password' => password_hash($password, PASSWORD_DEFAULT),
            'user_role' => 'Reader',
            'create_at' => date('Y-m-d H:i:s')
        ]);
        
        if ($result) {
            $_SESSION['success'] = 'Registration successful! Please login.';
            unset($_SESSION['old']);
            header('Location: /blog/public/login');
            exit;
        } else {
            $_SESSION['error'] = 'Registration failed. Please try again.';
            header('Location: /blog/public/register');
            exit;
        }
    }




}