<?php
session_start();

$conn = new mysqli("localhost","root","","voting_system");

if($conn->connect_error){
    die("Database Connection Failed");
}

$error = "";

if(isset($_POST['login'])){

    $citizenship = trim($_POST['citizenship']);
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $voter_id = trim($_POST['voter_id']);

    $stmt = $conn->prepare("
        SELECT *
        FROM users
        WHERE citizenship_no=?
        AND email=?
        AND full_name=?
        AND voter_id=?
    ");

    $stmt->bind_param(
        "ssss",
        $citizenship,
        $email,
        $name,
        $voter_id
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];

        header("Location: votingpage.php");
        exit();

    }else{
        $error = "Invalid voter information.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>National E-Voting System - Login</title>

<style>
*{box-sizing:border-box}
body{margin:0;font-family:Arial,sans-serif}

.hero{
position:relative;
min-height:100vh;
width:100vw;
overflow:hidden;
background:#000;
display:flex;
align-items:center;
justify-content:center;
padding:24px;
}

.bg{
position:absolute;
inset:0;
width:100%;
height:100%;
object-fit:cover;
filter:brightness(.5);
}

.overlay{
position:absolute;
inset:0;
background:rgba(0,0,0,.35);
}

.card{
position:relative;
width:480px;
max-width:92vw;
background:#fff;
border-radius:18px;
padding:26px 24px 22px;
box-shadow:0 25px 70px rgba(0,0,0,.45);
z-index:2;
}

.top{text-align:center}

.logo{
width:92px;
display:block;
margin:0 auto 10px;
}

.title{
margin:0;
color:#0c2f68;
font-size:30px;
font-weight:800;
}

.subtitle{
margin:8px 0 14px;
color:#6b7280;
font-size:14px;
font-weight:600;
}

label{
display:block;
margin:14px 0 6px;
font-weight:800;
color:#0c2f68;
font-size:14px;
}

.field{
display:flex;
align-items:center;
border:1px solid #d1d5db;
border-radius:10px;
padding:10px 12px;
}

input{
border:none;
outline:none;
width:100%;
font-size:14px;
}

.btn{
margin-top:18px;
width:100%;
padding:12px;
border:none;
border-radius:10px;
background:#0c2f68;
color:#fff;
font-size:16px;
font-weight:800;
cursor:pointer;
}

.btn:hover{
background:#0a3c86;
}

.error{
background:#ffdede;
color:#c00;
padding:10px;
border-radius:8px;
margin-bottom:15px;
text-align:center;
font-weight:bold;
}
</style>
</head>

<body>

<div class="hero">

<img class="bg" src="0-02-03-95b8c1bd0603e7ed06e7c07e4c5a25257fdc55a9d20b1ab4d0320b03d18c64ad_d6a95fe373cc898b.jpg" alt="">

<div class="overlay"></div>

<form class="card" method="POST">

<div class="top">

<img class="logo"
src="Emblem_of_Nepal.svg"
alt="Nepal">

<h1 class="title">
National E-Voting System
</h1>

<p class="subtitle">
Committed to Transparency, Security, and Electoral Integrity
</p>

</div>

<?php if($error!=""){ ?>
<div class="error">
<?php echo $error; ?>
</div>
<?php } ?>

<label>Citizenship Number</label>
<div class="field">
<input
type="text"
name="citizenship"
placeholder="Enter your citizenship number"
required>
</div>

<label>Email</label>
<div class="field">
<input
type="email"
name="email"
placeholder="Enter your email address"
required>
</div>

<label>Name</label>
<div class="field">
<input
type="text"
name="name"
placeholder="Enter your full name"
required>
</div>

<label>Voter ID</label>
<div class="field">
<input
type="text"
name="voter_id"
placeholder="Enter your voter ID"
required>
</div>

<button
class="btn"
type="submit"
name="login">
Login
</button>

</form>

</div>

</body>
</html>