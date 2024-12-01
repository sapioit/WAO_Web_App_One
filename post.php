<?php
$uploadedFilePath = isset($_GET['file']) ? $_GET['file'] : '';

if (empty($uploadedFilePath)) {
    die('No file to display.');
}

$fileExtension = pathinfo($uploadedFilePath, PATHINFO_EXTENSION);
$baseUrl = 'http://localhost/wao/';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WAO - Web App One - Uploaded Content</title>
</head>
<body>
    <h2>Uploaded Content</h2>

    <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
        <img src="<?php echo htmlspecialchars($baseUrl . $uploadedFilePath); ?>" alt="Uploaded Image" style="max-width: 100%; height: auto;">
    <?php elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])): ?>
        <video controls style="max-width: 100%; height: auto;">
            <source src="<?php echo htmlspecialchars($baseUrl . $uploadedFilePath); ?>" type="video/<?php echo htmlspecialchars($fileExtension); ?>">
            Your browser does not support the video tag.
        </video>
    <?php elseif (in_array($fileExtension, ['mp3', 'ogg', 'wav'])): ?>
        <audio controls>
            <source src="<?php echo htmlspecialchars($baseUrl . $uploadedFilePath); ?>" type="audio/<?php echo htmlspecialchars($fileExtension); ?>">
            Your browser does not support the audio element.
        </audio>
    <?php else: ?>
        <p>Unsupported file type. <a href="<?php echo htmlspecialchars($baseUrl . $uploadedFilePath); ?>">Download file</a></p>
    <?php endif; ?>

    <p><a href="add_post.php">Upload another file</a></p>
</body>
</html>
