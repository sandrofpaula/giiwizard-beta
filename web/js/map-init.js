function initMap() {
    var input = document.getElementById('localevento-local_evento_endereco');
    var locationField = document.getElementById('localevento-local_evento_localizacao');
    var mapCenter = {lat: -3.1190275, lng: -60.0217314}; // Localização padrão

    // Verifica se já existe uma localização salva e ajusta o centro do mapa
    if(locationField.value) {
        var savedLocation = locationField.value.split(',');
        if(savedLocation.length === 2) {
            mapCenter = {lat: parseFloat(savedLocation[0]), lng: parseFloat(savedLocation[1])};
        }
    } else {
        // Tenta obter a localização atual do usuário SOMENTE se for uma criação (campo de localização vazio)
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Atualiza o centro do mapa para a localização atual do usuário
                map.setCenter(userLocation);
                marker.setPosition(userLocation); // Move o marcador para a localização atual do usuário
                locationField.value = position.coords.latitude + ',' + position.coords.longitude; // Atualiza o campo de localização

            }, function() {
                console.warn("Erro ao recuperar a posição, o local padrão será usado.");
                // Se o usuário não permitir acesso à localização, usa a localização padrão
                map.setCenter(mapCenter);
            });
        } else {
            console.log("O navegador não suporta geolocalização, a localização padrão será usada.");
        }
    }

    var map = new google.maps.Map(document.getElementById('map'), {
        center: mapCenter,
        zoom: 20
    });

    var marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: mapCenter // Usa o centro do mapa definido anteriormente
    });

    
    var searchBox = new google.maps.places.SearchBox(input);
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });
    
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }
        
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                console.log("O local retornado não contém geometria");
                return;
            }
            marker.setPosition(place.geometry.location);
            
            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
    
    google.maps.event.addListener(marker, 'position_changed', function() {
        var latLng = marker.getPosition();
        locationField.value = latLng.lat() + ',' + latLng.lng();
    });
}

/* function initMap() {
    var input = document.getElementById('localevento-local_evento_endereco');
    var locationField = document.getElementById('localevento-local_evento_localizacao');
    var mapCenter =  {lat: -3.1190275, lng: -60.0217314}; // Default location
    
    // Verifica se já existe uma localização salva e ajusta o centro do mapa
    if(locationField.value) {
        var savedLocation = locationField.value.split(',');
        if(savedLocation.length === 2) {
            mapCenter = {lat: parseFloat(savedLocation[0]), lng: parseFloat(savedLocation[1])};
        }
    }
    // Tenta obter a localização atual do usuário
    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(function(position) {
    //         var userLocation = {
    //             lat: position.coords.latitude,
    //             lng: position.coords.longitude
    //         };

    //         // Atualiza o centro do mapa para a localização atual do usuário
    //         map.setCenter(userLocation);
    //         marker.setPosition(userLocation); // Move o marcador para a localização atual do usuário
    //         locationField.value = position.coords.latitude + ',' + position.coords.longitude; // Atualiza o campo de localização

    //     }, function() {
    //         console.warn("Error in retrieving position, default location will be used.");
    //         console.warn("Erro ao recuperar a posição, o local padrão será usado.");
    //         // Se o usuário não permitir acesso à localização, usa a localização padrão
    //         map.setCenter(mapCenter);
    //     });
    // } else {
    //     console.log("Browser doesn't support Geolocation, default location will be used.");
    //     console.log("O navegador não suporta geolocalização, a localização padrão será usada.");
    // }
    //fim- Tenta obter a localização atual do usuário
    
    var map = new google.maps.Map(document.getElementById('map'), {
        center: mapCenter,
        zoom: 15
    });
    
    var marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: mapCenter // Usa o centro do mapa definido anteriormente
    });
    
    var searchBox = new google.maps.places.SearchBox(input);
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });
    
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }
        
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                console.log("O local retornado não contém geometria");
                return;
            }
            marker.setPosition(place.geometry.location);
            
            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
    
    google.maps.event.addListener(marker, 'position_changed', function() {
        var latLng = marker.getPosition();
        locationField.value = latLng.lat() + ',' + latLng.lng();
    });
} */