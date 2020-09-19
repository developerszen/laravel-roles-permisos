<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $posts = Post::latest()
            ->with('author')
            ->when($user->hasRole('writer'), function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->paginate(8);

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->to('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('show', $post);

        $post->load([
            'author',
            'comments' => function ($query) {
                $query->orderBy('salient', 'desc')->orderBy('created_at', 'desc');
            },
            'comments.user'
        ]);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->to('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return redirect()->to('home');
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'content' => $request->input('comment'),
        ]);

        return redirect()->route('posts.show', $post);
    }

    function salientComment(Post $post, Comment $comment)
    {
        $this->authorize('salient', $post);

        Comment::where('salient', true)->update([
            'salient' => false,
        ]);

        $comment->update([
            'salient' => true,
        ]);

        return redirect()->route('posts.show', $post);
    }

    function publish(Post $post)
    {
        $this->authorize('publish', $post);

        $post->update([
            'published' => true,
        ]);

        return redirect()->route('posts.show', $post);
    }

    function unpublish(Post $post)
    {
        $this->authorize('unpublish', $post);

        $post->update([
            'published' => false,
        ]);

        return redirect()->route('posts.show', $post);
    }
}
