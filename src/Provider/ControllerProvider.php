<?php
/**
 * Controler Provider
 */

namespace Little\Provider;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class ControllerProvider implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
        $routes = $app['app.routes'];

        foreach ($routes as $bind => $options) {
            $methods = isset($options['methods']) ? $options['methods'] : ['GET', 'POST'];
            $controllers
                ->match($options['path'], $options['defaults']['_controller'])
                ->method(implode('|', $methods))
                ->bind($bind);
        }

        return $controllers;
    }
}
