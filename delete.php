<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    if (is_dir($file)) {
        rmdir($file);
        echo "folder deleted successfully";
    } else {
        unlink($file);
        echo "file deleted successfully";
    }
    header("Location: index.php");
    exit;
} else {
    exit('Invalid Request!');
}
?>