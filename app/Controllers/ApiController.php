<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Models\ModelRecipe;
use App\Entity\Ingredient;

/**
 * Description of ApiController
 *
 * @author michel
 */
class ApiController extends BaseController {

    public function index() {
        return view('api_help');
    }

    public function recipes() {
        $model = new ModelRecipe();
        $recipes = $model->findAllForApi();
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }

    public function category($cat) {
        $model = new ModelRecipe();
        $recipes = $model->findCat($cat);
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }

    public function recipe($id) {
        $model = new ModelRecipe();
        $recipe = $model->readOne($id);
        header('Content-Type: application/json');

        $result = ['recipe' => $recipe, 'ingredients' => $recipe->ingredients];
        echo json_encode($result);
        
        die;
    }
    
    public function searchRecipe($recherche) {
        $model = new ModelRecipe();
        $recipe = $model->searchRecipe($recherche);
        header('Content-Type: application/json');

        echo json_encode($recipe);
        
        die;
    }

}
