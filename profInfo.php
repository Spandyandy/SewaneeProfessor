<!--Junghoo Kim
  Emmanuel Oluloto
   CS 284
   Checkpoint 4
-->

<!DOCTYPE html>
<html>
	<head>
		<title>sample</title>
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
  			<li><a href="displayProfs.php">Professor List</a></li>
  			<li><a href="department.php">Departments</a></li>
  			<li><a href="#">Sign Up</a></li>
  			<li><a href="#">Log in</a></li>
  		</ul>
  	</div>

<span style="display:block; height: 100px;"></span>
    <div class="row">
      <h1 id="moto"><span>Click "DELETE RECORD"</span> button <br> in order to <span>delete</span> record of this professor.</h1>
    </div>


<?php
  // Usual connection to database
  require_once('login.php');

  $connection = new mysqli( $host, $user, $pass, $db );
  if ($connection->connect_error) die ('did not connect!');

     // Setup for deleting entry from table
  if(isset($_POST['delete']) && isset($_POST['profID'])){
    $profID = get_post($connection, 'profID');
    $query = "DELETE FROM profTable WHERE profID = $profID";

    $result = $connection->query($query);

    if(!$result) echo "DELETE failed: $query <br>".$connection->error."<br><br>";
    echo"Your account was deleted. Thanks for your service!<br>";

  }else{

   // Setup for PRINTING entry from table
  $profID = get_post($connection, 'prof');

  $query = "SELECT * FROM profTable WHERE profID = $profID";

  $result = $connection->query($query);

  if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;

 for ($j = $rows-1 ; $j >= 0; $j--){
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
      echo <<<_END
        <div class ="set">
        <pre>

          Professor $row[1] $row[2]
          Email        $row[3]
          Phone        $row[4]

_END;

  }



  $query = "SELECT COUNT(*),profTable.profID FROM profTable, hasLiked
            WHERE profTable.profID = hasLiked.profID
            AND   profTable.profID = $profID";
  $result = $connection->query($query);

  if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;

 for ($j = $rows-1 ; $j >= 0; $j--){
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
      echo <<<_END
        <div class ="set">
        <pre>
          Student Approval    $row[0]
        </pre>

          <form action="profInfo.php" method="post" class="button">
            <input type="hidden" name="delete" value="yes">
            <input type="hidden" name="profID" value="$row[1]">
            <input type="submit" value="DELETE RECORD">
          </form>
          </div>

          </div>
_END;

  }

 }


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
