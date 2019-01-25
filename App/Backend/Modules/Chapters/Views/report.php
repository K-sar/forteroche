<p style="text-align: center">Il y a actuellement  chapitres. En voici la liste :</p>

<table>
  <tr><th>Auteur</th></tr>
<?php
foreach ($comments as $comment)
{
  echo '<tr><td>', $comment['auteur'], '</td></tr>';
}
?>
</table>