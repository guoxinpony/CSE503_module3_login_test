<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">
    <head>
       <meta charset="utf-8">
       <title>Create News</title> 
    </head>

    <body>


    <?php
    require 'database.php';
    $aim_email = $_SESSION['email'];

    $stmt = $mysqli->prepare("select headline, name, email from news where email=$aim_email;");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();

    $stmt->bind_result($headline, $name, $email);

    echo "<ul>\n";
    while($stmt->fetch()){
        printf("\t<li>%s %s  %s</li>\n",
            htmlspecialchars($headline),
            htmlspecialchars($name), 
            htmlspecialchars($email)
        );
    }
    echo "</ul>\n";

    $stmt->close();
    ?>
    </body>
</html>