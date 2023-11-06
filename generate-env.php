<?php
// Specify the path for the new .env file
$newEnvFilePath = __DIR__ . '/.env';

// Define the environment variables and their values
$envData = [
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3306',
    'DB_DATABASE' => 'kapcco_store_db',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'APP_NAME' => 'kapcco',
];

// Generate the contents for the new .env file
$envContents = '';
foreach ($envData as $key => $value) {
    $envContents .= "$key=$value\n";
}

// Write the contents to the new .env file
file_put_contents($newEnvFilePath, $envContents);

echo "New .env file generated successfully.\n";
