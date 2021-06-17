<?php 
require_once 'modeles/apiUtilities.php';
$idPlace = $_POST['IdPlace'];
//instance de la classe EspacesVerts pour utiliser la fonction de récupération des espaces
$apiUtilities = new ApiUtilities();
$place = $apiUtilities->getPlace($idPlace);

//inclusion du header 
include "header.php"; 
?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?= $place->getNom(); ?></h2>
         
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper-container">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="<?= $place->getPicture1(); ?>" style="width:auto; height:500px">
                </div>

                <div class="swiper-slide">
                  <img src="<?= $place->getPicture2(); ?>" style="width:auto; height:500px">
                </div>

                <div class="swiper-slide">
                  <img src="<?= $place->getPicture3(); ?>" style="width:auto; height:500px">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3><?= $place->getNom(); ?></h3>
              <ul>
                <li><strong>Adresse</strong>: <?= $place->getFormatted_address(); ?> </li>
                <li><strong>Horraires</strong>:</li>
                <?php 
                //Tableau correspondances jours Anglais Francais
                  $jourAnglais = array('Monday', 'Tuesday', 'Wednesday', 'Thursday','Friday', 'Saturday', 'Sunday');
                  $jourFrancais = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

                  foreach ($place->getTimetable() as $key => $day) { 
                    //on traduit les horraires en francais
                    $horraireTraduite = str_replace($jourAnglais[$key],$jourFrancais[$key],$day);
                    /* traitement pour modfier le format horraire, mais ne peut pas s'appliquer dans tout les cas donc on laissera AM et PM..
                    //on enlève le "AM" et "PM"
                    $horraireTraduite = str_replace("AM", "", $horraireTraduite);
                    $horraireTraduite = str_replace("PM", "", $horraireTraduite);
                    //l'horraire du soir est au format 12h or on veut 24h
                    //on cherche la position du "-" et ":"
                    $pos1 = strpos($horraireTraduite, '–');
                    $pos2 = strpos($horraireTraduite, ':');
                    //on récupère la partie de l'horraire qui nous interessse
                    $horraireDouze = substr($horraireTraduite, $pos1+4,$pos2);
                    //on la converti en int
                    $horraireInt = (int)$horraireDouze;
                    //on lui ajoute +12 pour correspondre au format 24h
                    $horraireDouzeInt= $horraireInt+12;
                    //on remplace dans la chaine initial par la nouvelle valeur
                    $horraireTraduite = str_replace($horraireInt, $horraireDouzeInt, $horraireTraduite); */
              
                    ?>

                      <li><?= $horraireTraduite;?></li>
                    
                <?php } ?>
                
                <li><strong>Afficher sur la carte</strong>: <a href="<?= $place->getUrl(); ?>" target='_blank'>GoogleMap</a></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <p sytle="font-size: 14px"> " <?= $place->getReview()->getText(); ?> "</p> 
              <p><span style="font-weight : bold; font-style : italic; color : #64605F;"> <?= $place->getReview()->getAuthor_name(); ?></span> (<?= $place->getReview()->getRelative_time_description(); ?>)</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <?php 
  //Affichage des activités
    include "activite_affichage.php"; ?>

<?php 
    //Affichage des espaces verts
    include "footer.php" ?>

