<?php
require_once(__DIR__ . '/libraries/index.php');
global $library;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $filePath = $_FILES['fileToUpload']['tmp_name'];
    $targetDirectory = '/files/';
    $targetRedirect = isset($_POST['target_redirect']) ? $_POST['target_redirect'] : 'index.php';

    try {
        load_library('uploadfile');
        $upload = new UploadFile();
        $uploadedFilePath = $upload->add($targetDirectory, $filePath);
        // Remove leading slash from path for URL encoding
        $relativeFilePath = ltrim($uploadedFilePath, '/');
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        $relativeFilePath = '';
    }

    // Redirect to the target page with the path of the uploaded file
    if ($relativeFilePath) {
        header('Location: ' . $targetRedirect . '?file=' . urlencode($relativeFilePath));
    } else {
        header('Location: ' . $targetRedirect);
    }
    exit;
}
