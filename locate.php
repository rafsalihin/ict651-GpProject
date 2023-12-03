<?php include 'header.php'; ?>
<style>
  #map { height: 400px; }
  .location-details {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .location-card {
    width: 200px;
    margin: 10px;
    padding: 10px;
    background-color: #f0f0f0;
    border-radius: 5px;
    text-align: center;
    cursor: pointer; /* Add cursor pointer */
  }
  h1{
    text-align: center;
  }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<h1 style="text-align: center;">LOCATION COURTS MALAYSIA</h1>
<div id="map"></div>
<div class="location-details">
  <?php
    $locations = [
      ['name' => 'Gong Badak', 'address' => 'Lot PT 35479, 35480 & 35481 Dataran Austin, Jalan Gong Badak, Kg Wakaf Tembesu, 21300 Kuala Terengganu, Terengganu.', 'lat' => '5.356633852314807', 'lng' => '103.09669892464859'],
      ['name' => 'Kota Bharu', 'address' => 'No. 3183, Jln Sultan Ibrahim, 15050 Kota Bharu, Kelantan.', 'lat' => '6.118446786736867', 'lng' => '102.24209013068854'],
      ['name' => 'Kuantan', 'address' => 'No. 17-23, Jalan Bukit Ubi, 25200 Kuantan, Pahang.', 'lat' => '3.8068938942793045', 'lng' => '103.32448685162318'],
      ['name' => 'Temerloh', 'address' => 'No. 93, 94, 95 & 95A, Wisma MINGFA, Jln Tengku Ismail, 28000 Temerloh, Pahang.', 'lat' => '3.444299766759488', 'lng' => '102.41500248230997'],
      ['name' => 'Ipoh', 'address' => '86-1 & 86-A, Jalan Dato Lau Pak Khuan, Ipoh Garden, 31400 Ipoh, Perak.', 'lat' => '4.61579408809848', 'lng' => '101.10918185681622'],
      ['name' => 'Bukit Mertajam', 'address' => 'F33 , 1st Floor, AEON Bukit Mertajam, Jalan Rozhan, Alma, 14000 Bukit Mertajam, Pulau Pinang.', 'lat' => '5.32148459972201', 'lng' => '100.47741164418035'],
      ['name' => 'Jitra', 'address' => 'No 206 & 207 , Kompleks Sim , Pekan Jitra 2, 06000 Jitra, Kedah.', 'lat' => '6.2576932323244865', 'lng' => '100.41957463814717'],
      ['name' => 'Kulim', 'address' => '578, Lorong Kemuning 1, Taman Kemuning, 09000 Kulim, Kedah.', 'lat' => '5.375001546185626', 'lng' => '100.53763752279632'],
      ['name' => 'Batu Pahat', 'address' => 'NO 30,30A,30B,32,32A,32B, Jalan Flora Utama 6, Taman Flora Utama, 83300 Batu Pahat, Johor.', 'lat' => '1.8646897233136954', 'lng' => '102.9502507092882'],
      ['name' => 'Nojima LaLaport Bukit Bintang City Centre', 'address' => 'L3-10A, Level 3, Mitsui Shopping Park LaLaport Bukit Bintang, 2, Jalan Hang Tuah, Kuala Lumpur City Centre, 55100 Kuala Lumpur, Federal Territory of Kuala Lumpur.', 'lat' => '3.141621862095586', 'lng' => '101.70808470929231'],
      ['name' => 'Banting', 'address' => 'No. 179 & 181, Jalan Sultan Abdul Samad, 42700 Banting, Selangor.', 'lat' => '2.8136806498601055', 'lng' => '101.50345298465572'],
      ['name' => 'Bentong', 'address' => 'No. 77, Taman Ketari, 28700 Bentong, Pahang.', 'lat' => '3.510023409700416', 'lng' => '101.91333306696605']
    ];

    foreach ($locations as $index => $location) {
      echo '<div class="location-card" onclick="zoomToLocation(' . $index . ')">'; // Add onclick event
      echo '<h3>' . $location['name'] . '</h3>';
      echo '<p>' . $location['address'] . '</p>';
      echo '</div>';
    }
  ?>
</div>
<script>
  var locations = <?php echo json_encode($locations); ?>;

  var map = L.map('map').setView([4.2105, 101.9758], 7); // Set the initial view to West Malaysia

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  // Add markers for each location and bind popup
  locations.forEach(function(location) {
    var marker = L.marker([location.lat, location.lng]).addTo(map);
    marker.bindPopup(location.name);
  });

  // Function to zoom/focus the map to a specific location
  function zoomToLocation(index) {
    var location = locations[index];
    map.setView([location.lat, location.lng], 15); // Adjust zoom level as desired
  }
</script>
<?php include 'footer.php'; ?>
