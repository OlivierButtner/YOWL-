<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user', 'category')->get();
        return response($articles, 200);
    }

    /**
     * Display all articles  in home page with ability to filter or use search term
     *
     * @return \Illuminate\Http\Response
     */
    public function showWithFilterAndSearch(Request $request)
    {
        //filter only : most recent/most commented
        if ($request->filter) {
            $filter = $request->filter;
            switch ($filter) {
                case 'mostCommented':
                    if ($request->searchTerm) {
                        $articles = Article::withCount('comment')
                            ->join('users', 'articles.user_id', '=', 'users.id')
                            ->join('categories', 'articles.category_id', '=', 'categories.id')
                            ->select('articles.*', 'users.username', 'categories.name as categoryname')
                            ->where('articles.url', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('users.username', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('articles.description', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('categories.name', 'like', '%' . $request->searchTerm . '%')
                            ->orderBy('comment_count', 'desc')
                            ->get();
                        return response($articles, 200);
                    } else {
                        $articles = Article::withCount('comment')
                            ->orderBy('comment_count', 'desc')
                            ->get();
                        return response($articles, 200);
                    }
                case 'oldest':
                    if ($request->searchTerm) {
                        $articles = DB::table('articles')
                            ->join('users', 'articles.user_id', '=', 'users.id')
                            ->join('categories', 'articles.category_id', '=', 'categories.id')
                            ->select('articles.*', 'users.username', 'categories.name as categoryname')
                            ->where('articles.url', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('users.username', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('articles.description', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('categories.name', 'like', '%' . $request->searchTerm . '%')
                            ->orderBy('created_at', 'desc')
                            ->get();
                        return response($articles, 200);
                    } else {
                        $articles = DB::table('articles')
                            ->join('users', 'articles.user_id', '=', 'users.id')
                            ->join('categories', 'articles.category_id', '=', 'categories.id')
                            ->select('articles.*', 'users.username', 'categories.name as categoryname')
                            ->where('articles.url', 'like', '%' . $request->searchTerm . '%')
                            ->orderBy('created_at', 'desc')
                            ->get();
                        return response($articles, 200);
                    }
            }
        } else if ($request->searchTerm) {
            $articles = DB::table('articles')
                ->join('users', 'articles.user_id', '=', 'users.id')
                ->join('categories', 'articles.category_id', '=', 'categories.id')
                ->select('articles.*', 'users.username', 'categories.name as categoryname')
                ->where('articles.url', 'like', '%' . $request->searchTerm . '%')
                ->orWhere('users.username', 'like', '%' . $request->searchTerm . '%')
                ->orWhere('articles.description', 'like', '%' . $request->searchTerm . '%')
                ->orWhere('categories.name', 'like', '%' . $request->searchTerm . '%')
                ->get();
            return response($articles, 200);
        } else {
            //without searchTerm & without filter
            $articles = DB::table('articles')
                ->join('users', 'articles.user_id', '=', 'users.id')
                ->join('categories', 'articles.category_id', '=', 'categories.id')
                ->select('articles.*', 'users.username', 'categories.name as categoryname')
                ->latest()
                ->get();
            return response($articles, 200);
        }
    }

    /**
     * Display all articles  related to one specific category + search feature
     *
     * @return \Illuminate\Http\Response
     */

    public function categoryArticles(Request $request, $id)
    {
//filters : mostRecent, oldest, mostCommented

        //case with filter and/or search term
        if ($request->filter) {
            $filter = $request->filter;
            switch ($filter) {
                case 'mostRecent':
                    //case with search term + filter mostRecent
                    if ($request->searchTerm) {
                        $articles = DB::table('articles')
                            ->join('users', 'articles.user_id', '=', 'users.id')
                            ->join('categories', 'articles.category_id', '=', 'categories.id')
                            ->select('articles.*', 'users.username', 'categories.name as categoryname')
                            ->where('category_id', $id)
                            ->where('articles.url', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('users.username', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('articles.description', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('categories.name', 'like', '%' . $request->searchTerm . '%')
                            ->orderBy('created_at', 'desc')
                            ->get();
                        return response($articles, 200);
                    } else {
                        //case with filter and no search term
                        $articles = DB::table('articles')
                            ->join('users', 'articles.user_id', '=', 'users.id')
                            ->join('categories', 'articles.category_id', '=', 'categories.id')
                            ->select('articles.*', 'users.username', 'categories.name as categoryname')
                            ->where('category_id', $id)
                            ->orderBy('created_at', 'desc')
                            ->get();
                        return response($articles, 200);
                    }
                    break;
                case 'oldest':
                    //case with search term + filter mostRecent
                    if ($request->searchTerm) {
                        $articles = DB::table('articles')
                            ->join('users', 'articles.user_id', '=', 'users.id')
                            ->join('categories', 'articles.category_id', '=', 'categories.id')
                            ->select('articles.*', 'users.username', 'categories.name as categoryname')
                            ->where('category_id', $id)
                            ->where('articles.url', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('users.username', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('articles.description', 'like', '%' . $request->searchTerm . '%')
                            ->orWhere('categories.name', 'like', '%' . $request->searchTerm . '%')
                            ->orderBy('created_at', 'asc')
                            ->get();
                        return response($articles, 200);
                    } else {
                        //case with filter and no search term
                        $articles = DB::table('articles')
                            ->join('users', 'articles.user_id', '=', 'users.id')
                            ->join('categories', 'articles.category_id', '=', 'categories.id')
                            ->select('articles.*', 'users.username', 'categories.name as categoryname')
                            ->where('category_id', $id)
                            ->orderBy('created_at', 'asc')
                            ->get();
                        return response($articles, 200);
                        break;
                    }
                case 'mostCommented':
                    $articles = Article::withCount('comment')
                        ->where('category_id', $id)
                        ->orderBy('comment_count', 'desc')
                        ->get();
                    return response($articles, 200);
            }
        } else {
            //  All articles related to a category with  no filter and no search term
            $articles = DB::table('articles')
                ->join('users', 'articles.user_id', '=', 'users.id')
                ->join('categories', 'articles.category_id', '=', 'categories.id')
                ->select('articles.*', 'users.username', 'categories.name as categoryname')
                ->where('category_id', $id)
                ->get();
            return response($articles, 200);
        }
    }


    /**
     * Display all articles related to a specific user with search feature
     *
     * @return \Illuminate\Http\Response
     */

//    public function myArticles(Request $request)
//    {
//        if ($request->searchTerm) {
//            $mySearchedArticles = DB::table('articles')
//                ->join('users', 'articles.user_id', '=', 'users.id')
//                ->join('categories', 'articles.category_id', '=', 'categories.id')
//                ->select('articles.*', 'users.username', 'categories.name as categoryname')
//                ->where('articles.user_id', '=', auth()->user()->id)
//                ->where(function ($query) use ($request) {
//                    $query->where('articles.url', 'like', '%' . $request->searchTerm . '%')
//                        ->orWhere('users.username', 'like', '%' . $request->searchTerm . '%')
//                        ->orWhere('articles.description', 'like', '%' . $request->searchTerm . '%')
//                        ->orWhere('categories.name', 'like', '%' . $request->searchTerm . '%');
//                })
//                ->get();
//            return $mySearchedArticles;
//        } else {
//            $myArticles = DB::table('articles')
//                ->join('users', 'articles.user_id', '=', 'users.id')
//                ->join('categories', 'articles.category_id', '=', 'categories.id')
//                ->select('articles.*', 'users.username', 'categories.name as categoryname')
//                ->where('articles.user_id', '=', auth()->user()->id)
//                ->get();
////            $myArticles->user()->associate($request->user());
//            $myArticles->user()->associate();
//            $myArticles->category()->associate();
////            $myArticles->category()->associate();
//            return response($myArticles, 200);
//        }
//    }


    public function myArticles(Request $request)
    {

        $myArticles = Article::where('user_id', auth()->user()->id)
            ->with(['user', 'category'])->get();
        return $myArticles;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newArticle = Article::create([
            'url' => $request->url,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
        ]);
        $newArticle->user()->associate($request->user());
        $newArticle->category()->associate(Category::find($request->category_id));
        return response($newArticle, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if ($article) {
            return response($article, 200);
        } else {
            return response('Article not found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articleToUpdate = Article::find($id);
        $userConnectedInfos = $request->user();

        if (!$articleToUpdate) {
            return response('Article not found', 404);
        } else {
            // check if admin
            if ($userConnectedInfos['is_admin']) {
                $articleToUpdate->update($request->all());
                return response('Article updated by the admin with success', 200);
            } else {
                //if user not admin
                if ($articleToUpdate['user_id'] === $userConnectedInfos['id']) {
                    $articleToUpdate->update($request->all());
                    return response('Article updated by the owner with success', 200);
                } else {
                    return response('Forbidden this article is not yours', 403);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        $articleTobeDeleted = Article::find($id);
        $userConnectedInfos = $request->user();
        if (!$articleTobeDeleted) {
            return response('Article not found', 404);
        } else {
            //check if user is admin
            if ($userConnectedInfos['is_admin']) {
                Article::destroy($id);
                return response('Article deleted with success', 201);
            } else {
                //if user  not admin check if the article belongs to the connected user
                if ($articleTobeDeleted['user_id'] === $userConnectedInfos['id']) {
                    Article::destroy($id);
                    return response('Article removed with success', 201);
                } else {
                    return response('Forbidden this article is not yours', 403);
                }
            }
        }

    }


    /**
     * Count number of articles
     *
     * @return \Illuminate\Http\Response
     */


}

