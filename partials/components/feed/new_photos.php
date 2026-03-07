<?php addFeed($conn, "new_photos", 1, [
    "album_id" => $album_id,
    "album_title" => $title,
    "photos" => $photosArray
]);
?>