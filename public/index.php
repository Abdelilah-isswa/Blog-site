<?php

<?php



require_once __DIR__ . '/../bootstrap/autoload.php';




use App\Core\Router;

session_start();

$router = new Router();

$router->get('/blog2/public/', "HomeController@index");
$router->get('/blog2/public/home', "HomeController@index");

$router->get('/blog2/public/article', "ArticleController@show");

$router->get('/blog2/public/test', "TestController@index");

$router->get('/blog2/public/articles', "ArticleController@index");

$router->get('/blog2/public/articles/category', "ArticleController@byCategory");


$router->get('/blog2/public/article/create', "ArticleController@create");
$router->post('/blog2/public/article/store', "ArticleController@store");

$router->get('/blog2/public/login', "UserController@login");        
$router->post('/blog2/public/login', "UserController@loginPost");   

 
$router->get('/blog2/public/register', "UserController@register");
$router->post('/blog2/public/register', "UserController@registerPost");

$router->get('/blog2/public/logout', "UserController@logout");


$router->get('/blog2/public/user/profile', "UserController@profile");


$router->get('/blog2/public/categories', "CategoryController@index");

$router->get('/blog2/public/dashboard', "HomeController@dashboard");
$router->post('/blog2/public/comment/create', "CommentController@store");


$router->get('/blog2/public/categories', "CategoryController@index");         
$router->get('/blog2/public/categories/create', "CategoryController@create");  
$router->post('/blog2/public/categories/store', "CategoryController@store");    

$router->get('/blog2/public/categories/edit', "CategoryController@edit");       
$router->post('/blog2/public/categories/update', "CategoryController@update"); 

$router->get('/blog2/public/categories/delete', "CategoryController@delete");   




$router->post('/blog2/public/comment/update', "CommentController@update");
$router->get('/blog2/public/comment/delete', "CommentController@delete");
$router->get('/blog2/public/comment/edit', "CommentController@edit");


$router->post('/blog2/public/article/update', "ArticleController@update");

$router->get('/blog2/public/article/edit', "ArticleController@edit");
$router->get('/blog2/public/article/delete', "ArticleController@delete");
$router->post('/blog2/public/article/delete', "ArticleController@delete");

$router->get('/blog2/public/articles/my', "ArticleController@myArticles");


$router->post('/blog2/public/like/toggle', "LikeController@toggle");
$router->dispatch();