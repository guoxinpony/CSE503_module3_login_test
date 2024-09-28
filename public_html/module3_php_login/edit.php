<?php session_start(); ?>
<?php
if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}
?>


<html>
	<head>
		<title>Edit your news</title>
	</head>
	
	<body>
		
		<p>Hello <?php echo $_SESSION['name']?>!</p> <!--Displays user's name-->
		
		<a href="dashboard.php">Return to My Dashboard</a>
		<h2 align="center">Currently Selected</h2>
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

                $stmt->bind_result($NewsID, $headline, $content);

                
                while($stmt->fetch())
                {
                    Print "<tr>";
                    Print '<td align="center">'. $NewsID . "</td>";
                    Print '<td align="center">'. $headline . "</td>";
			        Print '<td align="center">'. $content . "</td>";

                    Print "</tr>";
                }
                
					
				
			?>
		</table>
		<br/>
        
		<?php
        /*
        $id_exists = true;
		if($id_exists)
		{
		Print '
		<form action="edit.php" method="POST">
			Enter new detail: <input type="text" name="details"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>
			<input type="submit" value="Update List"/>
		</form>
		';
		}
		else
		{
			Print '<h2 align="center">There is no data to be edited.</h2>';
		}
        */
		?>

        <form name="input" action="edit2.php" method="post">
            Please input the news ID you want to edit: <br>

            News ID: <input type="text" name="id" >
            New Content: <input type="text" name="newcontent" >
            
            <input type="submit" value="edit" >
        </form>
    
	</body>
</html>


<?php
/*
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
		mysql_select_db("first_db") or die("Cannot connect to database"); //Connect to database
		$details = mysql_real_escape_string($_POST['details']);
		$public = "no";
		$id = $_SESSION['id'];
		$time = strftime("%X");//time
		$date = strftime("%B %d, %Y");//date

		foreach($_POST['public'] as $list)
		{
			if($list != null)
			{
				$public = "yes";
			}
		}
		mysql_query("UPDATE list SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'") ;

		header("location: home.php");
	}
*/
?>