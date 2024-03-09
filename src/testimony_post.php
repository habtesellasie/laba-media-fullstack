<?php

$title = "TESTIMONIALS PAGE";
$need_global_form_style = false;
$style_path = '../styles/post-pages.css';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$testimonials = $connection->get_datas('testimonials');

?>

<main class="main">
    <h1 class="hero_title">Testimonial section</h1>
    <a href="./admin.php" class="go-back">
        < Go back</a>
            <div class="gallery-post__container">
                <?php if (empty($testimonials)) : ?>
                    <p class="warn-admin warn-admin-inner warn">Testimonial posts you add appear here.....</p>
                <?php else : ?>
                    <?php foreach ($testimonials as $testimony) : ?>
                        <div class="content">

                            <div class="img-wrapper">
                                <img src="<?= $testimony['photo'] ?>" alt="">
                            </div>
                            <div class="content__description">
                                <p class="title">Name: <span><?php echo $testimony['name'] ?></span></p>
                                <p class="company_name">Company name: <span><?php echo $testimony['company_name'] ?></span></p>
                                <p class="description">Testimony: <span><?= $testimony['testimony'] ?></span></p>
                            </div>
                            <div class="buttons">

                                <form action="./testimony_update.form.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $testimony['id'] ?>">
                                    <input type="submit" value="Update" class="submit-btn" name="update" />
                                </form>

                                <form action="./testimony_delete.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $testimony['id'] ?>">
                                    <input type="submit" value="Delete" name="delete" class="cancel-btn">
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <a href="./testimony_post.form.php" class="add">Add New</a>



            <?php require './includes/footer.php'; ?>