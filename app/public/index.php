<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/vendor/autoload.php';
//
//$pathEnv = '/docker/' . $_SERVER['APP_ENV'] . '/.env';
//$dotenv = (new Dotenv());
//$dotenv->bootEnv($pathEnv);
//
////dump($dotenv);
////dump($_ENV);
//dump('general');
//
//if ($_SERVER['APP_DEBUG']) {
//    umask(0000);
//
//    Debug::enable();
//}
//
//if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
//    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO);
//}
//
//if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
//    Request::setTrustedHosts([$trustedHosts]);
//}
//
//$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
//dump($kernel->getProjectDir());
//$request = Request::createFromGlobals();
//$response = $kernel->handle($request);
//$response->send();
//$kernel->terminate($request, $response);


require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
