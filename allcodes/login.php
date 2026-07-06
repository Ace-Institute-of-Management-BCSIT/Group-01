<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$conn = new mysqli("sql311.infinityfree.com", "if0_42346681", "sidd974244", "if0_42346681_voting_system");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$error = "";

if (isset($_POST['login'])) {

    $citizenship = trim($_POST['citizenship']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $name = trim($_POST['name']);
    $voter_id = trim($_POST['voter_id']);

    $stmt = $conn->prepare(
        "SELECT * FROM users
         WHERE citizenship_no=?
         AND email=?
         AND phone_number=?
         AND full_name=?
         AND voter_id=?"
    );

    $stmt->bind_param(
        "sssss",
        $citizenship,
        $email,
        $phone,
        $name,
        $voter_id
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // Store user information in session
        $_SESSION['id'] = $user['id'];
        $_SESSION['citizenship_no'] = $user['citizenship_no'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['voter_id'] = $user['voter_id'];
        $_SESSION['email'] = $user['email'];
        // Prevent login if already voted
        if ($user['voted'] == 1) {

            $error = "You have already voted.";

        } else {

           $otp = rand(100000,999999);

$_SESSION['otp'] = $otp;
$_SESSION['otp_time'] = time();

$mail = new PHPMailer(true);

try{

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'siddhartha.siddhi01@gmail.com';
    $mail->Password = 'webn pcuj gnog vksx';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('siddhartha.siddhi01@gmail.com','National E-Voting System');

    $mail->addAddress($user['email']);

    $mail->isHTML(true);

    $mail->Subject = 'Email Verification Code';

    $mail->Body = "
    <h2>National E-Voting System</h2>

    <p>Your verification code is:</p>

    <h1>$otp</h1>

    <p>This code is valid for 5 minutes.</p>
    ";

    $mail->send();

    header("Location: verify_otp.php");
    exit();

}catch(Exception $e){

    $error = "Failed to send verification email.";

}

        }

    } else {

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
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial,sans-serif;
    overflow-x:hidden;
}

/* Background */

.hero{
    position:relative;
    min-height:100vh;
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
    overflow:hidden;
    background:#000;
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

/* Login Card */

.card{
    position:relative;
    z-index:2;

    width:100%;
    max-width:500px;

    background:#fff;
    border-radius:18px;

    padding:30px;

    box-shadow:0 20px 60px rgba(0,0,0,.45);
}

/* Header */

.top{
    text-align:center;
}

.logo{
    width:90px;
    margin:auto;
    display:block;
    margin-bottom:12px;
}

.title{
    color:#0c2f68;
    font-size:clamp(1.8rem,4vw,2rem);
    font-weight:800;
    margin-bottom:10px;
}

.subtitle{
    color:#666;
    font-size:15px;
    line-height:1.5;
    margin-bottom:20px;
}

/* Form */

label{
    display:block;
    margin:14px 0 6px;
    color:#0c2f68;
    font-size:14px;
    font-weight:700;
}

.field{
    border:1px solid #d1d5db;
    border-radius:10px;
    display:flex;
    align-items:center;
    padding:12px 14px;
}

input{
    width:100%;
    border:none;
    outline:none;
    font-size:15px;
    background:transparent;
}

input::placeholder{
    color:#999;
}

/* Button */

.btn{
    width:100%;
    margin-top:22px;

    padding:14px;

    border:none;
    border-radius:10px;

    background:#0c2f68;
    color:white;

    font-size:17px;
    font-weight:bold;

    cursor:pointer;

    transition:.3s;
}

.btn:hover{
    background:#0a3c86;
    transform:translateY(-2px);
}

/* Error */

.error{
    margin-bottom:18px;
    padding:12px;
    border-radius:8px;
    background:#ffdede;
    color:#c40000;
    text-align:center;
    font-weight:bold;
}

/* ========================= */
/* TABLETS */
/* ========================= */

@media (max-width:992px){

    .hero{
        padding:25px;
    }

    .card{
        max-width:450px;
        padding:28px;
    }

    .logo{
        width:80px;
    }

}

/* ========================= */
/* MOBILE */
/* ========================= */

@media (max-width:768px){

    .hero{
        padding:20px;
        align-items:center;
    }

    .card{
        max-width:100%;
        padding:25px 20px;
        border-radius:16px;
    }

    .logo{
        width:70px;
    }

    .subtitle{
        font-size:14px;
    }

    label{
        font-size:13px;
    }

    input{
        font-size:14px;
    }

    .btn{
        font-size:16px;
    }

}

/* ========================= */
/* SMALL PHONES */
/* ========================= */

@media (max-width:480px){

    .hero{
        padding:15px;
    }

    .card{
        padding:22px 16px;
    }

    .logo{
        width:60px;
    }

    .title{
        font-size:28px;
    }

    .subtitle{
        font-size:13px;
    }

    .field{
        padding:10px 12px;
    }

    .btn{
        padding:13px;
    }

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

<label>Phone Number</label>
<div class="field">
    <input
        type="tel"
        name="phone"
        placeholder="Enter your phone number"
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