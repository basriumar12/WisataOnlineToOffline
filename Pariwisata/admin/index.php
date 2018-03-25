
<?php
require_once 'func.php';
if (isset($_SESSION['login'])) {
  if (!$_SESSION['login']) {
    $login = FALSE;
  }
  else{
    $login = TRUE;
  }
}
else{
  $login = FALSE;
}
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: ../");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Read tbl_wisata </title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/bootstrap-3.3.7-dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
    <script src="<?php echo BASE_URL; ?>/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
}

button:hover {
    opacity: 0.8;
}


.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

/* Change styles for span and cancel button on extra small screens */

</style>    
  </head>
  <body>
    <div class="container">
    <?php
    if(!empty($_SESSION['message'])){ ?>
    <div class="row-sm-12">
      <div class="alert alert-<?php echo $_SESSION['mType'];?> alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Notif !</strong> <?php echo $_SESSION['message']; ?>
      </div>      
    </div>
    <?php 
    $_SESSION['message'] = NULL;
    $_SESSION['mType'] = NULL;
     }?>
    <br>
    <?php if ($login) {?>
      <div class="row-sm-12">
         <a href='create.php' class='btn btn-info btn-sm'>Tambah</a>
      </div>
      <br>
      <div class="container">
      <div class="row">
        <?php  $ga = GetAll(); foreach($ga as $data){ ?>
          <div class="col-md-3">
            <div class="thumbnail">
                <img src="../img/wisata/<?php echo $data['gambar_wisata'];?>" style="width:100%">
                <div class="caption">
                  <p><?php echo $data['nama_wisata']; ?></p>
                 <!--  <p><?php echo $data['deksripsi_wisata']; ?></p>
                  <p><?php echo $data['event_wisata']; ?></p> -->
                  <div class="col-sm-12 text-center">
                    <div class="col-sm-6">
                      <form method='POST' action='edit.php'>
                        <input type='hidden' name='id_wisata' value='<?php echo $data['id_wisata']; ?>'>
                        <input type='submit' name='edit' Value=' Edit ' class='btn btn-warning '>
                      </form>                       
                    </div>
                    <div class="col-sm-6 text-center">
                      <form method='POST' action='func.php'>
                        <input type='hidden' name='id_wisata' value='<?php echo $data['id_wisata']; ?>'>
                        <input type='submit' name='delete' Value='Delete' class='btn btn-danger '>
                      </form>                       
                    </div>
                  </div>
                  <p>
                    <br>
                  </p>
                </div>
            </div>
          </div>
        <?php } ?>  
      </div>        
      </div>    
    <?php } else{ ?>
    <div class="container">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form action="" class="form-horizontal" method="POST">
          <div class="imgcontainer">
            <img src="../img/wisata/admin.png" alt="Avatar" class="avatar">
          </div>
          <div class="col-sm-12">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Username : </label>
                <input type="text" placeholder="Enter Username" name="uname" required >
              </div>
              <div class="form-group">
                <label>Password : </label>
                <input type="password" name="password" required placeholder="Enter Password">
              </div>
            </div>            
          </div>

          <div class="col-sm-12">
            <button name="login" value="L"> Login </button>
          </div>
          <div class="container"></div>
        </form>        
      </div>
      <div class="col-md-3"></div>
    </div>
    
    <?php }
    if (isset($_POST['login'])) {
      if (md5($_POST['uname']) == "21232f297a57a5a743894a0e4a801fc3") {
        if (md5($_POST['password']) == "21232f297a57a5a743894a0e4a801fc3") {
          $_SESSION['message'] = " Selamat datang Mimin ";
          $_SESSION['mType'] = "success ";
          $_SESSION['login'] = "Y";
          header("Location: index.php");
        }
        else{
          $_SESSION['message'] = " Password Salah ";
          $_SESSION['mType'] = "danger ";
          header("Location: index.php");
        }
      }
      else{
        $_SESSION['message'] = " Username Salah ";
        $_SESSION['mType'] = "danger ";
        header("Location: index.php");
      }
    }
     ?>



  </body>
</html>



