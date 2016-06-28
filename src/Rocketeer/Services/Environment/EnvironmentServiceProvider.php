<?php

/*
 * This file is part of Rocketeer
 *
 * (c) Maxime Fabre <ehtnam6@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rocketeer\Services\Environment;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Rocketeer\Services\Environment\Pathfinders\LocalPathfinder;
use Rocketeer\Services\Environment\Pathfinders\ServerPathfinder;

class EnvironmentServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = ['paths', 'environment'];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->container->share('environment', function () {
            return new Environment($this->container);
        });

        $this->container->share('paths', function () {
            $pathfinder = new Pathfinder($this->container);
            $pathfinder->registerPathfinder(LocalPathfinder::class);
            $pathfinder->registerPathfinder(ServerPathfinder::class);

            return $pathfinder;
        });
    }
}
