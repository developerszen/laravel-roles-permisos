@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Posts publicados') }}</strong></div>
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-warning btn-sm mb-3">
                            <img src="/icons/clipboard-plus.svg">
                            Escribir post
                        </a>
                        {{--Posts--}}
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-0"><strong>{{ $post->title }}</strong></h5>
                                            <div class="small text-secondary">
                                                {{ $post->created_at }}
                                            </div>
                                            <div class="small">Por: {{ $post->author->name }}</div>

                                            <p class="card-text mt-2">
                                                {{ substr($post->content, 0, 150) }}[...]
                                            </p>
                                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">
                                                Ver más
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $posts->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
