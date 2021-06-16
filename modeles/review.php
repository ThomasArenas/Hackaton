<?php
    class Review {

        private $author_name;
        private $rating;
        public  $relative_time_description;
        private $text;
        
    
        function __construct($author_name, $rating, $relative_time_description, $text) {
            $this->author_name = $author_name;
            $this->rating = $rating;
            $this->relative_time_description = $relative_time_description;
            $this->text = $text;
        }
    
    

        /**
         * Get the value of author_name
         */ 
        public function getAuthor_name()
        {
                return $this->author_name;
        }

        /**
         * Set the value of author_name
         *
         * @return  self
         */ 
        public function setAuthor_name($author_name)
        {
                $this->author_name = $author_name;

                return $this;
        }

        /**
         * Get the value of rating
         */ 
        public function getRating()
        {
                return $this->rating;
        }

        /**
         * Set the value of rating
         *
         * @return  self
         */ 
        public function setRating($rating)
        {
                $this->rating = $rating;

                return $this;
        }

        /**
         * Get the value of relative_time_description
         */ 
        public function getRelative_time_description()
        {
                return $this->relative_time_description;
        }

        /**
         * Set the value of relative_time_description
         *
         * @return  self
         */ 
        public function setRelative_time_description($relative_time_description)
        {
                $this->relative_time_description = $relative_time_description;

                return $this;
        }

        /**
         * Get the value of text
         */ 
        public function getText()
        {
                return $this->text;
        }

        /**
         * Set the value of text
         *
         * @return  self
         */ 
        public function setText($text)
        {
                $this->text = $text;

                return $this;
        }
}
?>