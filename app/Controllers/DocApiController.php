<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of ApiController
 *
 * @author michel
 */
class DocApiController extends BaseController
{

    public function recipes()
    {
        return  $this->twig->display('recettes.html');
    }

    public function recipe()
    {
        return  $this->twig->display('recette.html');
    }

    public function recipesbycategory()
    {
        return  $this->twig->display('recipesbycategory.html');
    }

    public function search()
    {
        return  $this->twig->display('search.html');
    }
}
