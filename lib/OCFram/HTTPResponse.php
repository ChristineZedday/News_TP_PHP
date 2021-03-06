<?php
namespace OCFram;

class HTTPResponse extends ApplicationComponent
{
	protected $page;

	public function addHeader($header)
	{
		header($header);
	}

	public function redirect($location)
	{
		header('Location: '.$location);
    	exit;
	}

	public function redirect404()
	{
	  $this->page = new Page($this->app);
	  $this->page->setContentFile(__DIR__.'/Web/Errors/404.html');
	  
	  $this->addHeader('HTTP/1.0 404 Not Found');
	  
	  $this->send();
	}

	public function send()
	{
		var_dump('fonction send de HTTPresponse');
		exit($this->page->getGeneratedPage());
	}

	public function setCookie($name, $value="", $expire=0, $path=null, $domain=null, $secure=false, $HTTPOnly=true)
	{
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}

	public function setPage(page $page)
	{
		$vars= $page->getVars();
		var_dump('la page? '.$vars[0]);
		$this->page = $page;
	}
}