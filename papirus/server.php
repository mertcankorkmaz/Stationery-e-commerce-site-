<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'papirus');

if (isset($_POST['reg_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


  if (empty($username)) { array_push($errors, "Kullanıcı adı gerekli"); }
  if (empty($email)) { array_push($errors, "Email gerekli"); }
  if (empty($password_1)) { array_push($errors, "Password gerekli"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Şifreler aynı değil");
  }

  $user_check_query = "SELECT * FROM kullanicilar WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Bu kullanıcı adı daha önce alınmış");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Bu email daha önce kullanılmış");
    }
  }

  if (count($errors) == 0) {
  	/*$password = md5($password_1);*/
    $password = $password;
  	$query = "INSERT INTO kullanicilar (username, email, password) VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Kullanıcı adı gerekli");
  }
  if (empty($password)) {
    array_push($errors, "Şifre gerekli");
  }

  if (count($errors) == 0) {
    /*$password = md5($password);*/
    $password = $password;
    $query = "SELECT * FROM kullanicilar WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Yanlış kullanıcı adı/şifre kombinasyonu");
    }
  }
}

?>