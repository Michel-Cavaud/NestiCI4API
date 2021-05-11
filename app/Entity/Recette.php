<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;
use CodeIgniter\Entity;
/**
 * Description of Recette
 *
 * @author michel
 */
class Recette extends Entity{
   
    protected $ingredients = [];
    
    function getIngredients() {
        return $this->ingredients;
    }

    function setIngredients($ingredients): void {
       $this->ingredients[] = $ingredients;
    }


    
}
