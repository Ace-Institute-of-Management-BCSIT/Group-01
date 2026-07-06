<?php
session_start();
$conn = new mysqli("sql311.infinityfree.com", "if0_42346681", "sidd974244", "if0_42346681_voting_system");

if($conn->connect_error){
    die("Database Connection Failed");
}

if(!isset($_SESSION['citizenship_no'])){
    die("Please login first.");
}

$citizenship_no = $_SESSION['citizenship_no'];

if(isset($_POST['symbol_no'])){

    

    $check = $conn->prepare(
        "SELECT id FROM votes WHERE citizenship_no=?"
    );

    $check->bind_param("s",$citizenship_no);
    $check->execute();

    $result = $check->get_result();

    if($result->num_rows > 0){

        echo "<script>
                alert('You have already voted.');
              </script>";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO votes(citizenship_no)
             VALUES(?)"
        );

        $stmt->bind_param(
            "s",
            $citizenship_no
            
        );

        if($stmt->execute()){

            $update = $conn->prepare(
                "UPDATE users
                 SET voted=1
                 WHERE citizenship_no=?"
            );

            $update->bind_param(
                "s",
                $citizenship_no
            );

            $update->execute();

            echo "<script>
        alert('Vote submitted successfully!');
        window.location.href='thankyou.php';
      </script>";
exit();

        } else {

            die("Database Error: ".$stmt->error);

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Vote</title>

<style>
:root{
    --overlay:rgba(11,86,148,.72);
    --accent:#e0001a;
    --border:rgba(255,255,255,.35);
    --tile:rgba(255,255,255,.08);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial,sans-serif;
    background:url("viber_image_2026-05-26_13-27-08-940.jpg") center/cover no-repeat fixed;
    color:#fff;
    position:relative;
    min-height:100vh;
    overflow-x:hidden;
}

body::before{
    content:"";
    position:fixed;
    inset:0;
    background:var(--overlay);
    z-index:0;
}

.wrap{
    position:relative;
    z-index:1;
    padding:25px;
}

/* Header */

header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    margin-bottom:25px;
}

h1{
    font-size:clamp(2rem,5vw,4rem);
    font-weight:900;
}

.hint{
    margin-top:10px;
    color:#ffd65a;
    font-size:clamp(1rem,2vw,1.5rem);
    font-style:italic;
    font-weight:bold;
}

.logo img{
    width:120px;
    height:auto;
}

/* Grid */

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(95px,1fr));
    gap:15px;
}

.symbol-btn{
    background:var(--tile);
    border:2px solid var(--border);
    border-radius:12px;
    padding:12px;

    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;

    cursor:pointer;
    transition:.3s;
}

.symbol-btn:hover{
    background:rgba(255,255,255,.15);
    transform:translateY(-3px);
}

.symbol-btn img{
    width:65px;
    height:65px;
    object-fit:contain;
}

.symbol-btn span{
    margin-top:10px;
    font-weight:bold;
    font-size:16px;
}

/* Modal */

.modal{
    position:fixed;
    inset:0;
    display:none;
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal.open{
    display:flex;
}

.backdrop{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.55);
}

.dialog{
    position:relative;
    background:#07244a;
    width:90%;
    max-width:650px;
    border-radius:20px;
    padding:25px;
    border:2px solid rgba(0,140,255,.4);
}

.dialog-top{
    display:flex;
    align-items:center;
    gap:25px;
}

.dialog img{
    width:150px;
    height:150px;
    object-fit:contain;
    background:white;
    border-radius:10px;
}

.dialog h2{
    font-size:28px;
    line-height:1.5;
}

.actions{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-top:25px;
}

.btn{
    border:none;
    border-radius:10px;
    padding:14px 35px;
    font-size:20px;
    font-weight:bold;
    cursor:pointer;
}

.cancel{
    background:#6b7280;
    color:white;
}

.vote{
    background:var(--accent);
    color:white;
}

/* ====================== */
/* TABLET */
/* ====================== */

@media (max-width:992px){

    .logo img{
        width:90px;
    }

    .dialog img{
        width:120px;
        height:120px;
    }

    .dialog h2{
        font-size:22px;
    }

}

/* ====================== */
/* MOBILE */
/* ====================== */

@media (max-width:768px){

    header{
        flex-direction:column;
        align-items:center;
        text-align:center;
    }

    .logo img{
        width:75px;
    }

    .grid{
        grid-template-columns:repeat(3,1fr);
    }

    .symbol-btn img{
        width:55px;
        height:55px;
    }

    .dialog-top{
        flex-direction:column;
        text-align:center;
    }

    .dialog img{
        width:110px;
        height:110px;
    }

    .dialog h2{
        font-size:20px;
    }

    .actions{
        flex-direction:column;
    }

    .btn{
        width:100%;
    }

}

/* ====================== */
/* SMALL PHONES */
/* ====================== */

@media (max-width:480px){

    .wrap{
        padding:15px;
    }

    .grid{
        grid-template-columns:repeat(2,1fr);
    }

    .symbol-btn{
        padding:10px;
    }

    .symbol-btn img{
        width:45px;
        height:45px;
    }

    .symbol-btn span{
        font-size:14px;
    }

    .dialog{
        padding:20px;
    }

    .dialog h2{
        font-size:18px;
    }

}
</style>
</head>

<body>

<div class="wrap">

<header>
  <div>
    <h1>Choose Your Party</h1>
    <p class="hint">Tap a symbol to select your vote.</p>
  </div>

  <div class="logo">
    <img src="Emblem_of_Nepal.svg" alt="">
  </div>
</header>

<div class="grid" id="grid"></div>

</div>

<div class="modal" id="modal">
  <div class="backdrop"></div>

  <div class="dialog">
    <div class="dialog-top">
      <img id="confirmImg">
      <h2>Are you sure you want to vote for this symbol?</h2>
    </div>

    <div class="actions">
      <button class="btn cancel">Cancel</button>
      <button class="btn vote">Yes, Vote</button>
    </div>
  </div>
</div>

<form method="POST" id="voteForm">
    <input type="hidden" name="symbol_no" id="symbol_no">
</form>

<script>
const grid=document.getElementById('grid');
const modal=document.getElementById('modal');
const confirmImg=document.getElementById('confirmImg');

let selectedSymbol=null;

grid.innerHTML=[...Array(37)].map((_,i)=>{
  const n=String(i+1).padStart(2,'0');
  return `
  <button
      class="symbol-btn"
      data-symbol="${i+1}"
      data-img="symbol_${n}.png">
    <img src="symbol_${n}.png" alt="">
    <span>${n}</span>
  </button>`;
}).join('');

grid.onclick=e=>{
  const btn=e.target.closest('.symbol-btn');
  if(!btn) return;

  selectedSymbol=btn.dataset.symbol;
  confirmImg.src=btn.dataset.img;

  modal.classList.add('open');
};

document.querySelector('.cancel').onclick=()=>{
  modal.classList.remove('open');
};

document.querySelector('.backdrop').onclick=()=>{
  modal.classList.remove('open');
};

document.querySelector('.vote').onclick=()=>{

  document.getElementById('symbol_no').value =
      selectedSymbol;

  document.getElementById('voteForm').submit();
};
</script>

</body>
</html>