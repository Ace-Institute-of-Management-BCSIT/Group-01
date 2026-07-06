<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>National E‑Voting System</title>

</head>

<body>
  <div class="hero">
    <img class="bg"
      src="0-02-03-95b8c1bd0603e7ed06e7c07e4c5a25257fdc55a9d20b1ab4d0320b03d18c64ad_d6a95fe373cc898b.jpg"
      alt="Mountain" />

    <div class="overlay"></div>

    <!-- Put your emblem image file name here -->
    <img class="logo" src="Emblem_of_Nepal.svg" alt="Logo" />

    <div class="text">
      <h1>National E‑Voting System</h1>
      <p>Committed to Transparency, Security, and Electoral Integrity</p>
    </div>

    <a class="btn" href="guideline.php">Continue →</a>
  </div>
</body>
</html>


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

/* HERO */
.hero{
    position:relative;
    width:100%;
    height:100vh;
    overflow:hidden;
    background:#000;
}

.hero img.bg{
    width:100%;
    height:100%;
    object-fit:cover;
    filter:brightness(0.5);
}

.overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.35);
}

/* LOGO */

.logo{
    position:absolute;
    top:25px;
    right:30px;
    width:140px;
    z-index:2;
}

/* TEXT */

.text{
    position:absolute;
    left:60px;
    bottom:70px;
    color:white;
    z-index:2;
    max-width:700px;
}

.text h1{
    font-size:clamp(2.3rem,5vw,4rem);
    margin-bottom:15px;
    font-weight:800;
    line-height:1.1;
}

.text p{
    font-size:clamp(1rem,2vw,1.4rem);
    font-weight:600;
    line-height:1.5;
}

/* BUTTON */

.btn{
    position:absolute;
    right:50px;
    bottom:60px;

    background:#e10d3a;
    color:white;
    text-decoration:none;

    padding:14px 26px;
    border-radius:30px;

    font-weight:bold;
    font-size:18px;

    transition:.3s;
    z-index:2;
}

.btn:hover{
    background:#ff2a55;
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(0,0,0,.35);
}

/* ========================= */
/* TABLET */
/* ========================= */

@media (max-width:992px){

    .logo{
        width:110px;
        right:25px;
        top:20px;
    }

    .text{
        left:40px;
        bottom:60px;
        max-width:500px;
    }

    .btn{
        right:40px;
        bottom:40px;
        padding:12px 22px;
        font-size:16px;
    }

}

/* ========================= */
/* MOBILE */
/* ========================= */

@media (max-width:768px){

    .hero{
        height:100vh;
    }

    .logo{
        width:80px;
        top:20px;
        right:20px;
    }

    .text{
        left:25px;
        right:25px;
        bottom:120px;
        text-align:left;
    }

    .text h1{
        font-size:34px;
    }

    .text p{
        font-size:17px;
        line-height:1.6;
    }

    .btn{
        left:25px;
        right:25px;
        bottom:35px;

        text-align:center;
        padding:15px;
        font-size:18px;
    }

}

/* ========================= */
/* SMALL PHONES */
/* ========================= */

@media (max-width:480px){

    .logo{
        width:65px;
    }

    .text{
        bottom:110px;
    }

    .text h1{
        font-size:28px;
    }

    .text p{
        font-size:15px;
    }

    .btn{
        font-size:16px;
        padding:14px;
    }

}
</style>