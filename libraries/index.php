<?php
// Load db.php first
include_once(__DIR__ . '/db.php');

// Array to hold the libraries
$library = [];

// Function to load a library
function load_library($name) {
    global $library;
    if (isset($library[$name])) {
        include_once(__DIR__ . '/' . $library[$name]);
        $class_name = strtolower($name) . '__class'; // Dynamically generate class name
        if (class_exists($class_name)) {
            $library[$name] = new $class_name();
        } else {
            throw new Exception("Class '$class_name' not found in library '$name'.");
        }
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
        $libraryName = pathinfo($file, PATHINFO_FILENAME);
        $library[$libraryName] = $file;
    }
}
