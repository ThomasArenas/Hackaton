function getXhr(){
	var xhr = null; 
	if(window.XMLHttpRequest) { // Firefox et autres
	  xhr = new XMLHttpRequest();
	} else if(window.ActiveXObject){ // Internet Explorer 
	  try {
		xhr = new ActiveXObject("Msxml2.XMLHTTP");
	  } catch (e) {
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	} else { // XMLHttpRequest non supporté par le navigateur 
	  alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest."); 
	  xhr = false; 
	} 
	return xhr;
  }

function callback(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	console.log(lat, lng);

	var xhr = getXhr();
	xhr.open("POST","espaces_verts_affichage.php",true);
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	xhr.send("latitude=2");
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

// On vérifie que la méthode est implémenté dans le navigateur
if (navigator.geolocation) {
	// On demande d'envoyer la position courante à la fonction callback
	navigator.geolocation.getCurrentPosition(callback, erreur);
}