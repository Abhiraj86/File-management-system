<?php
if (isset($_GET['directory'])) {
    $dir = rtrim($_GET['directory'], '/') . '/'; // Ensure directory has a trailing slash

    if (isset($_POST['filename'], $_POST['type'])) {
        $name = trim($_POST['filename']); // Trim whitespace from filename
        $path = $dir . $name; // Full path

        if ($_POST['type'] == 'directory') {
            // Check if directory already exists
            if (!is_dir($path)) {
                mkdir($path);
                echo "folder created successfully";
            } else {
                echo "<p style='color:red;'>Folder already exists!</p>";
            }
        } else {
            // Check if file already exists
            if (!file_exists($path)) {
                file_put_contents($path, '');
                echo "file created successfully";
                
            } else {
                echo "<p style='color:red;'>File already exists!</p>";
            }
        }

        // Redirect after creation (ensure no output is sent before this)
        header("Location: index.php?file=" . urlencode($dir));
        exit;
    }
} else {
    exit('Invalid directory!');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create file/folder</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    

<form method="post">
    <label>Type:</label>
    <select name="type">
        <option value="directory">Folder</option>
        <option value="file">File</option>
    </select>
    <label>Name:</label>
    <input type="text" name="filename" required>
    <button name="submit" type="submit">Create</button>
</form>
</body>
</html>
