<h3 class="text-center">Il y a actuellement <?= $numberReported ?> commentaires signalés :</h3>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Auteur</th>
      <th scope="col">Contenu</th>
      <th scope="col">Chapitre</th>
      <th scope="col">Signalements</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($commentsReported as $commentR)
  {
    echo '<tr class="table-warning">
            <td data-label="Auteur">', $commentR['auteur'], '</td>
            <td data-label="Contenu">', $commentR['contenu'], '</td>
            <td data-label="Chapitre">', $commentR['chapitreParent'], '</td>
            <td data-label="Signalement">', $commentR['signalement'], '</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a href="../chapters-', $commentR['chapters'], '.html" class="btn btn-secondary">Voir</a>                
                <a href="comment-moderating-', $commentR['id'], '.html" class="btn btn-secondary">Ignorer</a>
                <a href="comment-update-', $commentR['id'], '.html" class="btn btn-secondary">Modifier</a>
                <a href="comment-delete-', $commentR['id'], '.html" class="btn btn-secondary">Supprimer</a>
              </div>
            </td>
          </tr>';
  }
  ?>
  </tbody>
</table>
<h3 class="text-center">Il y a actuellement <?= $numberIgnored ?> commentaires ignorés :</h3>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Auteur</th>
      <th scope="col">Contenu</th>
      <th scope="col">Chapitre</th>
      <th scope="col">Signalements</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($commentsIgnored as $commentI)
  {
    echo '<tr class="table-dark">
            <td data-label="Auteur">', $commentI['auteur'], '</td>
            <td data-label="Contenu">', $commentI['contenu'], '</td>
            <td data-label="Chapitre">', $commentI['chapitreParent'], '</td>
            <td data-label="Signalement">', $commentI['signalement'], '</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a href="../chapters-', $commentI['chapters'], '.html" class="btn btn-secondary">Voir</a>                
                <a href="comment-moderating-', $commentI['id'], '.html" class="btn btn-secondary">Remonter</a>
                <a href="comment-update-', $commentI['id'], '.html" class="btn btn-secondary">Modifier</a>
                <a href="comment-delete-', $commentI['id'], '.html" class="btn btn-secondary">Supprimer</a>
              </div>
            </td>
          </tr>';
  }
  ?>
  </tbody>
</table>
