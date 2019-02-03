<?php
namespace Model;

use \Entity\Chapters;

class ChaptersManagerPDO extends ChaptersManager
{
  protected function add(Chapters $chapters)
  {
    $requete = $this->dao->prepare('INSERT INTO chapters SET chapitre = :chapitre, complement = :complement, titre = :titre, contenu = :contenu, auteur = :auteur, dateAjout = NOW(), dateModif = NOW()');

    $requete->bindValue(':chapitre', $chapters->chapitre());
    $requete->bindValue(':complement', $chapters->complement());
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':contenu', $chapters->contenu());
    $requete->bindValue(':auteur', $chapters->auteur());
    
    $requete->execute();

    $this->modifyPublish($chapters);
  }
  
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM chapters')->fetchColumn();
  }
    
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, dateAjout, dateModif, datePublication FROM chapters ORDER BY id DESC';
    
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
    
  protected function modify(Chapters $chapters)
  {
    $requete = $this->dao->prepare('UPDATE chapters SET chapitre = :chapitre, complement = :complement, titre = :titre, contenu = :contenu, auteur = :auteur, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':chapitre', $chapters->chapitre());
    $requete->bindValue(':complement', $chapters->complement());
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':contenu', $chapters->contenu());
    $requete->bindValue(':auteur', $chapters->auteur());
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

  public function getPrivateList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, publication, dateAjout, dateModif, datePublication FROM chapters WHERE publication = 0 ORDER BY id DESC';
    
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
  
  public function getPublicList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, publication, dateAjout, dateModif, datePublication FROM chapters WHERE publication = 1 ORDER BY chapitre ASC, complement ASC';
  
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
  
  public function getPublishList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, publication, datePublication FROM chapters WHERE publication = 1 ORDER BY datePublication DESC';
  
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

  public function getSummaryList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, publication FROM chapters WHERE publication = 1 ORDER BY chapitre ASC, complement ASC';

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