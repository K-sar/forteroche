<?php
namespace Model;

use \Entity\Chapters;

class ChaptersManagerPDO extends ChaptersManager
{
  protected function add(Chapters $chapters)
  {
    if (is_null($chapters->publication()))
    {
      $chapters->setPublication(0);
    }

    $requete = $this->dao->prepare('INSERT INTO chapters SET chapitre = :chapitre, complement = :complement, titre = :titre, contenu = :contenu, auteur = :auteur, publication = :publication, images = :images, dateAjout = NOW(), dateModif = NOW(), datePublication = NOW()');

    $requete->bindValue(':chapitre', $chapters->chapitre());
    $requete->bindValue(':complement', $chapters->complement());
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':contenu', $chapters->contenu());
    $requete->bindValue(':auteur', $chapters->auteur());
    $requete->bindValue(':publication', $chapters->publication());
    $requete->bindValue(':images', $chapters->images());
    
    $requete->execute();
  }
  
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM chapters')->fetchColumn();
  }
    
  protected function modify(Chapters $chapters)
  {
    $requete = $this->dao->prepare('UPDATE chapters SET chapitre = :chapitre, complement = :complement, titre = :titre, contenu = :contenu, auteur = :auteur, images = :images, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':chapitre', $chapters->chapitre());
    $requete->bindValue(':complement', $chapters->complement());
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':contenu', $chapters->contenu());
    $requete->bindValue(':auteur', $chapters->auteur());
    $requete->bindValue(':images', $chapters->images());
    $requete->bindValue(':id', $chapters->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }

  protected function modifyPublish(Chapters $chapters)
  {
    if (is_null($chapters->publication()))
    {
      $requete = $this->dao->prepare('UPDATE chapters SET publication = :publication, WHERE id = :id');

      $requete->bindValue(':publication', 0);
    }
    else
    {
      $requete = $this->dao->prepare('UPDATE chapters SET publication = :publication, datePublication = NOW() WHERE id = :id');

      $requete->bindValue(':publication', $chapters->publication());
    }
    
    $requete->bindValue(':id', $chapters->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }
  
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM chapters WHERE id = '.(int) $id);
  }  

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, chapitre, complement, titre, contenu, auteur, publication, dateAjout, dateModif, datePublication FROM chapters WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapters');
    
    if ($chapters = $requete->fetch())
    {
      $chapters->setDateAjout(new \DateTime($chapters->dateAjout()));
      $chapters->setDateModif(new \DateTime($chapters->dateModif()));
      $chapters->setDatePublication(new \DateTime($chapters->datePublication()));
      
      return $chapters;
    }   
    return null;
  }

  public function getList($where, $order, $debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, publication, dateAjout, dateModif, datePublication FROM chapters';
    
    if (!empty($where))
    {
      $sql .= ' WHERE '.$where[0];
      $i = 1;
      while ($i < count($where))
      {
        $sql .= ' AND '.$where[$i];
        $i ++;
      }
    }

    if (!empty($order))
    {
      $sql .= ' ORDER BY '.$order[0];
      $i = 1;
      while ($i < count($order))
      {
        $sql .= ', '.$order[$i];
        $i ++;
      }
    }
    
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
      $chapters->setDatePublication(new \DateTime($chapters->datePublication()));
    }
    
    $requete->closeCursor();
    
    return $listeChapters;
  }
}