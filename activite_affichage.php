<?php 
require_once 'modeles/apiUtilities.php';
//instance de la classe EspacesVerts pour utiliser la fonction de récupération des espaces
$apiUtilities = new ApiUtilities();
?>

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Portfolio</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-card">Card</li>
            <li data-filter=".filter-web">Web</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">
        <?php //Pour chaque espace vert présent, on génère son affichage
        foreach($apiUtilities->getPlaces() as $place){ ?>
          
        <?php } ?>
      </div>

    </div>
</section><!-- End Portfolio Section -->

<!--
    <form action="portfolio-details.html" method="post" id="formPlace<?= //$place->getIdPlace(); ?>">
        <input type='hidden' name="IdPlace" value='<?= //$place->getIdPlace(); ?>'>
    </form>

    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <div class="portfolio-wrap">
            <img src="<?php //echo $place->urlImage; ?>" class="" alt="">
            <div class="portfolio-info">
                <h4><?= //$place->getNom(); ?></h4>
                <p><?= //$place->getFormatedAddress(); ?></p>
                <div class="portfolio-links">
                    <a onclick="document.getElementById('formPlace<?= //$place->getIdPlace(); ?>').submit()"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>
        </div>
    </div>
-->