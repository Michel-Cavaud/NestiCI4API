<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Models\ModelRecipe;
use App\Models\ModelLogsJetons;
use App\Models\ModelJetons;

/**
 * Description of ApiController
 *
 * @author michel
 */
class ApiController extends BaseController
{

    public function recipes($jeton)
    {
        if ($this->chercheJeton($jeton, 'recipes')) {
            $model = new ModelRecipe();
            $recipes = $model->findAllForApi();
            header('Content-Type: application/json');
            echo json_encode($recipes);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalide token']);
        }
        die;
    }

    public function recipesbycategory($jeton, $cat)
    {
        if ($this->chercheJeton($jeton, 'recipesbycategory')) {
            $model = new ModelRecipe();
            $recipes = $model->findCat($cat);
            header('Content-Type: application/json');
            echo json_encode($recipes);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalide token']);
        }
        die;
    }

    public function recipe($jeton, $id)
    {
        if ($this->chercheJeton($jeton, 'recipe')) {
            $model = new ModelRecipe();
            $recipe = $model->readOne($id);
            header('Content-Type: application/json');

            $result = ['recipe' => $recipe, 'ingredients' => $recipe->ingredients];
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalide token']);
        }
        die;
    }

    public function searchRecipe($jeton, $recherche)
    {
        if ($this->chercheJeton($jeton, 'searchRecipe')) {
            $model = new ModelRecipe();
            $recipe = $model->searchRecipe($recherche);
            header('Content-Type: application/json');
            echo json_encode($recipe);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalide token']);
        }
        die;
    }

    private function chercheJeton($jeton, $methode)
    {
        $modelJeton = new ModelJetons();

        $validJeton = $modelJeton->where('etat_jetons', 'a')
            ->where('valeur_jetons', $jeton)
            ->find();
        if (empty($validJeton)) {
            return false;
        } else {
            $modelLogJeton = new ModelLogsJetons();

            $data = [
                'id_jetons' => $validJeton[0]->id_jetons,
                'methode_logs_jetons' => $methode
            ];

            $modelLogJeton->insert($data);
            return true;
        }
    }
}
