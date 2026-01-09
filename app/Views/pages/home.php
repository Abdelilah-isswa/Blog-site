<div class="container">
    <main>
        <!-- Hero Section -->
    <section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Welcome to BlogSpace</h1>
        <p class="hero-subtitle">Discover amazing articles, share your thoughts, and join our community.</p>
       
    </div>
</section>

        <!-- All Articles Grid -->
        <section class="articles-section">
            <div class="section-header">
                <h2 class="section-title">Latest Articles</h2>
                <div class="section-stats">
                    
                </div>
            </div>
            
            <?php if (!empty($articles)): ?>
                <div class="articles-grid">
                    <?php foreach ($articles as $article): ?>
                        <article class="article-card">
                            <div class="card-image" style="background: linear-gradient(135deg, #<?= substr(md5($article['title'] ?? ''), 0, 6) ?>, #3498db); height: 180px; border-radius: 10px 10px 0 0;"></div>
                            <div class="card-content">
                                <div class="card-category" style="margin-bottom: 10px;">
                                    <span class="category-tag"><?= $article['category_name'] ?? 'General' ?></span>
                                </div>
                                <h3 class="card-title">
                                    <a href="/blog/public/article?id=<?= $article['article_id'] ?? $article['id'] ?>">
                                        <?= htmlspecialchars($article['title'] ?? 'Untitled Article') ?>
                                    </a>
                                </h3>
                                <p class="card-excerpt">
                                    <?= htmlspecialchars(substr($article['content'] ?? $article['excerpt'] ?? 'No content available', 0, 120)) ?>...
                                </p>
                                
                                <div class="card-footer">
                                    <div class="author-info">
                                        <div class="author-avatar">
                                            <?= strtoupper(substr($article['author_name'] ?? 'A', 0, 1)) ?>
                                        </div>
                                        <div class="author-details">
                                            <div class="author-name"><?= htmlspecialchars($article['author_name'] ?? 'Anonymous') ?></div>
                                            <div class="article-date">
                                                <?php 
                                                $articleDate = $article['created_at'] ?? $article['creat_at'] ?? null;
                                                if ($articleDate): ?>
                                                    <?= date('M j, Y', strtotime($articleDate)) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="article-stats">
                                        <span class="stat">
                                            <span class="stat-icon">💬</span>
                                            <span class="stat-count"><?= $article['comment_count'] ?? 0 ?></span>
                                        </span>
                                        <span class="stat">
                                            <span class="stat-icon">❤️</span>
                                            <span class="stat-count"><?= $article['like_count'] ?? 0 ?></span>
                                        </span>
                                        <a href="/blog/public/article?id=<?= $article['article_id'] ?? $article['id'] ?>" class="read-more">
                                            Read →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">📝</div>
                    <h3>No Articles Yet</h3>
                    <p>Be the first to share your knowledge with the community!</p>
                    <?php if ($user && ($user['role'] === 'Author' || $user['role'] === 'Admin')): ?>
                        <a href="/blog/public/article/create" class="btn btn-primary">Write First Article</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
    
</div>


<style>
/* Grid Layout */
.articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.article-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.card-content {
    padding: 25px;
}

.card-category {
    margin-bottom: 12px;
}

.category-tag {
    display: inline-block;
    padding: 5px 12px;
    background: #eef5ff;
    color: #3498db;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.card-title {
    font-size: 1.3rem;
    line-height: 1.4;
    margin-bottom: 15px;
    color: #2c3e50;
}

.card-title a {
    color: inherit;
    text-decoration: none;
}

.card-title a:hover {
    color: #3498db;
}

.card-excerpt {
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.author-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.author-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
}

.author-details {
    display: flex;
    flex-direction: column;
}

.author-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.95rem;
}

.article-date {
    font-size: 0.85rem;
    color: #7f8c8d;
    margin-top: 2px;
}

.article-stats {
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #666;
    font-size: 0.9rem;
}

.stat-icon {
    font-size: 1rem;
}

.stat-count {
    font-weight: 500;
}

.read-more {
    color: #3498db;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 6px 12px;
    border: 2px solid #3498db;
    border-radius: 5px;
    transition: all 0.3s;
}

.read-more:hover {
    background: #3498db;
    color: white;
}




/* Responsive */
@media (max-width: 1100px) {
    .container {
        grid-template-columns: 1fr;
    }
    
    .sidebar {
        margin-top: 50px;
    }
}

@media (max-width: 768px) {
    .articles-grid {
        grid-template-columns: 1fr;
    }
    
    .card-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .article-stats {
        width: 100%;
        justify-content: space-between;
    }
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-top: 30px;
}

.empty-icon {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

/* Section Header */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #eee;
}

.section-stats {
    display: flex;
    gap: 20px;
    color: #7f8c8d;
    font-size: 0.95rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.no-data {
    text-align: center;
    color: #95a5a6;
    font-style: italic;
    padding: 20px;
}

.hero-section {
    background: linear-gradient(135deg, 
        #1e3c72 0%, 
        #2a5298 25%, 
        #3498db 50%, 
        #2980b9 75%, 
        #1c3d6d 100%);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    color: white;
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 60px;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 Z"/></svg>');
    background-size: cover;
    opacity: 0.1;
}

.hero-section::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -10%;
    right: -10%;
    height: 100px;
    background: white;
    transform: rotate(3deg);
    border-radius: 50%;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 1;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    background: linear-gradient(to right, #ffffff, #e3f2fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.hero-subtitle {
    font-size: 1.3rem;
    max-width: 600px;
    margin: 0 auto 40px;
    opacity: 0.9;
    line-height: 1.6;
    font-weight: 300;
}

.hero-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    padding: 16px 32px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    min-width: 180px;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: linear-gradient(135deg, #ffffff, #e3f2fd);
    color: #1e3c72;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.btn-primary:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, #e3f2fd, #ffffff);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

@keyframes gradientBG {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}


@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0;
        border-radius: 0 0 15px 15px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
        padding: 0 15px;
    }
    
    .btn {
        padding: 14px 28px;
        font-size: 1rem;
        min-width: 160px;
    }
    
    .hero-actions {
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .btn {
        width: 100%;
        max-width: 300px;
    }
}

/* Add some floating shapes */
.hero-section .shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    z-index: 0;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 10%;
    left: 10%;
    animation: float 6s ease-in-out infinite;
}

.shape-2 {
    width: 150px;
    height: 150px;
    bottom: 10%;
    right: 10%;
    animation: float 8s ease-in-out infinite reverse;
}

.shape-3 {
    width: 80px;
    height: 80px;
    top: 60%;
    left: 85%;
    animation: float 7s ease-in-out infinite;
}
</style>