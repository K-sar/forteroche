<p style="text-align: center">Il y a actuellement <?= $nombreChapters ?> chapitres. En voici la liste :</p>

<table>
  <tr><th>Chapitre</th><th>Titre</th><th>Auteur</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listeChapters as $chapters)
{
  echo '<tr><td>', $chapters['chapitre'], '</td><td>', $chapters['titre'], '</td><td>', $chapters['auteur'], '</td><td>le ', $chapters['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($chapters['dateAjout'] == $chapters['dateModif'] ? '-' : 'le '.$chapters['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="admin/chapters-update-', $chapters['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="admin/chapters-delete-', $chapters['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>