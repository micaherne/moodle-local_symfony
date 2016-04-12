<?php

use local_symfony\routing\moodle_router;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require_once '../../../config.php';
require_once($CFG->dirroot . '/local/symfony/vendor/autoload.php');

$dispatcher = new EventDispatcher();
$resolver = new ControllerResolver();
$app = new HttpKernel($dispatcher, $resolver);

$router = new moodle_router();
$request = Request::createFromGlobals();

try {
	$match = $router->matchRequest($request);
	$request->attributes->set('_controller', $match['_controller']);
	$response = $app->handle($request);
	$response->send();
} catch (ResourceNotFoundException $e) {
	$response = new Response();
	$response->setStatusCode(404, "not found");
}

$app->terminate($request, $response);
