<?php
namespace FormBuilder;

use \OCFram\Form\FormBuilder;
use \OCFram\Form\StringField;
use \OCFram\Form\TextField;
use \OCFram\Form\CheckBoxField;
use \OCFram\Form\FileField;
use \OCFram\Form\NumberField;

use \OCFram\Form\MaxLengthValidator;
use \OCFram\Form\NotNullValidator;
use \OCFram\Form\FileTypeValidator;
use \OCFram\Form\MaxFileSizeValidator;
use \OCFram\Form\ValidFileValidator;


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
        'maxLength' => 12,
        'validators' => [
          new MaxLengthValidator('Le complément du chapitre spécifié est trop long (12 caractères maximum)', 12),
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

       ->add(new CheckBoxField([
        'label' => 'Publication',
        'name' => 'publication',
       ]));
  }
}