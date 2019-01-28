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
    
  public function getListOf($chapters)
  {
    if (!ctype_digit($chapters))
    {
      throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
    }
    
    $q = $this->dao->prepare('SELECT id, chapters, auteur, contenu, signalement, date FROM comments WHERE chapters = :chapters');
    $q->bindValue(':chapters', $chapters, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    $comments = $q->fetchAll();
    
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
    
    return $comments;
  }
  
  public function getListOfReport()
  {
    $q = $this->dao->prepare('SELECT id, chapters, auteur, contenu, signalement, ignorer, date FROM comments WHERE signalement > :signalement AND ignorer = :ignorer ORDER BY signalement DESC');

    $q->bindValue(':signalement', 0, \PDO::PARAM_INT);
    $q->bindValue(':ignorer', false, \PDO::PARAM_INT);

    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    $comments = $q->fetchAll();
    return $comments;
  }

  public function countReport()
  {
    return $this->dao->query('SELECT COUNT(*) FROM comments WHERE signalement > 0 AND ignorer = 0')->fetchColumn();
  }

  public function getListOfignored()
  {
    $q = $this->dao->prepare('SELECT id, chapters, auteur, contenu, signalement, ignorer, date FROM comments WHERE ignorer = :ignorer ORDER BY signalement DESC');

    $q->bindValue(':ignorer', true, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    $comments = $q->fetchAll();
    return $comments;
  }

  public function countIgnored()
  {
    return $this->dao->query('SELECT COUNT(*) FROM comments WHERE ignorer = 1')->fetchColumn();
  }
  

  public function modify(Comment $comment){
    $requete = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu, signalement = :signalement, ignorer = :ignorer WHERE id = :id');
  
    $requete->bindValue(':auteur', $comment->auteur());
    $requete->bindValue(':contenu', $comment->contenu());
    $requete->bindValue(':signalement', $comment->signalement());    
    $requete->bindValue(':ignorer', $comment->ignorer());
    $requete->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }
  
  public function get($id) {
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
  
  public function delete($id) {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }
  
  public function deleteFromChapters($chapters)
  {
    $this->dao->exec('DELETE FROM comments WHERE chapters = '.(int) $chapters);
  }
}