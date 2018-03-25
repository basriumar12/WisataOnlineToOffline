<?php
require_once '../config/conn.php';

function GetAll(){
  $query = "SELECT * FROM tbl_wisata";
  $exe = mysqli_query(Connect(),$query);
  while($data = mysqli_fetch_array($exe)){
    $datas[] = array('id_wisata' => $data['id_wisata'],
		'nama_wisata' => $data['nama_wisata'],
		'gambar_wisata' => $data['gambar_wisata'],
		'deksripsi_wisata' => $data['deksripsi_wisata'],
		'alamat_wisata' => $data['alamat_wisata'],
		'event_wisata' => $data['event_wisata'],
		'latitude_wisata' => $data['latitude_wisata'],
		'longitude_wisata' => $data['longitude_wisata'],
		
    );
  }
  return $datas;
}

function GetOne($id){
  $query = "SELECT * FROM  `tbl_wisata` WHERE  `id_wisata` =  '$id'";
  $exe = mysqli_query(Connect(),$query);
  while($data = mysqli_fetch_array($exe)){
    $datas[] = array('id_wisata' => $data['id_wisata'], 
		'nama_wisata' => $data['nama_wisata'], 
		'gambar_wisata' => $data['gambar_wisata'], 
		'deksripsi_wisata' => $data['deksripsi_wisata'], 
		'alamat_wisata' => $data['alamat_wisata'], 
		'event_wisata' => $data['event_wisata'], 
		'latitude_wisata' => $data['latitude_wisata'], 
		'longitude_wisata' => $data['longitude_wisata']
    );
  }
return $datas;
}

function Insert(){
    $nama_wisata=$_POST['nama_wisata']; 
		$gambar_wisata=$_POST['gambar_wisata']; 
		$deksripsi_wisata=$_POST['deksripsi_wisata']; 
		$alamat_wisata=$_POST['alamat_wisata']; 
		$event_wisata=$_POST['event_wisata']; 
		$latitude_wisata=$_POST['latitude_wisata']; 
		$longitude_wisata=$_POST['longitude_wisata'];
    $file_path = "../img/wisata/";
    $file_path = $file_path . basename($_FILES['gambar_wisata']['name']);
    $nama =basename($_FILES['gambar_wisata']['name']);
    if (file_exists($file_path) && $file_path != "../img/wisata/") {
      $_SESSION['message'] = " Gambar Udah Ada ";
      $_SESSION['mType'] = "danger ";
      header("Location: index.php");
    }
    else if($file_path == "../img/wisata/"){
          $query = "INSERT INTO `tbl_wisata` (`id_wisata`,`nama_wisata`,`gambar_wisata`,`deksripsi_wisata`,`alamat_wisata`,`event_wisata`,`latitude_wisata`,`longitude_wisata`)
        VALUES (NULL,'$nama_wisata','$nama','$deksripsi_wisata','$alamat_wisata','$event_wisata','$latitude_wisata','$longitude_wisata')";
        $exe = mysqli_query(Connect(),$query);
          if($exe){
            $_SESSION['message'] = " Data Sudah disimpan ";
            $_SESSION['mType'] = "success ";
            header("Location: index.php");
          }
          else{
            $_SESSION['message'] = " Data Gagal disimpan ";
            $_SESSION['mType'] = "danger ";
            header("Location: index.php");
          }
    }
    else{
      if(move_uploaded_file($_FILES['gambar_wisata']['tmp_name'], $file_path)){
          $query = "INSERT INTO `tbl_wisata` (`id_wisata`,`nama_wisata`,`gambar_wisata`,`deksripsi_wisata`,`alamat_wisata`,`event_wisata`,`latitude_wisata`,`longitude_wisata`)
        VALUES (NULL,'$nama_wisata','$nama','$deksripsi_wisata','$alamat_wisata','$event_wisata','$latitude_wisata','$longitude_wisata')";
        $exe = mysqli_query(Connect(),$query);
          if($exe){
            $_SESSION['message'] = " Data Sudah disimpan ";
            $_SESSION['mType'] = "success ";
            header("Location: index.php");
          }
          else{
            $_SESSION['message'] = " Data Gagal disimpan ";
            $_SESSION['mType'] = "danger ";
            header("Location: index.php");
          }
      }
      else{
        $_SESSION['message'] = " Data Gagal disimpan ";
        $_SESSION['mType'] = "danger ";
        header("Location: index.php");
      }
    }
    
}
function Update($id){
  $nama_wisata=$_POST['nama_wisata']; 
		$gambar_wisata=$_POST['gambar_wisata']; 
		$deksripsi_wisata=$_POST['deksripsi_wisata']; 
		$alamat_wisata=$_POST['alamat_wisata']; 
		$event_wisata=$_POST['event_wisata']; 
		$latitude_wisata=$_POST['latitude_wisata']; 
		$longitude_wisata=$_POST['longitude_wisata'];
    $file_path = "../img/wisata/";
    $nama =basename($_FILES['gambar_wisata']['name']);
    $file_path = $file_path . basename($_FILES['gambar_wisata']['name']);
    if (file_exists($file_path) && $file_path != "../img/wisata/") {
      $_SESSION['message'] = " Gambar Udah Ada ";
      $_SESSION['mType'] = "danger ";
      header("Location: index.php");
    }
    else if($file_path == "../img/wisata/"){
          $query = "UPDATE `tbl_wisata` SET `nama_wisata` = '$nama_wisata',`deksripsi_wisata` = '$deksripsi_wisata',`alamat_wisata` = '$alamat_wisata',`event_wisata` = '$event_wisata',`latitude_wisata` = '$latitude_wisata',`longitude_wisata` = '$longitude_wisata' WHERE  `id_wisata` =  '$id'";
        $exe = mysqli_query(Connect(),$query);
          if($exe){
            // kalau berhasil
            $_SESSION['message'] = " Data Sudah diubah ";
            $_SESSION['mType'] = "success ";
            header("Location: index.php");
          }
          else{
            $_SESSION['message'] = " Data Gagal diubah ";
            $_SESSION['mType'] = "danger ";
            header("Location: index.php");
          }      
    }
    else{
      if(move_uploaded_file($_FILES['gambar_wisata']['tmp_name'], $file_path)){
          $query = "UPDATE `tbl_wisata` SET `nama_wisata` = '$nama_wisata',`gambar_wisata` = '$nama',`deksripsi_wisata` = '$deksripsi_wisata',`alamat_wisata` = '$alamat_wisata',`event_wisata` = '$event_wisata',`latitude_wisata` = '$latitude_wisata',`longitude_wisata` = '$longitude_wisata' WHERE  `id_wisata` =  '$id'";
        $exe = mysqli_query(Connect(),$query);
          if($exe){
            // kalau berhasil
            $_SESSION['message'] = " Data Sudah diubah ";
            $_SESSION['mType'] = "success ";
            header("Location: index.php");
          }
          else{
            $_SESSION['message'] = " Data Gagal diubah ";
            $_SESSION['mType'] = "danger ";
            header("Location: index.php");
          }
      }
      else{
        $_SESSION['message'] = " Data Gagal disimpan ";
        $_SESSION['mType'] = "danger ";
        header("Location: index.php");
      }
    }		

}
function Delete($id){
  $query = "DELETE FROM `tbl_wisata` WHERE `id_wisata` = '$id'";
  $exe = mysqli_query(Connect(),$query);
    if($exe){
      // kalau berhasil
      $_SESSION['message'] = " Data Sudah dihapus ";
      $_SESSION['mType'] = "success ";
      header("Location: index.php");
    }
    else{
      $_SESSION['message'] = " Data Gagal dihapus ";
      $_SESSION['mType'] = "danger ";
      header("Location: index.php");
    }
}


if(isset($_POST['insert'])){
  Insert();
}
else if(isset($_POST['update'])){
  Update($_POST['id_wisata']);
}
else if(isset($_POST['delete'])){
  Delete($_POST['id_wisata']);
}
?>
