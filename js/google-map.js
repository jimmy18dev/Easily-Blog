$MapEmbed = null;

$(document).ready(function(){
	$MapEmbed = $('.google-map');

	$.each($MapEmbed, function() {
		initMap($(this));
	});
});

function initMap($this) {
	var marker;

	$embed 		= $this.children('.embed-map');
	$latInput 	= $this.children('.lat');
	$lngInput 	= $this.children('.lng');

	var content_id = $this.attr('data-content');
	var lat 	= parseFloat($this.children('.lat').val());
	var lng 	= parseFloat($this.children('.lng').val());

	if(lat && lng){
		var default_location = {lat:lat, lng:lng};
	}else{
		var default_location = {lat: -25.363, lng: 131.044};
	}

	var map = new google.maps.Map($embed[0], {
		zoom: 15,
		center: default_location
	});

	if(lat && lng){
		marker = new google.maps.Marker({
			position: default_location,
			map: map
		});
	}else{
		marker = new google.maps.Marker();
	}

	map.addListener('click', function(e){
		$lngInput.val(e.latLng.lng());
		$latInput.val(e.latLng.lat()).trigger('input');

		var newlat = e.latLng.lat();
		var newlng = e.latLng.lng();

		marker.setMap(null);
		marker = new google.maps.Marker({
			position: e.latLng,
			map: map
		});

		map.panTo(e.latLng);
	});
}