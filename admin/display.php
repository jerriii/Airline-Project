  <?php

  include "../utils/database.php";

  $date = date('Y-m-d');
  ?>



  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>data display</title>
      <link rel="stylesheet" type="text/css" href="../res/css/homepage.css" />
      <link rel="stylesheet" type="text/css" href="../res/css/design.css" />
      <link rel="stylesheet" type="text/css" href="../res/css/dialog.css" />
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
  </head>
  <body>
    <div class="head adminphoto">
      <!-- <button class="btn-primary bg-red" onclick="getElementById('admin-dialog').show()">
        Add+
      </button>
      <button class="btn-primary bg-red" onclick="history.back()">
        Back
      </button> -->
      <div class="navbar">
				<div class="icon left">
					<h2 class="logo red_color"><a href="home.php">ATS</a></h2>
				</div>

				<div class="menu-admin right">
					<ul>
						<li>
							<a onclick="getElementById('admin-dialog').show()"><i>
                <span class="material-icons-outlined">
                  add
                </span></i></a>
						</li>
						<li>
              <a href="../utils/logout.php">
								<i for="logout">
									<span class="material-icons-outlined">logout</span>
								</i>
							</a>
						</li>
					</ul>
				</div>

			</div>
      <div class="container">
      <dialog close id="admin-dialog" class="admin-dialog">
        <button onclick="getElementById('admin-dialog').close()" class="close-dialog">
          <i for="close">
            <span class="material-icons-outlined">close</span>
          </i>
        </button>
        
        <br><br>
        <div class="form-admin">
          <form method="post" action="airline.php">
                    <label>Airline name:</label>&#9;
                    <input type="text"  placeholder="Enter the Airline" name="name" required>

                  <br>
                    <label>Aeroplane number:</label>&#9;
                    <input type="text"  placeholder="Enter aeroplane number" name="aeroplane_no" required>

                  <br>
                    <label>Departure:</label>&#9;
                    <input type="text"  placeholder="Enter Departure" name="departure" required>
                  <br>

                    <label>Arrival:</label>&#9;
                    <input type="text"  placeholder="Enter Arrival" name="arrival" required>
                  <br>
                    <label>Departure time:</label>&#9;
                      <input type="date" name="departure_date" required>
                      <input type="time" name="departure_time" required>
                  <br>
                    <label>Number of seats:</label>&#9;
                      <input type="number" name="seats" min = 0 required>
                  <br>
                  <button type="submit"  name="submit" class="button-dialog">Submit</button>
          </form>
        </div>
      </dialog> 

        <table class="table-admin" border>
          <thead>
            <tr>
              <th scope="col" style="width:10%">S. No</th>
              <th scope="col" style="width:15%">Airlines List</th>
              <th scope="col" style="width:12%">Flight no.</th>

              <th scope="col" style="width:23%">Departure-Arrival</th>

              <th scope="col" style="width:18%">Departure Time</th>

              <th scope="col" style="width:10%">Seats</th>

              <th scope="col" style="width:12%">Action</th>


            </tr>
          </thead>


          <tbody> 
            <?php
              $sql="SELECT * FROM flights WHERE departure_date>='$date'";
              $result=mysqli_query($db, $sql);
              $i=1;
            ?>
            <?php if ($result): ?>
              <?php while($row=mysqli_fetch_assoc($result)): ?>
                <tr>
                  <th scope="row" style="width:10%"> <?php echo $i++; ?> </th>
                  <td style="width:15%"> <?php echo $row['name']; ?> </td>
                  <td style="width:12%"> <?php echo $row['aeroplane_no']; ?> </td>
                  <td style="width:23%"> <?php echo $row['departure'].'-'.$row['arrival']; ?> </td>
                  <td style="width:18%"> <?php echo $row['departure_date'].' '.$row['departure_time']; ?> </td>
                  <td style="width:10%"> <?php echo $row['seats']; ?> </td>
                  <td style="width:12%">
                  <a href="update.php?updateid=<?php echo $row['id']; ?>"><button class="btn-primary bg-red">Update</button></a>
                  <a href="delete.php?deleteid=<?php echo $row['id']; ?>"><button class="btn-primary bg-red">Delete</button></a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
      <script>
        let adddialog
      </script>
  </body>
  </html>