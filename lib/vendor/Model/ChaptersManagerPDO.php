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

    $requete = $this->dao->prepare('INSERT INTO chapters SET chapitre = :chapitre, complement = :complement, titre = :titre, contenu = :contenu, auteur = :auteur, publication = :publication, dateAjout = NOW(), dateModif = NOW()');

    $requete->bindValue(':chapitre', $chapters->chapitre());
    $requete->bindValue(':complement', $chapters->complement());
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':contenu', $chapters->contenu());
    $requete->bindValue(':auteur', $chapters->auteur());    
    $requete->bindValue(':publication', $chapters->publication());
    
    $requete->execute();
  }
  
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM chapters')->fetchColumn();
  }
    
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, dateAjout, dateModif FROM chapters ORDER BY id DESC';
    
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
    $requete = $this->dao->prepare('SELECT id, chapitre, complement, titre, contenu, auteur, publication, dateAjout, dateModif FROM chapters WHERE id = :id');
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
    if (is_null($chapters->publication()))
    {
      $chapters->setPublication(0);
    }

    $requete = $this->dao->prepare('UPDATE chapters SET chapitre = :chapitre, complement = :complement, titre = :titre, contenu = :contenu, auteur = :auteur, publication = :publication, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':chapitre', $chapters->chapitre());
    $requete->bindValue(':complement', $chapters->complement());
    $requete->bindValue(':titre', $chapters->titre());
    $requete->bindValue(':contenu', $chapters->contenu());
    $requete->bindValue(':auteur', $chapters->auteur());
    $requete->bindValue(':publication', $chapters->publication());
    $requete->bindValue(':id', $chapters->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }
  
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM chapters WHERE id = '.(int) $id);
  }

  public function getPrivateList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, publication, dateAjout, dateModif FROM chapters WHERE publication = 0 ORDER BY id DESC';
    
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
  
  public function getPublicList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, contenu, auteur, publication, dateAjout, dateModif FROM chapters WHERE publication = 1 ORDER BY id DESC';
  
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

  public function getSummaryList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, chapitre, complement, titre, publication, dateAjout, dateModif FROM chapters WHERE publication = 1 ORDER BY chapitre ASC, complement ASC';

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
}