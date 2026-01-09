<?php
// Simple and reliable autoloader
spl_autoload_register(function ($className) {
    // Debug
    if (APP_DEBUG) {
        error_log("Autoloader trying to load: $className");
    }
    
    // Convert namespace to file path
    $className = str_replace('\\', '/', $className);
    
    // Try different possible locations
    $locations = [
        // Try SRC first (most likely)
        SRC . '/' . $className . '.php',
        // Try CONTROLLERS directory
        CONTROLLERS . '/' . basename($className) . '.php',
        // Try MODELS directory  
        MODELS . '/' . basename($className) . '.php',
        // Try CORE directory
        CORE . '/' . basename($className) . '.php',
        // Try root
        ROOT . '/' . $className . '.php',
    ];
    
    foreach ($locations as $file) {
        if (file_exists($file)) {
            if (APP_DEBUG) {
                error_log("✓ Loading class from: $file");
            }
            require_once $file;
            return;
        }
    }
    
    // Debug output
    if (APP_DEBUG) {
        echo "<div style='background:#ffcccc; padding:20px; margin:20px; border:2px solid red;'>";
        echo "<h3>❌ AUTOLOADER ERROR</h3>";
        echo "<strong>Class not found:</strong> $className<br>";
        echo "<strong>Namespace:</strong> " . $className . "<br>";
        echo "<strong>Searched in:</strong><br>";
        foreach ($locations as $loc) {
            $exists = file_exists($loc) ? "✅ EXISTS" : "❌ NOT FOUND";
            echo "- $loc ($exists)<br>";
        }
        echo "<strong>Current directories:</strong><br>";
        echo "ROOT: " . ROOT . "<br>";
        echo "SRC: " . SRC . "<br>"; 
        echo "CONTROLLERS: " . CONTROLLERS . "<br>";
        echo "MODELS: " . MODELS . "<br>";
        echo "CORE: " . CORE . "<br>";
        echo "</div>";
    }
});
if (!function_exists('site_url')) {
    function site_url($path = '') {
        return '/blog/' . ltrim($path, '/');
    }
}
// Load helpers
if (file_exists(APP . '/helpers.php')) {
    require_once APP . '/helpers.php';
}
// Check if Database class exists, load it manually if needed
if (!class_exists('Core\Database') && file_exists(CORE . '/Database.php')) {
    require_once CORE . '/Database.php';
}
?>