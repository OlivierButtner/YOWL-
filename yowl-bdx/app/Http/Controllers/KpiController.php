<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KpiController extends Controller
{
    //USERS KPI
    public function countUsers($period)
    {
        $chartData = User::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subDays($period), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        return $chartData;
    }

    //CATEGORY KPI

    //ARTICLES KPI
    public function countArticleCategory($period)
    {


        $articleCategory = Category::withCount(['article' => function ($query) use ($period) {
            $query->whereBetween('created_at', [Carbon::now()->subDays($period), Carbon::now()]);
        }
        ])->get();

        return $articleCategory;
    }

    public function countArticles($period)
    {
        $chartData = Article::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subDays($period), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        return $chartData;
    }


    //COMMENTS KPI

    public function countComments($period)
    {
        $chartData = Comment::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subDays($period), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        return $chartData;
    }


    public function countUserComments()
    {
        $comments = User::withCount('comment')->get();
        return $comments;
//        return 'number of comments per user';
    }
}

