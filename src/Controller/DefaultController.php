<?php
/**
 * DefaultController
 */

namespace Little\Controller;

use Silex\Application;

class DefaultController
{
    public function indexAction(Application $app)
    {
        return $app['twig']->render('index.html.twig');
    }
}
