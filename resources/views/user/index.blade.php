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

                        <a href="{{ route('users.create') }}" class="btn btn-warning btn-sm mb-3">
                            <img src="/icons/clipboard-plus.svg">
                            Registrar
                        </a>

                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estado</th>
                                <th>Información</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <span class="badge badge-{{ $user->enabled ? 'primary' :  'secondary' }}">
                                                {{ $user->enabled ? 'Habilitado' :  'Inhabilitado' }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge badge-light">Rol de usuario</span></td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}"
                                           class="btn btn-sm">
                                            <img src="/icons/toggle-on.svg">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
