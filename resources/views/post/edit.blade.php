@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Editar post') }}</strong></div>

                    <div class="card-body">

                        <form action="{{ route('posts.update', $post) }}" method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-form-label-sm col-2">Título</label>

                                <div class="col-10">
                                    <input id="title" type="text" name="title"
                                           value="{{ old('title', $post->title) }}"
                                           placeholder="Título de la publicación"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-form-label-sm col-2">Contenido</label>

                                <div class="col-10">
                                    <textarea id="content" name="content"
                                              placeholder="Contenido de la publicación"
                                              class="form-control form-control-sm"
                                              rows="8">{{ old('content', $post->content) }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                <a href="{{ route('home') }}" class="btn btn-light btn-sm">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
