<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('user', 'article')->get();
        return response($comments, 200);

    }

    /**
     * Display all comments related to a specific user with search feature
     *
     * @return \Illuminate\Http\Response
     */

    public function myComments(Request $request)
    {

        if ($request->searchTerm) {
            $myFilteredComments = DB::table('comments')
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->join('articles', 'comments.article_id', '=', 'articles.id')
                ->select('comments.*', 'users.username', 'articles.url as articleUrl', 'articles.description as articleDescription')
                ->where('comments.user_id', '=', auth()->user()->id)
                ->where(function ($query) use ($request) {
                    $query->where('comments.content', 'like', '%' . $request->searchTerm . '%')
                        ->orWhere('articles.description', 'like', '%' . $request->searchTerm . '%')
                        ->orWhere('articles.url', 'like', '%' . $request->searchTerm . '%');
                })
                ->get();
            return response($myFilteredComments, 200);
        } else {
            $myComments = DB::table('comments')
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->join('articles', 'comments.article_id', '=', 'articles.id')
                ->select('comments.*', 'users.username', 'articles.url as articleUrl', 'articles.description as articleDescription')
                ->where('comments.user_id', '=', auth()->user()->id)
                ->get();
            return response($myComments, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newComment = Comment::create([
            'content' => $request->content,
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id,
        ]);
        return response($newComment, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commentToShow = Comment::where('id', $id)->firstOrFail();
        return response($commentToShow, 200);
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
        $request->validate([
            'content' => 'required',
        ]);

        $commentToUpdate = Comment::find($id);
        $userConnectedInfos = $request->user();

        if (!$commentToUpdate) {
            return response('Comment not found', 404);
        } else {
            // check if admin
            if ($userConnectedInfos['is_admin']) {
                $commentToUpdate->update($request->all());
                return response('Comment updated by the admin with success', 200);
            } else {
                //if user not admin
                if ($commentToUpdate['user_id'] === $userConnectedInfos['id']) {
                    $commentToUpdate->update($request->all());
                    return response('Comment updated by the owner with success', 200);
                } else {
                    return response('Forbidden this comment is not yours', 403);
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
    public function destroy($id)
    {
        $commentTobeDeleted = Comment::find($id);
        $userConnectedInfos = auth()->user();
        if (!$commentTobeDeleted) {
            return response('Comment not found', 404);
        } else {
            //check if user is admin
            if ($userConnectedInfos['is_admin']) {
                Comment::destroy($id);
                return response('Comment deleted with success', 201);
            } else {
                //if user  not admin check if the comment belongs to the connected user
                if ($commentTobeDeleted['user_id'] === $userConnectedInfos['id']) {
                    Comment::destroy($id);
                    return response('Comment removed with success', 200);
                } else {
                    return response('Forbidden this comment is not yours', 403);
                }
            }
        }
    }

    public function showCommentsRelatedToArticle($id)
    {
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.username')
            ->where('article_id', '=', $id)
            ->get();
        return response($comments, 200);
    }

    /**
     * Count number of comments
     *
     * @return \Illuminate\Http\Response
     */


}
