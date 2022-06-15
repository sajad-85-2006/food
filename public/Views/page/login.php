
<?php
session_start();
error_reporting (~E_ALL);
if ($_SESSION['admin']){
    header('location: http://meno.food/Views/adminPanel.php');
}
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<div class="login">
    <div class="box_login">
        <form action="../../App/panel.php" method="post">
            <label for="input_user" id="label_user">Inter your user name</label>
            <input class="input_text" id="input_user" type="text" name="user" placeholder="Username" >
            <p style="color: red" id="q"></p>
            <label for="input_pass" id="label_pass">Inter your user name</label>
            <input class="input_text" id="input_pass" type="password" name="password" placeholder="Password" >
            <p id="a"></p>
            <label style="display: block">show password:</label>
            <label class="switch">
                <input type="checkbox" onclick="myFunction()">
                <span class="slider"></span>
            </label>
            <script>
                function myFunction() {
                    var x = document.getElementById("input_pass");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
            </script>
            <input style="display: none" name="login" value="login">
            <button style="display: inline !important;
float: right !important;
padding: 16px 56px !important;
border: none;
background: #00ADB5;
color: white;
border-radius: 5px;" id="btn_login" type="submit">Login</button>



        </form>
    </div>
</div>
</div>
</body>
</html>
<?php
