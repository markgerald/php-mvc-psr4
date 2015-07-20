<?php

namespace App\Controllers;

use App\Di\Container;

trait Crud {

    public function index() {

        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header("Location:/"); exit;
        }

        $model = Container::getClass($this->model);
        $this->view->objetos = $model->fetchAll();
        $this->render("index");
    }

   public function novo() {

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
       $this->render("novo");
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
       
       $this->render("edit");

   }
   
   public function delete() {

       if (!isset($_SESSION)) session_start();
       if (!isset($_SESSION['id'])) {
           session_destroy();
           header("Location:/"); exit;
       }

       if(isset($_GET['id'])) {
           $model = Container::getClass($this->model);
           $model->delete($_GET['id']);
           header("Location:/artigos?deleteok=1"); exit;
           //$this->render("delete");
       }
   }

}
