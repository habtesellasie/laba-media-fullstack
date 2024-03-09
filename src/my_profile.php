<?php

$title = "MY PROFILE";
$need_global_form_style = true;
$style_path = '../styles/my_profile.css';
require './includes/header.php';
$connection = require_once "./connection.php";
$connection = new Connection('laba_media');
$login = $connection->get_datas('login');
$email = '';
$profile_picture = '';
$password = '';
$error_message = '';

foreach ($login as $login_data) {
    $profile_picture =  $login_data['profile_picture'];
    $email =  $login_data['email'];
    $password = $login_data['password'];
}

$pdo = new PDO("mysql:server=localhost;dbname=laba_media", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $profile_picture = $_FILES['profile_picture']['name'];
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $confirm_password = trim(htmlspecialchars($_POST['confirm_password']));
    $is_hiring = isset($_POST['is_hiring']) ? $_POST['is_hiring'] : 0;

    if ($is_hiring) {
        $is_hiring = 1;
    } else {
        $is_hiring = 0;
    }


    $target_directory = '../images/static-images/';
    $target_file_path = $target_directory . $profile_picture;
    $extention  = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);

    if ($_FILES['profile_picture']['size'] > 0) {
        if ($_FILES['profile_picture']['size'] < 1024 * 128) {
            if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file_path) && $password === $confirm_password) {
                    $statment = $pdo->prepare('UPDATE login SET profile_picture = :profile_picture, email = :email, is_hiring = :is_hiring, password = :password WHERE id = :id');
                    $statment->bindValue('id', $id);
                    $statment->bindValue('profile_picture', $target_file_path);
                    $statment->bindValue('email', $email);
                    $statment->bindValue('password', $password);
                    $statment->bindValue('is_hiring', $is_hiring);
                    $statment->execute();
                    header("Location: ./admin.php");
                    exit();
                } else $error_message = 'The password and confirm password do not match!';
            } else $error_message = 'Failed to Upload the photo';
        } else if (!in_array($extention, ['jpeg', 'png', 'jpg', 'HEIF', 'svg'])) {
            $error_message = 'Your profile picture file extention must be jpg, jpeg, png, HEIF, svg';
        } else $error_message = 'Please upload less than 128KB';
    } else {
        if ($password === $confirm_password) {
            $statment = $pdo->prepare('SELECT * FROM login WHERE id = :id');
            $statment->bindValue('id', $id);
            $statment->execute();
            $new_one = $statment->fetch(PDO::FETCH_ASSOC);
            $updated = $pdo->prepare("UPDATE login SET profile_picture = :profile_picture, email = :email, is_hiring = :is_hiring, password = :password WHERE id = :id ");
            $updated->bindValue('id', $id);
            $updated->bindValue('profile_picture', $new_one['profile_picture']);
            $updated->bindValue('email', $email);
            $updated->bindValue('password', $password);
            $updated->bindValue('is_hiring', $is_hiring);
            $updated->execute();
            header("Location: ./admin.php");
            exit();
        } else $error_message = "Password and confirm password do not match";
    }
}

?>

<main class="main">
    <div class="my_profile__container">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <?php foreach ($login as $updated_data) : ?>
                <div class="form-control">
                    <img src="<?= $updated_data['profile_picture'] ?>" alt="" style="width: 250px; height: 250px; object-fit: cover;">
                </div>
                <div class="form-control">
                    <span for="profile_picture">Update profile picture</span>
                    <input type="file" id="profile_picture" name="profile_picture" maxlength="20" class="file-input" />
                </div>
                <div class="radio-btn_control" style="margin-bottom: 1rem;">
                    <input type="checkbox" name="is_hiring" id="is_hiring" value="is_hiring" <?= $updated_data['is_hiring'] ? 'checked' : 'unchecked' ?> style="width: unset;"><label style="position: unset; pointer-events:unset;" for="is_hiring"><?= !$updated_data['is_hiring'] ? 'Turn on hiring page' : 'Turn off hiring page' ?></label>
                </div>
                <div class="form-control">
                    <input type="email" id="email" name="email" maxlength="40" minlength="5" required value="<?= isset($_POST['email']) ? $_POST['email'] : $updated_data['email'] ?>" />
                    <label for="email">Email</label>
                </div>
                <div class="form-control">
                    <input type="password" id="password" maxlength="16" minlength="8" name="password" required value="<?= isset($_POST['password']) ? $_POST['password'] : $updated_data['password'] ?>" />
                    <label for="password">Password</label>
                </div>
                <div class="form-control">
                    <input type="password" name="confirm_password" id="confirm_password" minlength="8" maxlength="16">
                    <label for="confirm_password">Confirm Password</label>
                </div>
                <span class="error_message" style="color: var(--clr-warning);"><?= isset($error_message) ? $error_message : '' ?></span>
                <div class="form-control last-control" style="display: flex; gap: 10px;">
                    <input type="hidden" name="id" value="<?= $updated_data['id'] ?>">
                    <input type="submit" value="Update" class="submit-btn" name="update" />
                    <a href="./admin.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
                </div>
            <?php endforeach; ?>
        </form>
    </div>


    <?php require './includes/footer.php'; ?>