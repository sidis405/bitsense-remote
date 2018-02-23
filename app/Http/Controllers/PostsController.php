<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Bitsense\Blog\Repositories\PostRepository;

class PostsController extends Controller
{
    protected $postRepository;
    protected $postFactory;

    public function __construct(PostRepository $postRepository)
    {
        // $this->middleware('can:update,post')->only('destroy', 'edit');
        $this->middleware('auth')->only('create', 'store');
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Model event - OBSERVER Pattern - quando succede qualcosa
        // eseguito l'operazione (salvataggio, aggiornamento)
        // emeevento dattere l'l modello
        // eseguito il listener che intercetta il modello
        // inviato un job per l'esecuzione a una coda di elaborazione
        // dato risposta a utente
        // nella coda di elaborazione, abbiamo eseguito il job.
        // esegue il commando e invia la mail


        // $posts = new Post;
        // $posts->bind('mysql', 'qwerty12345');

        // return $posts->get();

        // $posts = $this->postRepository->latest()->paginate(15);

        $posts = Post::with('user')->latest()->paginate(15);

        if (request()->wantsJson()) {
            return $posts;
        }

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('title', 'body');
        $data['user_id'] = auth()->id();

        $post = $this->postRepository->create($data);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return $post->load('user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->only("title"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
