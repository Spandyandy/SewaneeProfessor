<! Emmanuel Oluloto
   CS 284
   Checkpoint 4
>



<?php
  // Usual connection to database
  require_once('login.php');
  $connection = new mysqli( $host, $user, $pass, $db );
  if ($connection->connect_error) die ('did not connect!');
  else  echo "Connected!!";
  
  
  
  
 /* $isready = isset($_POST['first_name']) &&
      isset($_POST['last_name'])   && 
      isset($_POST['email'])       && 
      isset($_POST['phone']) ;
      
  echo "Ready ???? $isready";    */
    
  // Setup for inserting entries
  if (isset($_POST['first_name']) &&
      isset($_POST['last_name'])   && 
      isset($_POST['email'])       && 
      isset($_POST['phone']) 
      ){
      
    echo "<br>Set!! ";

    $first_name = get_post($connection, 'first_name');
    $last_name  = get_post($connection, 'last_name');
    $email      = get_post($connection, 'email');
    $email      = $email.'@sewanee.edu'; 
    
    $phone      = get_post($connection, 'phone');   
    //$password   = get_post($connection, 'password');
    
    $query = "INSERT INTO profTable
                     ( first_name     ,last_name ,   email    ,phone ) 
           VALUES" ."('$first_name', '$last_name', '$email', '$phone')";
           
 /*   $query = "INSERT INTO profTable
                     ( first_name     ,last_name ,   email    ,phone     ,password) 
           VALUES" ."('$first_name', '$last_name', '$email', '$phone', '$password')";      */     
          
    $result = $connection->query($query);
    if(!$result) echo "INSERT failed: $query<br>" .
      $connection->error . "<br><br>";
      else echo "<br><span style='font-size:30px'>Succeeded in inserts!</span><br>";
    
    
    echo "$first_name, $last_name, $email, $phone, $password Here!!!";
  }

  echo <<<_END
 
<form action = "testqueries.php">
 
    <br>
  
    First name:<br>
    <input type="text" name="first_name" >
    <br>
    Last name:<br>
    <input type="text" name="last_name" >
    <br><br>

    E-mail Address:<br>
    <input type="text" name="email" >@sewanee.edu
    <br><br>
  
    Office Phone:<br>
    <input type="text" name="phone" >
    <br><br>
  

    
    Password:<br>
    <input type="text" name="password" >
  
   <pre>
    <input type="submit" value="ADD RECORD">
    </pre>
  </form>    
_END;

   // Setup for deleting entry from table
  if(isset($_POST['delete']) && isset($_POST['profID'])){
    $profID = get_post($connection, 'profID'); 
    $query = "DELETE FROM profTable WHERE profID = $profID";
    
    $result = $connection->query($query);
    
    if(!$result) echo "DELETE failed: $query <br>".$connection->error."<br><br>";
    
  }  
  
  // DISPLAYING DATA IN TABLES        
  $query = "SELECT * FROM profTable";
          
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
          <form action="testqueries.php" method="post" class="button">
            <input type="hidden" name="delete" value="yes">
            <input type="hidden" name="profID" value="$row[0]">
            <input type="submit" value="DELETE RECORD">
          </form>

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
 
