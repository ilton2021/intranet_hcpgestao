<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificação de ocorrência</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <style>
        .js-example-basic-single {
            width: 100%;
        }

        .js-example-basic-multiple {
            width: 100%;
        }
    </style>
</head>

<body>
    <h3 class="text-center">Notificação de Ocorrência</h3>
    @if ($errors->any())
    <div id="error-message" class="alert alert-success text-center">

        @foreach ($errors->all() as $error)
        <h3>{{ $error }}</h3>
        @endforeach

    </div>
    @endif
    <form action="{{ route('storeOcorrencia') }}" method="post" id="formID">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="row m-2">
            <div class="col-12 col-sm-6  p-4">
                <label class="fw-bold mt-1" for="data_ocorrencia" class="form-label">Data da Ocorrência:<span style="color:red">*</span></label>
                <input class="form-control form-control-sm" type="date" name="data_ocorrencia" id="data_ocorrencia" aria-label=".form-control-sm" required>
                <label class="fw-bold mt-1" for="data_relato" class="form-label">Data do relato:<span style="color:red">*</span></label>
                <input class="form-control form-control-sm" type="date" name="data_relato" id="data_relato" aria-label=".form-control-sm" required>
                <label class="fw-bold mt-1" for="setor_notificante" class="form-label">Setor notificante:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="setor_notificante" id="setor_notificante" aria-label=".form-select-sm example" required>
                    <option selected>Selecione o setor notificante </option>
                    <option value='AGÊNCIA TRANSFUSIONAL'>AGÊNCIA TRANSFUSIONAL</option>
                    <option value='ALMOXARIFADO'>ALMOXARIFADO</option>
                    <option value='AMBULATÓRIO'>AMBULATÓRIO</option>
                    <option value='ANESTESIOLOGIA'>ANESTESIOLOGIA</option>
                    <option value='ASSISTÊNCIA FARMACÊUTICA'>ASSISTÊNCIA FARMACÊUTICA</option>
                    <option value='ASSISTÊNCIA NUTRICIONAL'>ASSISTÊNCIA NUTRICIONAL</option>
                    <option value='AUDITORIA CLÍNICA'>AUDITORIA CLÍNICA</option>
                    <option value='BANCO DE LEITE HUMANO'>BANCO DE LEITE HUMANO</option>
                    <option value='CASA DAS BOLSAS'>CASA DAS BOLSAS</option>
                    <option value='CASA DA GESTANTE DO BEBÊ E DA PUÉRPERA'>CASA DA GESTANTE DO BEBÊ E DA PUÉRPERA</option>
                    <option value='CENTRAL DE MAQUEIRO'>CENTRAL DE MAQUEIRO</option>
                    <option value='CENTRO CIRÚRGICO'>CENTRO CIRÚRGICO</option>
                    <option value='CENTRO DE ABASTECIMENTO FARMACÊUTICO'>CENTRO DE ABASTECIMENTO FARMACÊUTICO</option>
                    <option value='CENTRO DE ATENÇÃO À MULHER VÍTIMA DE VIOLÊNCIA SONY SANTOS'>CENTRO DE ATENÇÃO À MULHER VÍTIMA DE VIOLÊNCIA SONY SANTOS</option>
                    <option value='CENTRO DE PARTO NORMAL'>CENTRO DE PARTO NORMAL</option>
                    <option value='CENTRO DIAGNÓSTICO DE IMAGEM'>CENTRO DIAGNÓSTICO DE IMAGEM</option>
                    <option value='CME'>CME</option>
                    <option value='COMISSÃO DE ÉTICA MÉDICA'>COMISSÃO DE ÉTICA MÉDICA</option>
                    <option value='COMISSÃO DE ÓBITO'>COMISSÃO DE ÓBITO</option>
                    <option value='COMISSÃO DE PADRONIZAÇÃO'>COMISSÃO DE PADRONIZAÇÃO</option>
                    <option value='COMISSÃO DE PRONTUÁRIO'>COMISSÃO DE PRONTUÁRIO</option>
                    <option value='COMISSÃO DE PROTOCOLO'>COMISSÃO DE PROTOCOLO</option>
                    <option value='COMUNICAÇÃO E MARKETING'>COMUNICAÇÃO E MARKETING</option>
                    <option value='CONTAS MÉDICAS'>CONTAS MÉDICAS</option>
                    <option value='DIRETORIA ADMINISTRATIVA FINANCEIRA'>DIRETORIA ADMINISTRATIVA FINANCEIRA</option>
                    <option value='DIRETORIA GERAL'>DIRETORIA GERAL</option>
                    <option value='DIRETORIA MULTIDISCIPLINAR'>DIRETORIA MULTIDISCIPLINAR</option>
                    <option value='DIRETORIA TÉCNICA'>DIRETORIA TÉCNICA</option>
                    <option value='EMERGÊNCIA'>EMERGÊNCIA</option>
                    <option value='ENFERMAIRIA ALOJAMENTO CONJUNTO'>ENFERMAIRIA ALOJAMENTO CONJUNTO</option>
                    <option value='ENFERMAIRIA ALTO RISCO'>ENFERMAIRIA ALTO RISCO</option>
                    <option value='ENFERMAIRIA GINECOLÓGICA'>ENFERMAIRIA GINECOLÓGICA</option>
                    <option value='ENGENHARIA CLÍNICA'>ENGENHARIA CLÍNICA</option>
                    <option value='ENSINO E PESQUISA'>ENSINO E PESQUISA</option>
                    <option value='FATURAMENTO'>FATURAMENTO</option>
                    <option value='FINANCEIRO'>FINANCEIRO</option>
                    <option value='FISIOTERAPIA'>FISIOTERAPIA</option>
                    <option value='GESTÃO DA TECNOLOGIA DA INFORMAÇÃO'>GESTÃO DA TECNOLOGIA DA INFORMAÇÃO</option>
                    <option value='HIGIENIZAÇÃO'>HIGIENIZAÇÃO</option>
                    <option value='LABORATÓRIO'>LABORATÓRIO</option>
                    <option value='LACTÁRIO'>LACTÁRIO</option>
                    <option value='MANUTENÇÃO PREDIAL'>MANUTENÇÃO PREDIAL</option>
                    <option value='NECROTÉRIO'>NECROTÉRIO</option>
                    <option value='NUCLEO DE EPIDEMIOLOGIA (NEPI)'>NUCLEO DE EPIDEMIOLOGIA (NEPI)</option>
                    <option value='NÚCLEO INTERNO DE REGULAÇÃO'>NÚCLEO INTERNO DE REGULAÇÃO</option>
                    <option value='OUVIDORIA'>OUVIDORIA</option>
                    <option value='PATRIMÔNIO'>PATRIMÔNIO</option>
                    <option value='PORTARIA'>PORTARIA</option>
                    <option value='PSICOLOGIA'>PSICOLOGIA</option>
                    <option value='RECEPÇÃO'>RECEPÇÃO</option>
                    <option value='ROUPARIA'>ROUPARIA</option>
                    <option value='SERVIÇO DE TERCEIROS'>SERVIÇO DE TERCEIROS</option>
                    <option value='SEGURANÇA PATRIMONIAL'>SEGURANÇA PATRIMONIAL</option>
                    <option value='SERVIÇO ARQUIVO MÉDICO ESTATÍSTICO (SAME)'>SERVIÇO ARQUIVO MÉDICO ESTATÍSTICO (SAME)</option>
                    <option value='COMISSÃO DE CONTROLE DE INFECÇÃO HOSPITALAR'>COMISSÃO DE CONTROLE DE INFECÇÃO HOSPITALAR</option>
                    <option value='SERVIÇO SOCIAL'>SERVIÇO SOCIAL</option>
                    <option value='SESMT'>SESMT</option>
                    <option value='SISTEMA DE GESTÃO DA QUALIDADE'>SISTEMA DE GESTÃO DA QUALIDADE</option>
                    <option value='SISTEMA DE GESTÃO DE PESSOAS'>SISTEMA DE GESTÃO DE PESSOAS</option>
                    <option value='SUPRIMENTOS'>SUPRIMENTOS</option>
                    <option value='UNIDADE DE CUIDADOS INTERMRDIÁRIOS CANGURU'>UNIDADE DE CUIDADOS INTERMRDIÁRIOS CANGURU</option>
                    <option value='UNIDADE DE CUIDADOS INTERMRDIÁRIOS CONVENCIONAL'>UNIDADE DE CUIDADOS INTERMRDIÁRIOS CONVENCIONAL</option>
                    <option value='UTI MULHER'>UTI MULHER</option>
                    <option value='UTI NEONATAL'>UTI NEONATAL</option>
                    <option value='VACINA'>VACINA</option>
                </select>
                <label class="fw-bold mt-1" for="setor_notificado" class="form-label">Setor notificado:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="setor_notificado" id="setor_notificado" aria-label=".form-select-sm example" required>
                    <option selected>Selecione o setor notificado </option>
                    <option value='AGÊNCIA TRANSFUSIONAL'>AGÊNCIA TRANSFUSIONAL</option>
                    <option value='ALMOXARIFADO'>ALMOXARIFADO</option>
                    <option value='AMBULATÓRIO'>AMBULATÓRIO</option>
                    <option value='ANESTESIOLOGIA'>ANESTESIOLOGIA</option>
                    <option value='ASSISTÊNCIA FARMACÊUTICA'>ASSISTÊNCIA FARMACÊUTICA</option>
                    <option value='ASSISTÊNCIA NUTRICIONAL'>ASSISTÊNCIA NUTRICIONAL</option>
                    <option value='AUDITORIA CLÍNICA'>AUDITORIA CLÍNICA</option>
                    <option value='BANCO DE LEITE HUMANO'>BANCO DE LEITE HUMANO</option>
                    <option value='CASA DAS BOLSAS'>CASA DAS BOLSAS</option>
                    <option value='CASA DA GESTANTE DO BEBÊ E DA PUÉRPERA'>CASA DA GESTANTE DO BEBÊ E DA PUÉRPERA</option>
                    <option value='CENTRAL DE MAQUEIRO'>CENTRAL DE MAQUEIRO</option>
                    <option value='CENTRO CIRÚRGICO'>CENTRO CIRÚRGICO</option>
                    <option value='CENTRO DE ABASTECIMENTO FARMACÊUTICO'>CENTRO DE ABASTECIMENTO FARMACÊUTICO</option>
                    <option value='CENTRO DE ATENÇÃO À MULHER VÍTIMA DE VIOLÊNCIA SONY SANTOS'>CENTRO DE ATENÇÃO À MULHER VÍTIMA DE VIOLÊNCIA SONY SANTOS</option>
                    <option value='CENTRO DE PARTO NORMAL'>CENTRO DE PARTO NORMAL</option>
                    <option value='CENTRO DIAGNÓSTICO DE IMAGEM'>CENTRO DIAGNÓSTICO DE IMAGEM</option>
                    <option value='CME'>CME</option>
                    <option value='COMISSÃO DE ÉTICA MÉDICA'>COMISSÃO DE ÉTICA MÉDICA</option>
                    <option value='COMISSÃO DE ÓBITO'>COMISSÃO DE ÓBITO</option>
                    <option value='COMISSÃO DE PADRONIZAÇÃO'>COMISSÃO DE PADRONIZAÇÃO</option>
                    <option value='COMISSÃO DE PRONTUÁRIO'>COMISSÃO DE PRONTUÁRIO</option>
                    <option value='COMISSÃO DE PROTOCOLO'>COMISSÃO DE PROTOCOLO</option>
                    <option value='COMUNICAÇÃO E MARKETING'>COMUNICAÇÃO E MARKETING</option>
                    <option value='CONTAS MÉDICAS'>CONTAS MÉDICAS</option>
                    <option value='DIRETORIA ADMINISTRATIVA FINANCEIRA'>DIRETORIA ADMINISTRATIVA FINANCEIRA</option>
                    <option value='DIRETORIA GERAL'>DIRETORIA GERAL</option>
                    <option value='DIRETORIA MULTIDISCIPLINAR'>DIRETORIA MULTIDISCIPLINAR</option>
                    <option value='DIRETORIA TÉCNICA'>DIRETORIA TÉCNICA</option>
                    <option value='EMERGÊNCIA'>EMERGÊNCIA</option>
                    <option value='ENFERMAIRIA ALOJAMENTO CONJUNTO'>ENFERMAIRIA ALOJAMENTO CONJUNTO</option>
                    <option value='ENFERMAIRIA ALTO RISCO'>ENFERMAIRIA ALTO RISCO</option>
                    <option value='ENFERMAIRIA GINECOLÓGICA'>ENFERMAIRIA GINECOLÓGICA</option>
                    <option value='ENGENHARIA CLÍNICA'>ENGENHARIA CLÍNICA</option>
                    <option value='ENSINO E PESQUISA'>ENSINO E PESQUISA</option>
                    <option value='FATURAMENTO'>FATURAMENTO</option>
                    <option value='FINANCEIRO'>FINANCEIRO</option>
                    <option value='FISIOTERAPIA'>FISIOTERAPIA</option>
                    <option value='GESTÃO DA TECNOLOGIA DA INFORMAÇÃO'>GESTÃO DA TECNOLOGIA DA INFORMAÇÃO</option>
                    <option value='HIGIENIZAÇÃO'>HIGIENIZAÇÃO</option>
                    <option value='LABORATÓRIO'>LABORATÓRIO</option>
                    <option value='LACTÁRIO'>LACTÁRIO</option>
                    <option value='MANUTENÇÃO PREDIAL'>MANUTENÇÃO PREDIAL</option>
                    <option value='NECROTÉRIO'>NECROTÉRIO</option>
                    <option value='NUCLEO DE EPIDEMIOLOGIA (NEPI)'>NUCLEO DE EPIDEMIOLOGIA (NEPI)</option>
                    <option value='NÚCLEO INTERNO DE REGULAÇÃO'>NÚCLEO INTERNO DE REGULAÇÃO</option>
                    <option value='OUVIDORIA'>OUVIDORIA</option>
                    <option value='PATRIMÔNIO'>PATRIMÔNIO</option>
                    <option value='PORTARIA'>PORTARIA</option>
                    <option value='PSICOLOGIA'>PSICOLOGIA</option>
                    <option value='RECEPÇÃO'>RECEPÇÃO</option>
                    <option value='ROUPARIA'>ROUPARIA</option>
                    <option value='SERVIÇO DE TERCEIROS'>SERVIÇO DE TERCEIROS</option>
                    <option value='SEGURANÇA PATRIMONIAL'>SEGURANÇA PATRIMONIAL</option>
                    <option value='SERVIÇO ARQUIVO MÉDICO ESTATÍSTICO (SAME)'>SERVIÇO ARQUIVO MÉDICO ESTATÍSTICO (SAME)</option>
                    <option value='COMISSÃO DE CONTROLE DE INFECÇÃO HOSPITALAR'>COMISSÃO DE CONTROLE DE INFECÇÃO HOSPITALAR</option>
                    <option value='SERVIÇO SOCIAL'>SERVIÇO SOCIAL</option>
                    <option value='SESMT'>SESMT</option>
                    <option value='SISTEMA DE GESTÃO DA QUALIDADE'>SISTEMA DE GESTÃO DA QUALIDADE</option>
                    <option value='SISTEMA DE GESTÃO DE PESSOAS'>SISTEMA DE GESTÃO DE PESSOAS</option>
                    <option value='SUPRIMENTOS'>SUPRIMENTOS</option>
                    <option value='UNIDADE DE CUIDADOS INTERMRDIÁRIOS CANGURU'>UNIDADE DE CUIDADOS INTERMRDIÁRIOS CANGURU</option>
                    <option value='UNIDADE DE CUIDADOS INTERMRDIÁRIOS CONVENCIONAL'>UNIDADE DE CUIDADOS INTERMRDIÁRIOS CONVENCIONAL</option>
                    <option value='UTI MULHER'>UTI MULHER</option>
                    <option value='UTI NEONATAL'>UTI NEONATAL</option>
                    <option value='VACINA'>VACINA</option>
                </select>
                <label class="fw-bold mt-1" for="unidade" class="form-label">Unidade:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="unidade" id="unidade" aria-label=".form-select-sm example" required>
                    <option selected>Hospital da Mulher do Recife</option>
                </select>
            </div>
            <div class="col-12 col-sm-6  p-4">
                <label class="fw-bold mt-1" for="nome_paciente" class="form-label">Nome do paciente:</label>
                <input class="form-control form-control-sm" type="text" aria-label=".form-control-sm" name="nome_paciente" id="nome_paciente">
                <label class="fw-bold mt-1" for="registro" class="form-label">Registro:</label>
                <input class="form-control form-control-sm" type="text" aria-label=".form-control-sm" name="registro" id="registro">
                <label class="fw-bold mt-1" for="data_nascimento" class="form-label">Data de nascimento:</label>
                <input class="form-control form-control-sm" type="date" aria-label=".form-control-sm" name="data_nascimento" id="data_nascimento">
                <label class="fw-bold mt-1" for="tipo" class="form-label">Tipo:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="tipo" id="tipo" aria-label=".form-select-sm example" required>
                    <option selected>Selecione</option>
                    <option value="1">Real (Já ocorrida)</option>
                    <option value="2">Potencial (pode ocorrer)</option>
                    <option value="3">Oportunidade de melhoria</option>
                </select>
                <label class="fw-bold mt-1" for="ocorrencia" class="form-label">Ocorrência:<span style="color:red">*</span></label>
                <select class="form-control form-control-sm js-example-basic-single " name="ocorrencia" id="ocorrencia" aria-label=".form-select-sm example" onchange="ocorrencia_itens()" required>
                    <option selected>Selecione a ocorrência</option>
                    @foreach ($ocorrencias as $o)
                    <option value="{{ $o->id }}">{{ $o->descricao }}</option>
                    @endforeach
                </select>
                <label class="fw-bold mt-1" for="descricao_ocorrencia" class="form-label">Descrição da
                    ocorrência:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="descricao_ocorrencia" id="descricao_ocorrencia" aria-label=".form-select-sm example" required>
                    <option selected>Selecione a descrição da ocorrência</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row m-2">
            <div class="col-12 col-sm-6 p-3">
                <label class="fw-bold mt-1" for="processo" class="form-label">Processo:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" id="processo" name="processo" aria-label=".form-select-sm example" required>
                    <option selected>Selecione</option>
                    <option value='AGÊNCIA TRANSFUSIONAL - AGT'>AGÊNCIA TRANSFUSIONAL - AGT</option>
                    <option value='ALMOXARIFADO - ALM'>ALMOXARIFADO - ALM</option>
                    <option value='AMBULATÓRIO - AMB'>AMBULATÓRIO - AMB</option>
                    <option value='ANESTESIOLOGIA - ANS'>ANESTESIOLOGIA - ANS</option>
                    <option value='ASSISTÊNCIA FARMACÊUTICA - FAR'>ASSISTÊNCIA FARMACÊUTICA - FAR</option>
                    <option value='ASSISTÊNCIA NUTRICIONAL - NUT'>ASSISTÊNCIA NUTRICIONAL - NUT</option>
                    <option value='AUDITORIA CLÍNICA - AUD'>AUDITORIA CLÍNICA - AUD</option>
                    <option value='BANCO DE LEITE HUMANO - BLH'>BANCO DE LEITE HUMANO - BLH</option>
                    <option value='CASA DA GESTANTE DO BEBÊ E DA PUÉRPERA - CGP'>CASA DA GESTANTE DO BEBÊ E DA PUÉRPERA - CGP</option>
                    <option value='CASA DAS BOLSAS - CSB'>CASA DAS BOLSAS - CSB</option>
                    <option value='CENTRAL DE MAQUEIRO - MAQ'>CENTRAL DE MAQUEIRO - MAQ</option>
                    <option value='CENTRAL DE MATERIAL ESTERILIZADO - CME'>CENTRAL DE MATERIAL ESTERILIZADO - CME</option>
                    <option value='CENTRO CIRÚRGICO - CCI'>CENTRO CIRÚRGICO - CCI</option>
                    <option value='CENTRO DE ABASTECIMENTO FARMACÊUTICO - CAF'>CENTRO DE ABASTECIMENTO FARMACÊUTICO - CAF</option>
                    <option value='CENTRO DE ATENÇÃO À MULHER VÍTIMA DE VIOLÊNCIA SONY SANTOS - CSS'>CENTRO DE ATENÇÃO À MULHER VÍTIMA DE VIOLÊNCIA SONY SANTOS - CSS</option>
                    <option value='CENTRO DE PARTO NORMAL - CPN'>CENTRO DE PARTO NORMAL - CPN</option>
                    <option value='CENTRO DIAGNÓSTICO DE IMAGEM - CDI'>CENTRO DIAGNÓSTICO DE IMAGEM - CDI</option>
                    <option value='COMUNICAÇÃO E MARKETING - CMK'>COMUNICAÇÃO E MARKETING - CMK</option>
                    <option value='CONTABILIDADE'>CONTABILIDADE</option>
                    <option value='CONTAS MÉDICAS - CMD'>CONTAS MÉDICAS - CMD</option>
                    <option value='DIRETORIA ADMINISTRATIVA FINANCEIRA - DAF'>DIRETORIA ADMINISTRATIVA FINANCEIRA - DAF</option>
                    <option value='DIRETORIA GERAL - DIG'>DIRETORIA GERAL - DIG</option>
                    <option value='DIRETORIA MULTIDISCIPLINAR - DMT'>DIRETORIA MULTIDISCIPLINAR - DMT</option>
                    <option value='DIRETORIA TÉCNICA - DIT'>DIRETORIA TÉCNICA - DIT</option>
                    <option value='EMERGÊNCIA - EMG'>EMERGÊNCIA - EMG</option>
                    <option value='ENFERMAIRIA ALTO RISCO - ALR'>ENFERMAIRIA ALTO RISCO - ALR</option>
                    <option value='ENFERMAIRIA GINECOLÓGICA - GIN'>ENFERMAIRIA GINECOLÓGICA - GIN</option>
                    <option value='ENFERMARIA ALOJAMENTO CONJUNTO - ALC'>ENFERMARIA ALOJAMENTO CONJUNTO - ALC</option>
                    <option value='ENGENHARIA CLÍNICA - ENC'>ENGENHARIA CLÍNICA - ENC</option>
                    <option value='ENSINO E PESQUISA - ESP'>ENSINO E PESQUISA - ESP</option>
                    <option value='FATURAMENTO - FAT'>FATURAMENTO - FAT</option>
                    <option value='FINANCEIRO - FIN'>FINANCEIRO - FIN</option>
                    <option value='FISIOTERAPIA - FIS'>FISIOTERAPIA - FIS</option>
                    <option value='GESTÃO DA TECNOLOGIA DA INFORMAÇÃO - GTI'>GESTÃO DA TECNOLOGIA DA INFORMAÇÃO - GTI</option>
                    <option value='HIGIENE E LIMPEZA - HIG'>HIGIENE E LIMPEZA - HIG</option>
                    <option value='HOTELARIA HOSPITALAR / ROUPARIA - HOT'>HOTELARIA HOSPITALAR / ROUPARIA - HOT</option>
                    <option value='LABORATÓRIO - LAB'>LABORATÓRIO - LAB</option>
                    <option value='LACTÁRIO - LAC'>LACTÁRIO - LAC</option>
                    <option value='MANUTENÇÃO PREDIAL - MAP'>MANUTENÇÃO PREDIAL - MAP</option>
                    <option value='NECROTÉRIO - NEC'>NECROTÉRIO - NEC</option>
                    <option value='NÚCLEO DE EPIDEMIOLOGIA - NEP'>NÚCLEO DE EPIDEMIOLOGIA - NEP</option>
                    <option value='NÚCLEO INTERNO DE REGULAÇÃO - NIR'>NÚCLEO INTERNO DE REGULAÇÃO - NIR</option>
                    <option value='OUVIDORIA - OUV'>OUVIDORIA - OUV</option>
                    <option value='PATRIMÔNIO - PAT'>PATRIMÔNIO - PAT</option>
                    <option value='PORTARIA - POR'>PORTARIA - POR</option>
                    <option value='PSICOLOGIA - PSI'>PSICOLOGIA - PSI</option>
                    <option value='RECEPÇÃO - REC'>RECEPÇÃO - REC</option>
                    <option value='SEGURANÇA PATRIMONIAL - SPT'>SEGURANÇA PATRIMONIAL - SPT</option>
                    <option value='SERV. ESPECIALIZADO EM ENG. SEGURANÇA MEDICINA DO TRAB (SESMT) - SES'>SERV. ESPECIALIZADO EM ENG. SEGURANÇA MEDICINA DO TRAB (SESMT) - SES</option>
                    <option value='SERVIÇO ARQUIVO MÉDICO ESTATÍSTICO (SAME) - ARQ'>SERVIÇO ARQUIVO MÉDICO ESTATÍSTICO (SAME) - ARQ</option>
                    <option value='SERVIÇO DE CONTROLE DE INFECÇÃO HOSPITALAR - SCIH'>SERVIÇO DE CONTROLE DE INFECÇÃO HOSPITALAR - SCIH</option>
                    <option value='SERVIÇO DE TERCEIROS - SVT'>SERVIÇO DE TERCEIROS - SVT</option>
                    <option value='SERVIÇO SOCIAL - SESO'>SERVIÇO SOCIAL - SESO</option>
                    <option value='SISTEMA DE GESTÃO DA QUALIDADE - SGQ'>SISTEMA DE GESTÃO DA QUALIDADE - SGQ</option>
                    <option value='SISTEMA DE GESTÃO DE PESSOAS - SGP'>SISTEMA DE GESTÃO DE PESSOAS - SGP</option>
                    <option value='SUPRIMENTOS -SUP'>SUPRIMENTOS -SUP</option>
                    <option value='UNIDADE DE CUIDADOS INTERMRDIÁRIOS CANGURU - UCA'>UNIDADE DE CUIDADOS INTERMRDIÁRIOS CANGURU - UCA</option>
                    <option value='UNIDADE DE CUIDADOS INTERMRDIÁRIOS CONVENCIONAL - UCI'>UNIDADE DE CUIDADOS INTERMRDIÁRIOS CONVENCIONAL - UCI</option>
                    <option value='UTI MULHER - UMU'>UTI MULHER - UMU</option>
                    <option value='UTI NEONATAL - UNE'>UTI NEONATAL - UNE</option>
                    <option value='VACINA - VAC'>VACINA - VAC</option>

                </select>
                <label class="fw-bold mt-1" for="origem" class="form-label">Origem:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="origem" id="origem" aria-label=".form-select-sm example" required>
                    <option selected>Selecione</option>
                    <option value="Análise de risco">Análise de risco</option>
                    <option value="Auditoria clínica">Auditoria clínica</option>
                    <option value="Auditoria Externa">Auditoria Externa</option>
                    <option value="Auditoria Interna">Auditoria Interna</option>
                    <option value="Indicador">Indicador</option>
                    <option value="Notificação Voluntaria">Notificação Voluntaria</option>
                    <option value="Revisão de Prontuário">Revisão de prontuário</option>
                    <option value="Ronda Diária">Ronda Diária</option>
                </select>
                <label class="fw-bold mt-1" for="descricao_evento" class="form-label">Descrição do evento<span style="color:red">*</span></label>
                <textarea class="form-control" name="descricao_evento" id="descricao_evento" rows="1" maxlength="700" required></textarea>
                <div class="mt-1" id="contador"></div>
            </div>
            <div class="col-12 col-sm-6 p-3">
                <label class="fw-bold mt-1" for="acao_imediata" class="form-label">Ação corretiva<span style="color:red">*</span></label>
                <textarea class="form-control" name="acao_imediata" id="acao_imediata" rows="1" maxlength="700" required></textarea>
                <div class="mt-1" id="contador_2"></div>
                <div class="d-sm-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <label class="fw-bold mt-1" for="data_acao_corretiva" class="form-label">Data:<span style="color:red">*</span></label>
                        <input class="form-control form-control-sm" type="date" name="data_acao_corretiva" id="data_acao_corretiva" aria-label=".form-control-sm" required>
                    </div>
                    <div class="d-flex flex-column">
                        <label class="fw-bold mt-1" for="responsavel_acao" class="form-label">Responsável pela
                            Ação:</label>
                        <input class="form-control form-control-sm" type="text" aria-label=".form-control-sm" name="responsavel_acao" id="responsavel_acao">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row m-2">
            <div class="col-12 col-sm-6 p-3">
                <label class="fw-bold mt-1" for="classificacao_ocorrencia" class="form-label">Classificação da
                    ocorrência:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="classificacao_ocorrencia" id="classificacao_ocorrencia" aria-label=".form-select-sm example" required>
                    <option selected>Selecione a classificação</option>
                    <option value="NÃO CONFORMIDADE">NÃO CONFORMIDADE</option>
                    <option value="INCIDENTE SEM DANO">INCIDENTE SEM DANO</option>
                    <option value="INCIDENTE COM DANO">INCIDENTE COM DANO</option>
                    <option value="QUASE ERRO (NEAR MISS)">QUASE ERRO (NEAR MISS)</option>
                    <option value="CIRCUNSTÂNCIA DE RISCO">CIRCUNSTÂNCIA DE RISCO</option>
                    <option value="EVENTO ADVERSO GRAVE">EVENTO ADVERSO GRAVE</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 p-3">
                <label class="fw-bold mt-1" for="classificacao_dano" class="form-label">Classificação do
                    Dano:<span style="color:red">*</span></label>
                <select class="js-example-basic-single form-control form-control-sm" name="classificacao_dano" id="classificacao_dano" aria-label=".form-select-sm example" required>
                    <option selected>Selecione a Classificação do dano</option>
                    <option value="SEM DANO">SEM DANO</option>
                    <option value="DANO LEVE">DANO LEVE</option>
                    <option value="DANO MODERADO">DANO MODERADO</option>
                    <option value="DANO GRAVE">DANO GRAVE</option>
                    <option value="ÓBITO">ÓBITO</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row m-2">
            <div class="col-12 col-sm-12 p-3">
                <label class="fw-bold mt-1" for="classificar_incidente" class="form-label">Classificação do
                    Dano:<span style="color:red">*</span></label>
                <select class="js-example-basic-multiple form-control form-control-sm" name="classificar_incidente[]" id="classificar_incidente" aria-label=".form-select-sm example" multiple="multiple" required>
                    <option value="Administração Clínica">Administração Clínica</option>
                    <option value="Hemoderivados">Hemoderivados</option>
                    <option value="Comportamento">Comportamento</option>
                    <option value="Documentação">Documentação</option>
                    <option value="Infecção Relacionada à Assistência a Saúde">Infecção Relacionada à Assistência a
                        Saúde
                    </option>
                    <option value="Procedimento / Processo Clínico">Procedimento / Processo Clínico</option>
                    <option value="Nutrição">Nutrição</option>
                    <option value="Estrutura">Estrutura</option>
                    <option value="Equipamento">Equipamento</option>
                    <option value="Medicação / Fluídos EV">Medicação / Fluídos EV</option>
                    <option value="Gases / Oxigênio">Gases / Oxigênio</option>
                    <option value="Gerenciamento de Recursos">Gerenciamento de Recursos</option>
                    <option value="Acidentes com o Paciente">Acidentes com o Paciente</option>
                </select>
            </div>
        </div>
        <div class="row m-2 p-3">
            <input class="btn btn-success" type="submit" aria-label=".form-control-sm" name="submit" id="submit">
        </div>
    </form>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/multiple-select.min.js') }}"></script>
    <script src="{{ asset('js/ocorrencia_form.js') }}"></script>
    <script>
        function ocorrencia_itens() {
            var select = document.getElementById("ocorrencia");
            var dados = <?php echo json_encode($tiposOcorrencias); ?>;
            var select_desc = document.getElementById("descricao_ocorrencia");
            select_desc.innerHTML = "";
            var option = document.createElement("option");
            option.text = "Selecione a descricao da ocorrência";
            option.value = "";
            select_desc.appendChild(option);
            dados.forEach(function(ocorrencia) {
                if (ocorrencia.ocorrencias_id == select.value) {
                    console.log("Ocorrência selecionada:", ocorrencia.id);
                    var option = document.createElement("option");
                    option.text = ocorrencia.descricao;
                    option.value = ocorrencia.descricao;
                    select_desc.appendChild(option);
                }
            });
        }
    </script>
    <script>
        //Função para bloquear botão enviar depois de clicado uma vez
        var formID = document.getElementById("formID");
        var send = $("#submit");

        $(formID).submit(function(event) {
            if (formID.checkValidity()) {
                send.attr("disabled", "disabled");
            }
        });
        //
    </script>
    <script>
        // Função para ocultar div depois de timer
        setTimeout(function() {
            document.getElementById("error-message").style.display = "none";
        }, 5000);
        //
    </script>
</body>

</html>