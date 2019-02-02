<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\CheckBoxField;
use \OCFram\FileField;
use \OCFram\NumberField;

use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;

class ChaptersFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new NumberField([
        'label' => 'Chapitre',
        'name' => 'chapitre',
        'maxLength' => 10,
        'validators' => [
          new MaxLengthValidator('Le numéro du chapitre spécifié est trop long (3 caractères maximum)', 3),
        ],
       ]))

       ->add(new StringField([
        'label' => 'Complément',
        'name' => 'complement',
        'maxLength' => 10,
        'validators' => [
          new MaxLengthValidator('Le complément du chapitre spécifié est trop long (10 caractères maximum)', 10),
        ],
        'placeholder' => 'A, Bis,...',
       ]))

       ->add(new StringField([
        'label' => 'Titre',
        'name' => 'titre',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
        ],
        'placeholder' => 'Inserez le titre du chapitre ici',
       ]))

       ->add(new TextField([
        'label' => 'Contenu',
        'name' => 'contenu',
        'rows' => 8,
        'cols' => 60,
        'validators' => [
          new NotNullValidator('Merci de spécifier le contenu du chapitre'),
        ],
       'placeholder' => 'Inserez le contenu du chapitre ici',
       ]))

       ->add(new StringField([
        'label' => 'Auteur',
        'name' => 'auteur',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier l\'auteur du chapitre'),       
        ],
        'value' => 'Jean Forteroche',
       ]))
       
       /*->add(new FileField([
        'maxFileSize' => 1048576,
        'label' => 'Image',
        'name' => 'image',
       ]))*/

       ->add(new CheckBoxField([
        'label' => 'Publication',
        'name' => 'publication',
       ]));
  }
}