<?php

namespace Blog\Visualizacao;

class Twig extends \Zeus\Singleton
{

    private $twig;
    private $base;

    protected function __construct()
    {
        $protocol = (isset($_SERVER['REQUEST_SCHEME'])) ? $_SERVER['REQUEST_SCHEME'] : 'http';
        $loader = new \Twig_Loader_Filesystem('./app');
        $this->twig = new \Twig_Environment($loader);
        $uriInfo = explode('/', $_SERVER['PHP_SELF']);
        $rootScript = end($uriInfo);
        $rootFolder = str_replace($rootScript, '', $_SERVER['PHP_SELF']);
        $this->base = "{$protocol}://{$_SERVER['HTTP_HOST']}$rootFolder";
    }

    public function render($name, array $context = array())
    {
        $context['__BASE__'] = $this->base;
        return $this->twig->render($name, $context);
    }

    public function getBase()
    {
        return $this->base;
    }

}
