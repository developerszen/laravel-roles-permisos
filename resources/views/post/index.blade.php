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

                        <a href="{{ route('posts.create') }}" class="btn btn-warning btn-sm mb-3">
                            <img src="/icons/clipboard-plus.svg">
                            Escribir post
                        </a>

                        @if(count($posts))
                            <table class="table table-sm table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>Post</th>
                                    @unlessrole('writer')
                                        <th>Autor</th>
                                    @endunlessrole

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
                                        <td>
                                            <strong>{{ $post->title }}</strong>

                                            <p class="mb-0">{{ substr($post->content, 0, 60) }}[...]</p>
                                        </td>
                                        @unlessrole('writer')
                                            <td>{{ $post->author->name }}</td>
                                        @endunlessrole

                                        <td>
                                            <a href="{{ route('posts.show', $post) }}"
                                               class="btn btn-sm px-1">
                                                <img src="/icons/eye.svg">

                                            </a>

                                            @if(auth()->user()->can('edit', $post))
                                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm px-1">
                                                    <img src="/icons/pencil-square.svg">
                                                </a>
                                            @endif

                                            @can('can delete post')
                                                <form action="{{ route('posts.destroy', $post) }}"
                                                      style="display: inline-block;" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm px-1">
                                                        <img src="/icons/trash.svg">
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                                <div class="alert alert-info">
                                    <h4 class="alert-heading">Sin registros</h4>
                                    Comienza escribiendo nuevos posts y los verás aquí.
                                </div>
                        @endif

                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
