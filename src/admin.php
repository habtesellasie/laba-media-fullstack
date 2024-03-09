<?php

$title = 'ADMIN PAGE';
$need_global_form_style = false;
$style_path = '../styles/admin.css';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$login = $connection->get_datas('login');
$profile_photo = '';
$is_hiring = '';

foreach ($login as $needed_data) {
  $profile_photo =  $needed_data['profile_picture'];
  $is_hiring = $needed_data['is_hiring'];
}

$gallery_datas = $connection->get_datas('gallery');
$about_us_datas = $connection->get_datas('about_us');
$testimonials = $connection->get_datas('testimonials');
$hiring_datas = $connection->get_datas('hiring');
$more_about_us_datas = $connection->get_datas('more_about_us');


?>
<header class="header">
  <div class="header__container">
    <div class="header__container-profile">
      <a href="./my_profile.php" class="my_profile-container">
        <div class="img-wrapper">
          <img src="<?php echo $profile_photo ?>" alt="" />
        </div>
        <span class="profile">Profile</span>
      </a>
    </div>
    <h1 class="header__container-title">Admin Dashboard</h1>
  </div>
  <a href="#hiring" style="position: absolute;
    text-decoration: none;
    color: var(--clr-white);
    top: 86px;
    left: 51px;
    font-size: 19px;
    z-index: 9;
    background: var(--clr-warning);
    width: 25px;
    height: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;"><?= sizeof($hiring_datas) ?></a>
</header>
<main class="main">

  <div class="modal">
    <button class="close-btn">
      <i class="fas fa-times" style="font-style: normal">X</i>
    </button>
    <div class="modal-content">
      <div class="btn-holder">
        <button class="prev-btn">
          <i class="fas fa-chevron-left" style="font-style: normal">
            < </i>
        </button>
        <button class="next-btn">
          <i class="fas fa-chevron-right" style="font-style: normal">></i>
        </button>
      </div>
      <img src="" alt="main image" class="main-img">
      <p class="image-description"></p>
      <div class="modal-images"></div>
    </div>
  </div>
  <div class="contained" style="display: flex; align-items: center; gap: 10px;">
    <h2 class="section__title">Hiring status</h2>
    <a href="./my_profile.php" <?php echo !$is_hiring ? 'style="color: var(--clr-warning); font-weight: bold; border: solid var(--foreground); padding: 4px 10px;"' : 'style="color: var(--clr-success); font-weight: bold; border: solid var(--foreground); padding: 4px 10px;"' ?>><?= $is_hiring ? 'HIRING' : "NOT HIRING" ?></a>
  </div>
  <div class="container" id="hiring">

    <?php if (!empty($hiring_datas)) : ?>
      <?php foreach ($hiring_datas as $hire_me) : ?>

        <div class="hiring__container">
          <a href="<?= $hire_me['cv'] ?>" download class="download">Download cv</a>
          <p>full name: <span><?= $hire_me['full_name'] ?></span></p>
          <p>gender: <span><?= $hire_me['gender'] ?></span></p>
          <p>phone number: <a style="color: var(--clr-blue); text-underline-offset: 2px;" href="tel:<?= $hire_me['phone_number'] ?>"><?= $hire_me['phone_number'] ?></a></p>
          <p>email: <a style="color: var(--clr-blue); text-underline-offset: 2px;" href="mailto:<?= $hire_me['email'] ?>"><?= $hire_me['email'] ?></a></p>
          <p>address: <span><?= $hire_me['address'] ?></span></p>
          <p>work time: <span><?= $hire_me['work_time'] ?></span></p>
          <p>role: <span><?= $hire_me['role'] ?></span></p>
          <p class="about">about: <span><?= $hire_me['about_you'] ?></span></p>
          <form action="hire_me-delete.php" method="POST">
            <input type="hidden" name="id" value="<?= $hire_me['id'] ?>">
            <input type="submit" name="delete" value="delete" class="delete">
          </form>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p style="color: var(--clr-warning) ;text-align: left;">No hiring data for now</p>
    <?php endif; ?>
  </div>



  <div class="gallery">
    <h1 class="section__title">Gallery Preview</h1>
    <div class="links">
      <a href="./gallery_post.form.php" class="link-to">Add new gallery post</a>
      <?php if (empty(!$gallery_datas)) : ?>
        <a href="./gallery_post.php" class="link-to">Update gallery posts</a>
      <?php else : ?>
        <p class="warn-admin">Gallery posts you add appear here.....</p>
      <?php endif; ?>
    </div>
    <div class="container">
      <?php foreach ($gallery_datas as $i => $gallery_data) : ?>
        <div class="content">
          <div class="img-wrapper">
            <img class="img" src="<?= $gallery_data['photo'] ?>" title="<?= $gallery_data['description'] ?>" data-id="<?= $i + 1 ?>">

          </div>
        </div>
      <?php endforeach; ?>
    </div>


  </div>

  <div class="about-us">
    <h1 class="section__title">About Us Preview</h1>

    <div class="links">
      <a href="./about_us.form.php" class="link-to">Post new about us</a>
      <?php if (empty(!$about_us_datas)) : ?>
        <a href="./about_us.php" class="link-to">Update about us posts</a>
      <?php else : ?>
        <p class="warn-admin">About us posts you add appear here.....</p>
      <?php endif; ?>
    </div>

    <div class="container">
      <?php foreach ($about_us_datas as $i => $about_us_data) : ?>
        <div class="content">
          <div class="img-wrapper">
            <img class="img" src="<?= $about_us_data['image'] ?>" title="<?= $about_us_data['description'] ?>" data-id="<?= $i + 1 ?>">
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <div class="more_about_us">
    <h1 class="section__title">More about us Preview</h1>
    <div class="links">
      <a href="./more_about_us.form.php" class="link-to">Update more about us post</a>
    </div>
    <div class="container more_about-us__container">
      <?php foreach ($more_about_us_datas as $i => $more_about_us) : ?>
        <div class="content" style="max-width: 450px; border: solid var(--foreground); padding: 1rem">
          <h3 style="margin-bottom: 1rem;">Why us</h3>
          <p style="font-size: clamp(16px, 3vw, 20px); line-height: var(--line-ht); letter-spacing: var(--letter-sp-para)"><?= $more_about_us['why_us'] ?></p>
        </div>
        <div class="content" style="max-width: 450px; border: solid var(--foreground); padding: 1rem">
          <h3 style="margin-bottom: 1rem;">Vision</h3>
          <p style="font-size: clamp(16px, 3vw, 20px); line-height: var(--line-ht); letter-spacing: var(--letter-sp-para)"><?= $more_about_us['vision'] ?></p>
        </div>
        <div class="content" style="max-width: 450px; border: solid var(--foreground); padding: 1rem">
          <h3 style="margin-bottom: 1rem;">Goal</h3>
          <p style="font-size: clamp(16px, 3vw, 20px); line-height: var(--line-ht); letter-spacing: var(--letter-sp-para)"><?= $more_about_us['goals'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="testimonial">
    <h1 class="section__title">Testimonial Preview</h1>
    <div class="links">

      <a href="./testimony_post.form.php" class="link-to">Post new Testimonial</a>
      <?php if (empty(!$testimonials)) : ?>
        <a href="./testimony_post.php" class="link-to">Update Testimonial Posts</a>
      <?php else : ?>
        <p class="warn-admin">Testimonial posts you add appear here.....</p>
      <?php endif; ?>
    </div>

    <div class="container">
      <?php foreach ($testimonials as $i => $testimony) : ?>
        <div class="content">
          <div class="img-wrapper">
            <img class="img" src="<?= $testimony['photo'] ?>" title="<?= $testimony['testimony'] ?>" data-id="<?= $i + 1 ?>">
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>


  <script src="../src/app/modalClass.js"></script>
  <?php require './includes/footer.php' ?>