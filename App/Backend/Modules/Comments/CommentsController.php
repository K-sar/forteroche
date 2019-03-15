<?php
namespace App\Backend\Modules\Comments;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\Form\FormHandler;
 
class CommentsController extends BackController
{
    public function executeIndex()
    {    
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
        $this->page->addVar('title', 'Modération des commentaires');

        $whereReported = array('signalement > 0', 'ignorer = 0');
        $orderReported = array('signalement DESC');
        $commentsReported = $this->managers->getManagerOf('Comments')->getListOf($whereReported, $orderReported);

        $whereIgnored = array('ignorer = 1');
        $orderIgnored = array('signalement DESC');
        $commentsIgnored = $this->managers->getManagerOf('Comments')->getListOf($whereIgnored, $orderIgnored);

        foreach ($commentsReported as $commentR)
        {
            $this->formateComment($commentR);
        }

        foreach ($commentsIgnored as $commentI)
        {
            $this->formateComment($commentI);
        }
    
        $this->page->addVar('commentsReported', $commentsReported);
        $this->page->addVar('commentsIgnored', $commentsIgnored);
        $this->page->addVar('numberReported', count($commentsReported));
        $this->page->addVar('numberIgnored', count($commentsIgnored));
    }

    private function formateComment($comment)
    {   
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
        if (strlen($comment->contenu()) > $nombreCaracteres)
        {
            $debut = substr($comment->contenu(), 0, $nombreCaracteres);
            $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

            $comment->setContenu($debut);
        }
        
        $chapterParent = $this->managers->getManagerOf('Chapters')->getUnique($comment->chapters('id'));
        $chapterParent = $chapterParent->chapitreAfficher();

        $comment->setChapitreParent($chapterParent);
        
        return $comment;    }

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
        $this->app->httpResponse()->redirect('report.html');
        }
    
        $this->page->addVar('form', $form->createView());
    }

    public function executeDeleteComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
    
        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
    
        $this->app->httpResponse()->redirect('report.html');
    }

    public function executeModeratingComment(HTTPRequest $request)
    {    
        $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

        if($comment->ignorer() == 1) {
        $comment->setIgnorer(0);
        } else {
        $comment->setIgnorer(1);
        }

        $this->managers->getManagerOf('Comments')->saveModeration($comment);

        $this->app->httpResponse()->redirect('report.html');
    }
}