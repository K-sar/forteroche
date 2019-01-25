<p>Il y a actuellement <?= $nombreChapters ?> chapitres. En voici la liste :</p>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Chapitre</th>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col">Date d'ajout</th>
      <th scope="col">Dernière modification</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($listeChapters as $chapters)
    {
        echo '
        <tr>
          <td>', $chapters['chapitre'], '</td>
          <td>', $chapters['titre'], '</td>
          <td>', $chapters['auteur'], '</td>
          <td>', $chapters['dateAjout']->format('d/m/Y à H\hi'), '</td>
          <td>', ($chapters['dateAjout'] == $chapters['dateModif'] ? '-' : 'le '.$chapters['dateModif']->format('d/m/Y à H\hi')), '</td>
          <td><div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary"><a href="admin/chapters-update-', $chapters['id'], '.html" style="text-decoration:none; color:black">Modifier</a></button><button type="button" class="btn btn-secondary"><a href="admin/chapters-delete-', $chapters['id'], '.html" style="text-decoration:none; color:black">Supprimer</a></button></div>
        </tr>',
        "\n";
  }
  ?>
  </tbody>
</table> 