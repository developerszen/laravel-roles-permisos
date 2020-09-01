@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Registrar post') }}</strong></div>

                    <div class="card-body">

                        <form action="{{ route('posts.store') }}" method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-form-label-sm col-2">Título</label>

                                <div class="col-10">
                                    <input id="title" type="text" name="title"
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
                                              rows="3">
                                    </textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                                <a href="{{ route('home') }}" class="btn btn-light btn-sm">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
