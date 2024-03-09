<?php

$title = "GALLERY PAGE";
$need_global_form_style = false;
$style_path = '../styles/post-pages.css';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$gallery_datas = $connection->get_datas('gallery');

?>

<main class="main">
    <h1 class="hero_title" style="text-align: center;">Gallery section</h1>
    <a href="./admin.php" style="color: var(--foreground); text-underline-offset: 5px; ">
        < Go back</a>
            <div class="gallery-post__container">
                <?php if (empty($gallery_datas)) : ?>

                    <p class="warn-admin warn-admin-inner warn">Gallery posts you add appear here.....</p>

                <?php else : ?>
                    <?php foreach ($gallery_datas as $gallery_data) : ?>
                        <div class="content" style="max-width: 286px;">

                            <div class=" img-wrapper" style="height: 250px;">
                                <img src="<?= $gallery_data['photo'] ?>" alt="" style="width: 250px; height: 250px; object-fit: cover;">
                            </div>
                            <p style="margin: 0;" class="description">description: <span class="<?= empty($gallery_data['description']) ? 'warn' : '' ?>"><?= empty($gallery_data['description']) ? 'Not provided' : $gallery_data['description'] ?></span></p>
                            <div class="buttons">

                                <form action="./gallery_update.form.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $gallery_data['id'] ?>">
                                    <input type="submit" value="Update" class="submit-btn" name="update" />
                                </form>

                                <form action="./gallery_delete.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $gallery_data['id'] ?>">
                                    <input type="submit" value="Delete" name="delete" class="cancel-btn">
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
            <a href="./gallery_post.form.php" class="add">Add New</a>



            <?php require './includes/footer.php'; ?>