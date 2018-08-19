<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', ["as" => "index", function () use ($router) {
    return view("index");
}]);

$router->get('/faq', ["as" => "faq", function() use ($router) {
    return view("faq");
}]);

$router->get("/{token}", ["uses" => "PasteController@view", "as" => "view_paste"]);
$router->get("/{token}/raw", ["uses" => "PasteController@viewRaw", "as" => "view_paste_raw"]);
$router->post("/", ["uses" => "PasteController@store", "as" => "store_paste"]);
