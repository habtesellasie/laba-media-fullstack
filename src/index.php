<?php

require_once './includes/index.header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$gallery_datas = $connection->get_datas('gallery');
$about_us_datas = $connection->get_datas('about_us');
$testimonials = $connection->get_datas('testimonials');
$login = $connection->get_datas('login');
$is_hiring = '';

foreach ($login as $needed_data) {
  $is_hiring = $needed_data['is_hiring'];
}


$why_us = '';
$vision = '';
$goal = '';
$more_about_us_datas = $connection->get_datas('more_about_us');
foreach ($more_about_us_datas as $datas) {
  $why_us = $datas['why_us'];
  $vision = $datas['vision'];
  $goal = $datas['goals'];
}

?>
<div class="marginer" style="margin-top: 4.6rem;"></div>
<header id="header" class="header">
  <h2 class="header__title"></h2>
  <section class="header__container">
    <div class="article">
      <article>
        <span class="counts" data-value="500">500</span>
        <p>Succeeded Projects</p>
      </article>
      <article>
        <span class="counts" data-value="3150">2321</span>
        <p>Happy Clients</p>
      </article>
      <article>
        <span class="counts" data-value="7100">7100</span>
        <p>Working Hours Spent</p>
      </article>
    </div>
    <!-- <div class="header__container--video" style="margin-bottom: 1rem;">
      <video src="../how ak 47 work.mp4" controls muted></video>
    </div> -->
  </section>

  <?php if (empty($gallery_datas)) : ?>
    <p style="padding-top: 20px; color: var(--clr-success); font-weight: bold;letter-spacing: 1.5;">No gallery images to show here</p>
  <?php else : ?>
    <section class="header__container">
      <!-- <h2 class="header__title-second">GALLERY</h2> -->
      <div class="header__container--holder">
        <button class="navigate-btn prev">
          <span class="first">
            < </span></button>
        <button class="navigate-btn next"> <span class="second">></span> </button>
        <div class="header__container--img">
          <?php foreach ($gallery_datas as $gallery) : ?>
            <img src="<?= $gallery['photo'] ?>" alt="<?= $gallery['description'] ?>" />
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif ?>

</header>
<main id="about" class="main">
  <h1 class="main__title">WHAT WE DO</h1>
  <section class="container">
    <?php foreach ($about_us_datas as $about_us) : ?>
      <div class="container__content">
        <div class="container__img-holder">
          <img src="<?= $about_us['image'] ?>" alt="<?= $about_us['title'] ?>" />
        </div>
        <div class="container__description">
          <h3 class="container__title"><?= $about_us['title'] ?></h3>
          <div class="container_more">
            <p><?= $about_us['description'] ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
  <section class="more-about-us">
    <section class="more-about-us__container">
      <div class="more-about-us__btns">
        <button class="tab-btn active" data-id="why_us">Why us</button>
        <button class="tab-btn" data-id="vision">Vision</button>
        <button class="tab-btn" data-id="goals">Goals</button>
        <!-- <button class="tab-btn" data-id="values">Values</button> -->
      </div>
      <div class="more-about-us__contents">
        <div class="more-about-us__content active-tab" id="why_us">
          <h4 class="more-about-us__title">Why Us?</h4>
          <br />
          <p class="more-about-us__description">
            <?= $why_us ?>
          </p>
        </div>
        <!-- end of single tab item -->
        <div class="more-about-us__content" id="vision">
          <h4 class="more-about-us__title">Vision</h4>
          <br />
          <p class="more-about-us__description">
            <?= $vision ?>
          </p>
        </div>
        <div class="more-about-us__content" id="goals">
          <h4 class="more-about-us__title">Goals</h4>
          <br />
          <p class="more-about-us__description">
            <?= $goal ?>
          </p>
        </div>
      </div>
    </section>
    <section id="testimonials" class="testimonials">
      <!-- <button class="testimonials-button prev-testimonials"> -->
      <!-- < </button> -->
      <!-- <button class="testimonials-button next-testimonials">></button> -->
      <?php foreach ($testimonials as $testimony) : ?>
        <div class="testimonials__container">
          <div class="testimonials__img-holder">
            <img src="<?= $testimony['photo'] ?>" alt="" />
          </div>
          <div class="testimonials__description--holder">
            <div class="testimonials__description">
              <p class="testimonials__name"><?= $testimony['name'] ?></p>
              <p class="testimonials__company">
                <span>From: </span><?= $testimony['company_name'] ?>
              </p>
              <br />
              <p class="testimonials__testimony">
                <?= $testimony['testimony'] ?>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </section>
  </section>
  <section class="hiring">
    <h2 class="hiring__title" <?= $is_hiring ? 'style="background: linear-gradient(to right, var(--clr-blue), var(--clr-gray)); background-clip: text;-webkit-background-clip: text;-moz-background-clip: text;"' : '' ?>><?= $is_hiring ? "We are hiring" : 'We are not currently hiring' ?></h2>
    <p <?= $is_hiring ? '' : 'style="opacity: .4; text-decoration: line-through"' ?>>For those of you who are looking for a job that is challenging in every aspect of content creating and making something out of nothing, we want to hire you.</p>
    <a href="<?= $is_hiring ? './hiring_page.php' : './index.php' ?>" <?= $is_hiring ? '' : 'style="background: gray; pointer-events: none;"' ?>>Apply</a>
  </section>
</main>

<?php require './includes/index.footer.php' ?>