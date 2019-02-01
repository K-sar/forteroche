<?php
namespace App\Frontend\Modules\Comments;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
 
class CommentsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'chapters' => $request->getData('chapters'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu'),
        'signalement' => $request->postData('signalement'),
      ]);
    }
    else
    {
      $comment = new Comment;
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
 
      $this->app->httpResponse()->redirect('chapters-'.$request->getData('chapters').'.html');
    }
 
    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
  }

  public function executeReportComment(HTTPRequest $request)
  {
    $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    $comment->setSignalement($comment->signalement()+1);
    $this->managers->getManagerOf('Comments')->saveModeration($comment);

    $this->app->user()->setFlash('Le commentaire a bien été signalé, merci !');
    $this->app->httpResponse()->redirect('chapters-'.$comment->chapters().'.html');
  }
}