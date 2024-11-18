<?php

// Function to load .env file manually
function loadEnv($filePath) {
    // Check if the file exists
    if (!file_exists($filePath)) {
        throw new Exception('The .env file does not exist.');
    }

    // Read the file line by line
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Parse each line
    foreach ($lines as $line) {
        // Ignore comments (lines starting with #)
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Split key and value by the first '='
        [$key, $value] = explode('=', $line, 2);

        // Trim spaces and store the result in the $_ENV superglobal
        $key = trim($key);
        $value = trim($value);

        // Add to $_ENV or a custom array
        $_ENV[$key] = $value;
    }
    return $_ENV;
}
