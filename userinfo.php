<?php require_once('header.php') ?>
<!--Junghoo Kim
  Emmanuel Oluloto
   CS 284
-->

/*Does not work yet*/

<!DOCTYPE html>
<html>
	<head>
		<title>User Information</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" />
		<link rel="stylesheet" type="text/css" href="stylingPHP.css"/>
	</head>
	<body>
    <!-- TOP-NAV HTML -->
  	<div class="top-nav active clearfix">
  		<a href="index.html" class="logo">
  			<img src="image/logo2.png" alt="Sewanee"/>
  		</a>
  		<div id="nav-searchbar">
  			<form method="GET" action="index.html">
  				<input type="text" name="search" id="nav-search" placeholder="Search"/>
  			</form>
  		</div>
  		<ul>
                  <?php $loggedin ? navItemsLoggedin() : navItems();?>
  		</ul>
  	</div>

<span style="display:block; height: 100px;"></span>



<?php
     // Setup for deleting entry from table
  if(isset($_POST['delete']) && isset($_POST['username'])){
    $username = get_post($connection, 'username');
    $query = "DELETE FROM studentTable WHERE username = '$username'";

    $result = $connection->query($query);

    if(!$result) echo "DELETE failed: $query <br>".$connection->error."<br><br>";
    echo"Your account was deleted. Thanks for your service!<br>";

  }
  
  // LOGOUT
  if(isset($_POST['logout'])) destroy_session();
  
  
  // User Info
  if( isset($_SESSION['username']) ){
    $username = $_SESSION['username'];
  

    $query = "SELECT * FROM studentTable WHERE username = '$username'";
    $result = $connection->query($query);

    if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;

    for ($j = $rows-1 ; $j >= 0; $j--){
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
      echo <<<_END
        <div class="row">
          <h1 id="moto">USER INFORMATION</h1>
        </div>
        <div class ="set" style="background:#F9C7FF;font-size:30px;margin:40px;text-align:center">
          <h4> Name:</h4> $row[0]
          <h4>Email:</h4> $row[2] 
          <h4>Year you started school in Sewanee:</h4>$row[3]
      

_END;


    $query = "SELECT first_name,last_name,hasLiked.profID FROM profTable,hasLiked,studentTable 
              WHERE hasLiked.username = '$username'
              AND   hasLiked.profID = profTable.profID 
              AND   hasLiked.username = studentTable.username";
             
    $result = $connection->query($query);

    if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;


    echo "<br><br><br><br><br><br><br><br>
     <h2>Professors You Have Liked</h2>";
     
    if($rows==0) echo "Go like some professors!!!";
    else{
      for ($j = $rows-1 ; $j >= 0; $j--){
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);
        echo <<<_END
          <a href="profInfo.php?profID=$row[2]" style="font-size: 48px;color:orange"> $row[0]  $row[1] </a><br>       
_END;
      }
    }
  echo "</div>";

  echo <<<_END
    <form action="userinfo.php" method="post">
      <input type="submit" value="LOG OUT">
      <input type="hidden" value="yes" name="logout">
    </form>

_END;

    }
  }else echo "<div id='moto' style='text-align:center'><br>
               You're logged out! Click 
              <a href='accountlogin.php' style='font-size:60px;'><span>here</span></a> 
              to log in again.
              <br></div>";

  $result->close;
  $connection->close;

  // the get_post function called
  function get_post($connection, $var){
    return $connection->real_escape_string($_POST[$var]);
  }


?>

<span style="display:block; height: 200px;"></span>
<!-- footer -->
<footer>
	<div class="section">
		<p>ANDY KIM & EMMANUEL</p>

	<p>ANDY KIM</p>
	<p><b>931-223-4066</b><br>
		735 University Ave.<br>
		Sewanee, Tennessee<br>
		<a href = "mailto:kimj0@sewanee.edu">kimj0@sewanee.edu</a></p>

	<br>
	<p> EMMANUEL OLULOTO</p>
		<p><b>931-636-8530</b><br>
		735 University Ave.<br>
		Sewanee, Tennessee<br>
		<a href = "mailto:oluloep0@sewanee.edu">oluloep0@sewanee.edu</a></p>
	</div>

	<div class="section"><div id="social">
		<p>Connect with us!</p>
		<ul>
			<li><a href="#"><img src="https://www.w3newbie.com/wp-content/uploads/googleplus.png"/></a></li>
			<li><a href="#"><img src="https://www.w3newbie.com/wp-content/uploads/facebook1.png"/></a></li>
			<li><a href="#"><img src="https://www.w3newbie.com/wp-content/uploads/twitter1.png"/></a></li>
			<li><a href="#"><img src="https://www.w3newbie.com/wp-content/uploads/youtube1.png"/></a></li>
		</ul>

	</div></div>
			<img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Sewanee.png"/>
</footer>

<p style="text-align:center">&#169;Copyright - Andy Kim/Emmanuel Oluloto, 2017.</p>


<!-- JAVASCRIPT IMPORT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="functions.js"></script>
</body>
</html>
