<?php 
require_once 'modeles/apiUtilities.php';
//instance de la classe EspacesVerts pour utiliser la fonction de récupération des espaces
$apiUtilities = new ApiUtilities();

if(!empty( $_POST["LatLng"]) && isset( $_POST["LatLng"])) {
  $LatLng = $_POST["LatLng"];
} else {
  $LatLng = "45.7578137,4.8320114";
}
?>

<!-- ======= Portfolio Section ======= -->

<section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title">
        <form action="index.php" method="post" id="changeVille">
            <input type='hidden' name="LatLng" id="LatLng">
        </form>
        <h2>Sélectionner une localisation : 
          <select id="villes" onchange="getPosition();">
            <option id="ly" value="45.7578137,4.8320114">Lyon</option>
            <option id="pa" value="48.8566969,2.3514616">Paris</option>
            <option id="ma" value="43.2961743,5.3699525">Marseille</option>
            <option id="mo" value="43.6112422,3.8767337">Montpellier</option>
            <option id="bo" value="44.841225,-0.5800364">Bordeaux</option>
            <option id="st" value="48.584614,7.7507127">Strasbourg</option>
            <option id="li" value="50.6365654,3.0635282">Lille</option>
            <option id="pos" value="position">Votre position</option>
          </select>
        </h2>
        <p>Découvrez vos espaces verts à travers les meilleures activités à proximité.</p>
      </div>

      <script>
        var ville = "<?= strval($LatLng) ?>";
        switch (ville) {
          case "45.7578137,4.8320114" :
            document.getElementById('ly').setAttribute("selected", "");
            break;
          case "48.8566969,2.3514616" :
            document.getElementById('pa').setAttribute("selected", "");
            break;
          case "43.2961743,5.3699525" :
            document.getElementById('ma').setAttribute("selected", "");
            break;
          case "43.6112422,3.8767337" :
            document.getElementById('mo').setAttribute("selected", "");
            break;
          case "44.841225,-0.5800364" :
            document.getElementById('bo').setAttribute("selected", "");
            break;
          case "48.584614,7.7507127" :
            document.getElementById('st').setAttribute("selected", "");
            break;
          case "50.6365654,3.0635282" :
            document.getElementById('li').setAttribute("selected", "");
            break;
          default :
            document.getElementById('pos').setAttribute("selected", "");
            break;

        }
      </script>

      <div class="row portfolio-container">
        <?php //Pour chaque espace vert présent, on génère son affichage
        foreach($apiUtilities->getPlaces($LatLng) as $place){  ?>
          <form action="park-details.php" method="post" id="formPlace<?= $place->getIdPlace(); ?>">
            <input type='hidden' name="Location" value='<?= $place->getLocation(); ?>'>
            <input type='hidden' name="IdPlace" value='<?= $place->getIdPlace(); ?>'>
          </form>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="<?php echo $place->urlImage; ?>" class="" alt="" style="max-height: 350px">
            <div class="portfolio-info">
              <h4><?= $place->getNom(); ?></h4>
              <p><?= $place->getFormatedAddress(); ?></p>
              <div class="portfolio-links">
                <a onclick="document.getElementById('formPlace<?= $place->getIdPlace(); ?>').submit()" title="Plus d'informations"><i class="bx bx-plus"></i></a>
                <a href="<?= $place->getUrlMap(); ?>" target="_blank" title="Voir sur Google Map"><i class="bi bi-geo-alt-fill"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>

    </div>
</section><!-- End Portfolio Section -->