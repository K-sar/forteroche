<?php if ($user->isAuthenticated()) { ?>
  <div class="btn-group" role="group" aria-label="Basic example">            
    <a href="admin/chapters-publish-<?= $chapters['id'] ?>.html" class="btn btn-secondary"><?php if($chapters['publication'] == 0){echo('Publier');}else{echo('Cacher');} ?></a>                
    <a href="admin/chapters-images-<?= $chapters['id']?>.html" class="btn btn-secondary">Illustrer</a>
    <a href="admin/chapters-update-<?= $chapters['id'] ?>.html" class="btn btn-secondary">Modifier</a>
    <a href="admin/chapters-delete-<?= $chapters['id'] ?>.html" class="btn btn-warning">Supprimer</a>
  </div>
<?php }

if (!empty($chapters['images'])) {?>
  <div class="imageCenter">
    <img class='illustrationChapters' src='<?= $chapters['images'] ?>' alt='<?= $chapters['alternatif'] ?>' />
  </div>
<?php }
?>
<div style="text-align:center">
  <h2><?php if (!preg_match('#[eé]pilogue#i', $chapters['complement'])) 
    {
      echo( 'Chapitre '. $chapters['chapitre']. ' ');
    }
    echo($chapters['complement']);
    ?>
  </h2>
  <h3>
  <?php  if (!empty($chapters['titre']))
    {
      echo($chapters['titre']);
    } ?>
  </h3>
<p><?= nl2br($chapters['contenu']) ?></p>
<p style="text-align: right;">Par <em><?= $chapters['auteur'] ?></em>, le <?= $chapters['datePublication']->format('d/m/Y') ?></p>

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
      <a href="report-comment-<?= $comment['id'] ?>.html" class="btn btn-outline-primary">Signaler</a>  
      <?php if ($user->isAuthenticated()) { ?>
      <a href="admin/comment-update-<?= $comment['id'] ?>.html" class="btn btn-outline-secondary">Modifier</a>
      <a href="admin/comment-delete-<?= $comment['id'] ?>.html" class="btn btn-outline-danger" >Supprimer</a>
      <?php } ?>  
    </div>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
</fieldset>
<?php } ?>

<p><a href="commenter-<?= $chapters['id'] ?>.html">Ajouter un commentaire</a></p>