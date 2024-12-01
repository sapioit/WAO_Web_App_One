<?php
class UploadFile {
    public function add($directory, $file_path) {
        try {
            if (is_null($file_path) || !is_string($file_path) || $file_path === '') {
                throw new Exception('Invalid file path provided.');
            }

            // Ensure the target directory exists
            $targetDirectory = __DIR__ . '/../' . $directory;  // Adjust the path to be one directory above
            if (!file_exists($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);
            }

            // Get the original filename
            $originalName = basename($_FILES['fileToUpload']['name']);

            // Check and adjust the file extension
            $pathInfo = pathinfo($originalName);
            if (in_array($pathInfo['extension'], ['httaccess', 'php', 'js'])) {
                $originalName .= '.txt';
            }

            // Implement file upload logic here
            $targetPath = $targetDirectory . $originalName;
            if (move_uploaded_file($file_path, $targetPath)) {
                echo 'File uploaded successfully!';  // Output success message
                return $targetPath;  // Return the saved file path
            } else {
                throw new Exception('File upload failed!');
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
}
