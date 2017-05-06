<?php require_once('header.php') ?>
<!--Junghoo Kim
  Emmanuel Oluloto
   CS 284
   Checkpoint 4
-->

<!DOCTYPE html>
<html>
	<head>
		<title>All Sewanee Professors</title>
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
    <div class="row">
      <h1 id="moto">To see a professor's details, select the Professor's name and press <br><span>"SELECT PROFESSOR".</span></h1>
    </div>


<?php
  // DISPLAYING all professors
  $query = "SELECT * FROM profTable";

  $result = $connection->query($query);

  if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;

  echo '<pre><form action="profInfo.php" method="post"> <div class ="set">' ;

    for ($j = $rows-1 ; $j >= 0; $j--){
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
      echo <<<_END

            <input style='line-height: 10px;' type="radio" name="prof" value="$row[0]"> $row[1] $row[2]

_END;
    }

  echo <<<_END
        <input type="submit" value="SELECT PROFESSOR">
        </div></form></pre>
        
        <div class="row">
        <h1 id="moto">If you're a professor without an account, you can set up a new account by selecting the 
        <span> CREATE NEW ACCOUNT</span> button below. </h1>
        </div>
        <form action="newprof.php" method="post">
        <input type="submit" value="CREATE NEW ACCOUNT" style=""></form>;
_END;

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
