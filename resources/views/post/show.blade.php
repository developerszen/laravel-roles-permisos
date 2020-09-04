@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                {{--Post--}}
                <div class="card">
                    <div class="card-header"><strong>{{ __('Detalle de post') }}</strong></div>

                    <div class="card-body">
                        <h3 class="mb-0">{{ $post->title }}</h3>

                        <div class="small text-secondary">Fecha de creación: {{ $post->created_at }}</div>
                        <div class="small">Por: {{ $post->author->name }}</div>
                        <span class="badge badge-{{ $post->published ? 'success' :  'primary' }}">
                                {{ $post->published ? 'Publicado' :  'No publicado' }}
                        </span>
                        <hr>
                        <p>{{ $post->content }}</p>
                    </div>
                </div>

                {{--Comments--}}
                @if(count($post->comments))
                    <div class="card my-3">
                        <div class="card-header">
                            <img src="/icons/chat.svg" class="mr-2">
                            <strong>Comentarios</strong>
                        </div>

                        @foreach($post->comments as $comment)
                            <div class="card small">
                                <div class="card-body py-2 {{ $comment->salient ? 'text-white bg-primary' : '' }}">
                                    <div class="card-text">
                                        <h6 class="mb-0">
                                            @if($comment->salient)
                                                <p class="mb-0 small">Comentario destacado</p>
                                            @endif
                                            <strong>{{ $comment->user->name }}</strong>

                                            {{--Salient--}}
                                            @if(!$comment->salient)
                                                <form action="{{ route('posts.comments.salient', [$post, $comment]) }}" method="post" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">
                                                        <img src="/icons/award.svg">
                                                    </button>
                                                </form>
                                            @endif
                                        </h6>

                                        <div class="small">{{ $comment->created_at }}</div>

                                        {{ $comment->content }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{--Send comment--}}
                <div class="card">
                    <div class="card-header">
                        <img src="/icons/chat-dots.svg" class="mr-2">
                        <strong>{{ __('Comentar Post') }}</strong>
                    </div>

                    {{-- Form --}}
                    <div class="card-body">
                        @guest
                            <div class="alert alert-info">
                                <h4 class="alert-heading">Inicia sesión</h4>
                                Debes iniciar sesión de usuario para poder comentar el post.
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm my-2">
                                        Iniciar sesión
                                    </a>
                                </div>
                            </div>
                        @else
                            @include('partials.errors')

                            <form action="{{ route('posts.comments.store', $post) }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="comment" class="col-form-label-sm col-2">Comentario</label>

                                    <div class="col-10">
                                    <textarea id="comment" name="comment"
                                              placeholder="Escribe aquí tu comentario"
                                              class="form-control form-control-sm"
                                              rows="3">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
                                </div>
                            </form>
                        @endguest
                    </div>
                </div>

                {{--Actions--}}
                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="btn btn-light btn-sm">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
