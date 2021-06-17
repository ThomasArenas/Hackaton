function callback(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	if(document.getElementById('villes').value == "position") {
		document.getElementById('LatLng').value = lat + "," + lng;
	} else {
		document.getElementById('LatLng').value = document.getElementById('villes').value;
	}
	console.log(document.getElementById('LatLng').value);
	document.getElementById('changeVille').submit()
}

function erreur(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			console.log('L\'utilisateur a refusé la demande');
			break;     
		case error.POSITION_UNAVAILABLE:
			console.log('Position indéterminée');
			break;
		case error.TIMEOUT:
			console.log('Réponse trop lente');
			break;
	}
};

function getPosition() {
	// On vérifie que la méthode est implémenté dans le navigateur
	if (navigator.geolocation) {
		// On demande d'envoyer la position courante à la fonction callback
		navigator.geolocation.getCurrentPosition(callback, erreur);
	}
}