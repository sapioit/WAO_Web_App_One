<?php
// Array to hold the libraries
$library = [];

// Function to load a library
function load_library($name) {
    global $library;
    if (isset($library[$name])) {
        require_once(__DIR__ . '/' . $library[$name]);
    } else {
        throw new Exception("Library '$name' not found.");
    }
}

// Scan the libraries directory and load files
foreach (scandir(__DIR__) as $file) {
    if ($file === 'index.php' || $file === 'db_connect.php' || $file === 'db.php') {
        continue; // Skip the index, db_connect, and db files
    }
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $library[pathinfo($file, PATHINFO_FILENAME)] = $file;
    }
}

// Load db.php first
require_once(__DIR__ . '/db.php');
