<?php
//Permet de couper une chaine de caractère car avis des activités trop long pour affichage mobile
function trunkString($str, $max) {

	if(strlen($str) > $max)
	{
		// On la raccourci
		$str = substr($str, 0, $max);
		$last_space = strrpos($str, " ");
		
		// Et on ajouter les ... à la fin de la chaine
		$str = substr($str, 0, $last_space)."...";
	}
    return $str;
}
?>