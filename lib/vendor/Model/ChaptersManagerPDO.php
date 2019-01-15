<?php
namespace Model;

use \Entity\Chapters;

class ChaptersManagerPDO extends ChaptersManager
{
  protected function add(Chapters $chapters)
  {
    $requete = $this->dao->prepare('INSERT INTO chapters SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
    
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':auteur', $chapters->auteur());
    $requete->bindValue(':contenu', $chapters->contenu());
    
    $requete->execute();
  }
  
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM chapters')->fetchColumn();
  }
    
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM chapters ORDER BY id DESC';
    
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapters');
    
    $listeChapters = $requete->fetchAll();
    
    foreach ($listeChapters as $chapters)
    {
      $chapters->setDateAjout(new \DateTime($chapters->dateAjout()));
      $chapters->setDateModif(new \DateTime($chapters->dateModif()));
    }
    
    $requete->closeCursor();
    
    return $listeChapters;
  }
  
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM chapters WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapters');
    
    if ($chapters = $requete->fetch())
    {
      $chapters->setDateAjout(new \DateTime($chapters->dateAjout()));
      $chapters->setDateModif(new \DateTime($chapters->dateModif()));
      
      return $chapters;
    }   
    return null;
  }
    
  protected function modify(Chapters $chapters)
  {
    $requete = $this->dao->prepare('UPDATE chapters SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':auteur', $chapters->auteur());
    $requete->bindValue(':contenu', $chapters->contenu());
    $requete->bindValue(':id', $chapters->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }
  
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM chapters WHERE id = '.(int) $id);
  }
}