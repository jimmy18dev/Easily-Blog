var map;
var markers = [];
$MapEmbed = null;
$(document).ready(function(){
	$MapEmbed = $('.google-map');

	$.each($MapEmbed, function() {
		initMap($(this));
	});
});

function initMap($this) {
	$embed 		= $this.children('.embed-map');
	$latInput 	= $this.children('.lat');
	$lngInput 	= $this.children('.lng');
	var content_id = $this.attr('data-content');
	var lat 	= parseFloat($this.children('.lat').val());
	var lng 	= parseFloat($this.children('.lng').val());

	if(lat && lng){
		var marker = {lat:lat, lng:lng};
	}else{
		var marker = {lat: -25.363, lng: 131.044};
	}

	var map = new google.maps.Map($embed[0], {
		zoom: 15,
		center: marker
	});

	var marker = new google.maps.Marker({
		position: marker,
		map: map
	});

	map.addListener('click', function(e){
		$lngInput.val(e.latLng.lng());
		$latInput.val(e.latLng.lat()).trigger('input');

		var newlat = e.latLng.lat();
		var newlng = e.latLng.lng();

		console.log('Article => '+current_article_id,'Content => '+content_id,newlat,newlng);

		// activeSaveButton();

		var marker = new google.maps.Marker({
			position: e.latLng,
			map: map
		});

		map.panTo(e.latLng);
	});
}

function addMarker(location) {
	clearMarkers();

	var marker = new google.maps.Marker({
		position: location,
		map: map
    });

    map.panTo(location);
    markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}