<?php session_start(); ?>
<?php include "header.php" ?>
<?php

// check login status, if not login, let user input email and password to login;
if (isset($_POST['signin'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

// query user's input email to get user's data record(ID, name, email, password); 
  
  $query = "SELECT * from users WHERE email = '$email'";
  $user = mysqli_query($mysqli, $query);
  

  if (!$user) {
    die('query Failed' . mysqli_error($mysqli));
  }

  /*
  assign id, name, email and passwd to four variables, then compare hashcode of user input
  passwd and hashcode of passwd from database;


  */
  while ($row = mysqli_fetch_array($user)) {

    $user_id = $row['ID'];
    $user_name = $row['username'];
    $user_email = $row['email'];
    $user_password = $row['password'];
  }

  /*
  if passwd is correct, save user's info in to SESSION; 
  otherwise, redirecting to login page

  */
  if ($user_email == $email  &&  password_verify($password, $user_password)) {

    $_SESSION['id'] = $user_id;       // Storing the value in session
    $_SESSION['name'] = $user_name;   // Storing the value in session
    $_SESSION['email'] = $user_email; // Storing the value in session
    //! Session data can be hijacked. Never store personal data such as password, security pin, credit card numbers other important data in $_SESSION
    header('location: dashboard.php?user_id=' . $user_id);
  } else {
    header('location: login.php');
  }
}
?>

<div class="container col-4 border rounded bg-light mt-5" style='--bs-bg-opacity: .5;'>
  <h1 class="text-center">Sign In</h1>
  <hr>
  <form action="" method="post">
    <div class="mb-3">
      <label for="email" class="form-label">Email ID</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your email" autocomplete="off" required>
      <small class="text-muted">Your email is safe with us.</small>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
      <small class="text-muted">Do not share your password.</small>
    </div>
    <div class="mb-3">
      <input type="submit" name="signin" value="Sign In" class="btn btn-primary">
    </div>
  </form>
</div>

<?php include "footer.php" ?>