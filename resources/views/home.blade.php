@extends('layouts.adm2')
<br><br>
@section('content')
    @if ($errors->any())
		<div class="alert alert-danger">
		  <ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
			@endforeach
		  </ul>
		</div>
	@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    @if(Auth::user()->perfil == "Comunicação" || Auth::user()->perfil == "Administrador")
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('cadastroDestaques') }}">Destaques <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->perfil == "Comunicação" || Auth::user()->perfil == "Administrador")
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('cadastroMural') }}">Mural de Avisos <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->perfil == "Administrador")
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('cadastroUnidade') }}">Unidades <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acesso Rápido
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->perfil == "Administrador")
                        <a class="dropdown-item" href="{{ route('cadastroEmails') }}">E-mails</a>
                        <a class="dropdown-item" href="{{ route('cadastroRamais') }}">Ramais</a>
                        <a class="dropdown-item" href="{{ route('cadastroOuvidorias') }}">Ouvidoria das Unidades</a>
                        <a class="dropdown-item" href="{{ route('cadastroIndicadores') }}">Indicadores</a>
                        <a class="dropdown-item" href="{{ route('cadastroSetores') }}">Setores</a>
                        @endif
                        @if(Auth::user()->perfil == "Qualidade" || Auth::user()->perfil == "Administrador")   
                        <a class="dropdown-item" href="{{ route('cadastroDocumentos') }}">Documentos de Qualidade</a>
                        <a class="dropdown-item" href="{{ route('cadastroProtocolos') }}">Protocolos Institucionais</a>
                        <a class="dropdown-item" href="{{ route('cadastroPoliticas') }}">Políticas e Normas</a>
                        @endif
                    </li>
                    @if(Auth::user()->perfil == "Administrador")
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('cadastroUsuarios') }}">Usuários <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('cadastroPermissoes') }}">Permissões <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    </ul>
                 </div>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
