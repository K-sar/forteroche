<form action="" method="post" enctype="multipart/form-data">
  <legend><h2>Illustrer un chapitre</h2></legend>

  <div class="imageCenter">
  <?php if (!empty($chapters['images'])) {?>
    <img src='../<?= $chapters['images'] ?>' class='illustrationChapters' alt='<?= $chapters['alternatif'] ?>' />
  <?php } ?>
  </div>

  <?= $form ?>

  <div class="form-group row">
    <input class="col-form-input btn btn-secondary btn-block" type="submit"  value=
    <?php 
      if (empty($chapters['images'])) 
      { echo "Ajouter";  } 
      else 
      { echo "Remplacer"; } 
    ?> />
  </div>
  
</form>