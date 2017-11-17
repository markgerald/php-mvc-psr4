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
                header("location:/usuario/confirmacao?id=$salvar");

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

        $id = $_GET['id'];

        if(isset($id)) {

            $this->view->usuario = $model->find($id);

            $nome = $this->view->usuario['nome'];

            $dados = [
                'nome' => $this->view->usuario['nome'],
                'email'=> $this->view->usuario['email']
            ];

            $assunto = "Confirmação de Cadastro";
            $destinatario = "mark.g.martins@gmail.com";

            $servidor = getenv('WEBSITE_HOST');

            $mensagemHtml = "
                Olá $nome,</br>
                Você se cadastrou em nosso sistema, segue a seguir link para ativação: $servidor/assinante/ativacao?id=$id
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
            } else {
                $model->_activate($_GET['id']);

                $confirmaLogin = $model->find($_GET['id']);

                if ($confirmaLogin['ativo'] == 1){

                    if (!isset($_SESSION)) session_start();

                    $_SESSION['nome'] = $confirmaLogin['nome'];
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