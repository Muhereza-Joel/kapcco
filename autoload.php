<?php
function autoload($class_name)
{
    $prefix = 'kapcco\\';
    $base_dir = __DIR__ . '/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class_name, $len) !== 0) {
        return;
    }

    $relative_class_name = substr($class_name, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class_name) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoload');


?>