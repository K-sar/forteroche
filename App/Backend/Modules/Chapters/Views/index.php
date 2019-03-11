<h3 style="text-align: center">Il y a actuellement <?= $numberChaptersPublic ?> chapitres publiés. En voici la liste :</h3>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Chapitre</th>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col">Date d'ajout</th>
      <th scope="col">Modification</th>      
      <th scope="col">Illustration</th>
      <th scope="col">Publication</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($listChaptersPublic as $chaptersPublic)
    {
        echo '
        <tr>
          <td data-label="Chapitre">', $chaptersPublic['chapitre'], ' ', $chaptersPublic['complement'], '</td>
          <td data-label="Titre">', $chaptersPublic['titre'], '</td>
          <td data-label="Auteur">', $chaptersPublic['auteur'], '</td>
          <td data-label="Date d\'ajout">', $chaptersPublic['dateAjout']->format('d/m/Y'), '</td>
          <td data-label="Modification"><a href="admin/chapters-update-', $chaptersPublic['id'], '.html" class="btn btn-secondary">', ($chaptersPublic['dateAjout'] == $chaptersPublic['dateModif'] ? '-' : $chaptersPublic['dateModif']->format('d/m/Y')), '</a></td>
          <td data-label="Illustration"><a href="admin/chapters-images-', $chaptersPublic['id'], '.html" class="btn btn-secondary">', (empty($chaptersPublic['images']) ? 'Non' : 'Oui'), '</a></td>
          <td data-label="Publication"><a href="admin/chapters-publish-', $chaptersPublic['id'], '.html" class="btn btn-secondary">', $chaptersPublic['datePublication']->format('d/m/Y'), '</a></td>
          <td>
            <div class="btn-group col-sm-12" role="group" aria-label="Basic example">
              <a href="chapters-', $chaptersPublic['id'], '.html" class="btn btn-success">Voir</a>
              <a href="admin/chapters-delete-', $chaptersPublic['id'], '.html" class="btn btn-warning">Supprimer</a>
            </div>
          </td>
        </tr>',
        "\n";
  }
  ?>
  </tbody>
</table>

<h3 style="text-align: center">Il y a actuellement <?= $numberChaptersPrivate ?> chapitres privés. En voici la liste :</h3>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Chapitre</th>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col">Date d'ajout</th>
      <th scope="col">Modification</th>      
      <th scope="col">Illustration</th>
      <th scope="col">Publication</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($listChaptersPrivate as $chaptersPrivate)
    {
      echo '
        <tr>
          <td data-label="Chapitre">', $chaptersPrivate['chapitre'], ' ', $chaptersPrivate['complement'], '</td>
          <td data-label="Titre">', $chaptersPrivate['titre'], '</td>
          <td data-label="Auteur">', $chaptersPrivate['auteur'], '</td>
          <td data-label="Date d\'ajout">', $chaptersPrivate['dateAjout']->format('d/m/Y'), '</td>
          <td data-label="Modification"><a href="admin/chapters-update-', $chaptersPrivate['id'], '.html" class="btn btn-secondary">', ($chaptersPrivate['dateAjout'] == $chaptersPrivate['dateModif'] ? '-' : $chaptersPublic['dateModif']->format('d/m/Y')), '</a></td>
          <td data-label="Illustration"><a href="admin/chapters-images-', $chaptersPrivate['id'], '.html" class="btn btn-secondary">', (empty($chaptersPrivate['images']) ? 'Non' : 'Oui'), '</a></td>
          <td data-label="Publication"><a href="admin/chapters-publish-', $chaptersPrivate['id'], '.html" class="btn btn-secondary"> - </a></td>
          <td>
            <div class="btn-group col-sm-12" role="group" aria-label="Basic example">                           
              <a href="admin/chapters-', $chaptersPrivate['id'], '.html" class="btn btn-success">Voir</a>
              <a href="admin/chapters-delete-', $chaptersPrivate['id'], '.html" class="btn btn-warning">Supprimer</a>
            </div>
          </td>
        </tr>',
        "\n";
  }
  ?>
  </tbody>
</table>