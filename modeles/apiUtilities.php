<?php
require_once 'modeles/place.php';

    class ApiUtilities {
        //nbr de resultats affichés
        private $resultCount = 7;
        //url qui ne change jamais
        private $baseURL = 'https://maps.googleapis.com/maps/api/';
        private $apiKey = 'AIzaSyAQPcwOFq77H4AO32_gN3olrErOVTmLgx8';
        
        //Retourne la liste des espaces verts récupérés avec l'API 
        public function getPlaces($location = '45.773754217023,4.8520206932541', $type = 'park' , $maxHeight = '500', $maxWidth = '' ) {
            $url = $this->baseURL.'place/nearbysearch/json?location='.$location.'&radius=500&type='.$type.'&key='.$this->apiKey;
            $response = file_get_contents($url);
            $response = json_decode($response);
            $tabEspacesVerts=array();

            //On boucle sur les espaces verts renvoyés  et on en affiche seulement un certain nombres
            for ($i=0; $i <sizeof($response->results) && ($i< $this->resultCount) ; $i++) { 
                //on récupère le noms, reference_photo et id de l'espace en cours 
                $nomEspacesVerts = $response->results[$i]->name;
                $referencePhotoEspacesVerts = $response->results[$i]->photos[0]->photo_reference;
                $idEspacesVerts = $response->results[$i]->place_id;
                //on crée l'url qui servira à afficher la photo de l'espace en cours
                $urlPhoto = $this->baseURL.'place/photo?maxwidth='.$maxWidth.'&maxheight='.$maxHeight.'&photoreference='.$referencePhotoEspacesVerts.'&key='.$this->apiKey;
                //on crée l'url qui servira à afficher l'addresse formatée de l'espace en cours
                $urlAddresse = $this->baseURL.'place/details/json?place_id='.$idEspacesVerts.'&fields=formatted_address,url,geometry&key='.$this->apiKey;
                $addresse = $this->getPlacesAddresse($urlAddresse);
                $urlMap = $this->getUrlMap($urlAddresse);
                $addressLocation = $this->getLocation($urlAddresse);
                //on stock les noms et référence_photo des espaces verts dans notre objet de type place
                $place = new Place($nomEspacesVerts, $addressLocation, $urlPhoto,$addresse, $idEspacesVerts, $urlMap);
                //on insère l'instance dans le tableau
                array_push($tabEspacesVerts, $place);
            }
            //die(print_r($place));
            //on retourne le tableau qui sera parcouru pour l'affichage
            return $tabEspacesVerts;
        }   

        //Retourne la liste des espaces verts récupérés avec l'API 
        public function getActivities($maxHeight = '500', $maxWidth = '500') {
            $tabType=array('bar', 'restaurant', 'movie_theater', 'tourist_attraction', 'spa');
            $tabActivites=array();
            foreach($tabType as $type) {
                $url = $this->baseURL.'place/nearbysearch/json?location='.$_GET['Location'].'&radius=500&type='.$type.'&key='.$this->apiKey;
                $response = file_get_contents($url);
                $response = json_decode($response);

                if($response->results == null){
                    switch($type) {
                        case 'bar' :
                            $typeFr = 'de bar ouvert';
                            break;
                        case 'restaurant' :
                            $typeFr = 'de restaurant ouvert';
                            break;
                        case 'movie_theater' :
                            $typeFr = 'de cinéma ouvert';
                            break;
                        case 'tourist_attraction' :
                            $typeFr = 'd\'attraction touristique ouverte';
                            break;
                        case 'spa' :
                            $typeFr = 'd\'établissements de bien-être ouvert';
                            break;
                    }
                    $place = new Place('Désolé', '', 'assets/img/close.png', 'Il n\'y a pas '.$typeFr.' à proximité', '', 'false');
                } else {
                    //on récupère le noms, reference_photo et id de l'espace en cours 
                    $nomEspacesVerts = $response->results[0]->name;
                    
                    if(!isset($response->results[0]->photos)) {
                        switch($type) {
                            case 'bar' :
                                $urlPhoto = 'assets/img/bar.png';
                                break;
                            case 'restaurant' :
                                $urlPhoto = 'assets/img/restaurant.png';
                                break;
                            case 'movie_theater' :
                                $urlPhoto = 'assets/img/cinema.png';
                                break;
                            case 'tourist_attraction' :
                                $urlPhoto = 'assets/img/touriste.png';
                                break;
                            case 'spa' :
                                $urlPhoto = 'assets/img/spa.png';
                                break;
                        }
                    } else {
                        $referencePhotoEspacesVerts = $response->results[0]->photos[0]->photo_reference;
                        //on crée l'url qui servira à afficher la photo de l'espace en cours
                        $urlPhoto = $this->baseURL.'place/photo?maxwidth='.$maxWidth.'&maxheight='.$maxHeight.'&photoreference='.$referencePhotoEspacesVerts.'&key='.$this->apiKey;
                    }
                    
                    $idEspacesVerts = $response->results[0]->place_id;
                    
                    //on crée l'url qui servira à afficher l'addresse formatée de l'espace en cours
                    $urlAddresse = $this->baseURL.'place/details/json?place_id='.$idEspacesVerts.'&fields=formatted_address,url,geometry&key='.$this->apiKey;
                    $addresse = $this->getPlacesAddresse($urlAddresse);
                    $urlMap = $this->getUrlMap($urlAddresse);
                    $addressLocation = $this->getLocation($urlAddresse);
                    //on stock les noms et référence_photo des activités dans notre objet de type place
                    $place = new Place($nomEspacesVerts, $addressLocation, $urlPhoto, $addresse, $idEspacesVerts, $urlMap);
                }
                //on insère l'instance dans le tableau
                array_push($tabActivites, $place);
            }
            //on retourne le tableau qui sera parcouru pour l'affichage
            return $tabActivites;
        } 
      
        //Recupère l'addresse d'une place
        public function getPlacesAddresse($url){

            $response = file_get_contents($url);
            $response = json_decode($response);
            $addresse = $response->result->formatted_address;
            return $addresse;
        } 

        //Recupère les coordonées d'une place
        public function getLocation($url){

            $response = file_get_contents($url);
            $response = json_decode($response);
            $location = $response->result->geometry->location->lat.','.$response->result->geometry->location->lng;
            return $location;
        } 

       //Recupère l'url Google Map d'une place
        public function getUrlMap($url){

            $response = file_get_contents($url);
            $response = json_decode($response);
            $adresseUrl = $response->result->url;
            return $adresseUrl;
        } 
}
?>