<?php
namespace App\Backend\Modules\Chapters;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Chapters;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\ChaptersFormBuilder;
use \FormBuilder\ImagesFormBuilder;
use \OCFram\Form\FormHandler;
 
class ChaptersController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des chapitres');
    
    $wherePublic = array('publication = 1');
    $orderPublic = array('chapitre ASC', 'complement ASC');
    $chaptersPublic = $this->managers->getManagerOf('Chapters')->getList($wherePublic, $orderPublic);
    $wherePrivate = array('publication = 0');
    $orderPrivate = array('id DESC');
    $chaptersPrivate = $this->managers->getManagerOf('Chapters')->getList($wherePrivate, $orderPrivate);
  
    $this->page->addVar('listChaptersPublic', $chaptersPublic);
    $this->page->addVar('listChaptersPrivate', $chaptersPrivate);
    $this->page->addVar('numberChaptersPublic', count($chaptersPublic));
    $this->page->addVar('numberChaptersPrivate', count($chaptersPrivate));
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

  public function executePublishChapter(HTTPRequest $request)
  {    
    $chapter = $this->managers->getManagerOf('Chapters')->getUnique($request->getData('id'));

    if($chapter->publication() == 1) {
      $chapter->setPublication(0);
    } else {
      $chapter->setPublication(1);
    }

    $this->managers->getManagerOf('Chapters')->savePublish($chapter);

    $this->app->httpResponse()->redirect('/admin');
  }

  public function executeImages(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Illustrer un chapitre');

    if ($request->method() == 'POST')
    {
      $chapters = new Chapters([
        'alternatif' => $request->postData('alternatif'),
        'images' => $request->fileData('images')
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
    }
  
    $formBuilder = new ImagesFormBuilder($chapters);
    $formBuilder->build();
 
    $form = $formBuilder->form();
   
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Chapters'), $request);
    
    
    if($request->method() == 'POST' && $form->isValid())
    {
      $this->managers->getManagerOf('Chapters')->saveImages($chapters);

      $this->app->user()->setFlash('L\'illustration du chapitre a bien été mise à jour!');
 
      $this->app->httpResponse()->redirect('/admin');
    }
 
    $this->page->addVar('form', $form->createView());
  }

  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $chapters = new Chapters([
        'chapitre' => $request->postData('chapitre'),
        'complement' => $request->postData('complement'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu'),
        'auteur' => $request->postData('auteur'),
        'publication' => $request->postData('publication'),
        'images' => $request->fileData('images')
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
      $this->app->user()->setFlash($chapters->isNew() ? 'Le chapitre a bien été ajouté!' : 'Le chapitre a bien été modifié!');
 
      $this->app->httpResponse()->redirect('/admin');
    }
 
    $this->page->addVar('form', $form->createView());
  }
}