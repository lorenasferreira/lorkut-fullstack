<?php

function addFeed($conn, $type, $user_id, $payload, $created_at = null)
{
    $json = json_encode($payload, JSON_UNESCAPED_UNICODE);

    if ($created_at) {
        $stmt = $conn->prepare("
            INSERT INTO activity_feed (type, user_id, payload, created_at)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("siss", $type, $user_id, $json, $created_at);
    } else {
        $stmt = $conn->prepare("
            INSERT INTO activity_feed (type, user_id, payload)
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("sis", $type, $user_id, $json);
    }

    $stmt->execute();
    $stmt->close();
}
