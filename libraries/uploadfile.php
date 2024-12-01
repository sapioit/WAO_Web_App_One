<?php
class UploadFile {
    public function add($directory, $file_path) {
        try {
            // Implement file upload logic here
            // Example: move uploaded file to the target directory
            if (move_uploaded_file($file_path, $directory . basename($file_path))) {
                echo 'File uploaded successfully!';
            } else {
                throw new Exception('File upload failed!');
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
