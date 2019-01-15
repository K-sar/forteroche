<p style="text-align: center">Il y a actuellement <?= $nombreNews ?> chapters. En voici la liste :</p>

<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listeNews as $chapters)
{
  echo '<tr><td>', $chapters['auteur'], '</td><td>', $chapters['titre'], '</td><td>le ', $chapters['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($chapters['dateAjout'] == $chapters['dateModif'] ? '-' : 'le '.$chapters['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="admin/chapters-update-', $chapters['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="admin/chapters-delete-', $chapters['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>