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


    <table border="1px" width="100%">
		<tr>
            <th>ID</th>
		    <th>Headline</th>
			<th>Story</th>
			
		</tr>

        <?php

            // Content of database.php
            require 'database.php';

            
            $id = $_POST['id'];   
            

            $stmt = $mysqli ->prepare("delete from where id='$id';");
            if(! $stmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }

            

            $stmt ->execute();

            $stmt -> close();

            header('location: My_news.php');
        ?>
    </table>


    
    </body>
</html>