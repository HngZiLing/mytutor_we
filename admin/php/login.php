<?php
    session_start();
    $_SESSION["sessionid"]=session_id();
    if (isset($_POST['submit'])) {
        include 'dbconnect.php';
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $sqllogin = "SELECT * FROM table_users WHERE user_email = '$email' AND user_password='$password'";
        $stmt = $conn->prepare($sqllogin);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
    
        if ($number_of_rows  > 0) {
            $_SESSION["email"] = $email ;
            echo "<script>alert('Login Success');</script>";
            echo "<script> window.location.replace('index.php')</script>";
        } else {
            echo "<script>alert('Login Failed');</script>";
            echo "<script> window.location.replace('login.php')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="../js/login.js" defer></script>
    </head>

    <body onload="loadCookies()">
        <div class="w3-header w3-indigo w3-center w3-padding-30">
            <h3 style="font-size:calc(4px + 4vw);">MyTutor</h3>
            <p style="font-size:calc(4px + 1vw);;">Never put off what you can do today until tomorrow</p>
        </div>

        <div style="display:flex; justify-content: center">
            <div class="w3-container w3-card w3-round w3-padding w3-margin" style="width:600px; margin:auto; text-align:left;">
                <form name="loginForm" class="w3-container" action="login.php" method="post">
                    <div class="w3-container w3-indigo w3-center">
                        <h2>Login</h2>
                    </div>
                    <p>
                        <label class="w3-text-grey"><b>Email</b></label>
                        <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail" placeholder="Your email" required>
                    </p>
                    <p>
                        <label class="w3-text-grey"><b>Password</b></label>
                        <input class="w3-input w3-round w3-border" type="password" name="password" id="idpassword" placeholder="Your password" required>
                    </p>
                    <p>
                        <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                        <label>Remember Me</label>
                    </p>
                    <p><input class="w3-button w3-round w3-block w3-amber" type="submit" name="submit" id=idsubmit></p>
                    <p><a href="register.php" class="w3-center" style="display:flex; justify-content: center">Create New Account</a>
                </form>
            </div>
        </div>
        
        <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
            <div class="w3-indigo">
                <h4>Cookie Consent</h4>
                <p>This website uses cookies or similar technologies, to enhance your
                    browsing experience and provide personalized recommendations.
                    By continuing to use our website, you agree to our
                    <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
                </p>
                <div class="w3-button">
                    <button onclick="acceptCookieConsent();">Accept</button>
                </div>
            </div>
        </div>
        <footer class="w3-footer w3-center w3-indigo w3-bottom">
            <p>Copyright : MyTutor</p>
        </footer>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"> 
        let cookie_consent=getCookie("user_cookie_consent");
        if (cookie_consent!="") {
            document.getElementById("cookieNotice").style.display="none";
        } else {
            document.getElementById("cookieNotice").style.display="block";
        }
    </script>
</html>