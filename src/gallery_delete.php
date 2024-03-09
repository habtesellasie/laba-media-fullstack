<?php
$connection = require_once './connection.php';
$connection = new Connection('laba_media');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $specific_data = $connection->get_data_by_id($_POST['id'], 'gallery');

    $connection->delete_data($id, 'gallery');
}

header('Location: ./gallery_post.php');
exit();
