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
		    <li><a href="about.html">About</a></li>
			<li><a href="displayProfs.php">Professor List</a></li>
			<li><a href="department.php">Departments</a></li>
			<li><a href="createaccount.php">Student Sign Up</a></li>
			<li><a href="accountlogin.php">Student Log in</a></li>
  		</ul>
  	</div>

<span style="display:block; height: 100px;"></span>
    <div class="row">
      <h1 id="moto">Sign in to your account from here. If you don't have one, then <a href="createaccount.php" style="font-size:30px;"><span>SIGN UP</span></a>.</h1>
    </div>


<?php
   // Setup for PRINTING entry from table
   
   //destroy_session();
   
  if (isset($_POST['username']) &&
      isset($_POST['password']) ) {
            
  $username = get_post($connection, 'username');
  $password = get_post($connection, 'password'); 
  
  
  $_SESSION['username'] = $username; 
  
  
  $loginresult = "";
  $query = "SELECT * FROM studentTable WHERE username='$username' AND password='$password'";
  $result = $connection->query($query);
  

  if (!$result) die ("Database access failed!!: " . $connection->error);
  $rows = $result->num_rows;     
      
  if($rows == 1){
    for ($j = 0 ; $j < $rows; $j++){
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
          
      $loginresult = "<br><br> You logged in successfully <span style='color:#03A2AB;'>$row[0]</span>! <br><br>
                         You can view your information <a href='userinfo.php' style='font-size:60px;'><span>here</span></a>.<br>";
                         
         /*  echo <<<_END 
           <form action='userinfo.php' method='post'>
           <input type='hidden' name='username' value='$row[0]'>
           </form>
_END;*/
    }
 
 }else $loginresult = "<br>Wrong username/password! Try again!<br>";
      

  
  }
      echo <<<_END
         <form action="accountlogin.php" method="post"><pre>
         Username:  <input type="text"     name="username" value=''> <br><br><br>
         Password:  <input type="password" name="password" value=''>
        <input type="submit" value="LOG IN">
        
        </pre></form>

_END;

  echo "<div class='row'><h1 id='moto' >";
  echo $loginresult;
  echo "</h1></div>";

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
