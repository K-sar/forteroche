<?php
foreach ($listeChapters as $chapters)
{
?>
  <h2><a href="chapters-<?= $chapters['id'] ?>.html">
  <?php if (!preg_match('#[eé]pilogue#i', $chapters['complement'])) 
  {
    echo( 'Chapitre '. $chapters['chapitre']. ' ');
  }

  echo($chapters['complement']); 
  
  if (!empty($chapters['titre']))
  {
    echo(' : '.$chapters['titre']);
  }
  ?></a>
  <div class="btn-group" role="group" aria-label="Basic example">
    <?php if ($user->isAuthenticated()) { ?>            
    <a href="admin/chapters-publish-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Cacher</a>                
    <a href="admin/chapters-images-<?= $chapters['id']?>.html" class="btn btn-secondary">Illustrer</a>
    <a href="admin/chapters-update-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Modifier</a>
    <a href="admin/chapters-delete-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Supprimer</a>
    <?php } ?>  
  </div>
  </h2>
  <p><?= nl2br($chapters['contenu']) ?></p>

<?php
}