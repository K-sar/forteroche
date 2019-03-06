<?php
namespace App\Frontend\Modules\Chapters;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\Form\FormHandler;
 
class ChaptersController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $nombreChapters = $this->app->config()->get('nombre_chapters');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreChapters.' derniers chapitres');
 
    // On récupère le manager des chaptires.
    $manager = $this->managers->getManagerOf('Chapters');

    $where = array('publication = 1');
    $order = array('datePublication DESC');
    $listeChapters = $manager->getList($where, $order, 0, $nombreChapters);
 
    foreach ($listeChapters as $chapters)
    {
      if (strlen($chapters->contenu()) > $nombreCaracteres)
      {
        $debut = substr($chapters->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $chapters->setContenu($debut);
      }
    }
 
    // On ajoute la variable $listeChapters à la vue.
    $this->page->addVar('listeChapters', $listeChapters);
  }
 
  public function executeShow(HTTPRequest $request)
  {
    $chapters = $this->managers->getManagerOf('Chapters')->getUnique($request->getData('id'));
 
    if (empty($chapters))
    {
      $this->app->httpResponse()->redirect404();
    }
 
    if (!preg_match('#[eé]pilogue#i', $chapters->complement())) {
      $pageTitle = 'Chapitre '. $chapters->chapitre().' '.$chapters->complement();
    } else {
      $pageTitle = $chapters->complement();
    }
    if (!empty($chapters->titre())){
      $pageTitle = $pageTitle.' : '.$chapters->titre();
    }

    $this->page->addVar('title', $pageTitle);
    $this->page->addVar('chapters', $chapters);

    $where = array('chapters = '.$chapters->id());
    $order = array('date DESC');
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($where, $order));
  }
 
  public function executeSummary(HTTPRequest $request)
  { 
    $this->page->addVar('title', 'Sommaire');
 
    $manager = $this->managers->getManagerOf('Chapters');
    
    $where = array('publication = 1');
    $order = array('chapitre ASC', 'complement ASC');
    $listeChapters = $manager->getList($where, $order);
 
    $this->page->addVar('listeChapters', $listeChapters);
  }
}