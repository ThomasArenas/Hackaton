<?php
require_once 'modeles/place.php';
require_once 'modeles/singlePlace.php';
require_once 'modeles/review.php';
require_once 'modeles/activities.php';
require_once 'trunkString.php';


    class ApiUtilities {
        //nbr de resultats affichés
        private $resultCount = 7;
        //url qui ne change jamais
        private $baseURL = 'https://maps.googleapis.com/maps/api/';
        private $apiKey = 'AIzaSyAQPcwOFq77H4AO32_gN3olrErOVTmLgx8';
        
        //Retourne la liste des espaces verts récupérés avec l'API 
        public function getPlaces($location = '45.773754217023,4.8520206932541', $type = 'park') {
            $url = $this->baseURL.'place/nearbysearch/json?location='.$location.'&radius=500&type='.$type.'&key='.$this->apiKey;
            $response = file_get_contents($url);
            $response = json_decode($response);
            $tabEspacesVerts=array();

            //On boucle sur les espaces verts renvoyés  et on en affiche seulement un certain nombres
            for ($i=0; $i <sizeof($response->results) && ($i< $this->resultCount) ; $i++) { 
                //on récupère le noms, reference_photo et id de l'espace en cours 
                $nomEspacesVerts = $response->results[$i]->name;

                if(!isset($response->results[$i]->photos)) {
                    $urlPhoto = 'assets/img/park.png';
                } else {
                    $referencePhotoEspacesVerts = $response->results[$i]->photos[0]->photo_reference;
                    //on crée l'url qui servira à afficher la photo de l'espace en cours
                    $urlPhoto = $this->baseURL.'place/photo?maxwidth=500&maxheight=500&photoreference='.$referencePhotoEspacesVerts.'&key='.$this->apiKey;
                }
                
                $idEspacesVerts = $response->results[$i]->place_id;
                
                //on crée l'url qui servira à afficher l'addresse formatée de l'espace en cours
                $urlAddresse = $this->baseURL.'place/details/json?place_id='.$idEspacesVerts.'&fields=formatted_address,url,geometry&key='.$this->apiKey;
                $addresse = $this->getPlacesAddresse($urlAddresse);
                $urlMap = $this->getUrlMap($urlAddresse);
                $addressLocation = $this->getLocation($urlAddresse);
                //on stock les noms et référence_photo des espaces verts dans notre objet de type place
                $place = new Place($nomEspacesVerts, $location, $urlPhoto, $addresse, $idEspacesVerts, $urlMap);
                //on insère l'instance dans le tableau
                array_push($tabEspacesVerts, $place);
            }
            //die(print_r($place));
            //on retourne le tableau qui sera parcouru pour l'affichage
            return $tabEspacesVerts;
        }   

        //Retourne la liste des espaces verts récupérés avec l'API 
        public function getActivities($maxHeight = '200', $maxWidth = '400') {
            $tabType=array('bar', 'restaurant', 'movie_theater', 'tourist_attraction', 'spa');
            $tabActivites=array();
            foreach($tabType as $type) {
                $url = $this->baseURL.'place/nearbysearch/json?location='.$_POST['Location'].'&radius=500&type='.$type.'&key='.$this->apiKey;
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
                    //$place = new Place('Désolé', '', 'assets/img/close.png', 'Il n\'y a pas '.$typeFr.' à proximité', '', 'false');
                    $activities = new Activities('Désolé', '', 'assets/img/close.png', 'Il n\'y a pas '.$typeFr.' à proximité', '', 'false');
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

                    //on récupère le premier avis de l'activité
                    $urlActiviteReview = $this->baseURL.'place/details/json?place_id='.$idEspacesVerts.'&language=fr&key='.$this->apiKey;
                    $responseReview = file_get_contents($urlActiviteReview);
                    $responseReview = json_decode($responseReview);

                    //si l'activité n'a pas de review
                    if(isset($responseReview->result->reviews)== false || is_null($responseReview->result->reviews)){
                        $text = "Commentaire non disponible";
                        $rating = "Note non disponible";
                        $author_name = "Information non disponible";
                        $relative_time_description = "Information non disponible";
                    }
                    else{
                        //fonction qui permet de tronquer la taille des avis souvent trop conséquents
                        $text = trunkString($responseReview->result->reviews[0]->text, 300);
                         
                        $rating = $responseReview->result->reviews[0]->rating;
                        $author_name = $responseReview->result->reviews[0]->author_name;
                        $relative_time_description = $responseReview->result->reviews[0]->relative_time_description;
                    }
                    //on stock un avis fait sur l'espace vert dans notre objet de type Review
                    $review = new Review($author_name, $rating, $relative_time_description, $text);

                    //on stock les infos de l'activité dans notre objet de type Activities
                    $activities = new Activities($nomEspacesVerts, $addressLocation, $urlPhoto, $addresse, $idEspacesVerts, $urlMap, $review);
                    
                }
                //on insère l'instance dans le tableau
                array_push($tabActivites, $activities);
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

        //Récupère un espace vert grace à son ID
        public function getPlace($placeId){
            $url = $this->baseURL.'place/details/json?place_id='.$placeId.'&language=fr&key='.$this->apiKey;
            $response = file_get_contents($url);
            $response = json_decode($response);
            //on récupère les infos de l'espace vert
            $nomEspaceVert = $response->result->name;
            $urlMap = $response->result->url;
            $addresse = $response->result->formatted_address;

            //on récupère les photos (si il y en a)
            for ($i=0; $i < 3; $i++) { 
                $numPhoto = $i +1;
               
                if(isset($response->result->photos[$i])==false){
                   
                    switch($numPhoto) {
                        case  1 :
                            $refPicture1 = 'assets/img/visuel-indisponible-650.png';
                            break;
                        case 2 :
                            $refPicture2 = '';
                            break;
                        case 3 :
                            $refPicture3 = '';
                            break;
                    }
                }
                else{
                    switch($numPhoto) {
                        case  1 :
                            $refPicture1 =$response->result->photos[0]->photo_reference;
                            break;
                        case 2 :
                            $refPicture2 =$response->result->photos[1]->photo_reference;
                            break;
                        case 3 :
                            $refPicture3 =$response->result->photos[2]->photo_reference;
                            break;
                    }
                }
            }
           
            //on récupère les horraires de l'espace vert dans un tableau (si il y en a)
            $timetable = array();
            if(isset($response->result->opening_hours->weekday_text[$i])){
                for ($i=0; $i < 7; $i++) { 
                    array_push($timetable, $response->result->opening_hours->weekday_text[$i]);
                }
            } else{
                array_push($timetable,"Non disponibles");
            }
            
            
            //on récupère le premier avis sur l'espace vert
            $text = $response->result->reviews[0]->text;
            $rating = $response->result->reviews[0]->rating;
            $author_name = $response->result->reviews[0]->author_name;
            $relative_time_description = $response->result->reviews[0]->relative_time_description;
            
            //on stock un avis fait sur l'espace vert dans notre objet de type Review
            $review = new Review($author_name, $rating, $relative_time_description, $text);

             //on stock les infos de l'espace vert dans notre objet de type SinglePlace
             $singlePlace = new SinglePlace($nomEspaceVert, $urlMap,$addresse, $timetable ,$this->generatePicture($refPicture1), $this->generatePicture($refPicture2), $this->generatePicture($refPicture3), $review);

            return $singlePlace;
            
        }
        //permet de générer les images 
       public function generatePicture($pictureReference, $maxHeight = '400', $maxWidth = ''){
           if($pictureReference=='' || $pictureReference=='assets/img/visuel-indisponible-650.png'){
               $urlPhoto = $pictureReference;
           } else{
            $urlPhoto = $this->baseURL.'place/photo?maxwidth='.$maxWidth.'&maxheight='.$maxHeight.'&photoreference='.$pictureReference.'&key='.$this->apiKey;
           }
        
        return $urlPhoto;
       } 
}
?>