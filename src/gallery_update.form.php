<?php
$title = "UPDATE GALLERY";
$need_global_form_style = true;

$style_path = '';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$error_message = '';
$specific_data = '';


if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $specific_data = $connection->get_data_by_id($id, 'gallery');

    if (isset($_POST['update_gallery'])) {
        $description = isset($_POST['description']) ? trim(htmlspecialchars($_POST['description'])) : '';
        $photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';
        $photo_size = isset($_FILES['photo']['size']) ? $_FILES['photo']['size'] : '';
        $target_directory = '../images/gallery-images/';
        $target_file_path = $target_directory . $photo;

        $pdo = new PDO("mysql:server=localhost;dbname=laba_media", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($photo_size > 0) {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file_path)) {
                $statment = $pdo->prepare("UPDATE gallery SET photo = :photo WHERE id = :id");
                $statment->bindValue('id', $id);
                $statment->bindValue('photo', $target_file_path);
                $statment->execute();
            } else $error_message = 'Failed to upload the photo';
        }


        $connection->update_gallery($id, $_POST);
        header("Location: ./gallery_post.php");
        exit();
    }
}


?>

<main class="main">
    <h1 class="hero_title" style="text-align: center;">Update gallery section</h1>
    <div class="gallery-update__container">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <div class="img-wrapper">
                <img src="<?= $specific_data['photo'] ?>" alt="">
            </div>
            <div class="form-control">
                <span for="photo">Update Photo</span>
                <input type="file" id="photo" name="photo" class="file-input" />
            </div>
            <div class="form-control">
                <input type="text" id="description" name="description" maxlength="29" value="<?= isset($_POST['description']) ? $_POST['description'] : $specific_data['description'] ?>" />
                <label for="description">Description</label>
            </div>
            <span class="error_message"><?= $error_message ?></span>
            <div class="form-control last-control" style="display: flex; gap: 10px;">
                <input type="hidden" name="id" value="<?= $specific_data['id'] ?>">
                <input type="submit" value="Update" class="submit-btn" name="update_gallery" />
                <a href="./gallery_post.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
            </div>

        </form>
    </div>


    <?php require './includes/footer.php'; ?>