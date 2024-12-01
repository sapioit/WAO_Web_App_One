<?php
require_once(__DIR__ . '/libraries/index.php');
global $library;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $filePath = $_FILES['fileToUpload']['tmp_name'];
    $targetDirectory = '/files/';
    $targetRedirect = isset($_POST['target_redirect']) ? $_POST['target_redirect'] : 'add_post.php';

    try {
        load_library('upload_file');
        $uploadedFilePath = $library['upload_file']->upload([
            'image' => ['image/jpeg', 'image/png', 'image/gif'],
            'video' => ['video/mp4', 'video/webm', 'video/ogg'],
            'audio' => ['audio/mpeg', 'audio/ogg', 'audio/wav']
        ]);
        $relativeFilePath = ltrim($uploadedFilePath, '/');
        echo "Uploaded File Path: " . $uploadedFilePath . "<br>"; // Debug
        echo "Relative File Path: " . $relativeFilePath . "<br>"; // Debug
        if ($relativeFilePath) {
            header('Location: ' . $targetRedirect . '?file=' . urlencode($relativeFilePath));
        } else {
            throw new Exception('File upload failed.');
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
