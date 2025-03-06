<?php
if (isset($_GET['file'])) {
    if (isset($_POST['filename'])) {
        $oldName = $_GET['file'];
        $newName = dirname($oldName) . '/' . $_POST['filename'];
        rename($oldName, $newName);
        header("Location: index.php");
        exit;
    }
} else {
    exit('Invalid file!');
}
?>

<form method="post">
    <label>New Name:</label>
    <input type="text" name="filename" value="<?= basename($_GET['file']) ?>" required>
    <button type="submit">Rename</button>
</form>