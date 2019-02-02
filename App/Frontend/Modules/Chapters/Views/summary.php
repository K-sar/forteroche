<?php
foreach ($listeChapters as $chapters)
{
?>
  <h2><a href="chapters-<?= $chapters['id'] ?>.html">Chapitre <?= $chapters['chapitre'] ?> <?= $chapters['complement'] ?> : <?= $chapters['titre'] ?></a></h2>
<?php
}