<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\News; // Add this line
use App\Controllers\Pages;
use App\Controllers\Blog;
use App\Controllers\Test;

//CI akan membuat jalur ketika ada akses yang metode requestnya get(mengetikkan sesuatu di url), 
//alamatnya adalah '/' (route adalah url utama atau baseURL, localhost:8080)
//jadi kalau ada yang akses halaman route maka akan diarahkan ke controllers Home, methodnya index
$routes->get('/', 'Home::index');

$routes->get('news', [News::class, 'index']); // Add this line
$routes->get('news/new', [News::class, 'new']); // Add this line
$routes->post('news', [News::class, 'create']); // Add this line
$routes->get('news/(:segment)', [News::class, 'show']); // Add this line
$routes->get('test', [Test::class, 'index']);

$routes->get('blog', [Blog::class, 'index']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
