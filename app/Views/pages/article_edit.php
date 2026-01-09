<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Edit Article') ?></title>
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
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }

        .page-title {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #7f8c8d;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        textarea {
            min-height: 300px;
            resize: vertical;
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
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-secondary {
            background: #eee;
            color: #333;
        }

        .btn-secondary:hover {
            background: #ddd;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #eee;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .character-count {
            text-align: right;
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .back-link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .article-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .article-info span {
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
 

    <div class="container">
        <!-- Article Info -->
        <div class="article-info">
            <span><strong>Author:</strong> <?= htmlspecialchars($user['name'] ?? 'Unknown') ?></span>
            <span><strong>Created:</strong>
                <?php
                $created = $article['created_at'] ?? $article['creat_at'] ?? 'Unknown';
                echo date('F j, Y', strtotime($created));
                ?>
            </span>
            <span><strong>ID:</strong> <?= $article['article_id'] ?? $article['id'] ?></span>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['error']) && $_SESSION['error']): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success']) && $_SESSION['success']): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Edit Form -->
        <form method="POST" action="/blog/public/article/update">
            <input type="hidden" name="id" value="<?= $article['article_id'] ?? $article['id'] ?>">

            <div class="form-group">
                <label for="title">Article Title *</label>
                <input type="text" id="title" name="title" required
                    value="<?= htmlspecialchars($article['title'] ?? '') ?>"
                    maxlength="200">
                <div class="character-count" id="titleCount"><?= strlen($article['title'] ?? '') ?>/200 characters</div>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">No category</option>
                    <?php if (!empty($categories) && is_array($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['categorie_id'] ?? $category['id'] ?>"
                                <?= ($category['categorie_id'] ?? $category['id']) == ($article['categorie_id'] ?? null) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['categorie_name'] ?? $category['name'] ?? '') ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Article Content *</label>
                <textarea id="content" name="content" required
                    maxlength="10000"><?= htmlspecialchars($article['content'] ?? '') ?></textarea>
                <div class="character-count" id="contentCount"><?= strlen($article['content'] ?? '') ?>/10000 characters</div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                <a href="/blog/public/article?id=<?= $article['article_id'] ?? $article['id'] ?>" class="btn btn-secondary">Cancel</a>

              <?php if (($user['role'] ?? '') === 'Admin' || $_SESSION['user_id'] == $article['author_id']): ?>
    <a href="/blog/public/article/delete?id=<?= $article['article_id'] ?? $article['id'] ?>" 
       class="btn btn-danger"
       onclick="return confirm('Are you sure you want to delete this article? This action cannot be undone.')">
        🗑 Delete Article
    </a>
<?php endif; ?>
               
            </div>
        </form>
    </div>

   
</body>

</html>