<?php
$connection = require_once './connection.php';
$connection = new Connection('laba_media');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $specific_data = $connection->get_data_by_id($_POST['id'], 'hiring');

    $connection->delete_data($id, 'hiring');
}

header("Location: ./admin.php");
exit();
