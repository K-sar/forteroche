<?php
foreach ($listeChapters as $chapters)
{
?>
  <h2><a href="chapters-<?= $chapters['id'] ?>.html">
  <?php if (!preg_match('#[eé]pilogue#i', $chapters['complement'])) 
  {
    echo( 'Chapitre '. $chapters['chapitre']. ' ');
  }
  echo($chapters['complement']) ?> : <?= $chapters['titre'] ?></a></h2>
<?php
}