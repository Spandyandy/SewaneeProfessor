<?php require_once('header.php') ?>
<!--Junghoo Kim
  Emmanuel Oluloto
   CS 284
   Checkpoint 4
-->

<!DOCTYPE html>
<html>
	<head>
		<title>Sewanee Student Login</title>
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
                  <?php navItems();?>
  		</ul>
  	</div>

<span style="display:block; height: 100px;"></span>
    <div class="row">
      <h1 id="moto"><span>Enter your username and password to sign in! </span></h1>
    </div>


<?php

   // Setup for inserting into users
   
  if (isset($_POST['username'])      &&
      isset($_POST['sewanee_Email']) &&
      isset($_POST['first_Year'])    &&
      isset($_POST['password']) ) {
 
  $username      = get_post($connection, 'username');
  $sewanee_Email = get_post($connection, 'sewanee_Email');
  $first_Year    = get_post($connection, 'first_Year');
  $password      = get_post($connection, 'password');

  $query = "INSERT INTO studentTable (username, sewanee_Email, first_Year, password) 
                        VALUES('$username', '$sewanee_Email', $first_Year, '$password')";
  
  //echo $query;
  

  $result = $connection->query($query);

    echo "<div class='row'><h1 id='moto'>";
    if (!$result) //die ("Database access failed!!: " . $connection->error);
        echo "<br> <b>ERROR!</b> Try a new username and MAKE SURE that the <span>First Year</span> is a number. <br>";
    else  echo "<br> You are now in the system! Log in by clicking the <span> Student Log In </span> link in the nagivation bar <b>above</b>.<br>";
    echo "</h1></div>";
  }

  
  
      echo <<<_END
         <form action="createaccount.php" method="post"><pre>
         Username:    <input type="text"     name="username" value=''> <br><br><br>
         Email:       <input type="text"     name="sewanee_Email" value=''placeholder=SEWANEE E-mail> <br><br><br>
         First Year:  <input type="text"     name="first_Year" value='' placeholder="When you came to Sewanee">    <br><br><br>
         Password:    <input type="password" name="password" value=''> <br><br><br>
    
        <input type="submit" value="SIGN UP">
        </pre></form>

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
