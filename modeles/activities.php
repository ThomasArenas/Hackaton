<?php
    class Activities {

        private $nom;
        private $location;
        public  $urlImage;
        private $formatedAddress;
        private $idPlace;
        private $urlMap;
        private $review;
        
        function __construct($nom, $location, $urlImage, $formatedAddress, $idPlace, $urlMap, $review) {
            $this->nom = $nom;
            $this->location = $location;
            $this->urlImage = $urlImage;
            $this->formatedAddress = $formatedAddress;
            $this->idPlace = $idPlace;
            $this->urlMap = $urlMap;
            $this->review = $review;
        }
     

     

        /**
         * Get the value of nom
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }

        /**
         * Get the value of location
         */ 
        public function getLocation()
        {
                return $this->location;
        }

        /**
         * Set the value of location
         *
         * @return  self
         */ 
        public function setLocation($location)
        {
                $this->location = $location;

                return $this;
        }

        /**
         * Get the value of urlImage
         */ 
        public function getUrlImage()
        {
                return $this->urlImage;
        }

        /**
         * Set the value of urlImage
         *
         * @return  self
         */ 
        public function setUrlImage($urlImage)
        {
                $this->urlImage = $urlImage;

                return $this;
        }

        /**
         * Get the value of formatedAddress
         */ 
        public function getFormatedAddress()
        {
                return $this->formatedAddress;
        }

        /**
         * Set the value of formatedAddress
         *
         * @return  self
         */ 
        public function setFormatedAddress($formatedAddress)
        {
                $this->formatedAddress = $formatedAddress;

                return $this;
        }

        /**
         * Get the value of idPlace
         */ 
        public function getIdPlace()
        {
                return $this->idPlace;
        }

        /**
         * Set the value of idPlace
         *
         * @return  self
         */ 
        public function setIdPlace($idPlace)
        {
                $this->idPlace = $idPlace;

                return $this;
        }

        /**
         * Get the value of urlMap
         */ 
        public function getUrlMap()
        {
                return $this->urlMap;
        }

        /**
         * Set the value of urlMap
         *
         * @return  self
         */ 
        public function setUrlMap($urlMap)
        {
                $this->urlMap = $urlMap;

                return $this;
        }

        /**
         * Get the value of review
         */ 
        public function getReview()
        {
                return $this->review;
        }

        /**
         * Set the value of review
         *
         * @return  self
         */ 
        public function setReview($review)
        {
                $this->review = $review;

                return $this;
        }
}
?>