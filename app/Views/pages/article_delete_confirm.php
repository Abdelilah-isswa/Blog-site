<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Delete Article') ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fa;
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .warning-icon {
            text-align: center;
            font-size: 4rem;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        
        .title {
            text-align: center;
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .subtitle {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        
        .article-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #e74c3c;
        }
        
        .article-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        
        .article-details {
            color: #666;
            font-size: 0.9rem;
        }
        
        .consequences {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-danger {
            background: #e74c3c;
            color: white;
            flex: 1;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
            flex: 1;
        }
        
        .btn-secondary:hover {
            background: #7f8c8d;
        }
        
        .countdown {
            text-align: center;
            margin-top: 20px;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        .countdown-number {
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning-icon">⚠️</div>
        <h1 class="title">Delete Article</h1>
        <p class="subtitle">This action cannot be undone. Please confirm you want to delete this article.</p>
        
        <div class="article-info">
            <div class="article-title">"<?= htmlspecialchars($article['title'] ?? 'Untitled Article') ?>"</div>
            <div class="article-details">
                <div>Author: <?= htmlspecialchars($user['name'] ?? 'Unknown') ?></div>
                <div>Created: 
                    <?php 
                    $created = $article['created_at'] ?? $article['creat_at'] ?? 'Unknown';
                    echo date('F j, Y', strtotime($created));
                    ?>
                </div>
                <div>ID: <?= $article['article_id'] ?? $article['id'] ?></div>
            </div>
        </div>
        
        <div class="consequences">
            <strong>⚠️ This will permanently delete:</strong>
            <ul style="margin-top: 10px; margin-left: 20px;">
                <li>The article content</li>
                <li>All comments on this article</li>
                <li>All likes on this article</li>
            </ul>
        </div>
        
        <form method="POST" action="/blog/public/article/delete?id=<?= $article['article_id'] ?? $article['id'] ?>">
            <input type="hidden" name="confirm" value="1">
            <div class="actions">
                <button type="button" onclick="window.location.href='/blog/public/article?id=<?= $article['article_id'] ?? $article['id'] ?>'" 
                        class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-danger" id="deleteBtn">Delete Permanently</button>
            </div>
        </form>
        
        <div class="countdown">
            <span id="countdownText">Button will be enabled in <span class="countdown-number" id="countdown">5</span> seconds</span>
        </div>
    </div>
    
    <script>
        // Countdown to prevent accidental deletion
        let countdown = 5;
        const deleteBtn = document.getElementById('deleteBtn');
        const countdownEl = document.getElementById('countdown');
        const countdownText = document.getElementById('countdownText');
        
        deleteBtn.disabled = true;
        deleteBtn.style.opacity = '0.5';
        deleteBtn.style.cursor = 'not-allowed';
        
        const countdownInterval = setInterval(() => {
            countdown--;
            countdownEl.textContent = countdown;
            
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                deleteBtn.disabled = false;
                deleteBtn.style.opacity = '1';
                deleteBtn.style.cursor = 'pointer';
                countdownText.innerHTML = '<span style="color: #27ae60;">✓ Ready to delete</span>';
            }
        }, 1000);
        
        // Double confirmation
        deleteBtn.addEventListener('click', function(e) {
            if (!confirm('FINAL WARNING: This will permanently delete the article and all associated data. Are you absolutely sure?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>