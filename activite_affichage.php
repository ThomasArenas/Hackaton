<?php 
require_once 'modeles/apiUtilities.php';
//instance de la classe EspacesVerts pour utiliser la fonction de récupération des espaces
$apiUtilities = new ApiUtilities();
?>

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container">

      <div class="row portfolio-container">
        <?php //Pour chaque espace vert présent, on génère son affichage
        foreach($apiUtilities->getActivities() as $place){ ?>
          <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <img src="<?php echo $place->urlImage; ?>" class="" alt="" style="max-width:20vw;max-height:auto">
          </div>
          <div class="col-lg-9 col-md-6 portfolio-item filter-app">
            <h4><?= $place->getNom(); ?></h4>
            <p><?= $place->getFormatedAddress(); ?></p>
            <div class="portfolio-links">
              <a href="<?= $place->getUrlMap(); ?>" title="Voir sur Google Map"><i class="bx bx-link"></i></a>
            </div>
          </div>
        <?php } ?>
      </div>

    </div>
</section><!-- End Portfolio Section -->
