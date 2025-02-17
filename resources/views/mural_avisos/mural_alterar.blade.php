@extends('layouts.adm')
<link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}" />
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
            <h3 style="font-size: 18px;">ALTERAR MURAL DE AVISOS:</h3>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row" style="margin-top: 25px;">
        <div class="col-md-2 col-sm-0"></div>
        <div class="col-md-8 col-sm-12 text-center">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <a class="card-header bg-success text-decoration-none text-white bg-success" type="button"
                        data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
                        Alterar Mural de Avisos: <i class="fas fa-check-circle"></i>
                    </a>
                </div>
                <form action="{{ \Request::route('updateMural') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="table-responsive-sm">
                        <table border="0" class="table-sm" style="line-height: 1.5;">
                            <tr>
                                <td> Título: </td>
                                <td>
                                    <input class="form-control" type="text" id="titulo" name="titulo" required
                                        value="<?php echo $murais[0]->titulo; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label id="imgT"> Imagem </label>
                                    <label id="vidT" style="display:none"> video </label> :
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="m-1">
                                            <select id="tipo" name="tipo" class="form-control m-1">
                                                <option {{ $murais[0]->tipo == 1 ? 'selected' : '' }} id="tipo"
                                                    name="tipo" value="1">Foto</option>
                                                <option {{ $murais[0]->tipo == 2 ? 'selected' : '' }} id="tipo"
                                                    name="tipo" value="2">Video</option>
                                            </select>
                                        </div>
                                        <div class="m-1">
                                            <input class="form-control m-1" type="file" id="imagem"
                                                name="imagem" />
                                        </div>
                                        <div class="m-1" id="tipovideo1" style="display:none;">
                                            <textarea class="form-control" type="text" id="video" name="video">{{ $murais[0]->video }}</textarea>
                                            Usar foto padrão do video ?
                                            <select id="videoFotoPadrao" name="videoFotoPadrao"
                                                class="form-control m-1">
                                                <option {{ $murais[0]->videominiatura == '' ? 'selected' : '' }}
                                                    id="videoFotoPadrao" name="videoFotoPadrao" value="1">Sim
                                                </option>
                                                <option {{ $murais[0]->videominiatura == '' ? '' : 'selected' }}
                                                    id="videoFotoPadrao" name="videoFotoPadrao" value="2">Não
                                                </option>
                                            </select>
                                        </div>
                                        <div id="tipovideo2" style="display:none;">
                                            <div class="d-flex flex-column m-1">
                                                <img style="width:155px;"
                                                    src="{{ asset('assets/img/imageDefault.png') }}" id="vidImg"
                                                    name="vidImg" class="img-fluid m-1"><span><strong> Foto padrão do
                                                        video</strong></span>
                                            </div>
                                        </div>
                                        <div id="tipovideo3" style="display:none;">
                                            <div class="d-flex flex-column">
                                                @if ($murais[0]->videominiatura !== '')
                                                    <div class="d-flex">
                                                        <img style="width:145px;"
                                                            src="{{ asset('storage') }}/{{ $murais[0]->videominiatura }}"
                                                            id="vidImg" name="vidImg" class="img-fluid m-1">
                                                    </div>
                                                @endif
                                                <input class="form-control m-1" type="file" id="videominiatura"
                                                    name="videominiatura" style="width:300px" />
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-inline-flex d-flex align-items-center">
                                            <label style="width:120px;"> Data Início:</label>
                                            <input class="form-control" type="date" id="data_inicio"
                                                name="data_inicio" required value="{{ $murais[0]->data_inicio }}" />
                                        </div>
                                        <div class="d-inline-flex d-flex align-items-center">
                                            <label style="width:120px;">Data Fim:</label>
                                            <input class="form-control" type="date" id="data_fim"
                                                name="data_fim" required value="{{ $murais[0]->data_fim }}" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Unidades que Visualizarão:</td>
                                <td class="d-flex">
                                    <li class="d-flex flex-column align-items-start" style="list-style: none;">
                                        <div class="m-1">
                                            <input style="font-size: 12px;" class="btn btn-primary" type="button"
                                                onclick='selects()' value="   Marcar todos   " />
                                        </div>
                                        <div class="m-1">
                                            <input style="font-size: 12px;" class="btn btn-danger" type="button"
                                                onclick='deSelect()' value="Desmarcar todos" />
                                        </div>
                                    </li>

                                    <div class="d-flex justify-content-between flex-wrap m-1">
                                        @foreach ($unidades as $unidade)
                                            <?php
                                            $marcado = '';
                                            if (in_array($unidade->id, $und_atual)) {
                                                $marcado = 'checked';
                                            }
                                            ?>
                                            <div class="m-1">
                                                <input type='checkbox' id="unidade_id[]" class="unidade"
                                                    name="unidade_id[]" <?php echo $marcado; ?>
                                                    value="<?php echo $unidade->id; ?>" />
                                                <label for="unidade_id[]">{{ $unidade->sigla }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> Texto: </td>
                                <td>
                                    <textarea class="form-control" style=" height: 50px;" id=texto name="texto" aria-label="With textarea">{{ $murais[0]->texto }}</textarea>
                                    <p><label for="review"></label> <small class="caracteres"></small></p>
                                </td>
                            </tr>
                            <tr hidden>
                                <td><input hidden type="text" id="tela" name="tela" class="form-control"
                                        value="novo_murais" /></td>
                                <td><input hidden type="text" id="user_id" name="user_id" class="form-control"
                                        value="<?php echo Auth::user()->id; ?>" /></td>
                                <td><input hidden type="text" id="idTabela" name="idTabela" class="form-control"
                                        value="" /> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tr>
                                <td class="d-flex justify-content-between">
                                    <a href="{{ route('cadastroMural') }}" id="Voltar" name="Voltar"
                                        type="button" class="btn btn-warning btn-sm"
                                        style="margin-top: 10px; color: #FFFFFF;"> Voltar <i
                                            class="fas fa-undo-alt"></i> </a>
                                    <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;"
                                        value="Salvar" id="Salvar" name="Salvar" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script language="javascript">
    var valor1 = "<?php print $murais[0]->tipo; ?>";
    var videoMini = "<?php print $murais[0]->videominiatura; ?>";
    if (valor1 == 2) {
        $('#vidT').show();
        $('#tipovideo1').show();
        $('#tipovideo2').show();
        $('#imgT').hide();
        $('#imagem').hide();
        if (videoMini == "") {
            $('#tipovideo2').show();
            $('#tipovideo3').hide();
        } else {
            $('#tipovideo2').hide();
            $('#tipovideo3').show();
        }
    } else {
        $('#imgT').show();
        $('#imagem').show();
        $('#vidT').hide();
        $('#tipovideo1').hide();
        $('#tipovideo2').hide();
        $('#tipovideo3').hide();
    }
</script>
<script language="javascript">
    var input = document.querySelector("#video");
    var link = input.value;
    var link = link.split('/');
    var link = link[4];
    var img = document.querySelector("#vidImg");
    img.setAttribute('src', 'http://img.youtube.com/vi/' + link + '/0.jpg');
</script>

<script language="javascript">
    $('#tipo').change(function() {
        var valor = $('#tipo').val();
        if (valor == "2") {
            $('#vidT').show();
            $('#tipovideo1').show();
            $('#tipovideo2').show();
            $('#imgT').hide();
            $('#imagem').hide();
        } else {
            $('#imgT').show();
            $('#imagem').show();
            $('#vidT').hide();
            $('#tipovideo1').hide();
            $('#tipovideo2').hide();

        }
    });
    $('#videoFotoPadrao').change(function() {
        var valor = $('#videoFotoPadrao').val();
        if (valor == "1") {
            $('#tipovideo2').show();
            $('#tipovideo3').hide();
        } else {
            $('#tipovideo2').hide();
            $('#tipovideo3').show();
        }

    });
</script>
<script language="javascript">
    $('#video').on('change', function() {
        var input = document.querySelector("#video");
        var link = input.value;
        var link = link.split('"');
        var link = link[5];
        var link = link.split('/');
        var link = link[4];
        var img = document.querySelector("#vidImg");
        img.setAttribute('src', 'http://img.youtube.com/vi/' + link + '/0.jpg');
    });
</script>
<script>
    //Contador de caracteres
    $(document).on("input", "#texto", function() {
        var limite = 800;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var comentario = $("textarea[name=texto]").val();
            $("textarea[name=texto]").val(comentario.substr(0, limite));
            $(".caracteres").text("0 " + informativo);
        } else if (caracteresRestantes >= 16) {
            $(".caracteres").css("color", "#000000");
            $(".caracteres").text(caracteresRestantes + " " + informativo);
        } else if (caracteresRestantes >= 0 && caracteresRestantes <= 15) {
            $(".caracteres").css("color", "red");
            $(".caracteres").text(caracteresRestantes + " " + informativo);
        } else {
            $(".caracteres").text(caracteresRestantes + " " + informativo);
        }
    });
</script>
</body>
