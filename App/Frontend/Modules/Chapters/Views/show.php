<h2><?= $chapters['titre'] ?></h2>
<p><?= nl2br($chapters['contenu']) ?></p>
<p>Par <em><?= $chapters['auteur'] ?></em>, le <?= $chapters['dateAjout']->format('d/m/Y à H\hi') ?></p>
<?php if ($chapters['dateAjout'] != $chapters['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $chapters['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>

<p><a href="commenter-<?= $chapters['id'] ?>.html">Ajouter un commentaire</a></p>

<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}

foreach ($comments as $comment)
{
?>
<fieldset>
  <legend>
    Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
    <div class="btn-group" role="group" aria-label="Basic example">
      <?php if ($user->isAuthenticated()) { ?>
      <a href="admin/comment-update-<?= $comment['id'] ?>.html" class="btn btn-secondary">Modifier</a>
      <a href="admin/comment-delete-<?= $comment['id'] ?>.html" class="btn btn-danger" >Supprimer</a>
      <?php } ?>  
    </div>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
</fieldset>
<?php
}
?>

<p><a href="commenter-<?= $chapters['id'] ?>.html">Ajouter un commentaire</a></p>