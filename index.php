<?php 
  //inclusion du header 
  include "header.php"; 
?>


  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background: url(assets/img/slide/slide-1.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Découvrez votre ville et ses magnifiques espaces verts</h2>
                <p class="animate__animated animate__fadeInUp">Pour favoriser la découverte des espaces verts proches de chez vous et vous permettre d’en profiter pleinement, notre équipe a voulu créer une application pour les habitants des grandes métropoles qui regroupe toutes les activités disponibles dans ces espaces verts et leurs alentours.</p>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background: url(assets/img/slide/slide-3.jpg);">
            <div class="carousel-container">
            <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Découvrez votre ville et ses magnifiques espaces verts</h2>
                <p class="animate__animated animate__fadeInUp">Pour favoriser la découverte des espaces verts proches de chez vous et vous permettre d’en profiter pleinement, notre équipe a voulu créer une application pour les habitants des grandes métropoles qui regroupe toutes les activités disponibles dans ces espaces verts et leurs alentours.</p>
              </div>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <?php 
    //Affichage des espaces verts
    include "espaces_verts_affichage.php" ?>
    
  </main><!-- End #main -->

  <?php 
    //Affichage des espaces verts
    include "footer.php" ?>

