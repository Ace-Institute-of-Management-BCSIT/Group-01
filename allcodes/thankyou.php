<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thank You For Voting</title>

  <style>
    *{ box-sizing:border-box; }

    body{
      margin:0;
      min-height:100vh;
      font-family: Arial, sans-serif;
      color:#fff;

      /* full screen background image */
      background: url("elephant.jpg") center/cover no-repeat;
      position:relative;
      overflow:hidden;
    }

    /* optional: subtle dark gradient to make text readable */
    .shade{
      position:absolute;
      inset:0;
      background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.10) 0%,
        rgba(0,0,0,0.10) 55%,
        rgba(0,0,0,0.35) 100%
      );
      z-index:0;
    }

    /* top-right logo */
    .logo{
      position:absolute;
      top:18px;
      right:22px;
      width:120px;
      height:120px;
      z-index:2;
    }
    .logo img{
      width:100%;
      height:100%;
      object-fit:contain;
      display:block;
    }

    /* center-bottom text */
    .content{
      position:relative;
      z-index:1;
      min-height:100vh;

      display:flex;
      flex-direction:column;
      justify-content:flex-end;
      align-items:center;

      padding: 0 18px 54px;
      text-align:center;
    }

    .small{
      font-size: 34px;
      font-weight: 800;
      margin: 0 0 10px;
      text-shadow: 0 3px 12px rgba(0,0,0,0.45);
    }

    .big{
      font-size: 64px;
      font-weight: 900;
      letter-spacing: 1px;
      margin: 0;
      text-transform: uppercase;
      text-shadow: 0 3px 14px rgba(0,0,0,0.50);
    }

    @media (max-width: 700px){
      .logo{ width:90px; height:90px; }
      .small{ font-size: 22px; }
      .big{ font-size: 38px; }
      .content{ padding-bottom: 34px; }
    }

    .view-results{
    position:absolute;
    right:40px;
    bottom:40px;
    background:#e10d3a;
    color:#fff;
    text-decoration:none;
    padding:12px 18px;
    border-radius:25px;
    font-weight:700;
    transition: 0.2s ease; /* smooth hover */
  }
    
  </style>
</head>

<body>
  <div class="shade"></div>

  <div class="logo">
    <img src="Emblem_of_Nepal.svg" alt="Logo" />
  </div>

  <div class="content">
    <p class="small">Your vote has been recorded</p>
    <h1 class="big">THANK YOU FOR VOTING</h1>
    
  </div>
</body>
</html>