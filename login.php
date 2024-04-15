<?php
include_once 'utils/startsession.php';
include_once 'utils/error.php';

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="new.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
        <div class="heading"><h1>Online Voting System</h1></div>
            <div class="form-box">
                <div class="button-box">
        
                    <div id="btn"> </div>
                    <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                    <button type="button" class="toggle-btn" onclick="register()">Register</button>
                </div>
                <div>
                    <?php ErrorHandler::display_error();?>
                </div>
        
                <form id="login" action="utils/login.php" class="inp-group" method="post">
                    <input type="email" class="inp" name="email" id="email" placeholder="Email Address" required autocomplete="off"><span id="email" ></span>
                    <input type="password" class="inp" name="password" id="password" placeholder="Enter your password" required autocomplete="off">
                    <button type="submit" name="login_btn" class="sub">Log In</button>
                </form>
                <form id="register" action="utils/register.php" class="inp-group" method="post">
                    <input
                        type="username"
                        class="inp"
                        name="username"
                        id="username"
                        placeholder="User name"
                        required
                        autocomplete="off">
                    <span
                    id="username"
                    class="text-danger">
                    </span>
                    <input
                    type="email"
                    class="inp"
                    name="email"
                    id="email"
                    placeholder="Email Id"
                    required
                    autocomplete="off">
                    <span
                    id="emailid"
                    class="text-danger">
                    </span>
                    <input
                    type="password"
                    class="inp"
                    name="password"
                    id="pw"
                    placeholder="Enter your password"
                    required
                    autocomplete="off">
                    <span
                    id="password"
                    class="text-danger">
                    </span>
                    <input
                    type="password"
                    class="inp"
                    name="confirm_password"
                    id="confirmPw"
                    placeholder="Confirm your password"
                    required
                    autocomplete="off">
                    <span
                    id="perr"
                    class="text-danger">
                    </span>
                    <button
                    type="submit"
                    name="register_btn"
                    class="sub">
                        Register
                    </button>
                </form>
            </div>
        </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function $Id(element){
            return document.getElementById(element);
        }

       

        $Id('confirmPw').addEventListener('keyup',
        function() {
                 var pw = $Id('pw');
                 var cpw = $Id('confirmPw');
                 pw.innerHTML="Invalid PW";
        
                if(pw.value !== cpw.value){
                       $Id('perr').innerHTML="Invalid Pw";
                       $Id('perr').style.color="red";
                }else{
                    $Id('perr').innerHTML="Valid Pw";
                       $Id('perr').style.color="black";
                }

        });

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
    </script>
</body>
</html>