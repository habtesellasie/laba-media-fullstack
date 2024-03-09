<?php

$title = 'UPDATE TESTIMONIAL';
$need_global_form_style = true;
$style_path = '';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $specific_data = $connection->get_data_by_id($id, 'testimonials');

    if (isset($_POST['update_testimony'])) {
        $name = trim(htmlspecialchars($_POST['name']));
        $company_name = trim(htmlspecialchars($_POST['company_name']));
        $photo = $_FILES['photo']['name'];
        $target_directory = '../images/testimonial-images/';
        $target_file_path = $target_directory . $photo;

        $pdo = new PDO('mysql:server=localhost;dbname=laba_media', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_FILES['photo']['size'] > 0) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file_path)) {
                $statment = $pdo->prepare('UPDATE testimonials SET photo = :photo WHERE id = :id ');
                $statment->bindValue('id', $id);
                $statment->bindValue('photo', $target_file_path);
                $statment->execute();
            } else $error_message = "Failed to Upload the photo";
        }

        $connection->update_testimonial($id, $_POST);
        header("Location: ./testimony_post.php");
        exit();
    }
}

?>



<main class="main">
    <div class="about-us__container">
        <h1 class="hero_title" style="text-align: center;">Update about us section</h1>
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <div class="img-wrapper">
                <img src="<?= isset($_POST['photo']) ? $_POST['photo'] : $specific_data['photo'] ?>" alt="">
            </div>
            <div class="form-control">
                <span for="photo">Testimonial photo</span>
                <input type="file" id="photo" name="photo" class="file-input" />
            </div>
            <div class="form-control">
                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : $specific_data['name'] ?>" required>
                <label for="name">Name</label>
            </div>
            <div class="form-control">
                <input type="text" name="company_name" value="<?= isset($_POST['company_name']) ? $_POST['company_name'] : $specific_data['company_name'] ?>" required>
                <label for="company_name">Company name</label>
            </div>
            <div class="form-control">
                <textarea id="description" name="testimony" maxlength="511" minlength="40" cols="30" rows="10" required><?= isset($_POST['testimony']) ? $_POST['testimony'] : $specific_data['testimony'] ?></textarea>
                <label for="testimony">Testimony</label>
            </div>
            <span class="error_message"><?php isset($error_message) ? $error_message : '' ?></span>
            <div class="form-control last-control" style="display: flex; gap: 10px;">
                <input type="hidden" name="id" value="<?= $specific_data['id'] ?>">
                <input type="submit" value="Update" class="submit-btn" name="update_testimony" />
                <a href="./about_us.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
            </div>

        </form>
    </div>


    <?php require './includes/footer.php'; ?>