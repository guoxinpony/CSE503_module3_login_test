<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">
    <head>
       <meta charset="utf-8">
       <title>All News</title> 
    </head>

    <body>


    <?php
    require 'database.php';

    $stmt = $mysqli->prepare("select headline, name, email from news");
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

    <a href="dashboard.php">
    <button>Back to Dashboard</button>
    </a>

    <a href="My_news.php">
    <button>My news</button>
    </a>
    
    </body>
</html>