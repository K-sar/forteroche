<p style="text-align: center">Il y a actuellement <?= $numberChaptersPublic ?> chapitres publiés. En voici la liste :</p>

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
    foreach ($listChaptersPublic as $chaptersPublic)
    {
        echo '
        <tr>
          <td>', $chaptersPublic['chapitre'], '</td>
          <td>', $chaptersPublic['titre'], '</td>
          <td>', $chaptersPublic['auteur'], '</td>
          <td>', $chaptersPublic['dateAjout']->format('d/m/Y à H\hi'), '</td>
          <td>', ($chaptersPublic['dateAjout'] == $chaptersPublic['dateModif'] ? '-' : 'le '.$chaptersPublic['dateModif']->format('d/m/Y à H\hi')), '</td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="chapters-', $chaptersPublic['id'], '.html" class="btn btn-secondary">Voir</a>                
              <a href="admin/chapters-publish-', $chaptersPublic['id'], '.html" class="btn btn-secondary">Cacher</a>
              <a href="admin/chapters-update-', $chaptersPublic['id'], '.html" class="btn btn-secondary">Modifier</a>
              <a href="admin/chapters-delete-', $chaptersPublic['id'], '.html" class="btn btn-secondary">Supprimer</a>
            </div>
          </td>
        </tr>',
        "\n";
  }
  ?>
  </tbody>
</table>

<p style="text-align: center">Il y a actuellement <?= $numberChaptersPrivate ?> chapitres privés. En voici la liste :</p>

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
    foreach ($listChaptersPrivate as $chaptersPrivate)
    {
        echo '
        <tr>
          <td>', $chaptersPrivate['chapitre'], '</td>
          <td>', $chaptersPrivate['titre'], '</td>
          <td>', $chaptersPrivate['auteur'], '</td>
          <td>', $chaptersPrivate['dateAjout']->format('d/m/Y à H\hi'), '</td>
          <td>', ($chaptersPrivate['dateAjout'] == $chaptersPrivate['dateModif'] ? '-' : 'le '.$chaptersPrivate['dateModif']->format('d/m/Y à H\hi')), '</td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="chapters-', $chaptersPrivate['id'], '.html" class="btn btn-secondary">Voir</a>                
              <a href="admin/chapters-publish-', $chaptersPrivate['id'], '.html" class="btn btn-secondary">Publier</a>
              <a href="admin/chapters-update-', $chaptersPrivate['id'], '.html" class="btn btn-secondary">Modifier</a>
              <a href="admin/chapters-delete-', $chaptersPrivate['id'], '.html" class="btn btn-secondary">Supprimer</a>
            </div>
          </td>
        </tr>',
        "\n";
  }
  ?>
  </tbody>
</table>