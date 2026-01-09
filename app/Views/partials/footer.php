    <style>
 .site-footer {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 60px 0 30px;
            margin-top: 80px;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }
        
        .footer-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
        }
        
        .footer-links h4 {
            color: white;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #34495e;
            color: #95a5a6;
            font-size: 0.9rem;
        }

    </style>
    <footer class="site-footer">
        <div class="footer-container">
            <div>
                <div class="footer-logo">BlogSpace</div>
                <p style="color: #bdc3c7; line-height: 1.6;">A platform for sharing knowledge and connecting through articles.</p>
            </div>
            
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="/blog/public/">Home</a></li>
                    <li><a href="/blog/public/">Articles</a></li>
                    <li><a href="/blog/public/">Categories</a></li>
                    <li><a href="/blog/public/">About</a></li>
                </ul>
            </div>
            
            <div class="footer-links">
                <h4>Account</h4>
                <ul>
                    <?php if ($user): ?>
                        <li><a href="/blog/public/">My Profile</a></li>
                        <li><a href="/blog/public/">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/blog/public/">Login</a></li>
                        <li><a href="/blog/public/">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            &copy; <?= date('Y') ?> BlogSpace. All rights reserved.
        </div>
    </footer>