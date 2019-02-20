<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Chapters;

abstract class ChaptersManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un chapitre.
   * @param $chapters Chapters Le chapitre à ajouter
   * @return void
   */
  abstract protected function add(Chapters $chapters);
  
  /**
   * Méthode permettant d'enregistrer un chapitre.
   * @param $chapters Chapters le chapitre à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Chapters $chapters)
  {
    if (!is_null($chapters->images()))
    {
      $imagesTemp = [$chapters->images()];
      $imagesTemp = $imagesTemp[0];

      $imagesName = $imagesTemp['name'];
      $imagesExtension = strrchr($imagesName, "."); 
      $imagesName = md5(uniqid(rand(), true)) . $imagesExtension;

      $imagesTmp_name = $imagesTemp['tmp_name'];
      $imagesDest = '../Web/Images/ChaptersImages/' .$imagesName;
      
      if(move_uploaded_file($imagesTmp_name, $imagesDest))
      {
        $chapters->setImages($imagesDest);
        } else {
        return false;
      }
    }
     
    if ($chapters->isValid())
    {
      $chapters->isNew() ? $this->add($chapters) : $this->modify($chapters);
    }
    else
    {
      throw new \RuntimeException('Le chapitre doit être validé pour être enregistré');
    }
  }

    /**
   * Méthode permettant de modifier la publication d'un chapitre.
   * @param $chapters Chapters le chapitre à enregistrer
   * @see self::modifyPublish()
   * @return void
   */
  public function savePublish(Chapters $chapters)
  {
    if ($chapters->isValid())
    {
       $this->modifyPublish($chapters);
    }
    else
    {
      throw new \RuntimeException('Le chapitre doit être validé pour être enregistré');
    }
  }
  
  /**
   * Méthode renvoyant le nombre de chapitres total.
   * @return int
   */
  abstract public function count();
    
  /**
   * Méthode retournant une liste de chapitres demandée.
   * @param $where string Condition des entrées du tableau
   * @param $order string L'ordre des entrées du tableau
   * @param $debut int Le premier chapitre à sélectionner
   * @param $limite int Le nombre de chapitres à sélectionner
   * @return array La liste des chapitres. Chaque entrée est une instance de Chapters.
   */
  abstract public function getList($where, $order, $debut = -1, $limite = -1);
  
  /**
   * Méthode retournant un chapitre précise.
   * @param $id int L'identifiant du chapitre à récupérer
   * @return Chapters Le chapitre demandée
   */
  abstract public function getUnique($id);
  
  /**
   * Méthode permettant de modifier un chapitre.
   * @param $chapters chapters le chapitre à modifier
   * @return void
   */
  abstract protected function modify(Chapters $chapters);
  
  /**
   * Méthode permettant de supprimer un chapitre.
   * @param $id int L'identifiant du chapitre à supprimer
   * @return void
   */
  abstract public function delete($id);
}