<?php
    class SinglePlace {

        private $nom;
        private $url;
        private $formatted_address;
        private $timetable;
        private $picture1;
        private $picture2;
        private $picture3;
        private $review;

        
        function __construct($nom, $url, $formatted_address,$timetable ,$picture1, $picture2, $picture3,$review) {
            $this->nom = $nom;
            $this->url = $url;
            $this->formatted_address = $formatted_address;
            $this->timetable = $timetable;
            $this->picture1 = $picture1;
            $this->picture2 = $picture2;
            $this->picture3 = $picture3;
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
         * Get the value of url
         */ 
        public function getUrl()
        {
                return $this->url;
        }

        /**
         * Set the value of url
         *
         * @return  self
         */ 
        public function setUrl($url)
        {
                $this->url = $url;

                return $this;
        }

        /**
         * Get the value of formatted_address
         */ 
        public function getFormatted_address()
        {
                return $this->formatted_address;
        }

        /**
         * Set the value of formatted_address
         *
         * @return  self
         */ 
        public function setFormatted_address($formatted_address)
        {
                $this->formatted_address = $formatted_address;

                return $this;
        }

        /**
         * Get the value of timetable
         */ 
        public function getTimetable()
        {
                return $this->timetable;
        }

        /**
         * Set the value of timetable
         *
         * @return  self
         */ 
        public function setTimetable($timetable)
        {
                $this->timetable = $timetable;

                return $this;
        }

        /**
         * Get the value of picture1
         */ 
        public function getPicture1()
        {
                return $this->picture1;
        }

        /**
         * Set the value of picture1
         *
         * @return  self
         */ 
        public function setPicture1($picture1)
        {
                $this->picture1 = $picture1;

                return $this;
        }

        /**
         * Get the value of picture2
         */ 
        public function getPicture2()
        {
                return $this->picture2;
        }

        /**
         * Set the value of picture2
         *
         * @return  self
         */ 
        public function setPicture2($picture2)
        {
                $this->picture2 = $picture2;

                return $this;
        }

        /**
         * Get the value of picture3
         */ 
        public function getPicture3()
        {
                return $this->picture3;
        }

        /**
         * Set the value of picture3
         *
         * @return  self
         */ 
        public function setPicture3($picture3)
        {
                $this->picture3 = $picture3;

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