<?php
$title = "GALLERY POST";
$need_global_form_style = true;
$style_path = '';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$error_message = '';

if (isset($_POST['add'])) {
    $description = trim(htmlspecialchars($_POST['description']));
    $photo = $_FILES['photo']['name'];
    $target_directory = '../images/gallery-images/';
    $target_file_path = $target_directory . $photo;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file_path)) {
        $data = $connection->add_to_gallery($_POST, $target_file_path);
        header("Location: ./gallery_post.php");
    } else $error_message  = "Failed to upload the photo!";
}


?>

<main class="main">
    <div class="my_profile__container">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <h1 class="hero_title">Post new gallery</h1>
            <div class="form-control">
                <span for="photo">Gallery Photo</span>
                <input type="file" id="photo" name="photo" class="file-input" required />
            </div>
            <div class="form-control">
                <input type="description" id="description" name="description" maxlength="25" minlength="5" />
                <label for="description">Description</label>
            </div>
            <span class="error_message"><?php isset($error_message) ? $error_message : '' ?></span>
            <div class="form-control last-control" style="display: flex; gap: 10px;">
                <input type="submit" value="Add" class="submit-btn" name="add" />
                <a href="./admin.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
            </div>

        </form>
    </div>


    <?php require './includes/footer.php'; ?>