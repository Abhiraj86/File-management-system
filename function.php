<?php

function convert_filesize($bytes, $precision = 2) {
    $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    $pow = $bytes ? floor(log($bytes) / log(1024)) : 0;
    return round($bytes / (1024 ** $pow), $precision) . ' ' . $units[$pow];
}


function get_filetype_icon($file) {
    if (is_dir($file)) {
        return '<i class="fa-solid fa-folder"></i>';
    }
    $mime_type = mime_content_type($file);
    if (strpos($mime_type, 'image') !== false) {
        return '<i class="fa-solid fa-file-image"></i>';
    }
    if (strpos($mime_type, 'video') !== false) {
        return '<i class="fa-solid fa-file-video"></i>';
    }
    if (strpos($mime_type, 'audio') !== false) {
        return '<i class="fa-solid fa-file-audio"></i>';
    }
    return '<i class="fa-solid fa-file"></i>';
}
?>
