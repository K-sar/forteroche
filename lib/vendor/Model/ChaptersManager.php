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
   * Méthode permettant de modifier l'illustration d'un chapitre.
   * @param $chapters Chapters le chapitre à enregistrer
   * @see self::modifyImages()
   * @return void
   */
  public function saveImages(Chapters $chapters)
  {
    $imagesTemp = $chapters->images();
    if ($imagesTemp['error'] == 0 )
    {
      $imagesName = $imagesTemp['name'];
      $imagesExtension = strrchr($imagesName, "."); 
      $imagesName = md5(uniqid(rand(), true)) . $imagesExtension;

      $imagesTmp_name = $imagesTemp['tmp_name'];
      $linkChapterDir = '../Web/Images/ChaptersImages/'.$chapters->id();

      if (is_dir($linkChapterDir))
      {
        $images = scandir($linkChapterDir);
        foreach($images as $image) {
          if ($image != "." && $image != "..") {
            unlink($linkChapterDir.'/'.$image);
          }
        }
      } else {
        mkdir($linkChapterDir);
      }
      $imagesDest = $linkChapterDir.'/'.$imagesName;
      $imagesReturn = 'Images/ChaptersImages/'.$chapters->id().'/'.$imagesName;
      
      if(move_uploaded_file($imagesTmp_name, $imagesDest))
      {
        $chapters->setImages($imagesReturn);
        } else {
        return false;
      }
    } else {
      $chapters->setImages(0);
    }

    $this->modifyImages($chapters);
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