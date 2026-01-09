<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Create Article') ?></title>
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
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #3498db;
            text-decoration: none;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        .form-container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 1rem;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        textarea {
            min-height: 300px;
            resize: vertical;
            line-height: 1.6;
        }

        .excerpt-textarea {
            min-height: 150px;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(52, 152, 219, 0.3);
        }

        .btn-secondary {
            background: #ecf0f1;
            color: #2c3e50;
        }

        .btn-secondary:hover {
            background: #d5dbdb;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #eee;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }

        .alert-error {
            background: linear-gradient(135deg, #fed7d7, #feb2b2);
            color: #c53030;
            border-left: 4px solid #fc8181;
        }

        .alert-success {
            background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
            color: #276749;
            border-left: 4px solid #68d391;
        }

        .character-count {
            text-align: right;
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .form-hint {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-top: 5px;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            .page-title {
                font-size: 2rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>



    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Create New Article</h1>
            <p class="page-subtitle">Share your knowledge and ideas with the community</p>
        </div>


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


        <div class="form-container">
            <form method="POST" action="/blog/public/article/store" id="articleForm">

                <div style="display:none;">
                    <h3>Debug Categories:</h3>
                    <pre><?php print_r($categories ?? 'No categories variable'); ?></pre>
                </div>
                <div class="form-group">
                    <label for="title">Article Title *</label>
                    <input type="text" id="title" name="title" required
                        placeholder="Enter a compelling title for your article"
                        maxlength="200">
                    <div class="character-count" id="titleCount">0/200 characters</div>
                </div>

                <div style="display:none;">
                    <h4>Debug Categories:</h4>
                    <pre><?php
                            echo "Is categories set? " . (isset($categories) ? 'YES' : 'NO') . "\n";
                            echo "Type: " . gettype($categories) . "\n";
                            if (isset($categories) && is_array($categories)) {
                                echo "Count: " . count($categories) . "\n";
                                print_r($categories);
                            }
                            ?></pre>
                </div>

                <div class="form-group">
                    <label for="category_id">Category *</label>
                    <select id="category_id" name="category_id">
                        <option value="" required >Select a category</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['categorie_id'] ?>">
                                    <?= htmlspecialchars($category['categorie_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div class="form-hint">Helps readers find your article</div>
                </div>

                <!-- <div class="form-group">
                    <label for="excerpt">Short Excerpt (Optional)</label>
                    <textarea id="excerpt" name="excerpt" class="excerpt-textarea"
                              placeholder="Write a brief summary of your article (appears in article listings)"
                              maxlength="500"></textarea>
                    <div class="character-count" id="excerptCount">0/500 characters</div>
                    <div class="form-hint">If left empty, first 200 characters of content will be used</div>
                </div> -->

                <div class="form-group">
                    <label for="content">Article Content *</label>
                    <textarea id="content" name="content" required
                        placeholder="Write your article here... You can use Markdown or HTML for formatting"
                        maxlength="10000"></textarea>
                    <div class="character-count" id="contentCount">0/10000 characters</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span style="font-size: 1.2rem;"></span> Publish Article
                    </button>
                    <!-- <button type="button" id="saveDraft" class="btn btn-secondary">
                        Save as Draft
                    </button> -->
                    <a href="/blog/public/" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        //     document.getElementById('title').addEventListener('input', function() {
        //         document.getElementById('titleCount').textContent = 
        //             this.value.length + '/200 characters';
        //     });

        //     document.getElementById('excerpt').addEventListener('input', function() {
        //         document.getElementById('excerptCount').textContent = 
        //             this.value.length + '/500 characters';
        //     });

        //     document.getElementById('content').addEventListener('input', function() {
        //         document.getElementById('contentCount').textContent = 
        //             this.value.length + '/10000 characters';
        //     });


        //     document.getElementById('title').dispatchEvent(new Event('input'));
        //     document.getElementById('excerpt').dispatchEvent(new Event('input'));
        //     document.getElementById('content').dispatchEvent(new Event('input'));


        //     document.getElementById('saveDraft').addEventListener('click', function() {

        //         const draft = {
        //             title: document.getElementById('title').value,
        //             excerpt: document.getElementById('excerpt').value,
        //             content: document.getElementById('content').value,
        //             category_id: document.getElementById('category_id').value,
        //             savedAt: new Date().toLocaleString()
        //         };

        //         localStorage.setItem('articleDraft', JSON.stringify(draft));
        //         alert('Draft saved locally! You can continue later.');
        //     });


        //     window.addEventListener('load', function() {
        //         const draft = localStorage.getItem('articleDraft');
        //         if (draft) {
        //             if (confirm('You have a saved draft. Load it?')) {
        //                 const data = JSON.parse(draft);
        //                 document.getElementById('title').value = data.title || '';
        //                 document.getElementById('excerpt').value = data.excerpt || '';
        //                 document.getElementById('content').value = data.content || '';
        //                 document.getElementById('category_id').value = data.category_id || '';


        //                 document.getElementById('title').dispatchEvent(new Event('input'));
        //                 document.getElementById('excerpt').dispatchEvent(new Event('input'));
        //                 document.getElementById('content').dispatchEvent(new Event('input'));
        //             }
        //         }
        //     });


        //     document.getElementById('articleForm').addEventListener('submit', function() {
        //         localStorage.removeItem('articleDraft');
        //     });


        //     document.getElementById('content').addEventListener('blur', function() {
        //         const excerptField = document.getElementById('excerpt');
        //         if (!excerptField.value && this.value.length > 0) {
        //             excerptField.value = this.value.substring(0, 200);
        //             excerptField.dispatchEvent(new Event('input'));
        //         }
        //     });
        // 
    </script>
</body>

</html>