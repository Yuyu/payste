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

$app->get('/', ["as" => "index", function () use ($app) {
    return view("index");
}]);

$app->get('/faq', ["as" => "faq", function() use ($app) {
    return view("faq");
}]);

$app->get("/{token}", ["uses" => "PasteController@view", "as" => "view_paste"]);
$app->get("/{token}/raw", ["uses" => "PasteController@viewRaw", "as" => "view_paste_raw"]);
$app->post("/", ["uses" => "PasteController@store", "as" => "store_paste"]);
