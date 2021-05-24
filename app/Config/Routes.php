<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'DocApiController::recipes');

$routes->group(
    'api/doc',
    function ($routes) {
        $routes->get('recipes', "DocApiController::recipes");
        $routes->get('recipe', "DocApiController::recipe");
        $routes->get('recipesbycategory', "DocApiController::recipesbycategory");
        $routes->get('search', "DocApiController::search");
    }
);

$routes->group(
    'api',
    function ($routes) {
        $routes->get('(:any)/recipe/(:num)', "ApiController::recipe/$1/$2");
        $routes->get('(:any)/search/(:alpha)', "ApiController::searchRecipe/$1/$2");

        $routes->get('(:any)/recipesbycategory/(:num)', "ApiController::recipesbycategory/$1/$2");
        $routes->get('(:any)/recipes', "ApiController::recipes/$1");

        $routes->get('', "DocApiController::recipes");
    }
);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
