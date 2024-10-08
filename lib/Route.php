<?php

namespace lib;

// Utilización de métodos "static" para llamar a las funciones de la clase Route sin necesidad de instanciarla
class Route {

    private static $routes = [];

    public static function get($uri, $callback){
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] = $callback;
    }
        
    public static function post($uri, $callback) {
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = $callback;
    }

    public static function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');

        if (strpos($uri, '?')) {
            $uri =substr($uri, 0, strpos($uri, '?'));
        }
    
        $method = $_SERVER['REQUEST_METHOD'];
    
        foreach (self::$routes[$method] as $route => $callback) {
            // Manejo de parámetros dinámicos en la ruta
            if (strpos($route, ':') !== false) {
                $route = preg_replace('#:([a-zA-Z]+)#','([a-zA-Z0-9-]+)', $route);
            }
    
            if (preg_match("#^$route$#", $uri, $matches)) {
                $params = array_slice($matches, 1);
                
                // Ejecutar el callback si es callable
                if (is_callable($callback)) {
                    $response = $callback(...$params);
                }
    
                // Manejar el caso en que $callback es un array
                if (is_array($callback)) {
                    $controller = new $callback[0];
                    $response = $controller->{$callback[1]}(...$params);
                    // $response = $controller->show(id: $params[0]); // Mal
                }

                // Asegúrate de que $response sea una cadena antes de hacer echo
                if (is_array($response) ||  is_object($response)) {
                    echo json_encode($response); // Convertir a JSON si es un array
                } else {
                    echo $response; // Imprimir la respuesta
                }

                return; // Salir después de enviar la respuesta
            }
        }
    
        echo "404"; // Respuesta de no encontrado
    }
}

?>
