<div class="register-container">
    <div class="register-box">
        <h1>Create Account</h1>
        <p class="subtitle">Join our community today</p>

        <?php if (isset($error) && $error): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success) && $success): ?>
            <div class="success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/blog/public/register">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required
                    placeholder="Choose a username"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required
                    placeholder="Enter your email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required
                        placeholder="Create password">
                    <div class="password-requirements">At least 6 characters</div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
                        placeholder="Confirm password">
                </div>
            </div>

            <button type="submit" class="btn">Create Account</button>
        </form>

        <div class="links">
            <p>Already have an account?
                <a href="/blog/public/login">Login here</a>
            </p>
        </div>
    </div>
</div>




<style>
    .register-container {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .register-box {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 10px;
        color: #333;
    }

    .subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    input:focus {
        outline: none;
        border-color: #3498db;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
    }

    .btn:hover {
        background: #2980b9;
    }

    .error {
        background: #ffebee;
        color: #c62828;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #ffcdd2;
    }

    .success {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c8e6c9;
    }

    .links {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .links a {
        color: #3498db;
        text-decoration: none;
    }

    .links a:hover {
        text-decoration: underline;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-row .form-group {
        flex: 1;
    }

    .password-requirements {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
</style>
<script>
    // Password confirmation check
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match!');
            return false;
        }

        if (password.length < 6) {
            e.preventDefault();
            alert('Password must be at least 6 characters long!');
            return false;
        }
    });
</script>