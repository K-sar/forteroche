<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW()');
    
    $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    
    $q->execute();
    
    $comment->setId($this->dao->lastInsertId());
  }
    
  public function getListOf($news)
  {
    if (!ctype_digit($news))
    {
      throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
    }
    
    $q = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE news = :news');
    $q->bindValue(':news', $news, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    $comments = $q->fetchAll();
    
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
    
    return $comments;
  }
    public function modify(Comment $comment){
      $requete = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');
    

      $requete->bindValue(':auteur', $comment->auteur());
      $requete->bindValue(':contenu', $comment->contenu());
      $requete->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
      
      $requete->execute();
    }
    
    public function get($id) {
      if (!ctype_digit($id))
      {
        throw new \InvalidArgumentException('L\'identifiant du commentaire passé doit être un nombre entier valide');
      }
      
      $q = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE id = :id');
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
  
  public function deleteFromNews($news)
  {
    $this->dao->exec('DELETE FROM comments WHERE news = '.(int) $news);
  }
}