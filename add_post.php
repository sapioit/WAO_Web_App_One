<?php
// Load the libraries
require_once(__DIR__ . '/libraries/index.php');

// Define allowed file types
$allowedTypes = [
    'image' => ['image/jpeg', 'image/png', 'image/gif'],
    'video' => ['video/mp4', 'video/webm', 'video/ogg'],
    'audio' => ['audio/mpeg', 'audio/ogg', 'audio/wav']
];

// Initialize the library array
global $library;
if (isset($library['upload_file']) && method_exists($library['upload_file'], 'upload')) {
    $uploadedFilePath = $library['upload_file']->upload($allowedTypes);
} else {
    $uploadedFilePath = null;
}

if ($uploadedFilePath) {
    echo "Uploaded File Path: " . $uploadedFilePath . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WAO - Web App One - File Upload</title>
</head>
<body>
    <h2>Upload a File</h2>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Select image to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif">
        <input type="hidden" name="uploadType" value="image">
        <input type="hidden" name="target_redirect" value="post.php">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Select video to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="video/mp4, video/webm, video/ogg">
        <input type="hidden" name="uploadType" value="video">
        <input type="hidden" name="target_redirect" value="post.php">
        <input type="submit" value="Upload Video" name="submit">
    </form>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Select audio to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="audio/mpeg, audio/ogg, audio/wav">
        <input type="hidden" name="uploadType" value="audio">
        <input type="hidden" name="target_redirect" value="post.php">
        <input type="submit" value="Upload Audio" name="submit">
    </form>

    <h2>Uploaded Files</h2>
    <ul>
        <?php
        // List all files in the /files/ directory
        $targetDirectory = __DIR__ . '/files/';
        $files = scandir($targetDirectory);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                echo '<li>' . htmlspecialchars($file) . '</li>';
            }
        }
        ?>
    </ul>
</body>
</html>
