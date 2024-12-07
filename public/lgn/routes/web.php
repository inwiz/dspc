<?php

$routes = [
    '/lgn/crud-posts.php' => 'Router@index',
    '/lgn/crud-posts.php/edit/{id}' => 'Router@postEdit',
    '/lgn/crud-posts.php/delete/{id}' => 'Router@postDelete',
    '/lgn/crud-posts.php/update/{id}' => 'Router@postUpdate',
    '/lgn/crud-posts.php/logout' => 'Router@logout',
    '/lgn/crud-posts.php/create' => 'Router@create',
    '/lgn/crud-posts.php/add' => 'Router@store',
    '/lgn/public-posts.php/currents' => 'Router@getPublicPostsJSON',
    '/lgn/public-posts.php/archive' => 'Router@getPublicPostsArchiveJSON',
   
   
];


$uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
function route($uri, $routes) {
   $id = '';
    $path_parts = explode("/",$uri);

    if (count($path_parts) ==5) {
      $id = array_pop($path_parts);
        $uri = implode("/",$path_parts);
    }
  
    foreach ($routes as $route => $controllerAction) {
        $route_parts = explode("/",$route);
        if (count($route_parts) ==5) {
            array_pop($route_parts);
              $route = implode("/",$route_parts);
         }

        if ($route === $uri) {
            list($controller, $action) = explode('@', $controllerAction);
            $controllerInstance = new $controller();
            if (!empty($id)) {
                $controllerInstance->$action($id);
            }
            else {
                $controllerInstance->$action(); 
            }
           
            return;
        }
    }
 
    http_response_code(404);
    echo "Страница не найдена";
}


