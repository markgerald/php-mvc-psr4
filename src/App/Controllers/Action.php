<?php

namespace App\Controllers;

/**
 * Class Action
 * @package App\Controllers
 */
abstract class Action {

    /**
     * @var string
     */
    protected $action;
    /**
     * @var \stdClass
     */
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass();
    }

    /**
     * @param $view
     * @param bool $layout
     */
    protected function render($view, $layout=true)
    {
        $this->action = $view;
        if($layout==true && file_exists("../src/App/views/layout.phtml"))
            include_once '../src/App/views/layout.phtml';
        else
            $this->content($view);
    }

    /**
     * Método de montagem de conteúdo a partir de controller e view.
     */
    protected function content()
    {
        $atual = get_class($this);
        $singleClassName = strtolower(str_replace("App\\Controllers\\", "", $atual));
        include_once '../src/App/views/' . $singleClassName . '/' . $this->action . '.phtml';
    }

}
