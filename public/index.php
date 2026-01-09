<?php



require_once __DIR__ . '/../bootstrap/autoload.php';




use App\Core\Router;

session_start();

$router = new Router();

$router->get('/blog/public/', "HomeController@index");
$router->get('/blog/public/home', "HomeController@index");

$router->get('/blog/public/article', "ArticleController@show");

$router->get('/blog/public/test', "TestController@index");

$router->get('/blog/public/articles', "ArticleController@index");

$router->get('/blog/public/articles/category', "ArticleController@byCategory");


$router->get('/blog/public/article/create', "ArticleController@create");
$router->post('/blog/public/article/store', "ArticleController@store");

$router->get('/blog/public/login', "UserController@login");        
$router->post('/blog/public/login', "UserController@loginPost");   

 
$router->get('/blog/public/register', "UserController@register");
$router->post('/blog/public/register', "UserController@registerPost");

$router->get('/blog/public/logout', "UserController@logout");


$router->get('/blog/public/user/profile', "UserController@profile");


$router->get('/blog/public/categories', "CategoryController@index");

$router->get('/blog/public/dashboard', "HomeController@dashboard");
$router->post('/blog/public/comment/create', "CommentController@store");


$router->get('/blog/public/categories', "CategoryController@index");         
$router->get('/blog/public/categories/create', "CategoryController@create");  
$router->post('/blog/public/categories/store', "CategoryController@store");    

$router->get('/blog/public/categories/edit', "CategoryController@edit");       
$router->post('/blog/public/categories/update', "CategoryController@update"); 

$router->get('/blog/public/categories/delete', "CategoryController@delete");   




$router->post('/blog/public/comment/update', "CommentController@update");
$router->get('/blog/public/comment/delete', "CommentController@delete");
$router->get('/blog/public/comment/edit', "CommentController@edit");


$router->post('/blog/public/article/update', "ArticleController@update");

$router->get('/blog/public/article/edit', "ArticleController@edit");
$router->get('/blog/public/article/delete', "ArticleController@delete");
$router->post('/blog/public/article/delete', "ArticleController@delete");

$router->get('/blog/public/articles/my', "ArticleController@myArticles");


$router->post('/blog/public/like/toggle', "LikeController@toggle");
$router->dispatch();