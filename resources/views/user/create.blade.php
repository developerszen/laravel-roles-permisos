@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Registrar usuario') }}</strong></div>

                    <div class="card-body">

                        @include('partials.errors')

                        <form action="{{ route('users.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group row">
                                        <label for="name" class="col-form-label-sm col-3">Nombre</label>

                                        <div class="col-9">
                                            <input id="name" type="text" name="name"
                                                   placeholder="Nombre del usuario"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="form-group row">
                                        <label for="email" class="col-form-label-sm col-4">Correo electrónico</label>

                                        <div class="col-8">
                                            <input id="email" type="email" name="email"
                                                   placeholder="Correo electrónico del usuario"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                                <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
