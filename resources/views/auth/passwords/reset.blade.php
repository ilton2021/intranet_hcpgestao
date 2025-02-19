@extends('layouts.adm2')
@section('content') <br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
			  <div class="alert alert-success">
				<ul>
					@foreach ($errors->all() as $error)
					  <li>{{ $error }}</li>
					@endforeach
				</ul>
			  </div>
	        @endif
            
            <div class="card">
                <div class="card-header">{{ __('Alterar Senha:') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('resetarSenha') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail cadastrado:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="token_" class="col-md-4 col-form-label text-md-right">{{ __('Token:') }}</label>

                            <div class="col-md-6">
                                <input id="token_" type="text" class="form-control" name="token_" required autocomplete="token_">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nova Senha:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
							</div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 text-md-right">
							    <a href="{{ url ('/') }}" class="btn btn-warning" style="width: 80px; height: 37px;"> Voltar </a>
								<button type="submit" class="btn btn-primary">
									{{ __('Alterar') }}
							    </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
