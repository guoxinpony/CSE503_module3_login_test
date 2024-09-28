<?php session_start(); ?>

<?php
if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
       <meta charset="utf-8">
       <title>Create News</title> 
    </head>

    <body>


        <?php

            // Content of database.php
            require 'database.php';

            
            $id = $_POST['id'];   //actually is healine of news;
            $first = $_POST['first'];  // actually is content of news
            $last = $_SESSION['name'];
            $email = $_SESSION['email'];

            $stmt = $mysqli ->prepare("insert into news (headline, story, name, email) values (?,?,?,?)");
            if(! $stmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }

            
            $stmt -> bind_param("ssss",$id, $first, $last, $email);

            $stmt ->execute();

            $stmt -> close();

            header('location: view_all_news.php');
        ?>
    </body>
</html>