<?php

namespace App\Controllers;

use App\Di\Container;

/**
 * Class Artigos
 * @package App\Controllers
 */
class Artigos extends Action
{
    /**
     * @var string
     */
    protected $model = "artigos";
    use Crud;

    public function novo()
    {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header("Location:/"); exit;
        }

        if(count($_POST)) {
            $model = Container::getClass($this->model);
            $model->save($_POST);
            $this->view->sucesso = true;
        }
        $this->render("novo", false);
    }

    public function edit() {

        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header("Location:/"); exit;
        }

        $model = Container::getClass($this->model);

        if(count($_POST)) {
            $model->save($_POST);
            $this->view->sucesso = true;
        }

        if(isset($_GET['id'])) {
            $this->view->dados = $model->find($_GET['id']);
        }

        $this->render("edit", false);

    }

}