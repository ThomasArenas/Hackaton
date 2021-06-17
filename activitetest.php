
<?php 
require_once 'modeles/apiUtilities.php';
//instance de la classe Activite pour utiliser la fonction de récupération des activités
$apiUtilities = new ApiUtilities();
?>
<!-- ======= Team Section ======= -->
<section id="team" class="team">
    <div class="container">

        <div class="section-title">
            <h2>Activités à proximités</h2>
        </div>

        <div class="row">

        <?php //Pour chaque activité présente, on génère son affichage
        foreach($apiUtilities->getActivities() as $place){ ?>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="member">
                    <img src="<?php echo $place->urlImage; ?>"  alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4><?= $place->getNom(); ?></h4>
                            <span style="font-size : 12px">"
                                <?php if(is_null($place->getReview()->getText())){
                                        echo "Pas de commentaire.";
                                        }  else {
                                        echo $place->getReview()->getText();  
                                        }
                                ?> "</span>
                            <div class="social">
                            <span><a href="<?= $place->getUrlMap(); ?>" target="_blank" title="Voir sur Google Map <?= $place->getUrlMap(); ?>"><?= $place->getFormatedAddress(); ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>

    </div>
  </section><!-- End Team Section -->
