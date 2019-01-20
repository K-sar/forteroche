<?php
foreach ($listeChapters as $chapters)
{
?>
  <h2><a href="chapters-<?= $chapters['id'] ?>.html"><?= $chapters['titre'] ?></a></h2>
<?php
}