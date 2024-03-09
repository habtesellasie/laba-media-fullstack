<?php
$title = "MORE ABOUT US POST";
$need_global_form_style = true;
$style_path = '';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$error_message = '';

$more_about_us_datas = $connection->get_datas('more_about_us');
$why_us = '';
$vision = '';
$goal = '';
$id;

foreach ($more_about_us_datas as $datas) {
    $id = $datas['id'];
    $why_us = $datas['why_us'];
    $vision = $datas['vision'];
    $goal = $datas['goals'];
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $why_us = trim(htmlspecialchars($_POST['why_us']));
    $vision = trim(htmlspecialchars($_POST['vision']));
    $goal = trim(htmlspecialchars($_POST['goals']));


    if (!empty($why_us) && !empty($vision) && !empty($goal)) {
        $connection->update_more_about_us($id, $_POST);
        header("Location: ./admin.php");
        exit();
    } else $error_message = 'Please don\'t leave the fields empty';
}

?>

<main class="main">
    <div class="my_profile__container">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <h1 class="hero_title">Update more about us</h1>

            <div class="form-control">
                <textarea id="why_us" name="why_us" maxlength="1800" minlength="400" cols="30" rows="10"><?= $why_us ?></textarea>

                <label for="why_us">Why us</label>
            </div>
            <div class="form-control">
                <textarea id="vision" name="vision" maxlength="1800" minlength="400" cols="30" rows="10"><?= $vision ?></textarea>

                <label for="vision">Vision</label>
            </div>
            <div class="form-control">
                <textarea id="goals" name="goals" maxlength="1800" minlength="400" cols="30" rows="10"><?= $goal ?></textarea>
                <label for="goals">Goal</label>
            </div>
            <span class="error_message" style="color: var(--clr-warning); font-weight: bold;"><?= $error_message ?></span>
            <div class="form-control last-control" style="display: flex; gap: 10px;">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="submit" value="update" class="submit-btn" name="update" />
                <a href="./admin.php" style="width: 100%"><input type="button" value="Cancel" class="cancel-btn"></a>
            </div>

        </form>
    </div>


    <?php require './includes/footer.php'; ?>