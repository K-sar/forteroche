<?php
namespace Entity;

use \OCFram\Entity;

class Chapters extends Entity
{
  protected $chapitre,
            $titre,
            $contenu,
            $auteur,
            $dateAjout,
            $dateModif;

  const AUTEUR_INVALIDE = 1;
  const TITRE_INVALIDE = 2;
  const CONTENU_INVALIDE = 3;

  public function isValid()
  {
    return !(empty($this->contenu) || empty($this->auteur));
  }


  // SETTERS //

  public function setChapitre($chapitre)
  {
    if (!is_string($chapitre) || empty($chapitre))
    {
      $this->erreurs[] = self::CHAPITRE_INVALIDE;
    }

    $this->chapitre = $chapitre;
  }

  public function setTitre($titre)
  {
    if (!is_string($titre) || empty($titre))
    {
      $this->erreurs[] = self::TITRE_INVALIDE;
    }

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

  // GETTERS //

  public function chapitre()
  {
    return $this->chapitre;
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
}