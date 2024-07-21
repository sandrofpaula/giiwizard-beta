function initMap() {
    if (!window.mapLocation) return; // Verifica se mapLocation está definido
    var coords = window.mapLocation.split(',');
    var latLng = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
    
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: latLng
    });

    var marker = new google.maps.Marker({
        position: latLng,
        map: map
    });
}