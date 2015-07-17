<?php

namespace App\Controllers;

use App\Di\Container;
use App\Mail\SendMail;

/**
 * Class Usuario
 * @package App\Controllers
 */
class Usuario extends Action
{
    /**
     * @var string
     */
    protected $model = "usuarios";

    /**
     * Tela Cadastro
     *
     */
    public function cadastro()
    {
        $servidor = &$_SERVER["SERVER_NAME"];

        $this->view->erroEmail = false;


        if(count($_POST)) {
            $model = Container::getClass($this->model);
            $validaEmail = $model->findByEmail($_POST['email']);

            if($validaEmail['rows'] == 1){
                $this->view->erroEmail = true;
            } else {
                $salvar = $model->save($_POST);
            }

            if(isset($salvar))
                header("location:http://$servidor/usuario/confirmacao?id=$salvar");

        }
        $this->render("cadastro");
    }

    /**
     * Tela confirmação
     */
    public function confirmacao()
    {

        $model = Container::getClass($this->model);

        $swift = new SendMail();
        $confMail = $swift->configuraSwift();

        if(isset($_GET['id'])) {

            $this->view->usuario = $model->find($_GET['id']);

            $id = $_GET['id'];

            $nome = $this->view->usuario['nome'];

            $dados = [
                'nome' => $this->view->usuario['nome'],
                'email'=> $this->view->usuario['email']
            ];
            $assunto = "Confirmação de Cadastro";
            $destinatario = "mark.g.martins@gmail.com";

            $mensagemHtml = "
                Olá $nome,</br>
                Você se cadastrou em nosso sistema, segue a seguir link para ativação: http://localhost.phpmvc/assinante/ativacao?id=$id
                ";

            $swift->enviaHtml($confMail['messageInstance'], $confMail['mailerInstance'],$assunto,$destinatario,$mensagemHtml,$dados);

        }
        $this->render("confirmacao");
    }

    /**
     * Tela Assinante / Edição
     */
    public function assinante()
    {
        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['id'])) {

            session_destroy();

            header("Location:/"); exit;
        }

        $model = Container::getClass($this->model);
        if(isset($_SESSION['id'])) {
            $this->view->usuario = $model->find($_SESSION['id']);
        }

        $model = Container::getClass($this->model);

        if(count($_POST)) {
            //print_r($_POST);die;
            $salvar = $model->save($_POST);

            if(isset($salvar))
                header("location:/assinante/confirma-alteracao?id=$salvar");

        }


        $this->render("assinante");
    }

    /**
     * Tela de confirmação de alteração
     */
    public function alteracao()
    {
        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['id'])) {

            session_destroy();

            header("Location:/"); exit;
        }

        $model = Container::getClass($this->model);
        if(isset($_SESSION['id'])) {
            $this->view->usuario = $model->find($_SESSION['id']);
        }

        $this->render("alteracao");

    }

    /**
     * Tela de ativação de usuário
     */
    public function ativacao()
    {
        $model = Container::getClass($this->model);

        $this->view->erro = false;

        if(isset($_GET['id'])) {
            $this->view->usuario = $model->find($_GET['id']);

            if($this->view->usuario['ativo'] == 1) {
                $this->view->erro = true;
            }
            else {
                $model->_activate($_GET['id']);

                $confirmaLogin = $model->find($_GET['id']);

                if ($confirmaLogin['ativo'] == 1){

                    if (!isset($_SESSION)) session_start();

                    $_SESSION['email'] = $confirmaLogin['email'];
                    $_SESSION['id'] = $confirmaLogin['id'];

                }

            }


        }

        $this->render("ativacao");
    }

    /**
     * Tela de recuperação de senha
     */
    public function esqueceu()
    {
        $model = Container::getClass($this->model);
        $this->view->erro = false;

        if(count($_POST)) {

            $usuario = $model->findByEmail($_POST['email']);

            //print_r($usuario);die;

            if($usuario['rows'] > 0){
                $id = $usuario['fetch']['id'];
                header("location: /usuario/senha-enviada?id=$id");
            } else {
                $this->view->erro = true;
            }
        }

        $this->render("esqueceu");

    }

    public function enviosenha()
    {
        $model = Container::getClass($this->model);
        if(isset($_GET['id'])) {
            $this->view->usuario = $model->find($_GET['id']);
        }

        $this->render("enviosenha");

    }

}