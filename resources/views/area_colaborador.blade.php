@extends('layouts.app')

<body onselectstart="return false">

    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-start align-items-center">
                    <i class="bi bi-person-workspace" style="font-size:30px"> Área do colaborador</i>
                </div>
            </div>
        </section>

        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="row gy-4">
                    <div class="d-inline-flex justify-content-around flex-wrap">
                        <div class="card border-0 m-4" style="width: 20rem;outline:none;">
                            <a href="https://login.lg.com.br/login/hospitaldecancerdepernambuco" class="btn btn-success btn-lg text-white" target="_blank">
                                <strong>Portal do colaborador LG <i class="bi bi-globe" style="font-size:20px"></i></strong>
                            </a>
                        </div>
                        <div class="card border-0 m-3" style="width: 18rem;outline:none;">
                            <button class="btn btn-success btn-lg text-white aaa" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">
                                <strong>Ouvidoria RH <i class="bi bi-chat-right-text" style="font-size:15px"></i></strong>
                            </button>
                        </div>
                        <div class="card border-0 m-3" style="width: 18rem;outline:none;">
                            <a href="{{ route('acessoRapido', 7) }}" class="btn btn-success btn-lg text-white" target="_blank">
                                <strong>Canal de denúncia <i class="bi bi-chat-right-text" style="font-size:15px"></i></strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="row gy-4">
                    <div class="d-inline-flex justify-content-around flex-wrap">
                        <div class="card border-0 m-3" style="width: 28rem;outline:none;">
                            <button class="btn btn-success btn-lg text-white aaa" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap">
                                <strong>Acompanhamento De Experiência <i class="bi bi-chat-right-text" style="font-size:15px"></i></strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div>
                    <p class="m-3 p-2 bg-secondary text-white text-center rounded">
                        Bem-vindo(a), este é um canal para você, integrante do HCP Gestão, expressar livremente seus
                        elogios, solicitações, reclamações, dúvidas, sugestões, criticas e denúncias.
                    </p>
                    <p class="m-2 p-2 text-center">
                        Ao preecher esse formulário, garantimos a todos o direito de total sigilo. O Comitê será
                        responsável por apurar, avaliar e buscar solução para as questões abordadas com muita ética e
                        profissionalismo, defendendo os interesses dos manifestantes e do HCP Gestão.
                    </p>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ouvidoriaRhSend') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        @if ($error == 'Mensagem enviada com sucesso !')
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
                        <div class="border-bottom border-gray p-1">
                            <div>
                                <h5 class="modal-title text-dark">Informações do solicitante <?php ?></h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="m-1">
                                    <label for="recipient-name" class="col-form-label">Tipo de colaborador: <label style="color: red">*</label></label>
                                    <select id="tipocolaborador" name="tipocolaborador" class="form-control" required>
                                        <option {{ old('tipocolaborador') == '' ? 'selected' : '' }} value="">
                                            Selecione...</option>
                                        <option value="O que você faz no HPC Gestão">O que você faz no HPC Gestão
                                        </option>
                                        <option {{ old('tipocolaborador') == 'Colaborador HCP Gestão' ? 'selected' : '' }} value="Colaborador HCP Gestão">Colaborador HCP Gestão</option>
                                        <option {{ old('tipocolaborador') == 'Aprendiz' ? 'selected' : '' }} value="Aprendiz">Aprendiz</option>
                                        <option {{ old('tipocolaborador') == 'Estagiário' ? 'selected' : '' }} value="Estagiário">Estagiário</option>
                                        <option {{ old('tipocolaborador') == 'Residente' ? 'selected' : '' }} value="Residente">Residente</option>
                                        <option {{ old('tipocolaborador') == 'Voluntário' ? 'selected' : '' }} value="Voluntário">Voluntário</option>
                                    </select>
                                </div>
                                <div class="m-1">
                                    <label for="recipient-name" class="col-form-label">E-mail:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                                </div>
                                <div class="m-1" id="tel">
                                    <label for="recipient-name" class="col-form-label">Telefone(Ramal):</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}">
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="m-1">
                                    <label for="recipient-name" class="col-form-label">Celular:</label>
                                    <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular') }}">
                                </div>
                                <div class="m-1">
                                    <label for="recipient-name" class="col-form-label">Setor:</label>
                                    <select id="setor" name="setor" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach ($setores as $s)
                                        <option {{ old('setor') == $s->nome ? 'selected' : '' }} value="{{ $s->nome }}">{{ $s->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="m-1">
                                    <label for="recipient-name" class="col-form-label">Data da ocorrência: <label style="color: red">*</label></label>
                                    <input type="date" class="form-control" id="dtocorren" name="dtocorren" value="{{ old('dtocorren') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="">
                                <h5 class="modal-title text-dark">Informações do atendimento:</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="m-2">
                                    <label for="message-text" class="col-form-label">Qual a natureza desta
                                        solicitação <label style="color: red">*</label></label>
                                    <select id="solicitacao" name="solicitacao" class="form-control" required>
                                        <option {{ old('solicitacao') == '' ? 'selected' : '' }} value="">
                                            Selecione...</option>
                                        <option {{ old('solicitacao') == 'Elogio' ? 'selected' : '' }} value="Elogio">
                                            Elogio</option>
                                        <option {{ old('solicitacao') == 'Solicitação' ? 'selected' : '' }} value="Solicitação">Solicitação</option>
                                        <option {{ old('Reclamação') == 'Reclamação' ? 'selected' : '' }} value="Reclamação">Reclamação</option>
                                        <option {{ old('Reclamação') == 'Dúvida' ? 'selected' : '' }} value="Dúvida">
                                            Dúvida</option>
                                        <option {{ old('Reclamação') == 'Sugestão' ? 'selected' : '' }} value="Sugestão">Sugestão</option>
                                        <option value="Crítica">Crítica</option>
                                        <option value="Denúncia">Denúncia</option>
                                    </select>
                                </div>
                                <div class="m-2">
                                    <label for="message-text" class="col-form-label">Escreva uma mensagem descrevendo
                                        o ocorrido: <label style="color: red">*</label></label>
                                    <textarea class="form-control autoAjuste" id="texto" name="texto" rows="1" cols="45" placeholder="Exemplo:  (O que houve ? Quando ? Quem ? Onde ?)" required>{{ old('texto') }}</textarea>
                                </div>
                            </div>
                        </div>
                </div>
                @if (isset($token))
                <input class="form-control" type="text" name="token" id="token" placeholder="cole aqui o TOKEN" />
                <button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button>
                @else
                <button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button>
                @endif
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div>
                    <p class="m-3 p-2 bg-secondary text-white text-center rounded">
                        ACOMPANHAMENTO DE DESEMPENHO/EXPERIÊNCIA 						
                    </p>
                    <p class="m-2 p-2 text-justify">
                        O período de experiência tem várias funções essenciais. Mas principalmente, esse contrato permite que funcionários e empregadores avaliem a adequação mútua e alinhem suas expectativas e demandas. Além de poder identificar necessidades de treinamento e entender melhor a cultura da empresa.
                    </p>
                </div>
                @if (isset($token))
                <input class="form-control" type="text" name="token" id="token" placeholder="cole aqui o TOKEN" />
                <a href="{{ route('avaliacaoExp') }}" class="btn btn-success m-2">Responder</a>
                @else
                <a href="{{ route('avaliacaoExp') }}" class="btn btn-success m-2">Responder</a>
                @endif
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.6.0.js') }}"></script>

    <?php
    if ($errors->any()) {
        echo '<script> $(document).ready(function() { $("#exampleModal").modal("show"); });</script>';
    }
    if ($errors->any()) {
        echo '<script> $(document).ready(function() { $("#exampleModal2").modal("show"); });</script>';
    }
    ?>
    <script>
        $('.autoAjuste').on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
</body>

</html>