@extends('layouts.adm2')
<link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}" />
<br><br><br>
@section('content')
    <div class="m-3">
        <a class="btn btn-warning" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a>
    </div>
    <section class="cards p-4">
        <div class="card ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs pull-right" id="myTab" role="tablist">
				<?php if ((in_array(19, $perfil_user)) || (in_array(1, $perfil_user))) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Controle de veiculos</a>
                    </li>
				<?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Portais de Notas de Fiscal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false" style="pointer-events: none;">...</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
				<?php if ((in_array(19, $perfil_user)) || (in_array(1, $perfil_user))) { ?>
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<section class="cards d-flex flex-wrap p-4">
                            <div class="card m-2" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Relatório geral</h5>
                                    <p class="card-text"> </p>

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal2" data-whatever="@getbootstrap">Filtrar</button>

                                    <div class="modal fade" id="exampleModal2" tabindex="-1"
                                        aria-labelledby="exampleModal2Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModal2Label">Relatório de veiculos -
                                                        Filtros</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('relatorioVeiculos') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @if ($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            @if ($error == 'Aguarde o relátorio está sendo gerado')
                                                                <div class="alert alert-success">
                                                                    <li>{{ $error }}</li>
                                                                </div>
                                                            @else
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        <li>{{ $error }}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <!--label for="recipient-name" class="col-form-label">Data
                                                                inicial:</label>
                                                            <input type="date" class="form-control" id="data_ini"
                                                                name="data_ini" value="{{ old('data_ini') }}" required>
                                                            <label for="recipient-name" class="col-form-label">Data
                                                                final:</label>
                                                            <input type="date" class="form-control" id="data_fim"
                                                                name="data_fim" value="{{ old('data_fim') }}" required-->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success m-2" value="Salvar"
                                                            id="Salvar" name="Salvar">Gerar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
					<?php }?>
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <section class="cards d-flex flex-wrap p-4">
                            <div class="card m-2" style="width: 26rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Portal de Notas Fiscal</b></h5>
                                    <p class="card-text"> </p>
                                    <form action="{{ route('relatoriosNF') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-2"><label for="">Unidade:</label></div>
                                            <div class="col">
                                                <select name="unidade_id" id="unidade_id" class="form form-control">
                                                    @foreach($unidades as $unidade)
                                                        @if($unidade->id == 1)
                                                        @else
                                                            <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="m-auto">
                                                <input type="submit" value="Gerar Relatório" class="btn btn-success btn-sm">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>


                    <div class="tab-pane fade show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        TESTE 3
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="{{ asset('assets/vendor/jquery/jquery-3.6.0.js') }}"></script>
    <?php
    if ($errors->any()) {
        echo '<script> $(document).ready(function() { $("#exampleModal2").modal("show"); });</script>';
    }
    ?>
@endsection
