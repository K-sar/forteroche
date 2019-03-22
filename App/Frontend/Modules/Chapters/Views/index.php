<h1>Dernières publications :</h1>

<?php
foreach ($listeChapters as $chapters)
{
?>
<a href="chapters-<?= $chapters['id'] ?>.html" class="text-dark">
  <div class="card border-primary mt-3">
    <div class="card-body">
      <h2 class="card-title">
        
          <?php if (!preg_match('#[eé]pilogue#i', $chapters['complement'])) 
          {
            echo( 'Chapitre '. $chapters['chapitre']. ' ');
          }

          echo($chapters['complement']); 
          
          if (!empty($chapters['titre']))
          {
            echo(' : '.$chapters['titre']);
          } ?>
      </h2>
      <p class="card-text"><?= nl2br($chapters['contenu']) ?></p>
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