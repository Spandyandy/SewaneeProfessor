<!--Junghoo Kim
  Emmanuel Oluloto
   CS 284
-->
  <?php session_start();
  
    // Usual connection to database
    require_once('login.php');
    $connection = new mysqli( $host, $user, $pass, $db );
    if ($connection->connect_error) die ('did not connect!');
    
    
    // Checks if someone is logged in
    if(isset($_SESSION['username'])){
      $user = isset($_SESSION['username']);
      $loggedin = TRUE;
    }else $loggedin = false;
    
    // Logs user out
    function destroy_session(){
      $_SESSION = array();
      setcookie(session_name(), '', time() - 2592000, '/');
      session_destroy();
    }
    
    // Nagivation for no user
    function navItems(){
        echo<<<_END
		        <li><a href="about.html">About</a></li>
			<li><a href="displayProfs.php">Professor List</a></li>
			<li><a href="department.php">Departments</a></li>
			<li><a href="createaccount.php">Student Sign Up</a></li>
			<li><a href="accountlogin.php">Student Log in</a></li>    
_END;
    
     }
     
    // Nagivation for when someone is logged in 
    function navItemsLoggedin(){
      $u = $_SESSION['username'];
        echo<<<_END
		        <li><a href="about.html">About</a></li>
			<li><a href="displayProfs.php">Professor List</a></li>
			<li><a href="department.php">Departments</a></li>
			<li><a href="userinfo.php">Your Profile</a></li>
      	                <li><span id= 'user'> $u </span></li>

_END;

    }
  
  

  ?>
