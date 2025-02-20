<?php
function getImagePath(string $filename): ?string {
    $uploadDir = '/public/uploads/pictures/';
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDir . $filename;
    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    foreach ($extensions as $ext) {
        if (file_exists($fullPath . '.' . $ext)) {
            return $uploadDir . $filename . '.' . $ext;
        }
    }
    return null;
}
?>