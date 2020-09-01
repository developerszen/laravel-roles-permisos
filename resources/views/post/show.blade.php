@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
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
                    <div class="text-center mb-3">
                        <a href="{{ route('home') }}" class="btn btn-light btn-sm">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
