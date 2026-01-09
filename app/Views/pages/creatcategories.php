

<div class="container">
    <!-- Back button -->
    <div class="back-link" style="margin-bottom: 20px;">
        <a href="/blog/public/categories" class="btn btn-secondary">← Back to Categories</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><?= isset($category) ? 'Edit Category' : 'Create New Category' ?></h2>
        </div>
        
        <div class="card-body">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger" style="padding: 12px; margin-bottom: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px;">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" style="padding: 12px; margin-bottom: 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

           
            <form method="POST" action="<?= isset($category) ? '/blog/public/categories/update' : '/blog/public/categories/store' ?>" style="max-width: 600px;">
                
                <?php if (isset($category)): ?>
                    <input type="hidden" name="id" value="<?= $category['categorie_id'] ?>">
                <?php endif; ?>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="categorie_name" style="display: block; margin-bottom: 8px; font-weight: bold;">
                        Category Name *
                    </label>
                    <input type="text" 
                           id="categorie_name" 
                           name="categorie_name" 
                           required
                           value="<?= isset($category) ? htmlspecialchars($category['categorie_name']) : '' ?>"
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px;"
                           placeholder="Enter category name (e.g., Technology, Lifestyle, Education)">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="description" style="display: block; margin-bottom: 8px; font-weight: bold;">
                        Description (Optional)
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; resize: vertical;"
                              placeholder="Describe what this category is about..."><?= isset($category) ? htmlspecialchars($category['description'] ?? '') : '' ?></textarea>
                </div>

                <div class="form-actions" style="display: flex; gap: 10px; margin-top: 30px;">
                    <button type="submit" 
                            style="background: #3498db; color: white; border: none; padding: 12px 24px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">
                        <?= isset($category) ? 'Update Category' : 'Create Category' ?>
                    </button>
                    <a href="/blog/public/categories" 
                       style="background: #95a5a6; color: white; border: none; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-size: 16px; font-weight: bold; display: inline-flex; align-items: center;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        overflow: hidden;
    }
    
    .card-header {
        background: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .card-header h2 {
        margin: 0;
        color: #2c3e50;
    }
    
    .card-body {
        padding: 30px;
    }
    
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #95a5a6;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
    }
    
    button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s;
    }
</style>