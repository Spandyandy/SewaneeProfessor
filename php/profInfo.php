<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">

<style>
</style>

<head>
  <title>Andy_Emmanuel</title>
</head>

<body>
  <div id="wrapper">
    <div id="callout">
      <p>Call us at <b>931-223-4066</b></p>
    </div>
     <img id="titleLogo" src="http://www.sewaneevillage.com/sba/files/stacks-image-ba97a9d.png"/>
    <nav>
    	<ul>
    		<li class='active'><a href="index.html">Home</a></li>
    		<li><a href="About.html">About</a></li>
    		<li><a href="">Ratings</a></li>
    		<li><a href="">Feedback</a></li>
    		<li><a href="">Search</a></li>
    	</ul>
    	<div class="clearfix"></div>
    </nav>	

    
	



<?php
  // Usual connection to database
  require_once('login.php');
  
  $connection = new mysqli( $host, $user, $pass, $db );
  if ($connection->connect_error) die ('did not connect!');
  
  
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
          ID Number    $row[0]
          First Name   $row[1]
          Last Name    $row[2]
          Email        $row[3]
          Phone        $row[4]
        </pre>
          </div>
_END;
  }
  $query = "SELECT COUNT(*) FROM profTable, hasLiked
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
          Number of Likes    $row[0]
        </pre>
          </div>
_END;
  }
    
  $result->close;
  $connection->close;
    
  // the get_post function called
  function get_post($connection, $var){
    return $connection->real_escape_string($_POST[$var]);
  }    
    
  
?>
 
 
     <hr>
    <img id=univLogo src="https://upload.wikimedia.org/wikipedia/en/1/12/The_Seal_of_The_University_of_the_South.png"/>


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
    	<div class="section">
    		<div id="logo">
    			<img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Sewanee.png"/>
    		</div>
    	</div>
    </footer>
  </div>
  	<p style="text-align:center">&#169;Copyright - Andy Kim/Emmanuel Oluloto, 2017.</p>
 </body>
</html>
