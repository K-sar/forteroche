<?php
foreach ($listeChapters as $chapters)
{
?>
  <h2><a href="chapters-<?= $chapters['id'] ?>.html">Chapitre <?= $chapters['chapitre'] ?> : <?= $chapters['titre'] ?></a></h2>
  <p><?= nl2br($chapters['contenu']) ?></p>
  <div class="btn-group" role="group" aria-label="Basic example">
    <?php if ($user->isAuthenticated()) { ?>            
    <a href="admin/chapters-publish-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Cacher</a>
    <a href="admin/chapters-update-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Modifier</a>
    <a href="admin/chapters-delete-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Supprimer</a>
    <?php } ?>  
    </div>
<?php
}