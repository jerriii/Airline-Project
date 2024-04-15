<?php
include "../utils/startsession.php";
include "../utils/database.php";
include "../utils/User.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../layout.css">
    <link rel="stylesheet" href="../table.css">
</head>
<body style="background-color: white !important;">
    <div class="header">
        <div class="icon">
            <h2>Online Voting System</h2>
        </div>

        <div class="user-details">
            <ul>    
                <li><a href="home.php">Back</a></li>
            </ul>
        </div> 
    </div>

    <div class="table">
        <table class="table-user">
            <tr>
                <th>S. No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
                $sql="SELECT * FROM users";
                $result=mysqli_query($db, $sql);
                $i=1;
            ?>
            <?php if ($result): ?>
                <?php while($row=mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edituser.php?updateid=<?php echo $row['id']; ?>">
                            <button>Edit</button>
                        </a>
                        <a href="deleteuser.php?deleteid=<?php echo $row['id']; ?>">
                            <button class="del">Delete</button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>