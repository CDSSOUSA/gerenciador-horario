<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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
//$routes->get('/', 'Home::index');

/* ROUTES HORARIO */
$routes->group('/horario',['namespace'=>'App\Controllers\Horario'],function ($routes){
    $routes->get('/','Horario::index');
    $routes->get('add_profissional_horario/(:any)/(:any)/(:any)','Horario::addProfissionalHorario/$1/$2/$3');   
    $routes->post('add', 'Horario::add'); 
});

/* ROUTES PROFESSOR */
$routes->group('/professor',['namespace'=>'App\Controllers\Professor'],function ($routes){
    $routes->get('/','Professor::index');
    //$routes->get('add_profissional_horario/(:any)/(:any)/(:any)','Horario::addProfissionalHorario/$1/$2/$3');   
    $routes->post('add', 'Professor::add'); 
});

/* ROUTES ALOCAÇÃO */
$routes->group('/alocacao',['namespace'=>'App\Controllers\Alocacao'],function ($routes){
    $routes->get('/','Alocacao::index');
    //$routes->get('add_profissional_horario/(:any)/(:any)/(:any)','Horario::addProfissionalHorario/$1/$2/$3');   
    $routes->post('add_etp02', 'Alocacao::add_etp02'); 
    $routes->post('add', 'Alocacao::add'); 
    $routes->post('delete/(:any)', 'Alocacao::delete/$1'); 
});


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
