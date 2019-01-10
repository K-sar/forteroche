<?php
namespace App\Frontend\Modules\Contact;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class ContactController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Contact');
  }
}