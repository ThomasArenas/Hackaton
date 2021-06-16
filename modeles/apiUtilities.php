<?php
require_once 'modeles/place.php';
require_once 'modeles/singlePlace.php';
require_once 'modeles/review.php';

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
                $referencePhotoEspacesVerts = $response->results[$i]->photos[0]->photo_reference;
                $idEspacesVerts = $response->results[$i]->place_id;
                //on crée l'url qui servira à afficher la photo de l'espace en cours
                //$urlPhoto = $this->baseURL.'place/photo?maxwidth='.$maxWidth.'&maxheight='.$maxHeight.'&photoreference='.$referencePhotoEspacesVerts.'&key='.$this->apiKey;
                //on crée l'url qui servira à afficher l'addresse formatée de l'espace en cours
                $urlAddresse = $this->baseURL.'place/details/json?place_id='.$idEspacesVerts.'&fields=formatted_address,url&key='.$this->apiKey;
                $addresse = $this->getPlacesAddresse($urlAddresse);
                $urlMap = $this->getUrlMap($urlAddresse);
                //on stock les noms et référence_photo des espaces verts dans notre objet de type place
                $place = new Place($nomEspacesVerts, $location, $this->generatePicture($referencePhotoEspacesVerts),$addresse, $idEspacesVerts, $urlMap);
                //on insère l'instance dans le tableau
                array_push($tabEspacesVerts, $place);
            }
            //die(print_r($place));
            //on retourne le tableau qui sera parcouru pour l'affichage
            return $tabEspacesVerts;
        }    
      
        //Recupère l'addresse d'une place
        public function getPlacesAddresse($url){

            $response = file_get_contents($url);
            $response = json_decode($response);
            $addresse = $response->result->formatted_address;
            return $addresse;
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
            $url = $this->baseURL.'place/details/json?place_id='.$placeId.'&key='.$this->apiKey;
            $response = file_get_contents($url);
            $response = json_decode($response);
            //on récupère les infos de l'espace vert
            $nomEspaceVert = $response->result->name;
            $urlMap = $response->result->url;
            $addresse = $response->result->formatted_address;
            
            $refPicture1 =$response->result->photos[0]->photo_reference;
            $refPicture2 =$response->result->photos[1]->photo_reference;
            $refPicture3 =$response->result->photos[2]->photo_reference;

            //on récupère les horraires de l'espace vert dans un tableau
            $timetable = array();
            for ($i=0; $i < 7; $i++) { 
                array_push($timetable, $response->result->opening_hours->weekday_text[$i]);
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
       public function generatePicture($pictureReference, $maxHeight = '500', $maxWidth = ''){
        $urlPhoto = $this->baseURL.'place/photo?maxwidth='.$maxWidth.'&maxheight='.$maxHeight.'&photoreference='.$pictureReference.'&key='.$this->apiKey;
        return $urlPhoto;
       } 
}
?>