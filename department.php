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
		<link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
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
      <h1 id="moto"><span>Select</span> department's name and press <br><span>"SELECT DEPARTMENT".</span></h1>
    </div>


<?php
  // Usual connection to database
  require_once('login.php');
  $connection = new mysqli( $host, $user, $pass, $db );
  if ($connection->connect_error) die ('did not connect!');




  // DISPLAYING DATA IN TABLES
  $query = "SELECT * FROM departments";

  $result = $connection->query($query);

  if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;

  echo '<pre><form action="profsByDept.php" method="post"> <div class ="set">' ;

    for ($i = 0; $i < $rows; $i++){
      $result->data_seek($i);
      $row = $result->fetch_array(MYSQLI_NUM);
      echo <<<_END

            <input style='line-height: 50px;' type="radio" name="dept" value="$row[0]"> $row[1] $row[2] <br>

_END;
    }

  echo '
        <input type="submit" name="search" value="SELECT DEPARTMENT"/>
       </div> </form></pre>';

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
