<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Blog System'; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        nav {
            background: #333;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
        }
        nav a:hover {
            background: #555;
        }
        .debug-box {
            background: #f0f0f0;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <nav>
            <?php $baseUrl = isset($baseUrl) ? $baseUrl : '/blog_project'; ?>
            <a href="<?php echo $baseUrl; ?>/">Home</a>
            <a href="<?php echo $baseUrl; ?>/home/about">About</a>
            <a href="<?php echo $baseUrl; ?>/articles">Articles</a>
            <a href="<?php echo $baseUrl; ?>/home/test">Test</a>
            <a href="<?php echo $baseUrl; ?>/articles/show/5">Article 5</a>
        </nav>
        
        <!-- Page Content -->
        <?php echo $content; ?>
        
        <!-- Debug Info -->
        <div class="debug-box">
            <strong>Path Info:</strong><br>
            Project Folder: <?php echo dirname($_SERVER['SCRIPT_NAME']); ?><br>
            Base URL: <?php echo $baseUrl; ?>
        </div>
        
        <!-- Footer -->
        <footer style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd;">
            <p>&copy; <?php echo date('Y'); ?> MVC Blog System</p>
        </footer>
    </div>
</body>
</html>