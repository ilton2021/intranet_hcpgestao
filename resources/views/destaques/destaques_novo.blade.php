@extends('layouts.adm')
<script type="text/javascript">
    function selects() {
        var ele = document.getElementsByClassName('unidade');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = true;
        }
    }

    function deSelect() {
        var ele = document.getElementsByClassName('unidade');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = false;

        }
    }

    function selects_und_cad() {
        var ele = document.getElementsByClassName('unidade_cad');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = true;
        }
    }

    function deSelect_und_cad() {
        var ele = document.getElementsByClassName('unidade_cad');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = false;

        }
    }
</script>
<div class="container-fluid">
    <div class="row" style="margin-top: 0px;">
        <div class="col-md-12 text-center">
            <h3 style="font-size: 18px;">CADASTRAR NOVO DESTAQUES:</h3>
        </div>
    </div>
    <div class="row" style="margin-top: 25px;">
        <div class="col-md-2 col-sm-0"></div>
        <div class="col-md-8 col-sm-12 text-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
                        Destaques: <i class="fas fa-check-circle"></i>
                    </a>
                </div>
                <form action="{{ \Request::route('storeDestaques') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="table-responsive-sm">
                        <table border="0" class="table-sm" style="line-height: 1.5;">
                            <tr>
                                <td> Título: </td>
                                <td>
                                    <input class="form-control" type="text" id="titulo" name="titulo" required value="{{ old('titulo') }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label id="imgT"> Imagem </label>
                                    <label id="vidT" style="display:none"> video </label> :
                                </td>
                                <td class="d-inline-flex">
                                    <select id="tipo" name="tipo" class="form-control m-1">
                                        <option id="tipo" name="tipo" value="1">Foto</option>
                                        <option id="tipo" name="tipo" value="2">Video</option>
                                    </select>
                                    <input class="form-control m-1" type="file" id="imagem" name="imagem" value="" />
                                    <textarea class="form-control m-1" style="display:none;" cols="100" type="text" id="video" name="video"></textarea>
                                </td>

                            </tr>
                            <tr>
                                <td> Data Início: </td>
                                <td>
                                    <input class="form-control" type="date" id="data_inicio" name="data_inicio" required value="{{ old('data_inicio') }}" />
                                </td>
                            </tr>
                            <tr>
                                <td> Data Fim: </td>
                                <td>
                                    <input class="form-control" type="date" id="data_fim" name="data_fim" required value="{{ old('data_fim') }}" />
                                </td>
                            </tr>
                            <tr>
                                <td> Resumo: </td>
                                <td>
                                    <textarea placeholder="Este texto será exibido logo abaixo da imagem do destaque na página principal.." class="form-control" rows="3" type="text" id="subtitulo" name="subtitulo" required value="{{ old('subtitulo') }}"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td> Texto: </td>
                                <td>
                                    <textarea placeholder="Descreva sobre o destaque.." class="form-control" rows="5" type="text" id="texto" name="texto" required value="{{ old('texto') }}"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Unidades que Visualizarão:</td>
                                <td>
                                    <li style="list-style: none;">
                                        <input style="font-size: 12px;" class="btn btn-primary" type="button" onclick='selects()' value="Marcar todos" />
                                        <input style="font-size: 12px;" class="btn btn-danger" type="button" onclick='deSelect()' value="Desmarcar todos" />
                                    </li>
                                    <li style="list-style: none;">
                                        @foreach ($unidades as $unidade)
                                        <input type='checkbox' id="unidade_id[]" class="unidade" name="unidade_id[]" value="<?php echo $unidade->id; ?>" />{{ $unidade->sigla }}&nbsp;&nbsp;</input>
                                        @endforeach
                                    </li>
                                </td>
                            </tr>
                            <?php for ($i = 2; $i <= 6; $i++) { ?>
                                <tr>
                                    <td> <label id="imgT{{$i}}"> Imagem </label> <label id="vidT{{$i}}" style="display:none"> video </label> {{$i}} : </td>
                                    <td class="d-inline-flex">
                                        <select id="tipo{{$i}}" name="tipo{{$i}}" class="form-control m-1" style="width: 200px">
                                            <option id="tipo{{$i}}" name="tipo{{$i}}" value="1">Foto</option>
                                            <option id="tipo{{$i}}" name="tipo{{$i}}" value="2">Video</option>
                                        </select>
                                        <input class="form-control m-1" type="file" id="imagem{{$i}}" name="imagem{{$i}}" value="" />
                                        <textarea class="form-control m-1" rows="2" cols="100" style="display:none;" type="text" id="video{{$i}}" name="video{{$i}}" ></textarea>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td><input hidden type="text" id="tela" name="tela" class="form-control" value="novo_destaques" /></td>
                                <td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>" /></td>
                                <td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tr>
                                <td class="d-flex justify-content-between">
                                    <a href="{{ route('cadastroDestaques') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i>
                                    </a>
                                    <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#tipo').change(function() {
            var valor = $('#tipo').val();
            if (valor == "2") {
                $('#vidT').show();
                $('#video').show();
                $('#imgT').hide();
                $('#imagem').hide();
            } else {
                $('#imgT').show();
                $('#imagem').show();
                $('#vidT').hide();
                $('#video').hide();

            }
        });
        for (let index = 2; index <= 6; index++) {
            $('#tipo' + index).change(function() {
                var valor = $('#tipo' + index).val();
                if (valor == "2") {
                    $('#vidT' + index).show();
                    $('#video' + index).show();
                    $('#imgT' + index).hide();
                    $('#imagem' + index).hide();
                } else {
                    $('#imgT' + index).show();
                    $('#imagem' + index).show();
                    $('#vidT' + index).hide();
                    $('#video' + index).hide();
                }
            });
        }
    </script>
    </body>