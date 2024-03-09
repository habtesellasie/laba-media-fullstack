<?php

$title = 'TESTIMONIAL POST';
$need_global_form_style = true;
$style_path = '';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$error_message = '';
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

if (isset($_POST['add'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $company_name = trim(htmlspecialchars($_POST['company_name']));
    $photo = $_FILES['photo']['name'];
    $target_directory = '../images/testimonial-images/';
    $target_file_path = $target_directory . $photo;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file_path)) {
        $connection->add_testimonial($_POST, $target_file_path);
        header("Location: ./testimony_post.php");
        exit();
    } else $error_message = "Failed to upload the photo";
}

?>



<main class="main">
    <div class="my_profile__container">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <h1 class="hero_title">Post new Testimony</h1>

            <div class="form-control">
                <span for="photo">Photo</span>
                <input type="file" id="photo" name="photo" class="file-input" required />
            </div>
            <div class="form-control">
                <input type="text" id="name" name="name" maxlength="20" minlength="3" required />
                <label for="name">Name</label>
            </div>
            <div class="form-control">
                <input type="text" id="company_name" name="company_name" maxlength="20" minlength="3" required />
                <label for="company_name">Company name</label>
            </div>
            <div class="form-control">
                <textarea id="testimony" name="testimony" maxlength="511" minlength="40" cols="30" rows="10" required></textarea>

                <label for="testimony">Testimony</label>
            </div>
            <span class="error_message"><?php isset($error_message) ? $error_message : '' ?></span>
            <div class="form-control last-control" style="display: flex; gap: 10px;">
                <input type="submit" value="Add" class="submit-btn" name="add" />
                <a href="./admin.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
            </div>

        </form>
    </div>


    <?php require './includes/footer.php'; ?>