<h2>Illustrer le chapitre</h2>

<?php 
if (!empty($chapters['images'])) {?>
  <img class='illustrationChapters' src='../<?= $chapters['images'] ?>' alt='<?= $chapters['alternatif'] ?>' />
<?php }
?>

<form action="" method="post" enctype="multipart/form-data">
  <p>
    <?= $form ?>
    
<input class="col-sm-2 col-form-input" type="submit" value=
<?php 
if (empty($chapters['images'])) 
{ echo "Ajouter";  } 
else 
{ echo "Remplacer"; } ?> />
  </p>
</form>