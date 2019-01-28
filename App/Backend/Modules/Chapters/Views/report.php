<p style="text-align: center">Il y a actuellement  commentaires signalés. En voici la liste :</p>

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
    echo '<tr>
            <td>', $commentR['auteur'], '</td>
            <td>', $commentR['contenu'], '</td>
            <td>', $commentR['chapters'], '</td>
            <td>', $commentR['signalement'], '</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a href="../chapters-', $commentR['chapters'], '.html" class="btn btn-secondary">Voir</a>                
                <a href="comment-ignoring-', $commentR['id'], '.html" class="btn btn-secondary">Ignorer</a>
                <a href="comment-update-', $commentR['id'], '.html" class="btn btn-secondary">Modifier</a>
                <a href="comment-delete-', $commentR['id'], '.html" class="btn btn-secondary">Supprimer</a>
              </div>
            </td>
          </tr>';
  }
  ?>
  </tbody>
</table>
<p style="text-align: center">Il y a actuellement  commentaires ignorés. En voici la liste :</p>

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
            <td>', $commentI['auteur'], '</td>
            <td>', $commentI['contenu'], '</td>
            <td>', $commentI['chapters'], '</td>
            <td>', $commentI['signalement'], '</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a href="../chapters-', $commentI['chapters'], '.html" class="btn btn-secondary">Voir</a>                
                <a href="comment-reminding-', $commentI['id'], '.html" class="btn btn-secondary">Remonter</a>
                <a href="comment-update-', $commentI['id'], '.html" class="btn btn-secondary">Modifier</a>
                <a href="comment-delete-', $commentI['id'], '.html" class="btn btn-secondary">Supprimer</a>
              </div>
            </td>
          </tr>';
  }
  ?>
  </tbody>
</table>
