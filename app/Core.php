<?php
class Core{

    protected $currentController = 'Controller';
    protected $currentMethod = 'index';
    protected $params = [];

public function __construct(){

    //1) Put the url into a string
    print_r($this->getUrl());
    $url = $this->getUrl();

    //2) The first element of the url-array is the name of the controller
    if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
    }
    require_once '../app/controllers/'.$this->currentController.'.php';

    //3) The second element of the url-array is the method of that controller
    if(isset($url[1])){
        if(method_exists($this->currentController,$url[1])){
            $this->currentMethod = $url[1];
            unset($url[1]);
        }
    }

    //4) Any other things remaining in the url-array will be the parameters to be put into the method
    $this->params= $url ? array_values($url):[];
    call_user_func_array([$this->currentController,$this->currentMethod], $this->params);




}



// To fetch the url and return it in a string
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL); // get rid of any characters url shouldn't have
            $url = explode('/', $url); // put into array everything sepaarted by / char
            return $url;
        }
    }
}