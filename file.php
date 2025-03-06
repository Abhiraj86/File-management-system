<?php
$current_directory = isset($_GET['file']) ? $_GET['file'] : __DIR__; // Get current directory or default to script's directory

// Ensure directory exists
if (!is_dir($current_directory)) {
    die("Invalid directory.");
}

// Get files and folders inside the directory
$results = scandir($current_directory) ?: []; // Scan directory or return an empty array

// Function to convert file size into human-readable format
function convert_filesize($bytes, $decimals = 2)
{
    $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $sizes[$factor];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="file-manager">
        <h1>File Manager </h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <?php if ($result !== '.' && $result !== '..'): // Skip parent & current directory links ?>
                    <tr>
                        <td>
                            <?= is_dir("$current_directory/$result") ? '[Folder] ' : '' ?>
                            <a href="?file=<?= urlencode("$current_directory/$result") ?>">
                                <?= htmlspecialchars($result) ?>
                            </a>
                        </td>
                        <td>
                            <?= is_dir("$current_directory/$result") ? 'Folder' : convert_filesize(filesize("$current_directory/$result")) ?>
                        </td>
                        <td>
                            <a href="rename.php?file=<?= urlencode("$current_directory/$result") ?>">Rename</a> |
                            <a href="delete.php?file=<?= urlencode("$current_directory/$result") ?>" onclick="return confirm('Are you sure?')">Delete</a> |
                            <?php if (!is_dir("$current_directory/$result")): ?>
                                <a href="<?= "$current_directory/$result" ?>" download>Download</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="create-button" href="create.php?directory=<?= urlencode($current_directory) ?>">+ Create New</a>
    </div>
</body>

</html>
