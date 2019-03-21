<h1>Sommaire :</h1>

<?php
foreach ($listeChapters as $chapters)
{
?>
<a href="chapters-<?= $chapters['id'] ?>.html">
  <div class="card border-primary mt-3">
    <div class="card-body text-center">
      <h2 class="card-title">
        
          <?php if (!preg_match('#[eé]pilogue#i', $chapters['complement'])) 
          {
            echo( 'Chapitre '. $chapters['chapitre']. ' ');
          }

          echo($chapters['complement']);?>
      </h2>
      <?php
      if (!empty($chapters['titre']))
      {
        echo('<h3 class="card-text">'.$chapters['titre'].'</h3>');
      } ?>
    </div>
  </div>
</a>

<?php if ($user->isAuthenticated()) { ?>
  <div class="btn-group" role="group" aria-label="Basic example">          
    <a href="admin/chapters-publish-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Cacher</a>                
    <a href="admin/chapters-images-<?= $chapters['id']?>.html" class="btn btn-secondary">Illustrer</a>
    <a href="admin/chapters-update-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Modifier</a>
    <a href="admin/chapters-delete-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Supprimer</a>
  </div>
<?php } ?>
<?php
}