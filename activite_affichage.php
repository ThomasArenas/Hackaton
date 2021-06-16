<?php 
require_once 'modeles/apiUtilities.php';
//instance de la classe Activite pour utiliser la fonction de récupération des activités
$apiUtilities = new ApiUtilities();
?>

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container">

      <div class="row portfolio-container">
        <?php //Pour chaque activité présente, on génère son affichage
        foreach($apiUtilities->getActivities() as $place){ ?>
          <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <img src="<?php echo $place->urlImage; ?>" class="" alt="" style="max-width:16vw;">
          </div>
          <div class="col-lg-9 col-md-6 portfolio-item filter-app">
            <h4><?= $place->getNom(); ?></h4>
            <p><?= $place->getFormatedAddress(); ?></p>
            <?php if($place->getUrlMap() != '') { ?>
              <div class="portfolio-links">
                <a href="<?= $place->getUrlMap(); ?>" title="Voir sur Google Map <?= $place->getUrlMap(); ?>"><i class="bx bx-link"></i></a>
              </div>
              <?php } ?>
          </div>
        <?php } ?>
      </div>

    </div>
</section><!-- End Portfolio Section -->
