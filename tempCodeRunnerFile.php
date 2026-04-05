<?php
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
var dhakaBounds = L.latLngBounds([23.65, 90.30], [23.90, 90.55]);
var map = L.map('map', {
  center: [23.78, 90.40],
  zoom: 12,
  maxBounds: dhakaBounds,
  maxBoundsViscosity: 1.0,
  minZoom: 11,
  maxZoom: 16
});
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);
<?php foreach($mapReports as $r): if(!empty($r['latitude']) && !empty($r['longitude'])): ?>
L.marker([<?= (float)$r['latitude']?>,<?= (float)$r['longitude']?>])
  .addTo(map).bindPopup("<b><?= addslashes($r['category']) ?></b><br><?= addslashes($r['description']) ?>");
<?php endif; endforeach; ?>
</script>