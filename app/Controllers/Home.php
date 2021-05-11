<?php

namespace App\Controllers;

class Home extends BaseController {

    public function index() {
        
        //echo $test;
        $data['test'] = 'Balise test';
        
        $this->twig->display('test.html', $data);
    }

}
