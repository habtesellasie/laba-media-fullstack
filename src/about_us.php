<?php

$title = "ABOUT US PAGE";
$need_global_form_style = false;
$style_path = '../styles/post-pages.css';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$about_us_datas = $connection->get_datas('about_us');

?>

<main class="main">
    <h1 class="hero_title">About us section</h1>
    <a href="./admin.php" class="go-back">
        < Go back</a>
            <div class="gallery-post__container">
                <?php if (empty($about_us_datas)) : ?>

                    <p class="warn-admin warn-admin-inner warn">About us posts you add appear here.....</p>

                <?php else : ?>
                    <?php foreach ($about_us_datas as $about_us_data) : ?>
                        <div class="content">

                            <div class="img-wrapper">
                                <img src="<?= $about_us_data['image'] ?>" alt="">
                            </div>
                            <div class="content__description">
                                <p class="title">title: <span><?php echo $about_us_data['title'] ?></span></p>
                                <p class="description">description: <span><?= $about_us_data['description'] ?></span></p>
                            </div>
                            <div class="buttons">

                                <form action="./about_us_update.form.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $about_us_data['id'] ?>">
                                    <input type="submit" value="Update" class="submit-btn" name="update" />
                                </form>

                                <form action="./about_us_delete.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $about_us_data['id'] ?>">
                                    <input type="submit" value="Delete" name="delete" class="cancel-btn">
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
            <a href="./about_us.form.php" class="add">Add New</a>



            <?php require './includes/footer.php'; ?>