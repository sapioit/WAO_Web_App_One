<?php
class upload_file__class {
    public function upload($allowedTypes) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
            $uploadType = $_POST['uploadType'];
            $allowedUploadTypes = $allowedTypes[$uploadType];
            $fileType = $_FILES['fileToUpload']['type'];

            echo "File Type: " . $fileType . "<br>"; // Debug
            echo "Allowed Types: " . implode(", ", $allowedUploadTypes) . "<br>"; // Debug

            if (in_array($fileType, $allowedUploadTypes)) {
                $filePath = $_FILES['fileToUpload']['tmp_name'];
                $targetDirectory = '/files/';
                $targetDirectoryFullPath = __DIR__ . '/../' . $targetDirectory;

                echo "File Path: " . $filePath . "<br>"; // Debug
                echo "Temporary File Name: " . $_FILES['fileToUpload']['tmp_name'] . "<br>"; // Debug

                if (!file_exists($targetDirectoryFullPath)) {
                    mkdir($targetDirectoryFullPath, 0777, true);
                    echo "Created target directory: " . $targetDirectoryFullPath . "<br>"; // Debug
                }

                $originalName = basename($_FILES['fileToUpload']['name']);
                echo "Original Name: " . $originalName . "<br>"; // Debug

                $targetPath = $targetDirectoryFullPath . $originalName;
                echo "Target Path: " . $targetPath . "<br>"; // Debug
                if (move_uploaded_file($filePath, $targetPath)) {
                    echo 'File uploaded successfully to: ' . $targetPath . '<br>'; // Debug
                    return $targetDirectory . $originalName;
                } else {
                    echo 'File upload failed! Check permissions and file size limits.'; // Debug
                    throw new Exception('File upload failed!');
                }
            } else {
                echo 'Unsupported file type. Please upload a valid image, video, or audio file.'; // Debug
            }
        }
        return null;
    }
}

// Automatically add the library to the global $library array
global $library;
$library['upload_file'] = new upload_file__class();
