<?php /*
+-------------------------------------------------------+
| Rajarshi Das						                    |
+-------------------------------------------------------+
| Created On:   18-Feb-2024                             |
| Updated On:                                           |
+-------------------------------------------------------+
*/

namespace BadDragon;

class Controller
{

    public function __construct()
    {
        // die("Hello from bad-dragon");
    }

    public function fire($route)
    {
        $controllerModule = W3APP . '/Controller/' . $route->module . '/' . $route->module . '.php';
        $controllerMethod = W3APP . '/Controller/' . $route->module . '/' . $route->controller . '/' . $route->controller . '.php';
        $controllerScript = W3APP . '/Controller/' . $route->module . '/' . $route->controller . '/' . $route->method . '.php';

        if (!is_file($controllerModule)) {
            die("Module " . $controllerMethod . " files missing...");
        };

        if (!is_file($controllerMethod)) {
            die("Controller Method " . $controllerMethod . " is missing...");
        };

        if (!is_file($controllerScript)) {
            die("Controller Method Script " . $controllerScript . " is missing...");
        };

        $rx = [
            $controllerModule,
            $controllerMethod,
            $controllerScript
        ];
        return $rx;
    }
}
