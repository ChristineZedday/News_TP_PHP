<?php
namespace App\Frontend;

use \OCFram\Application;

class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();

    $this->name = 'Frontend';
   
  }

  public function run()
  {
    var_dump('le bootstrap ma anvoyé ici dans run de frontendapp');
    $controller = $this->getController();
    var_dump ('revenu dans frontendapp avec le controleur, que je vais executer');
    var_dump('a-t-il une page?'.$controller->page()->getVars());
    $controller->execute();
var_dump('je reviens avec la liste des news fournie par Newscontroller, je vas ds httpresponse avec la page: '.$controller->page()->getVars([1]));
    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}
