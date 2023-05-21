<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        // validate request
        $validated = $request->validated();

        // store the comment
        $comment = Comment::create($validated);

        // return response to frontend if fail or success with flash message
        if ($comment) {
            return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Komentar gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('superadmin.comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        // update the comment
        $comment = $comment->update($request->validated());

        // return response to frontend if fail or success with flash message
        if (!$comment) return redirect()->back()->with('error', 'Komentar gagal diubah');

        return redirect()->back()->with('success', 'Komentar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        return $comment->deleteOrFail() ? redirect()->back()->with('success', 'Komentar berhasil dihapus') : redirect()->back()->with('error', 'Komentar gagal dihapus');
    }
}
