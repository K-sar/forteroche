<?php
foreach ($listeChapters as $chapters)
{
?>
  <h2><a href="chapters-<?= $chapters['id'] ?>.html"><?= $chapters['titre'] ?></a></h2>
  <p><?= nl2br($chapters['contenu']) ?></p>
  <?php if ($user->isAuthenticated()) { ?> -
    <a href="admin/chapters-update-<?= $chapters['id'] ?>.html">Modifier</a> |
    <a href="admin/chapters-delete-<?= $chapters['id'] ?>.html">Supprimer</a>
  <?php } ?>
<?php
}