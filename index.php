<?php
// Load the libraries
require_once(__DIR__ . '/libraries/index.php');

$uploadedFilePath = isset($_GET['file']) ? $_GET['file'] : '';

// Ensure target directory exists
$targetDirectory = __DIR__ . '/files/';
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
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
        <label for="fileToUpload">Select file to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="hidden" name="target_redirect" value="index.php">
        <input type="submit" value="Upload File" name="submit">
    </form>

    <?php if (!empty($uploadedFilePath)): ?>
        <h3>Uploaded File:</h3>
        <p>File Path: <?php echo htmlspecialchars($uploadedFilePath); ?></p>
        <img src="<?php echo htmlspecialchars($uploadedFilePath); ?>" alt="Uploaded Image" style="max-width: 100%; height: auto;">
    <?php endif; ?>

    <h2>Uploaded Files</h2>
    <ul>
        <?php
        // List all files in the /files/ directory
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
