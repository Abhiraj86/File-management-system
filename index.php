<?php
$initial_directory = './Desktop/';
$current_directory = isset($_GET['file']) ? $_GET['file'] : $initial_directory;

$results = glob($current_directory . '*');


usort($results, function ($a, $b) {
    return is_dir($b) - is_dir($a);
    
});


function convert_filesize($bytes, $precision = 2)
{
    $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
    
}
?>

