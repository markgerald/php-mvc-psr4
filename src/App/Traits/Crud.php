<?php

namespace App\Traits;

use App\Controllers\Action;
use App\Di\Container;

/**
 * Trait Crud
 * @package App\Traits
 */
trait Crud {

    /**
     * Método de listagem padrão
     */
    public function index()
    {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header("Location:/"); exit;
        }

        $model = Container::getClass($this->model);
        $this->view->objetos = $model->fetchAll();
        $this->render("index");
    }

    /**
     * Método de adicionar item padrão
     */
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

    /**
     * Método de edição de item padrão
     */
   public function edit()
   {

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

    /**
     * Método de exclusão de item padrão
     */
   public function delete()
   {

       if (!isset($_SESSION)) session_start();
       if (!isset($_SESSION['id'])) {
           session_destroy();
           header("Location:/"); exit;
       }

       if(isset($_GET['id'])) {
           $model = Container::getClass($this->model);
           $model->delete($_GET['id']);
           header("Location:/artigos?deleteok=1"); exit;

       }
   }
}
