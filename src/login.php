<?php
// echo "<br>";
$title = 'LOGIN PAGE';
$need_global_form_style = true;
$style_path = '../styles/login-form.css';
require './includes/header.php';
$connection = require_once './connection.php';
$connection = new Connection('laba_media');
$login_data = $connection->get_datas('login');
$actual_email = '';
$actual_password = '';
$error_message = '';


foreach ($login_data as $data) {
  $actual_email = $data['email'];
  $actual_password = $data['password'];
}

if (isset($_POST['login'])) {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  if ($email === $actual_email && $password === $actual_password) {
    header("Location: ./admin.php");
    exit();
  } else {
    $error_message = 'Email or Password did not match!';
  }
}

?>
<main class="main">
  <form action="" method="POST" class="form">
    <h2 class="form-title">LOGIN</h2>
    <div class="form-control">
      <input type="email" id="email" name="email" maxlength="34" required value="<?= isset($email) ? $email : '' ?>" />
      <label for="email">Email</label>
    </div>
    <div class="form-control">
      <input type="password" id="password" name="password" required maxlength="29" value="<?= isset($password) ? $password : '' ?>" />
      <label for="password">Password</label>
    </div>
    <?php if ($error_message) : ?>
      <span class="error-message"><?= $error_message ?></span>
    <?php endif; ?>
    <div class="form-control">
      <input type="submit" value="Log" name="login" class="btn" />
    </div>
  </form>

  <?= require './includes/footer.php'; ?>