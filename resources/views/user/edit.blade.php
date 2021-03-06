@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Actualizar usuario') }}</strong></div>

                    <div class="card-body">
                        <h3 class="mb-0">{{ $user->name }}</h3>

                        <div>
                            <img src="/icons/gear.svg">
                            <strong>{{ ucfirst($user->getRoleNames()[0]) }}</strong>
                        </div>

                        <div class="small text-secondary">Fecha de registro: {{ $user->created_at }}</div>
                        <div class="small">Correo electrónico: {{ $user->email }}</div>
                        <span class="badge badge-{{ $user->enabled ? 'primary' :  'secondary' }}">
                            {{ $user->enabled ? 'Habilitado' :  'Inhabilitado' }}
                        </span>

                        @include('partials.errors')

                        <form action="{{ route('users.update', $user) }}" method="post">
                            @csrf
                            @method('put')

                            {{--Status--}}
                            <div class="card my-3">
                                <div class="card-body py-2">
                                    <h6 class="card-title text-primary mb-0"><strong>Estado</strong></h6>

                                    <div class="form-group form-check">
                                        <input id="enabled" type="checkbox" name="enabled" class="form-check-input"
                                                {{ $user->enabled ? 'checked' :  '' }}>
                                        <label class="form-check-label" for="enabled">Habilitado</label>
                                    </div>
                                </div>
                            </div>

                            {{--Permissions--}}
                            @if(auth()->user()->hasRole('super-admin') && $user->hasRole('editor'))
                                <div class="card my-3">
                                    <div class="card-body py-2">
                                        <h6 class="card-title text-primary mb-0">
                                            <strong>Permisos de edición</strong>
                                        </h6>

                                        <div class="form-group form-check mb-0">
                                            <input id="all_edit" type="checkbox" name="all_edit" class="form-check-input">
                                            <label for="all_edit" class="form-check-label">Editar todo</label>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
