<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use CodeIgniter\Model;
use App\Entity\Recette;
use App\Entity\Ingredient;

/**
 * Description of newPHPClass
 *
 * @author michel
 */
class ModelRecipe extends Model {

    public function findAllForApi() {
        $query = $this->db->query('SELECT * FROM `view_api_recipes`');
        return $query->getResult();
    }

    public function findCat($cat) {
        $query = $this->db->query('SELECT * FROM view_api_recipes WHERE idcat="' . $cat . '"');
        return $query->getResult();
    }

    public function readOne($id) {

        $query = $this->db->query('SELECT id_recettes as id, nom_recettes as nom, nombre_personne_recettes as nb, temps_recettes as temps'
                . ' FROM recettes WHERE id_recettes="' . $id . '"');

        $recette = new Recette();
        $row = $query->getRow();
        $recette->id = $row->id;
        $recette->nom = $row->nom;
        $recette->nb = $row->nb;
        $recette->temps = $row->temps;
        
        $query = $this->db->query('SELECT contenu_paragraphes FROM paragraphes WHERE id_recettes="' . $id . '"');
        foreach ($query->getResult('array') as $row) {
            $preparations[] = $row['contenu_paragraphes']; 
        }
        $recette->preparations = $preparations;
        
        $query =  $this->db->query("SELECT i.id_produits as idproduit, p.nom_produits as nomProduit, i.quantite_ingredients_recette as qty, u.nom_unites_de_mesure as nomUnite, i.ordre_ingredients_recette as ordre"
                . " FROM ingredients_recettes as i, unites_de_mesure as u, produits as p WHERE i.id_unites_de_mesure = u.id_unites_de_mesure"
                . " AND i.id_produits = p.id_produits AND i.id_recettes ='" . $id .  "' ORDER BY ordre ASC");
        
        foreach ($query->getResult('array') as $row) {
            $ingredient =  new Ingredient();
            $ingredient->nom = $row['nomProduit'];
            $ingredient->qty = $row['qty'];
            $ingredient->unite = $row["nomUnite"];
            $ingredient->id = $row['idproduit'];
            $recette->setIngredients($ingredient);
            
        }
       
        return $recette;
    }
    
    public function searchRecipe($recherche) {
        $query = $this->db->query('SELECT * FROM recettes WHERE nom_recettes LIKE "%' . $recherche . '%"');
        return $query->getResult();
    }
    
   
    
}   