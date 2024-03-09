<?php
$title = "UPDATE ABOUT US";
$need_global_form_style = true;

$style_path = '';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$error_message = '';
$specific_data = '';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $specific_data = $connection->get_data_by_id($id, 'about_us');

    if (isset($_POST['update_about_us'])) {
        $title = trim(htmlspecialchars($_POST['title']));
        $description = trim(htmlspecialchars($_POST['description']));
        $image = $_FILES['image']['name'];
        $target_directory = '../images/about-us-images/';
        $target_file_path = $target_directory . $image;

        $pdo = new PDO("mysql:server=localhost;dbname=laba_media", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_FILES['image']['size'] > 0) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file_path)) {

                $statment = $pdo->prepare('UPDATE about_us SET image = :image WHERE id = :id');
                $statment->bindValue('id', $id);
                $statment->bindValue('image', $target_file_path);
                $statment->execute();
            } else $error_message = "Failed to upload the image";
        }

        $connection->update_about_us($id, $_POST);
        header("Location: ./about_us.php");
        exit();
    }
}

?>

<main class="main">
    <div class="about-us__container">
        <h1 class="hero_title" style="text-align: center;">Update about us section</h1>
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <div class="img-wrapper">
                <img src="<?= isset($_POST['image']) ? $_POST['image'] : $specific_data['image'] ?>" alt="">
            </div>
            <div class="form-control">
                <span for="photo">Update About us image</span>
                <input type="file" id="image" name="image" class="file-input" />
            </div>
            <div class="form-control">
                <input type="text" name="title" value="<?= isset($_POST['title']) ? $_POST['title'] : $specific_data['title'] ?>" required>
                <label for="title">title</label>
            </div>
            <div class="form-control">
                <textarea id="description" name="description" maxlength="511" minlength="40" cols="30" rows="10" required><?= isset($_POST['description']) ? $_POST['description'] : $specific_data['description'] ?></textarea>
                <label for="description">Description</label>
            </div>
            <span class="error_message"><?php isset($error_message) ? $error_message : '' ?></span>
            <div class="form-control last-control" style="display: flex; gap: 10px;">
                <input type="hidden" name="id" value="<?= $specific_data['id'] ?>">
                <input type="submit" value="Update" class="submit-btn" name="update_about_us" />
                <a href="./about_us.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
            </div>

        </form>
    </div>


    <?php require './includes/footer.php'; ?>