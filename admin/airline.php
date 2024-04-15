  <?php
   include "../utils/startsession.php";
   include "../utils/database.php";
   include_once "../utils/error.php";
   include_once "../utils/User.php";
   
  if (!User::isLoggedIn())
    ErrorHandler::error(9, '../login.php');
   $user=User::getUserFromSession();
   if (!$user->isAdmin()) 
    ErrorHandler::error(10, '../index.php');
    if(isset($_POST['submit']))
    {
      $name=$_POST['name'];
      $aeroplane_no=$_POST['aeroplane_no'];
      $departure=$_POST['departure'];
      $arrival=$_POST['arrival']; 
      $departure_date=$_POST['departure_date'];
      $departure_time=$_POST['departure_time'];
      
      $seats=$_POST['seats'];


      $sql="INSERT INTO flights ( name,  aeroplane_no, departure, arrival, departure_date, departure_time, seats) VALUES ('$name','$aeroplane_no','$departure','$arrival','$departure_date','$departure_time','$seats')";
      $result = mysqli_query($db,$sql);

      if($result)
          header('location:display.php');
      else
      {
          
      }
    }
  ?>