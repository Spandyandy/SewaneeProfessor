<?php require_once('header.php') ?>

<!--Junghoo Kim
  Emmanuel Oluloto
   CS 284
   Checkpoint 4
-->

<?php
  // Usual connection to database
  require_once('login.php');

  $connection = new mysqli( $host, $user, $pass, $db );
  if ($connection->connect_error) die ('did not connect!');

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sewanee Professor</title>
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
      <h1 id="moto"><span>Click "DELETE RECORD"</span> button <br> in order to <span>delete</span> this professor's information.</h1>
    </div>

 <?php  
 
 /*echo <<<_END 
  <form action = "newprof.php">
    First name:<br>
    <input type="text" name="first_name" value="">
    <br>
    
    Last name:<br>
    <input type="text" name="last_name" value="">
    <br><br>
  
    Office Phone:<br>
    <input type="text" name="phone" value="">
    <br><br>
  
    E-mail Address:<br>
    <input type="text" name="email" value="">@sewanee.edu
  
    <br><br>
    Enter the classes you are teaching <b>this</b> semester. You can enter multiple classes.<br>
    Select your department then enter your class number.<br>
    <select class="dept">
      <option value=""></option>
_END;*/

       
         $query = "SELECT * FROM departments";
         $result = $connection->query($query);

  if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; $i++){
      $result->data_seek($i);
      $row = $result->fetch_array(MYSQLI_NUM);
      echo "<option style='line-height: 50px; name='dept' value=$row[0]> $row[1] <br> </option>";
    }     
  /*  
       echo <<<_END    
        
    </select>
    <input type="text" name="class1" value="101">
    <br><br>
    Enter semester that these classes are for: <br>
    Semester:
    <select id="period" class="dept">
      <option value=""></option>
      <option value="Easter">Easter Semester</option>
      <option value="Advent">Advent Semester</option>
    </select>
    <br>
    
    Year:
    <select id="year" class="dept">
      <option value=""></option>
      <option value=2017>2017</option>
      <option value=2018>2018</option>
      <option value=2019>2019</option>
      <option value=2020>2020</option>
    </select>    
    <br><br>
    
    
    <br><br>
    Enter the classes you are teaching <b>next</b> semester (if that information is available).<br>
    Select your department then enter your class number.<br>
    <select class="dept">
      <option value=""></option>
_END;
      
         $query = "SELECT * FROM departments";
         $result = $connection->query($query);
         if (!$result) die ("Database access failed!!: " . $connection->error);
           $rows = $result->num_rows;

         for ($i = 0; $i < $rows; $i++){
           $result->data_seek($i);
           $row = $result->fetch_array(MYSQLI_NUM);
           echo "<option style='line-height: 50px; name='dept' value=$row[0]> $row[1] <br> </option>";
        }     
       echo <<<_END

            <input style='line-height: 50px;' type="radio" name="dept" value="$row[0]"> $row[1] $row[2] <br>

   
    </select>
    <input type="text" name="class2" value="101">
    <br><br>
    Enter semester that these classes are for: <br>
    Semester:
    <select id="period" class="dept">
      <option value=""></option>
      <option value="Easter">Easter Semester</option>
      <option value="Advent">Advent Semester</option>
    </select>
    <br>
    
    Year:
    <select id="year" class="dept">
      <option value=""></option>
      <option value=2017>2017</option>
      <option value=2018>2018</option>
      <option value=2019>2019</option>
      <option value=2020>2020</option>
    </select>    
    <br><br>    

    Password:<br>
    <input type="password" name="email" value="">
          
    <input type="submit" value="Submit">
</form>	

_END;

  // Setup for inserting entries
 /* if (isset($_POST['first_name'])&&
      isset($_POST['last_name']) &&
      isset($_POST['phone'])     &&
      isset($_POST['email'])     &&
      isset($_POST['password']) ){*/
      
   echo "<br><br>In here...<br><br>";
   
    $first_name = get_post($connection, 'first_name');
    $last_name  = get_post($connection, 'last_name');
    $phone      = get_post($connection, 'phone');
    $email      = get_post($connection, 'email'); 
    $email =  $email."@sewanee.edu"; 
    
    $password   = get_post($connection, 'password');
    
    
    $query = "INSERT INTO profTable (first_name, last_name, email, phone,password) VALUES
               ('$first_name', '$last_name', '$email', $phone, '$password')";
          
    echo $query; 
         
    $result = $connection->query($query);

    if(!$result) echo "<br>INSERT failed: $query<br>" .
      $connection->error . "<br><br>";
 
 // }

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
