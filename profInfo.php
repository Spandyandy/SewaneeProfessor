<?php require_once('header.php') ?>
<!--Junghoo Kim
  Emmanuel Oluloto
   CS 284
   Checkpoint 4
-->

<style>
#like{
  background:#0093C4;
  float:right;
  margin-right:40px
}

table{
  background:white;
  
}

th, td {
    padding: 15px;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}

tr.top{
  color:blue;
}

#unlike{  
  float:right;
  margin-right:40px
}

</style>

<!DOCTYPE html>
<html>
	<head>
		<title>Detailed Professor Information</title>
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
      <h1 id="moto">If you are signed in as the professor, you can delete your account by selecting the <span>DELETE ACCOUNT</span> button below.</h1>
    </div>


<?php
    
    // Get profID info from link    
    if(isset($_GET["profID"]) ){
        $profIDlink = $_GET["profID"];

    }
    
  
  // If profID is set from link (as in userinfo.php) then post that, else get from submit
  $profID = get_post($connection, 'prof');  
  if($profIDlink!="") $profID = $profIDlink;

  if($profID != ""){
    $query = "SELECT * FROM profTable WHERE profID = $profID";
    $result = $connection->query($query);

    if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;

    for ($j = $rows-1 ; $j >= 0; $j--){
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_NUM);
      echo <<<_END
        <div class ="set" style="background:#F9C7FF;font-size:30px;margin:40px;">
        <pre>

          <h4>Professor $row[1] $row[2]</h4>
          
          <h4>Email</h4> $row[3]
          <h4>Phone</h4> $row[4]

_END;

    }
  
  
  


 // Displays classes that they teach for Advent 2017
    $query = " SELECT whoTeachesWhat.registerID, abbr,courseNo,dept,period,year  
     FROM profTable, whoTeachesWhat,whatIsTaughtWhen, semester,departments
            WHERE whoTeachesWhat.profID = $profID
            AND   period = 'Advent'
            AND   year = 2017
            AND   departments.deptID = whoTeachesWhat.deptID
            AND   whoTeachesWhat.profID = profTable.profID
            AND   whoTeachesWhat.registerID = whatIsTaughtWhen.registerID      
            AND   whatIsTaughtWhen.semesterID = semester.semesterID       "; 
     
    $result = $connection->query($query);            
    if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows2 = $result->num_rows;

    echo "<div style ='margin-left:20%;'>";
    echo "<br><br><h5 style='color:red;margin-left:20%;'>Classes Taught for Advent 2017</h5> <table style='width:75%;font-size:30px;'>";
    echo " <tr class='top'><th>REGISTER ID</th> <th>CLASS</th> <th>DEPARTMENT</th> <th>YEAR</th> </tr><br>";
    for ($k = 0 ; $k < $rows2; $k++){
      $result->data_seek($j);
      $row2 = $result->fetch_array(MYSQLI_NUM);
      echo " <tr><th>$row2[0]</th> <th>$row2[1] $row2[2]</th> <th>$row2[3]</th> <th>$row2[5]</th> </tr>";
    }
  echo "</table></div>";
  
  // Displays like if user has not yet liked, and vice versa  
  echo "<form action='profInfo.php' method='post' class='button'style=''>";  

  if( $loggedin ) {
    $username = $_SESSION['username'];
    $query = "SELECT * from hasLiked 
                 WHERE username = '$username' 
                 AND   profID   = $profID";
    
    $result = $connection->query($query);            
    if (!$result) die ("Database access failed!!: " . $connection->error);
    $rows = $result->num_rows;             
      
    if($rows == 0)     
       echo "<input id='like' type='submit' value='LIKE' >
          <input type='hidden' name='like' value='yes'>";
    else
       echo "<input id='unlike' type='submit' value='UNLIKE' >
          <input type='hidden' name='unlike' value='yes'>";
    
    echo "<input type='hidden' name='profID' value='$profID'>
        </form>";
    
   }
   
   echo "<br> <b style='font-size:60px;'> Like button does not work. </b><br> ";


  // Displays number of likes
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

        <pre>
          <span style="color:blue">Student Approval</span>    $row[0]
        </pre>

          <form action="profInfo.php" method="post" class="button">
            <input type="hidden" name="delete" value="yes">
            <input type="hidden" name="profID" value="$row[1]">
            <!-- <input type="submit" value="DELETE RECORD"> -->
          </form>
          </div>

_END;

  }
  }else echo "<div class='row'>Please go back and pick a professor!.</div>";


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
