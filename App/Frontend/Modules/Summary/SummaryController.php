<?php
namespace App\Frontend\Modules\Summary;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
 
class SummaryController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $nombreChapters = $this->app->config()->get('nombre_chapters');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreChapters.' dernières chapters');
 
    // On récupère le manager des chaptires.
    $manager = $this->managers->getManagerOf('Chapters');
 
    $listeChapters = $manager->getSummaryList(0, $nombreChapters);
 
    // On ajoute la variable $listeChapters à la vue.
    $this->page->addVar('listeChapters', $listeChapters);
  }
}