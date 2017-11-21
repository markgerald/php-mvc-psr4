<?php

namespace App\Controllers;

use App\Di\Container;

/**
 * Class Index - Responsável pelo Login
 * @package App\Controllers
 */
class Index extends Action
{
    /**
     * @var string
     */
    protected $model = "usuarios";

    /**
     * Método / Action de Login
     */
    public function index()
    {
        $model = Container::getClass($this->model);
        $this->view->erro = false;

        if(count($_POST)) {
            $senha = md5(sha1(base64_encode($_POST['senha'])));
            $confirmaLogin = $model->_login($_POST['email'], $senha);
            if ($confirmaLogin['rows'] == 1){
                if (!isset($_SESSION)) session_start();
                $_SESSION['email'] = $confirmaLogin['fetch']['email'];
                $_SESSION['id'] = $confirmaLogin['fetch']['id'];
                $_SESSION['nome'] = $confirmaLogin['fetch']['nome'];
                header('location:/dashboard');
            } else {
                $this->view->erro = true;
            }
        }

        $this->render("index");
    }

    /**
     * Método / Action de Logout
     */
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location:/"); exit;

    }

    public function dashboard()
    {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header("Location:/"); exit;
        }

        $this->render("dashboard");
    }
}
