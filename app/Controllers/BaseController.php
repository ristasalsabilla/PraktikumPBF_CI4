<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// $request = request();

// // the URI path being requested (i.e., /about)
// $request->getUri()->getPath();

// // Retrieve $_GET and $_POST variables
// $request->getGet('foo');
// $request->getPost('foo');

// // Retrieve from $_REQUEST which should include
// // both $_GET and $_POST contents
// $request->getVar('foo');

// // Retrieve JSON from AJAX calls
// $request->getJSON();

// // Retrieve server variables
// $request->getServer('Host');

// // Retrieve an HTTP Request header, with case-insensitive names
// $request->header('host');
// $request->header('Content-Type');

// // Checks the HTTP method
// $request->is('get');
// $request->is('post');

// $response = response();

// $response->setStatusCode(Response::HTTP_OK);
// $response->setBody($output);
// $response->setHeader('Content-Type', 'text/html');
// $response->noCache();

// // Sends the output to the browser
// // This is typically handled by the framework
// $response->send();

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
