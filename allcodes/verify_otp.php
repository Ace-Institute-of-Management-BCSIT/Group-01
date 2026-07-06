<?php
session_start();

if (!isset($_SESSION['otp'])) {
    header("Location: login.php");
    exit();
}

$error = "";

if (isset($_POST['verify'])) {

    $enteredOtp = implode("", $_POST['otp']);

    if (time() - $_SESSION['otp_time'] > 300) {

        $error = "OTP has expired.";

    } elseif ($enteredOtp == $_SESSION['otp']) {

        unset($_SESSION['otp']);
        unset($_SESSION['otp_time']);

        header("Location: votingpage.php");
        exit();

    } else {

        $error = "Invalid OTP.";

    }

}
?>
<!doctype html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>Email Verification</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{

background:url("0-02-03-95b8c1bd0603e7ed06e7c07e4c5a25257fdc55a9d20b1ab4d0320b03d18c64ad_d6a95fe373cc898b.jpg") center/cover;

height:100vh;

display:flex;
justify-content:center;
align-items:center;

}

.overlay{

position:absolute;
inset:0;
background:rgba(0,0,0,.45);

}

.card{

position:relative;
z-index:2;

width:420px;

background:white;

padding:35px;

border-radius:18px;

box-shadow:0 20px 60px rgba(0,0,0,.4);

text-align:center;

}

.logo{

width:70px;
margin-bottom:15px;

}

h2{

color:#0c2f68;
margin-bottom:10px;

}

p{

color:#666;
margin-bottom:25px;

}

.otp{

display:flex;
justify-content:center;
gap:10px;

margin-bottom:25px;

}

.otp input{

width:50px;
height:55px;

text-align:center;

font-size:24px;

border:2px solid #ddd;

border-radius:10px;

}

.otp input:focus{

border-color:#0c2f68;

outline:none;

}

button{

width:100%;

padding:14px;

background:#0c2f68;

color:white;

border:none;

border-radius:10px;

font-size:16px;

cursor:pointer;

font-weight:bold;

}

button:hover{

background:#0a3c86;

}

.error{

background:#ffdede;

color:red;

padding:12px;

margin-bottom:18px;

border-radius:8px;

font-weight:bold;

}

.small{

margin-top:20px;

font-size:14px;

}

.small a{

color:#0c2f68;
text-decoration:none;
font-weight:bold;

}

</style>

</head>

<body>

<div class="overlay"></div>

<form class="card" method="POST">

<img class="logo"
src="Emblem_of_Nepal.svg">

<h2>Email Verification</h2>

<p>

Enter the 6-digit verification code sent to

<br><br>

<b><?php echo $_SESSION['email']; ?></b>

</p>
<?php
if(isset($_SESSION['success'])){
?>
<div style="
background:#d4edda;
color:#155724;
padding:12px;
border-radius:8px;
margin-bottom:15px;
font-weight:bold;
text-align:center;
">
<?php
echo $_SESSION['success'];
unset($_SESSION['success']);
?>
</div>
<?php
}
?>

<?php if($error!=""){ ?>

<div class="error">

<?php echo $error; ?>

</div>

<?php } ?>

<div class="otp">

<input type="text" maxlength="1" name="otp[]" required>

<input type="text" maxlength="1" name="otp[]" required>

<input type="text" maxlength="1" name="otp[]" required>

<input type="text" maxlength="1" name="otp[]" required>

<input type="text" maxlength="1" name="otp[]" required>

<input type="text" maxlength="1" name="otp[]" required>

</div>

<button name="verify">

Verify OTP

</button>

<p class="small">

Didn't receive the code?

<a href="resend_otp.php">

Resend OTP

</a>

</p>

</form>

<script>

const inputs=document.querySelectorAll('.otp input');

inputs.forEach((input,index)=>{

input.addEventListener('input',()=>{

if(input.value.length==1 && index<inputs.length-1){

inputs[index+1].focus();

}

});

input.addEventListener('keydown',e=>{

if(e.key==="Backspace" && input.value=="" && index>0){

inputs[index-1].focus();

}

});

});

</script>

</body>

</html>