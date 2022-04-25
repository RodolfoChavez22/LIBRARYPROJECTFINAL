<?php
  session_start();
  include("connect.php");
  date_default_timezone_set('America/Chicago');
  $BackSlashCount = substr_count($_SERVER['REQUEST_URI'],"/");
  if($BackSlashCount == 2){$BackSlash = '';}
  if($BackSlashCount == 3){$BackSlash = '../';}
  if($BackSlashCount == 4){$BackSlash = '../../';}
  
  if(empty($_SESSION['User_id'])){
    $_SESSION['User_Status'] = '';
  }

  if($_SESSION['User_Status'] != 'admin' && substr_count($_SERVER['REQUEST_URI'],"admin") > 0){
    if($BackSlashCount == 3){header('location: ../homepage');die;}
    if($BackSlashCount == 4){header('location: ../../homepage');die;}
  }

  if(!empty($_SESSION['User_id'])){
    $log = 'LOGOUT';
    $logref = $BackSlash.'logout.php';

  }
  else{
    $log = 'LOGIN';
    $logref = $BackSlash.'login';

  }

  if(!empty($_SESSION['User_id'])){
    if($_SESSION['User_Status'] == 'admin'){
      $sign = 'ADMIN PANEL';
      $signref = $BackSlash.'admin/dashboard';
    }
    else{
      $sign = 'USER PANEL';
      $signref = $BackSlash.'user/userdashboard';
    }
  }
  else{
    $sign = 'SIGNUP';
    $signref = $BackSlash.'signup';
    }

    $homepage = $BackSlash.'homepage';
    $catalogheader = $BackSlash.'catalog';

  if(!empty($_SESSION['User_id'])){
    if($_SESSION['User_Status'] == 'admin'){
      $about  = 'USER PANEL';
      $aboutref = $BackSlash.'user/userdashboard';
    }
    else{
      $about  = 'ABOUT';
      $aboutref  = $BackSlash.'about';
    }
  }
  else{
    $about  = 'ABOUT';
    $aboutref  = $BackSlash.'about';    
  }
?>




<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="header-top">
      <h1>Team 1: Library Management System</h1>
    </div>
    <div class="header" id="myHeader">
      <button class="button buttonHome" onclick="location.href='<?php echo $homepage; ?>';">HOME</button>
			<button class="button buttonCatalog" onclick="location.href='<?php echo $catalogheader; ?>';">CATALOG</button>
      <button class="button buttonAbout" onclick="location.href='<?php echo $aboutref; ?>';"><?php echo $about; ?></button>
      <button class="button buttonSignup" onclick="location.href='<?php echo $signref; ?>';"><?php echo $sign; ?></button>
      <button class="button buttonLogin" onclick="location.href='<?php echo $logref; ?>';"><?php echo $log; ?></button>
    </div>
                        
