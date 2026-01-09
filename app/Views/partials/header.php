<?php
// At the top of header.php, add:
if (!isset($user) && isset($_SESSION['user_id'])) {
    $user = [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['user_name'] ?? 'User',
        'name' => $_SESSION['user_name'] ?? 'User',
        'email' => $_SESSION['user_email'] ?? '',
        'role' => $_SESSION['user_role'] ?? 'Reader'
    ];
}
?>


<style>
    .site-header {
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 15px 0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .header-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        text-decoration: none;
    }

    .logo span {
        color: #3498db;
    }

    .nav-links {
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .nav-links a {
        color: #555;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-links a:hover {
        color: #3498db;
    }

    /* .btn {
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    } */
/* 
    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
        transform: translateY(-2px);
        COLOR:white;
    }

    .btn-outline {
        background: transparent;
        color: #3498db;
        border: 2px solid #3498db;
    } */

    /* .btn-outline:hover {
        background: #3498db;
        color: white;
    } */

    .user-menu {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
    }
</style>


<header class="site-header">
    <div class="header-container">
        <a href="/blog/public/" class="logo">Blog<span>Space</span></a>

        <div class="nav-links">
            <a href="/blog/public/">Home</a>



            <?php if ($user && ($user['role'] === 'Author')): ?>
                <a href="/blog/public/article/create" class="btn btn-outline">Write Article</a>
                <a href="/blog/public/articles/my"> My Articles</a>
            <?php endif; ?>


            <?php if (isset($user) && $user['role'] === 'Admin'): ?>
                <div style="margin: 20px 0; text-align: center;">
                    <a href="/blog/public/categories"
                        style="display: inline-flex; align-items: center; gap: 8px;  color: black; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        Manage Categories
                    </a>
                </div>
            <?php endif; ?>
            <?php if (isset($user) && !empty($user)): ?>
                <div class="user-menu">
                    <div class="user-avatar">
                        <?= strtoupper(substr($user['name'] ?? $user['username'] ?? 'U', 0, 1)) ?>
                    </div>
                    <span><?= htmlspecialchars($user['name'] ?? $user['username'] ?? 'User') ?></span>
                    <a href="/blog/public/logout" class="btn btn-outline" >Logout</a>
                </div>
            <?php else: ?>
                <a href="/blog/public/login" class="btn btn-outline">Login</a>
                <a href="/blog/public/register" class="btn btn-primary">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>
</header>