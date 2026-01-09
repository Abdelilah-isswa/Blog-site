<?php
// Add this CSS directly since external resources might not be loading
?>
<style>
    /* Basic reset and styling */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Header */
    .page-header {
        text-align: center;
        margin-bottom: 40px;
        padding: 30px 0;
    }

    .page-header h1 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .page-header p {
        color: #7f8c8d;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 20px;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    /* Layout */
    .main-layout {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }

    .articles-grid {
        flex: 1;
        min-width: 300px;
    }

    .sidebar {
        width: 300px;
    }

    /* Article Cards */
    .article-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    .card-content {
        padding: 25px;
    }

    .article-meta {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        color: #7f8c8d;
        font-size: 0.9rem;
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
        font-size: 1.5rem;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .article-title a {
        color: inherit;
        text-decoration: none;
    }

    .article-title a:hover {
        color: #3498db;
    }

    .article-excerpt {
        color: #555;
        margin-bottom: 20px;
        line-height: 1.7;
    }

    .article-stats {
        display: flex;
        gap: 20px;
        color: #7f8c8d;
        font-size: 0.9rem;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .article-stats span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .read-more {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
        display: inline-block;
        margin-left: auto;
    }

    /* Sidebar */
    .sidebar-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
        padding: 25px;
    }

    .sidebar-title {
        font-size: 1.3rem;
        color: #2c3e50;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #3498db;
    }

    /* Categories */
    .categories-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .category-tag {
        background: #e8f4fc;
        color: #3498db;
        padding: 8px 16px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .category-tag:hover {
        background: #3498db;
        color: white;
    }

    .category-count {
        background: #3498db;
        color: white;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.8rem;
        margin-left: 5px;
    }

    /* Trending */
    .trending-list {
        list-style: none;
    }

    .trending-item {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .trending-item:last-child {
        border-bottom: none;
    }

    .trending-item a {
        color: #2c3e50;
        text-decoration: none;
        display: block;
    }

    .trending-item a:hover {
        color: #3498db;
    }

    .trending-number {
        display: inline-block;
        width: 25px;
        height: 25px;
        background: #3498db;
        color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 25px;
        margin-right: 10px;
        font-size: 0.9rem;
    }

    /* Newsletter */
    .newsletter {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        text-align: center;
    }

    .newsletter-title {
        color: white;
        border-bottom-color: rgba(255, 255, 255, 0.3);
    }

    .newsletter p {
        margin-bottom: 20px;
        opacity: 0.9;
    }

    .email-input {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        margin-bottom: 10px;
        font-size: 1rem;
    }

    .btn-subscribe {
        background: white;
        color: #3498db;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        width: 100%;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-subscribe:hover {
        background: #f8f9fa;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 40px;
        list-style: none;
    }

    .page-link {
        padding: 10px 16px;
        background: white;
        color: #3498db;
        text-decoration: none;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }

    .page-link:hover {
        background: #3498db;
        color: white;
    }

    .page-link.active {
        background: #3498db;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-layout {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
        }

        .page-header h1 {
            font-size: 2rem;
        }
    }

    /* Icons fallback */
    .icon {
        display: inline-block;
        width: 16px;
        height: 16px;
        margin-right: 5px;
        background-color: #7f8c8d;
        position: relative;
    }

    .icon-comment::after {
        content: "💬";
        position: absolute;
        top: -3px;
        left: 0;
    }

    .icon-heart::after {
        content: "♥";
        position: absolute;
        top: -3px;
        left: 0;
        color: #e74c3c;
    }

    .icon-eye::after {
        content: "👁";
        position: absolute;
        top: -3px;
        left: 0;
    }
</style>

<div class="container">


    <div class="main-layout">
        <!-- Main Articles Column -->
        <div class="articles-grid">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="article-card">
                        <div class="card-content">
                            <!-- Article Meta -->
                            <div class="article-meta">
                                <div class="author-avatar">
                                    <?= strtoupper(substr($article['author_name'] ?? 'A', 0, 1)) ?>
                                </div>
                                <div>
                                    <strong><?= htmlspecialchars($article['author_name'] ?? 'Anonymous') ?></strong>
                                    <?php if (!empty($article['created_at'])): ?>
                                        · <?= date('M j, Y', strtotime($article['created_at'])) ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Article Title -->
                            <h2 class="article-title">
                                <a href="/blog/public/article?id=<?= $article['id'] ?>">
                                    <?= htmlspecialchars($article['title'] ?? 'Untitled Article') ?>
                                </a>
                            </h2>

                            <!-- Article Excerpt -->
                            <div class="article-excerpt">
                                <?= htmlspecialchars($article['excerpt'] ?? substr($article['content'] ?? '', 0, 200) . '...') ?>
                            </div>

                            <!-- Article Stats -->
                            <div class="article-stats">
                                <span>
                                    <span class="icon icon-comment"></span>
                                    <?= $article['comment_count'] ?? 0 ?> comments
                                </span>
                                <span>
                                    <span class="icon icon-heart"></span>
                                    <?= $article['like_count'] ?? 0 ?> likes
                                </span>
                                <span>
                                    <span class="icon icon-eye"></span>
                                    <?= $article['views'] ?? 0 ?> views
                                </span>

                                <a href="/blog/public/article?id=<?= $article['id'] ?? $article['article_id'] ?>" class="read-more">Read More →</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Pagination -->
                <ul class="pagination">
                    <li><a href="#" class="page-link">←</a></li>
                    <li><a href="#" class="page-link active">1</a></li>
                    <li><a href="#" class="page-link">2</a></li>
                    <li><a href="#" class="page-link">3</a></li>
                    <li><a href="#" class="page-link">→</a></li>
                </ul>

            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">📝</div>
                    <h2>No Articles Yet</h2>
                    <p>Be the first to share your knowledge and insights with the community.</p>
                    <a href="/blog/public/article/create" class="btn-primary">Create First Article</a>
                </div>
            <?php endif; ?>
        </div>

  
            
          
            <?php if (!empty($articles) && count($articles) > 2): ?>
                <div class="sidebar-card">
                    <h3 class="sidebar-title">Trending Now</h3>
                    <ul class="trending-list">
                        <?php
                        $trending = array_slice($articles, 0, 3);
                        foreach ($trending as $index => $trend): ?>
                            <li class="trending-item">
                                <a href="/article/<?= $trend['id'] ?? '' ?>">
                                    <span class="trending-number"><?= $index + 1 ?></span>
                                    <?= htmlspecialchars(substr($trend['title'] ?? '', 0, 50)) ?>...
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
  
        </div> 
    </div>
</div>