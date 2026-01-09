<!-- /var/www/html/blog/app/Views/pages/article_show.php -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.8;
        color: #333;
        background: #f9f9f9;
        padding: 20px;
    }
    
    .article-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .back-link {
        margin-bottom: 20px;
    }
    
    .back-link a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
    }
    
    .back-link a:hover {
        text-decoration: underline;
    }
    
    .article-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #eee;
    }
    
    .article-meta {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        color: #666;
    }
    
    .author-avatar {
        width: 40px;
        height: 40px;
        background: #3498db;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-weight: bold;
        font-size: 1.1rem;
    }
    
    .article-title {
        font-size: 2rem;
        color: #2c3e50;
        margin-bottom: 15px;
    }
    
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 30px;
    }
    
    .article-content p {
        margin-bottom: 1.5rem;
    }
    
    .article-stats {
        display: flex;
        gap: 20px;
        margin: 25px 0;
        padding: 20px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        color: #666;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .actions {
        margin: 25px 0;
        display: flex;
        gap: 15px;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        font-size: 1rem;
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
        border: 1px solid #ddd;
    }
    
    .btn-secondary:hover {
        background: #ddd;
    }
    
    .category-badge {
        display: inline-block;
        padding: 5px 15px;
        background: #e8f4fc;
        color: #3498db;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-left: 15px;
    }
    
    /* Comments Section */
    .comments-section {
        margin-top: 40px;
    }
    
    .comments-title {
        font-size: 1.5rem;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    
    .comment-form {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }
    
    .comment-form textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        margin-bottom: 12px;
        font-family: inherit;
        font-size: 1rem;
        resize: vertical;
        min-height: 100px;
    }
    
    .comments-list {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
    }
    
    .comment-item {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }
    
    .comment-item:last-child {
        border-bottom: none;
    }
    
    .comment-author {
        font-weight: bold;
        color: #2c3e50;
        margin-right: 10px;
    }
    
    .comment-date {
        color: #999;
        font-size: 0.9rem;
    }
    
    .comment-content {
        line-height: 1.6;
        color: #555;
        margin-top: 8px;
    }
    
    .empty-comments {
        text-align: center;
        padding: 30px;
        color: #999;
    }
</style>

<div class="article-container">
    <!-- Back button -->
    <div class="back-link">
        <a href="/blog/public">← Back to Articles</a>
    </div>
    
    <!-- Article Header -->
    <div class="article-header">
        <div class="article-meta">
            <div class="author-avatar">
                <?= strtoupper(substr($author['username'] ?? $author['name'] ?? 'A', 0, 1)) ?>
            </div>
            <div>
                <div style="font-weight: bold;"><?= htmlspecialchars($author['username'] ?? $author['name'] ?? 'Anonymous') ?></div>
                <div>
                    <?php if (!empty($article['created_at'])): ?>
                        Published: <?= date('F j, Y', strtotime($article['created_at'])) ?>
                    <?php endif; ?>
                    
                    
                </div>
            </div>
        </div>
        
        <h1 class="article-title"><?= htmlspecialchars($article['title'] ?? 'Untitled Article') ?></h1>
    </div>
    
    <!-- Article Content -->
    <div class="article-content">
        <?php 
        if (!empty($article['content'])) {
            $content = htmlspecialchars($article['content']);
            echo nl2br($content);
        } else {
            echo '<p>No content available for this article.</p>';
        }
        ?>
    </div>
    
    <!-- Article Stats -->
    <div class="article-stats">
     
        <div class="stat-item">
            <span>💬</span>
            <span><?= $commentCount ?> comments</span>
        </div>
        <div class="stat-item">
            <span>♥</span>
            <span><?= $likeCount ?> likes</span>
        </div>
    </div>
    
    <!-- Actions -->
    <div class="actions">
        
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['user_id'] == $article['author_id']): ?>
              <a href="/blog/public/article/edit?id=<?= htmlspecialchars($article['article_id'] ?? $article['id'] ?? '') ?>" class="btn btn-primary">✏️ Edit</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <!-- Comments Section -->
    <div class="comments-section">
        <h3 class="comments-title">Comments (<?= $commentCount ?>)</h3>
        
        <!-- Comment Form -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <form class="comment-form" method="POST" action="/blog/public/comment/create">
                <input type="hidden" name="article_id" value="<?= $article['article_id'] ?? $article['id'] ?>">
                <textarea name="content" placeholder="Add a comment..." required></textarea>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        <?php else: ?>
            <div class="comment-form">
                <p>Please <a href="/blog/public/login">login</a> to leave a comment.</p>
            </div>
        <?php endif; ?>
        <!-- Like Button -->
<div style="margin: 20px 0;">
    <form method="POST" action="/blog/public/like/toggle">
        <input type="hidden" name="article_id" value="<?= $article['article_id'] ?? $article['id'] ?>">
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($isLiked): ?>
                <button type="submit" style="
                    background: #e74c3c;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 6px;
                    cursor: pointer;
                    font-weight: bold;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                ">
                    <span style="font-size: 1.2rem;">❤️</span> 
                    Unlike (<?= $likeCount ?>)
                </button>
                <span style="margin-left: 10px; color: #27ae60; font-weight: 500;">
                    ✓ You liked this article
                </span>
            <?php else: ?>
                <button type="submit" style="
                    background: #ecf0f1;
                    color: #333;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 6px;
                    cursor: pointer;
                    font-weight: bold;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                ">
                    <span style="font-size: 1.2rem;">♡</span> 
                    Like (<?= $likeCount ?>)
                </button>
            <?php endif; ?>
        <?php else: ?>
            <a href="/blog/public/login" style="
                background: #ecf0f1;
                color: #333;
                border: none;
                padding: 10px 20px;
                border-radius: 6px;
                cursor: pointer;
                font-weight: bold;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            ">
                <span style="font-size: 1.2rem;">♡</span> 
                Like (<?= $likeCount ?>)
            </a>
            <span style="margin-left: 10px; color: #7f8c8d; font-size: 0.9rem;">
                Login to like this article
            </span>
        <?php endif; ?>
    </form>
</div>

<style>
    button[type="submit"]:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        transition: all 0.3s;
    }
</style>
        <!-- Comments List -->
<div class="comments-list">
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): 
            $currentUserId = $_SESSION['user_id'] ?? null;
            $currentUserRole = $_SESSION['user_role'] ?? 'Reader';
            $isCommentOwner = ($currentUserId == $comment['user_id']);
            $isAdmin = ($currentUserRole === 'Admin');
            $canEditDelete = ($currentUserId && ($isCommentOwner || $isAdmin));
        ?>
            <div class="comment-item" style="padding: 15px; margin-bottom: 15px; background: #f9f9f9; border-radius: 5px; border-left: 3px solid #3498db; position: relative;">
                <div>
                    <span class="comment-author" style="font-weight: bold; color: #2c3e50;">
                        <?= htmlspecialchars($comment['author_name'] ?? 'Anonymous') ?>
                    </span>
                    <span class="comment-date" style="font-size: 0.8rem; color: #7f8c8d; margin-left: 10px;">
                        <?php 
                        $commentDate = $comment['created_at'] ?? $comment['create_at'] ?? 'now';
                        echo date('M j, Y g:i a', strtotime($commentDate));
                        ?>
                    </span>
                </div>
                
                <!-- Display comment or edit form -->
                <?php if (isset($_SESSION['editing_comment_id']) && $_SESSION['editing_comment_id'] == $comment['comment_id'] && $canEditDelete): ?>
                    <!-- Edit Form -->
                    <form method="POST" action="/blog/public/comment/update" style="margin-top: 10px;">
                        <input type="hidden" name="id" value="<?= $comment['comment_id'] ?>">
                        <textarea name="content" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"><?= htmlspecialchars($comment['content'] ?? '') ?></textarea>
                        <div style="margin-top: 10px;">
                            <button type="submit" style="background: #2ecc71; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                                Save Changes
                            </button>
                            <a href="/blog/public/article?id=<?= $article['article_id'] ?? $article['id'] ?>" 
                               style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 4px; text-decoration: none; display: inline-block; margin-left: 10px; font-weight: bold;">
                                Cancel
                            </a>
                        </div>
                    </form>
                    <?php unset($_SESSION['editing_comment_id']); ?>
                <?php else: ?>
                    <!-- Display Comment Content -->
                    <div class="comment-content" style="margin-top: 8px; line-height: 1.5;">
                        <?= nl2br(htmlspecialchars($comment['content'] ?? '')) ?>
                    </div>
                    
                    <!-- Action buttons (only for comment owner or admin) -->
<?php if ($canEditDelete): ?>
    <div style="margin-top: 10px; display: flex; gap: 10px;">
        <!-- Edit button -->
        <a href="/blog/public/comment/edit?id=<?= $comment['comment_id'] ?>" 
           style="background: #3498db; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; font-size: 0.9rem;">
            ✏️ Edit
        </a>
        
        <!-- Delete link (CHANGED FROM FORM TO LINK) -->
        <a href="/blog/public/comment/delete?id=<?= $comment['comment_id'] ?>" 
           onclick="return confirm('Are you sure you want to delete this comment?')"
           style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; font-size: 0.9rem;">
            🗑️ Delete
        </a>
    </div>
<?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-comments" style="text-align: center; padding: 30px; color: #7f8c8d;">
            <p>No comments yet. Be the first to comment!</p>
        </div>
    <?php endif; ?>
</div>
    </div>
</div>