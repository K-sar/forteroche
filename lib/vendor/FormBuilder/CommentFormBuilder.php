<?php
namespace FormBuilder;
 
use \OCFram\Form\FormBuilder;

use \OCFram\Form\StringField;
use \OCFram\Form\TextField;

use \OCFram\Form\MaxLengthValidator;
use \OCFram\Form\NotNullValidator;
 
class CommentFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Auteur',
        'name' => 'auteur',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
        ],        
        'placeholder' => 'Inserez votre nom ici',
       ]))
       ->add(new TextField([
        'label' => 'Contenu',
        'name' => 'contenu',
        'rows' => 7,
        'cols' => 50,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],        
        'placeholder' => 'Inserez votre commentaire ici',
       ]));
  }
}