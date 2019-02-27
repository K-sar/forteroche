<?php
namespace FormBuilder;

use \OCFram\Form\FormBuilder;
use \OCFram\Form\StringField;
use \OCFram\Form\FileField;

use \OCFram\Form\MaxLengthValidator;
use \OCFram\Form\NotNullValidator;
use \OCFram\Form\FileTypeValidator;
use \OCFram\Form\MaxFileSizeValidator;
use \OCFram\Form\ValidFileValidator;


class ImagesFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new FileField([
        'label' => 'Image',
        'name' => 'images',
        'maxFileSize' => 1048576,
        'validFileType' => array('jpg', 'jpeg', 'gif', 'png'),
        'validators' => [
          new ValidFileValidator('Erreur lors du transfert, vérifiez la taille et l\'extension du fichier', 'images'),
          new MaxFileSizeValidator('Le fichier spécifié est trop gros (1 Mo maximum)', 1048576, 'images'),
          new FileTypeValidator('L\'extension du fichier n\'est pas conforme (jpg, jpeg, gif ou png)', array('jpg', 'jpeg', 'gif', 'png'), 'images'),       
        ],
        ]))
    
        ->add(new StringField([
        'label' => 'Texte alternatif',
        'name' => 'alternatif',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le texte alternatif spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le texte alternatif de l\'image'),       
        ],
        ]));     
  }
}