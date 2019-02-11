<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET chapters = :chapters, auteur = :auteur, contenu = :contenu, date = NOW()');
    

    $q->bindValue(':chapters', $comment->chapters(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());

    $q->execute();
    
    $comment->setId($this->dao->lastInsertId());
  }

  protected function modify(Comment $comment)
  {
    $requete = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');
  
    $requete->bindValue(':auteur', $comment->auteur());
    $requete->bindValue(':contenu', $comment->contenu());
    $requete->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }

  protected function modifyModeration(Comment $comment)
  {
    $requete = $this->dao->prepare('UPDATE comments SET signalement = :signalement, ignorer = :ignorer WHERE id = :id');
  
    $requete->bindValue(':signalement', $comment->signalement());
    $requete->bindValue(':ignorer', $comment->ignorer());
    $requete->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
    $requete->execute();
  }
  
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }
  
  public function deleteFromChapters($chapters)
  {
    $this->dao->exec('DELETE FROM comments WHERE chapters = '.(int) $chapters);
  }

  public function get($id) 
  {
    if (!ctype_digit($id))
    {
      throw new \InvalidArgumentException('L\'identifiant du commentaire passé doit être un nombre entier valide');
    }
    
    $q = $this->dao->prepare('SELECT id, chapters, auteur, contenu, signalement, ignorer, date FROM comments WHERE id = :id');
    $q->bindValue(':id', $id, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    $comment = $q->fetch();

    $comment->setDate(new \DateTime($comment->date()));
    
    return $comment;
  }
  
  public function getListOf($where, $order)
  {    
    $q = 'SELECT id, chapters, auteur, contenu, signalement, ignorer, date FROM comments';
    
    if (!empty($where))
    {
      $q .= ' WHERE '.$where[0];
      $i = 1;
      while ($i < count($where))
      {
        $q .= ' AND '.$where[$i];
        $i ++;
      }
    }

    if (!empty($order))
    {
      $q .= ' ORDER BY '.$order[0];
      $i = 1;
      while ($i < count($order))
      {
        $q .= ', '.$order[$i];
        $i ++;
      }
    }
    
    $requete = $this->dao->query($q);    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    $comments = $requete->fetchAll();
    
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
    
    $requete->closeCursor();

    return $comments;    
  }
}