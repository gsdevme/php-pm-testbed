<?php

namespace App;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application implements DelegateInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request)
    {
        /** @var \Interop\Container\ContainerInterface $container */
        $container = require __DIR__ . '/../../../config/container.php';

        /** @var \Zend\Expressive\Application $app */
        $app = $container->get(\Zend\Expressive\Application::class);

        require __DIR__ . '/../../../config/pipeline.php';
        require __DIR__ . '/../../../config/routes.php';

        return $app->process($request, $app->getDefaultDelegate());
    }
}
