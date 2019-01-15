<?php
namespace Model;

use \OCFram\Manager;
use \Entity\News;

abstract class NewsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un chapitre.
   * @param $chapters News Le chapitre à ajouter
   * @return void
   */
  abstract protected function add(News $chapters);
  
  /**
   * Méthode permettant d'enregistrer un chapitre.
   * @param $chapters News le chapitre à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(News $chapters)
  {
    if ($chapters->isValid())
    {
      $chapters->isNew() ? $this->add($chapters) : $this->modify($chapters);
    }
    else
    {
      throw new \RuntimeException('Le chapitre doit être validée pour être enregistrée');
    }
  }
  
  /**
   * Méthode renvoyant le nombre de chapitres total.
   * @return int
   */
  abstract public function count();
    
  /**
   * Méthode retournant une liste de chapitres demandée.
   * @param $debut int Le premier chapitre à sélectionner
   * @param $limite int Le nombre de chapitres à sélectionner
   * @return array La liste des chapitres. Chaque entrée est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);
  
  /**
   * Méthode retournant un chapitre précise.
   * @param $id int L'identifiant du chapitre à récupérer
   * @return News Le chapitre demandée
   */
  abstract public function getUnique($id);
  
  /**
   * Méthode permettant de modifier un chapitre.
   * @param $chapters chapters le chapitre à modifier
   * @return void
   */
  abstract protected function modify(News $chapters);
  
  /**
   * Méthode permettant de supprimer un chapitre.
   * @param $id int L'identifiant du chapitre à supprimer
   * @return void
   */
  abstract public function delete($id);
}