@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Posts') }}</strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm mb-3">
                            Registrar
                        </a>

                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estado</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        <span class="badge badge-{{ $post->published ? 'success' :  'primary' }}">
                                                {{ $post->published ? 'Publicado' :  'No publicado' }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $post->title }}</strong></td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>
                                        <a href="{{ route('posts.show', $post) }}"
                                           class="btn btn-sm">
                                            <img src="/icons/eye.svg">

                                        </a>
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm">
                                            <img src="/icons/pencil-square.svg">
                                        </a>

                                        <form action="" style="display: inline-block;">
                                            <button type="submit" class="btn btn-sm">
                                                <img src="/icons/trash.svg">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
