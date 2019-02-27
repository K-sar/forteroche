<?php
namespace Entity;

use \OCFram\Entity;

class Chapters extends Entity
{
  protected $chapitre,
            $complement,
            $titre,
            $contenu,
            $auteur,
            $publication,
            $dateAjout,
            $dateModif,
            $datePublication,
            $images,
            $alternatif;


  const AUTEUR_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;

  public function isValid()
  {
    return !(empty($this->contenu) || empty($this->auteur));
  }


  // SETTERS //

  public function setChapitre($chapitre)
  {
    if (!is_int($chapitre))
    {
      $chapitre = (int) $chapitre;
    }

    $this->chapitre = $chapitre;
  }

  public function setComplement($complement)
  {
    $this->complement = $complement;
  }

  public function setTitre($titre)
  {
    $this->titre = $titre;
  }

  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->contenu = $contenu;
  }
  
  public function setAuteur($auteur)
  {
    if (!is_string($auteur) || empty($auteur))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }

    $this->auteur = $auteur;
  }

  public function setDateAjout(\DateTime $dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }

  public function setDateModif(\DateTime $dateModif)
  {
    $this->dateModif = $dateModif;
  }

  public function setDatePublication(\DateTime $datePublication)
  {
    $this->datePublication = $datePublication;
  }

  public function setPublication($publication)
  {
    $this->publication = $publication;
  }  
  
  public function setImages($images)
  {
    $this->images = $images;
  }

  public function setAlternatif($alternatif)
  {
    $this->alternatif = $alternatif;
  }

  // GETTERS //

  public function chapitre()
  {
    return $this->chapitre;
  }

  public function complement()
  {
    return $this->complement;
  }

  public function titre()
  {
    return $this->titre;
  }

  public function contenu()
  {
    return $this->contenu;
  }
    
  public function auteur()
  {
    return $this->auteur;
  }

  public function dateAjout()
  {
    return $this->dateAjout;
  }

  public function dateModif()
  {
    return $this->dateModif;
  }

  public function datePublication()
  {
    return $this->datePublication;
  }

  public function publication()
  {
    return $this->publication;
  }

  public function images()
  {
    return $this->images;
  }

  public function alternatif()
  {
    return $this->alternatif;
  }
}