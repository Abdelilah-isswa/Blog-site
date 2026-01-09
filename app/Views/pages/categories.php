
<div class="container">
    <div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0; color: #2c3e50;">Manage Categories</h1>
        <a href="/blog/public/categories/create" 
           style="background: #27ae60; color: white; border: none; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px;">
            <span style="font-size: 1.2rem;">+</span> New Category
        </a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" style="padding: 15px; margin-bottom: 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" style="padding: 15px; margin-bottom: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px;">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (!empty($categories)): ?>
        <div class="table-responsive" style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee; font-weight: bold; color: #2c3e50;">ID</th>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee; font-weight: bold; color: #2c3e50;">Name</th>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee; font-weight: bold; color: #2c3e50;">Description</th>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee; font-weight: bold; color: #2c3e50;">Articles</th>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee; font-weight: bold; color: #2c3e50;">Created</th>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee; font-weight: bold; color: #2c3e50;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr style="border-bottom: 1px solid #eee; transition: background 0.2s;">
                            <td style="padding: 15px;"><?= $category['categorie_id'] ?></td>
                            <td style="padding: 15px; font-weight: 500;"><?= htmlspecialchars($category['categorie_name']) ?></td>
                            <td style="padding: 15px; color: #666;"><?= htmlspecialchars($category['description'] ?? 'No description') ?></td>
                            <td style="padding: 15px;">
                                <span style="background: #3498db; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.85rem;">
                                    <?= $category['article_count'] ?> articles
                                </span>
                            </td>
                            <td style="padding: 15px; color: #666; font-size: 0.9rem;">
                                <?= date('M j, Y', strtotime($category['create_at'])) ?>
                            </td>
                            <td style="padding: 15px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="/blog/public/categories/edit?id=<?= $category['categorie_id'] ?>" 
                                       style="background: #3498db; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 0.9rem;">
                                        Edit
                                    </a>
                                    <a href="/blog/public/categories/delete?id=<?= $category['categorie_id'] ?>" 
                                       style="background: #e74c3c; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 0.9rem;">
                       
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state" style="text-align: center; padding: 50px 20px; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div style="font-size: 3rem; margin-bottom: 20px; color: #bdc3c7;">📂</div>
            <h3 style="margin: 0 0 10px 0; color: #2c3e50;">No Categories Found</h3>
            <p style="color: #7f8c8d; margin-bottom: 30px;">Get started by creating your first category!</p>
            <a href="/blog/public/categories/create" 
               style="background: #27ae60; color: white; border: none; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px;">
                <span style="font-size: 1.2rem;">+</span> Create First Category
            </a>
        </div>
    <?php endif; ?>
</div>