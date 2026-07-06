<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Voting Guidelines</title>

  <style>
 :root{
    --overlay:rgba(11,86,148,.72);
    --btn:#e20b2d;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial,sans-serif;
    min-height:100vh;
    background:url("viber_image_2026-05-26_13-27-08-940.jpg") center center/cover no-repeat fixed;
    color:#fff;
    overflow-x:hidden;
}

.overlay{
    position:fixed;
    inset:0;
    background:var(--overlay);
    z-index:0;
}

.page{
    position:relative;
    z-index:1;
    min-height:100vh;
    padding:40px 70px 120px;
}

/* Logo */

.logo{
    position:absolute;
    top:25px;
    right:35px;
}

.logo img{
    width:130px;
    height:auto;
}

/* Heading */

h1{
    text-align:center;
    margin:15px 0 25px;
    font-size:clamp(2.3rem,5vw,4rem);
    font-weight:800;
}

.subtitle{
    margin-bottom:20px;
    font-size:clamp(1.2rem,2vw,1.8rem);
    font-style:italic;
    font-weight:700;
}

/* List */

ul{
    padding-left:30px;
    font-size:clamp(1rem,1.8vw,1.5rem);
    line-height:1.8;
}

li{
    margin-bottom:10px;
}

/* Button */

.continue{
    position:fixed;
    right:40px;
    bottom:30px;

    display:flex;
    align-items:center;
    gap:15px;

    background:var(--btn);
    color:#fff;

    text-decoration:none;
    padding:14px 22px;
    border-radius:50px;

    font-weight:bold;
    font-size:18px;

    transition:.3s;
    z-index:1000;
}

.continue:hover{
    background:#111;
    transform:translateY(-3px);
}

.icon{
    width:35px;
    height:35px;
    border-radius:50%;
    background:#fff;
    color:var(--btn);

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:20px;
    font-weight:bold;
}

/* ========================= */
/* TABLETS */
/* ========================= */

@media (max-width:992px){

    .page{
        padding:35px 40px 110px;
    }

    .logo img{
        width:100px;
    }

    ul{
        line-height:1.7;
    }

    .continue{
        right:30px;
        bottom:25px;
    }

}

/* ========================= */
/* MOBILE */
/* ========================= */

@media (max-width:768px){

    .page{
        padding:25px 22px 120px;
    }

    .logo{
        position:static;
        text-align:center;
        margin-bottom:15px;
    }

    .logo img{
        width:80px;
    }

    h1{
        margin-top:0;
        margin-bottom:20px;
    }

    .subtitle{
        text-align:center;
        margin-bottom:20px;
    }

    ul{
        padding-left:22px;
        line-height:1.7;
    }

    .continue{
        left:20px;
        right:20px;
        bottom:20px;

        justify-content:center;
        font-size:17px;
        padding:15px;
    }

}

/* ========================= */
/* SMALL PHONES */
/* ========================= */

@media (max-width:480px){

    .page{
        padding:20px 16px 115px;
    }

    .logo img{
        width:65px;
    }

    ul{
        font-size:15px;
    }

    .subtitle{
        font-size:18px;
    }

    .continue{
        font-size:16px;
        padding:14px;
    }

}
  </style>
</head>

<body>

  <div class="overlay"></div>

  <div class="page">

    <div class="logo">
      <img src="Emblem_of_Nepal.svg" alt="Logo">
    </div>

    <h1>E-Voting Guidelines</h1>

    <p class="subtitle">
      Please read the following guidelines before voting
    </p>

    <ul>
      <li>Carefully review the election symbol before casting your vote.</li>
      <li>Ensure the selected election symbol is correct before submission.</li>
      <li>Each registered voter may vote only once.</li>
      <li>Once submitted, the vote cannot be modified or cancelled.</li>
      <li>Do not refresh or close the browser during vote submission.</li>
      <li>Maintain confidentiality and secrecy while voting.</li>
      <li>Do not allow others to access your voting session.</li>
      <li>Multiple voting attempts are strictly prohibited.</li>
      <li>A confirmation email will be sent after successful vote submission.</li>
      <li>The confirmation email will only confirm successful submission of the vote.</li>
      <li>Report any technical issues immediately to the Election Support Team.</li>
    </ul>

  </div>

  <a href="login.php" class="continue">
    Continue
    <span class="icon">&rsaquo;</span>
  </a>

</body>
</html>