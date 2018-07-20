<?php

namespace App\Controllers;

use App\Di\Container;
use App\Traits\Crud;

/**
 * Class Artigos
 * @package App\Controllers
 */
class Artigos extends Action
{
    use Crud;

    /**
     * @var string
     */
    protected $model = "artigos";
}