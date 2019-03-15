<?php
namespace Entity;

use \OCFram\Entity;

class Comment extends Entity
{
  protected $chapters,
            $chapitreParent,
            $auteur,
            $contenu,
            $date,
            $signalement,
            $ignorer;

  const AUTEUR_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;

  public function isValid()
  {
    return !(empty($this->auteur) || empty($this->contenu));
  }

  public function setChapters($chapters)
  {
    $this->chapters = (int) $chapters;
  }

  public function setChapitreParent($chapitreParent)
  {
    $this->chapitreParent = $chapitreParent;
  }

  public function setAuteur($auteur)
  {
    if (!is_string($auteur) || empty($auteur))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }

    $this->auteur = $auteur;
  }

  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->contenu = $contenu;
  }

  public function setDate(\DateTime $date)
  {
    $this->date = $date;
  }

  public function setSignalement($signalement)
  {
    $this->signalement = $signalement;
  }

  public function setIgnorer($ignorer)
  {
    $this->ignorer = $ignorer;
  }

  public function chapters()
  {
    return $this->chapters;
  }

  public function chapitreParent()
  {
    return $this->chapitreParent;
  }

  public function auteur()
  {
    return $this->auteur;
  }

  public function contenu()
  {
    return $this->contenu;
  }

  public function date()
  {
    return $this->date;
  }

  public function signalement()
  {
    return $this->signalement;
  }

  public function ignorer()
  {
    return $this->ignorer;
  }
}