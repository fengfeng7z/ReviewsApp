  // var defaultBounds = new google.maps.LatLngBounds(
//   new google.maps.LatLng(-33.8902, 151.1759),
//   new google.maps.LatLng(-33.8474, 151.2631));
//var defaultLat=51.501364;
//var defaultLng=-0.141890;
var defaultLat=Number($('#defaultLat').val());
var defaultLng=Number($('#defaultLng').val());
var pyrmont =   {lat: defaultLat, lng: defaultLng};
//var pyrmont =$('#position').val();
var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 19,
center: pyrmont
});
var marker= new google.maps.Marker({
        position:pyrmont,
        map: map,
        draggable:true,
        label:"P"
    });
    
