<?php
namespace App\Backend\Modules\Chapters;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Chapters;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\ChaptersFormBuilder;
use \OCFram\FormHandler;
 
class ChaptersController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des chapitres');
 
    $manager = $this->managers->getManagerOf('Chapters');
 
    $this->page->addVar('listeChapters', $manager->getList());
    $this->page->addVar('nombreChapters', $manager->count());
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Ajout d\'un chapitre');
  }
 
  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Modification d\'un chapitre');
  }
 
  public function executeDelete(HTTPRequest $request)
  {
    $chaptersId = $request->getData('id');
 
    $this->managers->getManagerOf('Chapters')->delete($chaptersId);
    $this->managers->getManagerOf('Comments')->deleteFromChapters($chaptersId);
 
    $this->app->user()->setFlash('Le chapitre a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('/admin');
  }
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
    
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');
      $this->app->httpResponse()->redirect('/admin');
    }
 
    $this->page->addVar('form', $form->createView());
  }

  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('/admin');
  }

  public function executeReport()
  {    
    $this->page->addVar('title', 'Modération des commentaires');

    $Reported = $this->managers->getManagerOf('Comments');
    $Ignored = $this->managers->getManagerOf('Comments');
  
    $this->page->addVar('commentsReported', $Reported->getListOfReport());
    $this->page->addVar('commentsIgnored', $Ignored->getListOfIgnored());
    $this->page->addVar('numberReported', $Reported->countReport());
    $this->page->addVar('numberIgnored', $Ignored->countIgnored());
  }

  public function executeIgnoringComment(HTTPRequest $request)
  {    
    $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    $comment->setIgnorer(true);
    $this->managers->getManagerOf('Comments')->modify($comment);

    $this->app->httpResponse()->redirect('report.html');
  }

  public function executeRemindingComment(HTTPRequest $request)
  {    
    $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    $comment->setIgnorer(0);
    $this->managers->getManagerOf('Comments')->modify($comment);

    $this->app->httpResponse()->redirect('report.html');
  }
 
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $chapters = new Chapters([
        'chapitre' => $request->postData('chapitre'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu'),
        'auteur' => $request->postData('auteur')
      ]);
 
      if ($request->getExists('id'))
      {
        $chapters->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant du chapitre est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $chapters = $this->managers->getManagerOf('Chapters')->getUnique($request->getData('id'));
      }
      else
      {
        $chapters = new Chapters;
      }
    }
 
    $formBuilder = new ChaptersFormBuilder($chapters);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Chapters'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($chapters->isNew() ? 'Le chapitre a bien été ajouté !' : 'Le chapitre a bien été modifié !');
 
      $this->app->httpResponse()->redirect('/admin');
    }
 
    $this->page->addVar('form', $form->createView());
  }
}