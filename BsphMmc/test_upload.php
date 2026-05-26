<?php
// Simple file upload test
echo "PHP Upload Settings:\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "max_input_time: " . ini_get('max_input_time') . "\n";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\nPOST Data:\n";
    var_dump($_POST);
    echo "\nFILES Data:\n";
    var_dump($_FILES);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Test</title>
</head>
<body>
    <h1>File Upload Test</h1>
    <form method="POST" enctype="multipart/form-data">
        <p>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*">
        </p>
        <p>
            <label>PDF:</label>
            <input type="file" name="pdf" accept="application/pdf">
        </p>
        <p>
            <input type="submit" value="Test Upload">
        </p>
    </form>
</body>
</html>