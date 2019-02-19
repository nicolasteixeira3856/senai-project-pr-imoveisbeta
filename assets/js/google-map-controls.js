function init() {
 	    var pinLocation = new google.maps.LatLng(-25.5145982,-49.23512499999998); 
		var pinLocation1 = new google.maps.LatLng(-25.4375544,-49.3358104000000014); 
		var pinLocation2 = new google.maps.LatLng(-25.437024,-49.33484759999999); 
		var pinLocation3 = new google.maps.LatLng(-25.5550586,-49.2571969); 
		var pinLocation4 = new google.maps.LatLng(-25.421902,-49.33048050000002); 
		var pinLocation5 = new google.maps.LatLng(-25.5114442,-49.23877160000001); 
		var pinLocation6 = new google.maps.LatLng(-25.4123501,-49.35316449999999); 
		var pinLocation7 = new google.maps.LatLng(-25.466281,-49.30417929999999); 
		var pinLocation8 = new google.maps.LatLng(-25.4085449,-49.28345789999997); 
		var pinLocation9 = new google.maps.LatLng(-25.4623402,-49.29465540000001); 
		var pinLocation10 = new google.maps.LatLng(-25.3838939,-49.3321368); 
		var pinLocation11 = new google.maps.LatLng(-25.3838939,-49.3321368); 


		

  var mapOptions = {

    zoom: 14,
    center: pinLocation,
    mapTypeId: google.maps.MapTypeId.ROADMAP,

    panControl: false,
    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.SMALL,
      position: google.maps.ControlPosition.TOP_RIGHT
    },
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
      position: google.maps.ControlPosition.TOP_LEFT
    },
    scaleControl: true,
    scaleControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER
    },
    streetViewControl: false,
    overviewMapControl: false
  };
  var venueMap = new google.maps.Map(document.getElementById('map'), mapOptions);

  var startPosition = new google.maps.Marker({    // Create a new marker
    position: pinLocation,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/pin.png"                            // Path to image from HTML
  });
  
    var Position1 = new google.maps.Marker({    // Create a new marker
    position: pinLocation1,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"       
var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position2 = new google.maps.Marker({    // Create a new marker
    position: pinLocation2,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
	var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position3 = new google.maps.Marker({    // Create a new marker
    position: pinLocation3,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position4 = new google.maps.Marker({    // Create a new marker
    position: pinLocation4,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position5 = new google.maps.Marker({    // Create a new marker
    position: pinLocation5,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position6 = new google.maps.Marker({    // Create a new marker
    position: pinLocation6,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position7 = new google.maps.Marker({    // Create a new marker
    position: pinLocation7,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position8 = new google.maps.Marker({    // Create a new marker
    position: pinLocation8,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
      var Position9 = new google.maps.Marker({    // Create a new marker
    position: pinLocation9,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
        var Position10 = new google.maps.Marker({    // Create a new marker
    position: pinLocation9,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });
        var Position11 = new google.maps.Marker({    // Create a new marker
    position: pinLocation9,                        // Set its position
    map: venueMap,                                // Specify the map
    icon: "assets/img/marcador.png"                            // Path to image from HTML
  var infowindow = new google.maps.InfoWindow(), Position1;
 
google.maps.event.addListener(Position1, 'click', (function(Position1, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        infowindow.open(map, Position1);
    }	// Path to image from HTML
}
  });

}

function loadScript() {
  var script = document.createElement('script');
  script.src = 'http://maps.googleapis.com/maps/api/js?sensor=false&callback=init';
  document.body.appendChild(script);
}

window.onload = loadScript;