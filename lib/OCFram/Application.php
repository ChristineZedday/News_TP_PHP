<?php
namespace OCFram;

abstract class Application
{
  protected $httpRequest;
  protected $httpResponse;
  protected $name;
  
  public function __construct(Application $app)
  {
    $this->httpRequest = new HTTPRequest($app);
    $this->httpResponse = new HTTPResponse($app);
    $this->name = '';
  }
  
  abstract public function run();
  
  public function httpRequest()
  {
    return $this->httpRequest;
  }
  
  public function httpResponse()
  {
    return $this->httpResponse;
  }
  
  public function name()
  {
    return $this->name;
  }
}