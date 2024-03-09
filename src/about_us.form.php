<?php
$title = "ABOUT US POST";
$need_global_form_style = true;
$style_path = '';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$error_message = '';

if (isset($_POST['add'])) {
    $title = trim(htmlspecialchars($_POST['title']));
    $description = trim(htmlspecialchars($_POST['description']));
    $image = $_FILES['image']['name'];
    $target_directory = '../images/about-us-images/';
    $target_file_path = $target_directory . $image;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file_path)) {
        $connection->add_about_us($_POST, $target_file_path);
        header("Location: ./about_us.php");
        exit();
    } else $error_message = "Failed to upload the photo";
}


?>

<main class="main">
    <div class="my_profile__container">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <h1 class="hero_title">Post new about us</h1>

            <div class="form-control">
                <span for="image">About us image</span>
                <input type="file" id="image" name="image" class="file-input" required />
            </div>
            <div class="form-control">
                <input type="text" id="title" name="title" maxlength="20" minlength="3" required />
                <label for="title">title</label>
            </div>
            <div class="form-control">
                <textarea type="description" required id="description" name="description" maxlength="511" minlength="40" cols="30" rows="10" required></textarea>

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