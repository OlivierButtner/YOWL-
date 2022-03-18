<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\ForgotController;

use App\Http\Controllers\KpiController;

use App\Models\Article;
use App\Models\category;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// PUBLIC ROUTES

// users
Route::get('/users', [UsersController::class, 'index']);
Route::post('/searchUsers', [UsersController::class, 'searchUser']);
Route::post('/forgot-password', [ForgotController::class, 'forgotPassword']);
Route::get('/reset-password/{token}', [ForgotController::class, 'tokenReset']);
Route::post('/change-password', [ForgotController::class, 'passwordChange']);

//category
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/category', [CategoryController::class, 'search']);


// articles
Route::get('/articles', [ArticleController::class, 'index']);
//Get one specific article
Route::get('/articles/{id}', [ArticleController::class, 'show']);
//Fetch  articles to display in homePage + search and filter feature
Route::post('/home/articles',  [ArticleController::class, 'showWithFilterAndSearch']);
//Fetch articles related to a specific category
Route::post('/articles/category/{id}', [ArticleController::class, 'categoryArticles']);


// comments
//get all comments
Route::get('/comments', [CommentController::class, 'index']);
//get one specific comment
Route::get('/comments/{id}', [CommentController::class, 'show']);

//get comments related to a specific article
Route::get('/comments/article/{id}', [CommentController::class, 'showCommentsRelatedToArticle']);

//others
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//dashboard kpi
//count articles per category
Route::get('/dashboard/category/count/{period}', [KpiController::class, 'countArticleCategory']);
//Route::get('/dashboard/category/count', [KpiController::class, 'countArticleCategory']);



    //count users
Route::get('/dashboard/users/count/{period}',[KpiController::class, 'countUsers']);
    //count articles
Route::get('/dashboard/articles/count/{period}',[KpiController::class, 'countArticles']);
    //count comments
Route::get('/dashboard/comments/count/{period}',[KpiController::class, 'countComments']);
//most active user (depending on number of comment)
Route::get('/dashboard/users/kpi_comments', [KpiController::class, 'countUserComments']);



    //homepage search
Route::post('/home/search', [SearchController::class, 'search']);




// PROTECTED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function () {
    //users
    Route::post('/users', [UsersController::class, 'store']);
    Route::put('/users/{user}', [UsersController::class, 'update']);
    Route::delete('/users/{user}', [UsersController::class, 'destroy']);
    Route::post('/reset-password', [ForgotController::class,]);

    // category
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    Route::get('/dashboard/categories/count/{period}', [KpiController::class, 'countArticleCategory']);

    // articles

    //Get all articles related to one specific user + search feature
    Route::post('/myarticles', [ArticleController::class, 'myArticles']);
    //Create one article
    Route::post('/articles', [ArticleController::class, 'store']);
    //Update one article
    Route::put('articles/{id}', [ArticleController::class, 'update']);
    //Delete one article
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

    // comments
    //Get all comments related to one specific user + search feature
    Route::post('/mycomments', [CommentController::class, 'myComments']);
    //Create one comment
    Route::post('/comments', [CommentController::class, 'store']);
    //Update a comment  as user or admin
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    //Delete one specific comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

//others
    Route::post('/logout', [AuthController::class, 'logout']);
});
