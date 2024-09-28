<?php session_start(); ?>
<?php
if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}
?>

<?php include "header.php" ?>

<!DOCTYPE html>

<html lang="en">
    <head>
       <meta charset="utf-8">
       <title>My News</title> 
    </head>

    <body>

    <h2 align="center">My News</h2>

    

    <table border="1px" width="100%">
		<tr>
		    <th>News ID</th>
			<th>Headline</th>
			
			<th>Content</th>
			
			
		</tr>
        <?php
            require 'database.php';

            $stmt = $mysqli->prepare("select id, headline, story from news where email='$_SESSION[email]'; ");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }

            $stmt->execute();

            $stmt->bind_result($headline, $name, $email);

            while($stmt->fetch())
            {
                Print "<tr>";
			        Print '<td align="center">'. $headline . "</td>";
			        Print '<td align="center">'. $name . "</td>";
			        Print '<td align="center">'. $email . "</td>";

			        
		        Print "</tr>";
            }
            $stmt->close();
        ?>
    </table>

    <a href="edit.php">
    <button>Edit my news</button>
    </a>

    <a href="delete.php">
    <button>Delete my news</button>
    </a>

    <a href="dashboard.php">
    <button>Back to Dashboard</button>
    </a>


    <?php
    /*
    require 'database.php';
    
    echo $_SESSION['email'];

    $stmt = $mysqli->prepare("select headline, name, email from news where email='$_SESSION[email]'; ");
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
    */
    ?>

    
    </body>
</html>

<?php include "footer.php" ?>