<?php
foreach ($listeChapters as $chapters)
{
?>
  <h2><a href="chapters-<?= $chapters['id'] ?>.html">Chapitre <?= $chapters['chapitre'] ?> : <?= $chapters['titre'] ?></a></h2>
  <p><?= nl2br($chapters['contenu']) ?></p>
  <div class="btn-group" role="group" aria-label="Basic example">
    <?php if ($user->isAuthenticated()) { ?>
    <button type="button" class="btn btn-secondary"><a href="admin/chapters-update-<?= $chapters['id'] ?>.html" style="text-decoration:none; color:black">Modifier</a></button>
    <button type="button" class="btn btn-secondary"><a href="admin/chapters-delete-<?= $chapters['id'] ?>.html" style="text-decoration:none; color:black">Supprimer</a></button>
    <?php } ?>  
    </div>
<?php
}