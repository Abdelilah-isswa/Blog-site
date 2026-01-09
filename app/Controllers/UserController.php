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







}