<?php

// $typography = \Config\Services::typography(false);

// $options1 = [
//     'baseURI' => 'http://example.com/api/v1/',
//     'timeout' => 3,
// ];
// $client1 = \Config\Services::curlrequest($options1);

// $options2 = [
//     'baseURI' => 'http://another.example.com/api/v2/',
//     'timeout' => 10,
// ];
// $client2 = \Config\Services::curlrequest($options2);
// $options2 does not work.
// $client2 is the exactly same instance as $client1.

// $logger = service('logger');

// The code above is the same as the code below.
// $logger = \Config\Services::logger(false);

// $renderer = service('renderer', APPPATH . 'views/');

// The code above is the same as the code below.
// $renderer = \Config\Services::renderer(APPPATH . 'views/');
// $renderer = \Config\Services::renderer('/shared/views/');


namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */
    // public static function routes($getShared = true)
    // {
    //     if ($getShared) {
    //         return static::getSharedInstance('routes');
    //     }

    //     return new \App\Router\MyRouteCollection(static::locator(), config('Modules'));
    // }

    // public static function renderer($viewPath = APPPATH . 'views/')
    // {
    //     return new \CodeIgniter\View\View($viewPath);
    // }
}
