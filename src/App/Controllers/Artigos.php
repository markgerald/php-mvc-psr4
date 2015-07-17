<?php

namespace App\Controllers;

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

}