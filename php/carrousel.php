<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <!-- Indicateurs -->
  <ol class="carousel-indicators">
    <?php
    $idCarrousel = $db->prepare('SELECT idCar FROM carrousel;');
    $idCarrousel->execute();
    while($chaqueIdImage = $idCarrousel->fetch()){
      ?>
      <li data-target="#carousel-example-generic" data-slide-to="<?php echo $chaqueIdImage['idCar']; ?>" class="<?php if ($chaqueIdImage['idCar'] == 0) { ?> active <?php } ?>"></li>
      <?php
    }
    $idCarrousel->closeCursor();
    ?>
  </ol>

  <!-- Diapositives à afficher -->
  <div class="carousel-inner" role="listbox">
    <?php
    $imagesCarrousel = $db->prepare('SELECT * FROM carrousel;');
    $imagesCarrousel->execute();
    while($chaqueImage = $imagesCarrousel->fetch()){
      ?>

      <div class="item<?php
	if ($chaqueImage['idCar'] == 0) { ?> active <?php } ?>">
        <img class="imgcarousel" src="<?php echo $chaqueImage['imageCar']; ?>" alt="diapo<?php echo $chaqueImage['idCar']; ?>">
        <div class="carousel-caption">
          <!--<section class="carousel_legend carousel_legend_<?php echo $chaqueImage['idCar']; ?>">-->
            <h2><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueImage['sousTitreCar']); ?></h2>
          <!--</section>-->
      </div>
      </div>

      <?php
    }
    $imagesCarrousel->closeCursor();
    ?>
  </div>

  <!-- Controlleurs -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>
