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
  foreach ($comments as $comment)
  {
    echo '<tr>
            <td>', $comment['auteur'], '</td>
            <td>', $comment['contenu'], '</td>
            <td>', $comment['chapters'], '</td>
            <td>', $comment['signalement'], '</td>
            <td><div class="btn-group" role="group" aria-label="Basic example"><a href="comment-update-', $comment['id'], '.html" class="btn btn-secondary">Modifier</a><a href="comment-delete-', $comment['id'], '.html" class="btn btn-secondary">Supprimer</a></div>
          </tr>';
  }
  ?>
  </tbody>
</table>
