<?php
//Start the session
session_start();

try{
  $dbUrl = getenv('DATABASE_URL');
  $dbopts = parse_url($dbUrl);
  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  if(!empty($dbopts["path"])){
    $dbName = ltrim($dbopts["path"],'/');
  }else{
    $dbName = $dbase;
  }
  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <meta name="description" content="Registration">
    <?php include '../modules/head.php';?>
  </head>

  <body>
    <header>
      <?php include '../modules/header.php';?>
    </header>

    <main>
      <h1>User Sign-Up</h1>

      <?php if (isset($msg)){ echo $msg;} ?>

      <form method="post" action="controller.php">
        <label for="user">Username</label>
        <input type="text" name="clientusername" placeholder="Sherlock Holmes" autofocus required>
        <label for="password">Password</label>
        <input type="password" name="clientpassword" placeholder="FunkyChicken92!" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character" required>
        <input type="submit" value="REGISTER">
        <input type="hidden" name="action" value="register">
      </form>

      <?php if (isset($prompt)){echo $collection;}?>
    </main>

    <footer>
      <?php include '../modules/footer.php';?>
    </footer>
    <?php include '../modules/scripts.php';?>
  </body>
</html>
<!-- https://stackoverflow.com/questions/10004723/html5-input-type-range-show-range-value?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa -->
