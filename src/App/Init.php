<?php

namespace App;

use App\Init\Bootstrap;

/**
 * Class Init
 * @package App
 */
class Init extends Bootstrap
{

    /**
     * Método para setar rotas, baseadas em controlers e actions
     */
    protected function initRoutes()
    {
        $ar['home'] = ['route' => '/', 'controller' => 'index', 'action' => 'index'];
        $ar['cadastro'] = ['route' => '/usuario/cadastro', 'controller' => 'usuario', 'action' => 'cadastro'];
        $ar['cadastro-confirmacao'] = ['route' => '/usuario/confirmacao', 'controller' => 'usuario', 'action' => 'confirmacao'];
        $ar['usuario-assinante'] = ['route' => '/assinante', 'controller' => 'usuario', 'action' => 'assinante'];
        $ar['dashboard'] = ['route' => '/dashboard', 'controller' => 'index', 'action' => 'dashboard'];
        $ar['logout'] = ['route' => '/logout', 'controller' => 'index', 'action' => 'logout'];
        $ar['confirma-alteracao'] = ['route' => '/assinante/confirma-alteracao', 'controller' => 'usuario', 'action' => 'alteracao'];
        $ar['ativacao'] = ['route' => '/assinante/ativacao', 'controller' => 'usuario', 'action' => 'ativacao'];
        $ar['esqueceu-senha'] = ['route' => '/usuario/esqueceu', 'controller' => 'usuario', 'action' => 'esqueceu'];
        $ar['senha-enviada'] = ['route' => '/usuario/senha-enviada', 'controller' => 'usuario', 'action' => 'enviosenha'];

        //Artigos Route
        $ar['artigos'] = ['route' => '/artigos', 'controller' => 'artigos', 'action' => 'index'];
        $ar['artigo-novo'] = ['route' => '/artigo/novo', 'controller' => 'artigos', 'action' => 'novo'];
        $ar['artigo-edit'] = ['route' => '/artigo/edit', 'controller' => 'artigos', 'action' => 'edit'];
        $ar['artigo-delete'] = ['route' => '/artigo/delete', 'controller' => 'artigos', 'action' => 'delete'];



        $this->setRoutes($ar);
    }



}
