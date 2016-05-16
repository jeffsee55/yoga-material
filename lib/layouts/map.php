<div class="map-container" style="height: 500px;">
  <div class='map-sidebar'>
    <div id='listings' class='listings'></div>
  </div>
  <div id='map' class='map'> </div>
</div>

<script>
L.mapbox.accessToken = 'pk.eyJ1IjoiamVmZnNlZTU1IiwiYSI6Ikx3SDJWYkEifQ.HZU9OPR9xo_RKYIedF6QWQ';

var props = [
<?php foreach( $posts as $post ) {
  if( !empty( get_post_meta( $post->ID, '_latitude', true ) ) && !empty( get_post_meta( $post->ID, '_longitude', true ) ) ) :
  ?>
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [
        <?php echo json_encode( get_post_meta( $post->ID, '_longitude', true) ); ?>,
        <?php echo json_encode( get_post_meta( $post->ID, '_latitude', true) ); ?>
      ]
    },
    "properties": {
      "address": <?php echo json_encode( listing_address( $post->ID ) ); ?>,
      "city": <?php echo json_encode( get_post_meta( $post->ID, '_city') ); ?>,
      "state" : "South Carolina",
      "country": "United States",
      "postalCode": <?php echo json_encode( get_post_meta( $post->ID, '_zip_code') ); ?>,
      "link": <?php echo json_encode(get_permalink( $post->ID ) ); ?>,
      "image": <?php echo json_encode(get_post_meta( $post->ID, '_listing_featured_image', true ) ); ?>
    }
  },
<?php endif; }; ?>
]

Array.min = function( array ){
    return Math.min.apply( Math, array );
};
Array.max = function( array ){
    return Math.max.apply( Math, array );
};

// Array of longitudes in the list
var longitudes = []
props.forEach(function(listing) {
  longitudes.push(listing.geometry.coordinates[0])
});
// Array of latitudes in the list
var latitudes = []
props.forEach(function(listing) {
  latitudes.push(listing.geometry.coordinates[1])
});
// Remove 0 values
for (var i = 0; i < longitudes.length; i ++) {
  if (longitudes[i] == 0) { 
    longitudes.splice(i, 1);
    break;
  }
}
// Remove 0 values
for (var i = 0; i < latitudes.length; i ++) {
  if (latitudes[i] == 0) { 
    latitudes.splice(i, 1);
    break;
  }
}

// Define mins and maxes for fitting bounding box
var maxLat = Array.max(latitudes);
var maxLng = Array.max(longitudes);
var minLat = Array.min(latitudes);
var minLng = Array.min(longitudes);

var geojson = [
  {
    "type": "FeatureCollection",
    "features": props
  }
];
var map = L.mapbox.map('map', 'jeffsee55.j5l6fgid');

map.fitBounds([[ minLat, minLng ], [ maxLat, maxLng ]]);

map.scrollWheelZoom.disable();

var listings = document.getElementById('listings');
var locations = L.mapbox.featureLayer().addTo(map);

locations.setGeoJSON(geojson);

function setActive(el) {
  var siblings = listings.getElementsByTagName('div');
  for (var i = 0; i < siblings.length; i++) {
    siblings[i].className = siblings[i].className
    .replace(/active/, '').replace(/\s\s*$/, '');
  }

  el.className += ' active';
}

locations.eachLayer(function(locale) {

  // Shorten locale.feature.properties to just `prop` so we're not
  // writing this long form over and over again.
  var prop = locale.feature.properties;

  // Each marker on the map.
  var popup = '<img src=' + prop.image + '><h3><a href= ' + prop.link + '>' + prop.address + '</h3></a>';

  var listing = listings.appendChild(document.createElement('div'));
  listing.className = 'item';

  var link = listing.appendChild(document.createElement('a'));
  link.href = '#';
  link.className = 'title';

  link.innerHTML = prop.address;
  if (prop.crossStreet) {
    link.innerHTML += '<br /><small class="quiet">' + prop.crossStreet + '</small>';
    popup += '<br /><small class="quiet">' + prop.crossStreet + '</small>';
  }

  var details = listing.appendChild(document.createElement('div'));
  details.innerHTML = prop.city;

  link.onclick = function() {
    setActive(listing);

    // When a menu item is clicked, animate the map to center
    // its associated locale and open its popup.
    // -80.325928647000
    // 25.796793426842
    
    map.setView([ locale.getLatLng().lat + 0.002, locale.getLatLng().lng ], 16);
    locale.openPopup();
    return false;
  };

  // Marker interaction
  locale.on('click', function(e) {
    // 1. center the map on the selected marker.
    map.panTo([ locale.getLatLng().lat, locale.getLatLng().lng ]);

    // 2. Set active the markers associated listing.
    setActive(listing);
  });

  locale.bindPopup(popup);

  locale.setIcon(L.icon({
    iconUrl: '/wp-content/themes/must-see/images/marker.png',
    iconSize: [32, 32],
    iconAnchor: [22, 45],
    popupAnchor: [-5, -40]
  }));

});

// Adjust
jQuery(document).foundation({
  tab: {
    callback : function (tab) {
      map.invalidateSize();
      map.fitBounds([[ minLat, minLng ], [ maxLat, maxLng ]]);
    }
  }
});

</script>

<?php
if (function_exists('equity')) {
  must_see_posts_nav( 'map' );
}

