<?php

$title = 'HIRING PAGE';
$need_global_form_style = true;
$style_path = '../styles/hiring-part.css';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$error_message = '';

if (isset($_POST['apply'])) {
    $full_name = trim(htmlspecialchars($_POST['full_name']));
    $phone_number = trim(htmlspecialchars($_POST['phone_number']));
    $email = trim(htmlspecialchars($_POST['email']));
    $address = trim(htmlspecialchars($_POST['address']));
    $about_you = trim(htmlspecialchars($_POST['about_you']));
    $work_time = trim(htmlspecialchars($_POST['work_time']));
    $gender = trim(htmlspecialchars($_POST['gender']));
    $role = trim(htmlspecialchars($_POST['role']));
    $cv = $_FILES['cv']['name'];
    $target_directory = '../images/hiring/';
    $target_file_path = $target_directory . $cv;
    $extention = pathinfo($cv, PATHINFO_EXTENSION);

    if ($_FILES['cv']['size'] < 5 * 1024 * 1048) {
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $target_file_path)) {
            $connection->hire_me($_POST, $target_file_path);
            header("Location: ./index.php");
        } else $error_message = 'Faile to Upload the photo';
    } else if (!in_array($extention, ['jpg', 'jpeg', 'pdf'])) {
        $error_message = 'Your cv file should be a pdf';
    } else $error_message = 'You can\'t upload more than 5MB';
}





?>
<main class="main">

    <p class="warner">The application only takes about 5 minutes of your time</p>
    <form action="" method="POST" enctype="multipart/form-data">


        <div class="form-control">
            <input type="text" id="full_name" name="full_name" maxlength="30" required value="<?= isset($_POST['full_name']) ? $_POST['full_name'] : '' ?>" />
            <label for="full_name">Full name* </label>
        </div>
        <div class="form-control">
            <input type="tel" id="phone_number" maxlength="16" name="phone_number" required value="<?= isset($_POST['phone_number']) ? $_POST['phone_number'] : '' ?>" />
            <label for="phone_number">Phone no.* </label>
        </div>
        <div class="form-control">
            <input type="email" id="email" name="email" maxlength="40" required value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" />
            <label for="email">Email *</label>
        </div>
        <div class="form-control">
            <input type="address" id="address" name="address" maxlength="55" required value="<?= isset($_POST['address']) ? $_POST['address'] : '' ?>" />
            <label for="address">Your address *</label>
        </div>
        <!-- <div class="form-control">
            <input type="url" id="url" name="url" maxlength="50" />
            <label for="url">url here</label>
            <p style="padding-top: 15px;">Share us your tallent via youtube url / link (optional)</p>
        </div> -->
        <div class="form-control">
            <textarea name="about_you" id="about_you" rows="10" maxlength="450" minlength="120" required><?= isset($_POST['about_you']) ? $_POST['about_you'] : '' ?></textarea>
            <label for="about_you">Tell us About you *</label>
            <p style="padding-top: 15px; color: var(--clr-success)">Write an essay about yourself in less than 120 words</p>
        </div>
        <div class="form-control">
            <span for="name">Work time: </span>
            <select name="work_time" id="work_time">
                <option value="Full time" selected>Full time</option>
                <option value="part time">Part time</option>
            </select>
        </div>
        <div class="form-control">

            <div class="radio-btn_control">
                <label for="gender">Gender: </label>
                <label><input type="radio" name="gender" <?= isset($_POST['gender']) ? ($_POST['gender'] === 'male' ? 'checked' : '') : '' ?> value="male" id="male" required> Male</label>
                <label><input type="radio" name="gender" id="female" value="female" required <?= isset($_POST['gender']) ? ($_POST['gender'] === 'female' ? 'checked' : '') : '' ?>> Female</label>
            </div>
            <br>
            <div class="radio-btn_control">
                <label for="role">On what roll do you want to apply: </label>
                <label><input type="checkbox" name="role" required id="editor" value="editor"> Editor</label>
                <label><input type="checkbox" name="role" id="camera_man" value="camera_man"> Camera man</label>
                <label><input type="checkbox" name="role" id="graphics_designer" value="graphics_designer"> Graphics designer</label>
                <label><input type="checkbox" name="role" id="jornalist" value="jornalist"> Journalist</label>
            </div>
        </div>

        <div class="form-control">
            <span for="cv" style="padding-left: 10px;">Upload your CV</span>
            <input type="file" id="cv" name="cv" required style="border: none;" />
        </div>
        <p style="color: var(--clr-warning); font-weight: bold;" class="error"><?= $error_message ?></p>
        <div class="form-control last-control">
            <input type="submit" value="SEND" name="apply" class='submit-btn' />
            <a href="./index.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
        </div>
    </form>

    <script>
        setTimeout(() => {
            document.querySelector('.warner').style.display = 'none'
        }, 7000)
    </script>

    <?php require './includes/footer.php'; ?>