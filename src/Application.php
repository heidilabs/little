<?php
/**
 * Little App
 * @author erikaheidi
 */

namespace Little;

use Little\Provider\ConfigServiceProvider;
use Little\Provider\ControllerProvider;
use Silex\Application as SilexApp;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

class Application extends SilexApp
{
    public function __construct(array $values = [])
    {
        parent::__construct($values);
        $this->init();
    }

    public function init()
    {
        $app = $this;

        $this['app.root_dir'] = $this->share(function () use ($app) {
            return __DIR__ . '/../';
        });

        $this->register(new ConfigServiceProvider());

        $this['config'] = $this->share(function () use ($app) {
            return $app['config.loader']->load($this['config.file']);
        });

        $this->register(new UrlGeneratorServiceProvider());

        $this['app.routes'] = $this->share(function () use ($app) {
            return $app['config.loader']->load($this['app.root_dir'] . $this['config']['routing']);
        });

        $this->mount('/', new ControllerProvider());

        $this->register(new TwigServiceProvider(), [
            'twig.path' => $this['app.root_dir'] . $this['config']['views'],
        ]);

        $this->register(new SessionServiceProvider());

    }
}
