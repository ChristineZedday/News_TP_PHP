<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class NewsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
   var_dump('dans executeIndex de Newscontroller');
    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    
    // On ajoute une définition pour le titre.
   
    $this->page->addVar('title', 'Liste des '.$nombreNews.' dernières news');
    $vars = $this->page->getVars();
    echo '<pre>';
    var_dump($vars[0]);
    echo '/<pre>';
    
    // On récupère le manager des news.
    
    $manager = $this->managers->getManagerOf('News');
    
    $listeNews = $manager->getList(0, $nombreNews);
    
    foreach ($listeNews as $news)
    {
      if (strlen($news->contenu()) > $nombreCaracteres)
      {
        $debut = substr($news->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        
        $news->setContenu($debut);
      }
    }
    echo '<pre>';
    var_dump($listeNews) ;
    echo '</pre>';
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('listeNews', $listeNews);
    echo '<pre>';
    var_dump('ma page vue par NewsController '.$this->page->getVars([1]));
    echo '</pre>';
  }
  
  public function executeShow(HTTPRequest $request)
  {
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
    
    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }
    
    $this->page->addVar('title', $news->titre());
    $this->page->addVar('news', $news);
  }
}