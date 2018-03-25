
<?php
require_once 'func.php';
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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/bootstrap-3.3.7-dist/css/jumbotron-narrow.css">
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>    
    <script src="<?php echo BASE_URL; ?>/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class='container'>
      <div class='col-sm-1'></div>
      <div class='col-sm-10'>
        <div class='panel panel-info'>
          <div class='panel-heading'>Form Input tbl_wisata </div>
          <div class='panel-body'>
          <form action='func.php' method='POST' enctype="multipart/form-data">          
              <div class="form-group">
                <label for="nama_wisata"> nama_wisata:</label>
                <input type="text" class="form-control" id="nama_wisata" name='nama_wisata' placeholder='nama_wisata'>
              </div>
              <div class="form-group">
                <label for="gambar_wisata"> gambar_wisata:</label>
                <input type="file" class="form-control" id="gambar_wisata" name='gambar_wisata' placeholder='gambar_wisata'>
              </div>
              <div class="form-group">
                <label for="deksripsi_wisata"> deksripsi_wisata:</label>
                <textarea rows="10" class="form-control" id="deksripsi_wisata" name='deksripsi_wisata' placeholder='deksripsi_wisata'></textarea> 
              </div>
              <div class="form-group">
                <label for="alamat_wisata"> alamat_wisata:</label>
                <input type="text" class="form-control" id="alamat_wisata" name='alamat_wisata' placeholder='alamat_wisata'>
              </div>
              <div class="form-group">
                <label for="event_wisata"> event_wisata:</label>
                <input type="text" class="form-control" id="event_wisata" name='event_wisata' placeholder='event_wisata'>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="latitude_wisata"> latitude_wisata:</label>
                  <input type="text" class="form-control" id="latitude_wisata" name='latitude_wisata' placeholder='latitude_wisata' readonly>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="longitude_wisata"> longitude_wisata:</label>
                  <input type="text" class="form-control" id="longitude_wisata" name='longitude_wisata' placeholder='longitude_wisata' readonly>
                </div>                
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="longitude_wisata"> Tampilkan Map </label>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Buka Map</button>
                </div> 
              </div>
              <div class="col-sm-12">
              <input type='submit' name='insert' value='Save' class='btn btn-sm btn-primary'>                
              </div>

          </form>
          </div>
        </div>
      </div>
      <div class='col-sm-1'></div>
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div id="map"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>      
    </div>
    <script>
      var marker;
      function initMap() {
        var latlng = new google.maps.LatLng(-6.175072, 106.827153);
        var map = new google.maps.Map(document.getElementById("map"),{
            zoom: 15,
            center: latlng,
        });
        google.maps.event.addListener(map, 'click', function(event) { 
          $('input[name="latitude_wisata"]').val(event.latLng.lat());
          $('input[name="longitude_wisata"]').val(event.latLng.lng());
          placeMarker(event.latLng); 
        });
        function placeMarker(location) {
            if (marker == undefined){
                marker = new google.maps.Marker({
                    position: location,
                    map: map, 
                    animation: google.maps.Animation.DROP,
                });
            }
            else{
                marker.setPosition(location);
            }
            map.setCenter(location);
        }
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVzX5sbjSWQOlxQPmcuWNa3igsCB3cbOA&callback=initMap">
    </script>    
  </body>
</html>

