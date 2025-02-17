@extends('layouts.app')

<script language=javascript type="text/javascript">
  function pegarDiaSemana() {
    dateValue  = new Date(document.getElementById('data_evento').value);
    dia_semana = dateValue.getUTCDay();
    if(dia_semana == 0) {
      document.getElementById('dia_semana').value = "Domingo";
    } else if(dia_semana == 1) {
      document.getElementById('dia_semana').value = "Segunda-feira";
    } else if(dia_semana == 2) {
      document.getElementById('dia_semana').value = "Terça-feira";
    } else if(dia_semana == 3) {
      document.getElementById('dia_semana').value = "Quarta-feira";
    } else if(dia_semana == 4) {
      document.getElementById('dia_semana').value = "Quinta-feira";
    } else if(dia_semana == 5) {
      document.getElementById('dia_semana').value = "Sexta-feira";
    } else if(dia_semana == 6) {
      document.getElementById('dia_semana').value = "Sábado";
    } else {
      document.getElementById('dia_semana').value = "";
    }
  }

  function agenteCausador() {
    value = document.getElementById('agente_causador').value;
    if (value == 'outros') {
      document.getElementById('agente_causador_outros').hidden = false;
    } else {
      document.getElementById('agente_causador_outros').hidden = true;
    }
  }
</script>

<body onselectstart="return false">

    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-start align-items-center">
                    <i class="bi bi-person-workspace" style="font-size:30px"> Indicador de Acidente de Trabalho</i>
                </div>
            </div>
        </section>
        @if ($errors->any())
          @foreach ($errors->all() as $error)
            @if ($error == 'Indicador de Acidente Cadastrado com Sucesso!')
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
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
              <div class="row gy-4">
                <form action="{{ route('indicadorAcidenteStore') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <div class="border-bottom border-gray p-1">
                  <div>
                    <h5 class="modal-title text-dark">Informações do Acidentado:<?php ?></h5>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                     <label for="recipient-colaborador" class="col-form-label">Nome do Acidentado: <label style="color: red">*</label></label>
                     <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Informe o Nome Completo do Acidentado..." required>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Gênero:<label style="color: red">*</label></label>
                      <select id="genero" name="genero" class="form-select" required>
                        <option value=""> Selecione o Gênero...</option>
                        <option value="feminino" <?php if(old('genero') == 'feminino') { echo 'selected'; } ?>>Feminino</option>
                        <option value="masculino" <?php if(old('genero') == 'masculino') { echo 'selected'; } ?>>Masculino</option>
                      </select>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                     <label for="recipient-gestor" class="col-form-label">Setor do Acidentado: <label style="color: red">*</label></label>
                     <select id="setor" name="setor" class="form-select" required>
                        <option value=""> Selecione o Setor do Acidentado...</option>
                        @foreach($setores as $setor)
                          <option value="<?php echo $setor->nome; ?>" <?php if(old('setor') == $setor->nome) { echo 'selected'; } ?>>{{ $setor->nome }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-unidade" class="col-form-label">Tempo na Função:<label style="color: red">*</label></label>
                      <input type="date" class="form-control" id="tempo_funcao" name="tempo_funcao" value="{{ old('tempo_funcao') }}" required>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                      <label for="recipient-vaga" class="col-form-label">Função do Acidentado: <label style="color: red">*</label></label>
                      <select id="funcao" name="funcao" class="form-select" required>
                        <option value=""> Selecione a Função do Acidentado...</option>
                        @foreach($cargos as $cargo)
                          <option value="<?php echo $cargo->nome; ?>" <?php if(old('funcao') == $cargo->nome) { echo 'selected'; } ?>>{{ $cargo->nome }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Idade: <label style="color: red">*</label></label>
                      <input type="number" min="16" max="80" class="form-control" id="idade" name="idade" value="{{ old('idade') }}" placeholder="Informe sua Idade..." required>
                    </div>
                  </div>
                  <hr>
                  <div>
                    <h5 class="modal-title text-dark">Informações do Evento:<?php ?></h5>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                     <label for="recipient-colaborador" class="col-form-label">Data do Evento: <label style="color: red">*</label></label>
                     <input type="date" class="form-control" id="data_evento" name="data_evento" value="{{ old('data_evento') }}" required onchange="pegarDiaSemana(this)">
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-vaga" class="col-form-label">Dia da Semana: <label style="color: red">*</label></label>
                      <input type="text" class="form-control" id="dia_semana" name="dia_semana" value="{{ old('dia_semana') }}" required readonly>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Tipo de Acidente: <label style="color: red">*</label></label>
                      <select id="tipo" name="tipo" class="form-select" required>
                        <option value=""> Selecione o Tipo...</option>
                        <option value="acidente_tipico" <?php if(old('tipo') == 'acidente_tipico') { echo 'selected'; } ?>>Acidente Típico</option>
                        <option value="acidente_trajeto" <?php if(old('tipo') == 'acidente_trajeto') { echo 'selected'; } ?>>Acidente Trajeto</option>
                        <option value="incidente" <?php if(old('tipo') == 'incidente') { echo 'selected'; } ?>>Incidente</option>
                      </select>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Situação do Acidente: <label style="color: red">*</label></label>
                      <input type="text" class="form-control" id="situacao" name="situacao" value="{{ old('situacao') }}" placeholder="Informe a Situação do Acidente..." required>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Agente Causador do Acidente: <label style="color: red">*</label></label>
                      <select id="agente_causador" name="agente_causador" class="form-select" required onchange="agenteCausador(this)">
                        <option value=""> Selecione o Agente Causador do Acidente...</option>
                        @foreach($agente_c as $ac)
                          <option value="<?php echo $ac->descricao; ?>" <?php if(old('agente_causador') == $ac->descricao) { echo 'selected'; } ?>>{{ $ac->descricao }}</option>
                        @endforeach
                        <option value="outros">Outros</option>
                      </select>
                      <input type="text" class="form-control" id="agente_causador_outros" name="agente_causador_outros" value="{{ old('agente_causador_outros') }}" hidden>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Turno do Acidente: <label style="color: red">*</label></label>
                      <select id="turno" name="turno" class="form-select" required>
                        <option value=""> Selecione o Turno...</option>
                        <option value="manha" <?php if(old('turno') == 'manha') { echo 'selected'; } ?>>Manhã</option>
                        <option value="tarde" <?php if(old('turno') == 'tarde') { echo 'selected'; } ?>>Tarde</option>
                        <option value="noite" <?php if(old('turno') == 'noite') { echo 'selected'; } ?>>Noite</option>
                        <option value="madrugada" <?php if(old('turno') == 'madrugada') { echo 'selected'; } ?>>Madrugada</option>
                      </select>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Momento da Jornada: <label style="color: red">*</label></label>
                      <select id="momento_jornada" name="momento_jornada" class="form-select" required>
                        <option value=""> Selecione o Momento da Jornada...</option>
                        <option value="antes" <?php if(old('momento_jornada') == 'antes') { echo 'selected'; } ?>>Antes de chegar ao trabalho</option>
                        <option value="inicio" <?php if(old('momento_jornada') == 'inicio') { echo 'selected'; } ?>>Início (Primeiras 3h de Trabalho)</option>
                        <option value="meio" <?php if(old('momento_jornada') == 'meio') { echo 'selected'; } ?>>Meio da Jornada</option>
                        <option value="fim" <?php if(old('momento_jornada') == 'fim') { echo 'selected'; } ?>>Fim (Últimas 3h de Trabalho)</option>
                      </select>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Local do Incidente: <label style="color: red">*</label></label>
                      <input type="text" class="form-control" id="local_incidente" name="local_incidente" value="{{ old('local_incidente') }}" placeholder="Informe o Local do Incidente..." required>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Horário do Acidente: <label style="color: red">*</label></label>
                      <input type="time" class="form-control" id="horario_acidente" name="horario_acidente" value="{{ old('horario_acidente') }}" placeholder="Informe o Horário do Acidente..." required>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Parte do Corpo Atingida: <label style="color: red">*</label></label>
                      <select id="parte_corpo_atingida" name="parte_corpo_atingida" class="form-select" required>
                        <option value=""> Selecione a Parte do Corpo Atingida...</option>
                        @foreach($partes_corpo as $pc)
                          <option value="<?php echo $pc->descricao; ?>" <?php if(old('parte_corpo_atingida') == $pc->descricao) { echo 'selected'; } ?>>{{ $pc->descricao }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Status do Acidente: <label style="color: red">*</label></label>
                      <select id="status" name="status" class="form-select" required>
                        <option value=""> Selecione o Status...</option>
                        <option value="com_afastamento" <?php if(old('status') == 'com_afastamento') { echo 'selected'; } ?>>Com afastamento</option>
                        <option value="sem_afastamento" <?php if(old('status') == 'sem_afastamento') { echo 'selected'; } ?>>Sem afastamento</option>
                      </select>
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Dias de Afastamento: <label style="color: red">*</label></label>
                      <input type="number" min="1" max="100" class="form-control" id="dias_afastamento" name="dias_afastamento" value="{{ old('dias_afastamento') }}" placeholder="Informe o Número de Dias de Afastamento...">
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Responsável pelo Preenchimento: <label style="color:red">*</label></label>
                      <input type="text" class="form-control" id="responsavel_preenchimento" name="responsavel_preenchimento" required value="{{ old('responsavel_preenchimento') }}" placeholder="Informe o nome do Responsável pelo Preenchimento" />
                    </div>
                    <div class="m-2 col-5">
                      <label for="recipient-area" class="col-form-label">Após Quantas Horas Trabalhadas: <label style="color: red">*</label></label>
                      <input type="number" min="0" class="form-control" id="apos_horas_trabalhadas" name="apos_horas_trabalhadas" required value="{{ old('apos_horas_trabalhadas') }}" placeholder="Informe Após Quantas Horas Trabalhadas" />
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2 col-12">
                      <label for="recipient-area" class="col-form-label">Descrição do Acidente: <label style="color: red">*</label></label>
                      <textarea class="form-control" rows="10" id="descricao_acidente" name="descricao_acidente" required>{{ old('descricao_acidente') }}</textarea>
                    </div>
                  </div>
                 </div> <br>
                </div>
                 @if (isset($token))
                   <input class="form-control" type="text" name="token" id="token" placeholder="cole aqui o TOKEN" />
                   <center>
                    <a href="{{ route('indicadorAcidenteInfo') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> &nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success m-1 btn-sm" value="Salvar" id="Salvar" name="Salvar"> ENVIAR</button>
                   </center>
                 @else
                   <center>
                    <a href="{{ route('indicadorAcidenteInfo') }}" id="Voltar" name="Voltar" type="button"  class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> &nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success m-1 btn-sm" value="Salvar" id="Salvar" name="Salvar">ENVIAR</button>
                   </center>
                 @endif
                </form>
               </div>
             </div>
            </div>
          </div>
         </div>
        </section>
    </main>
</body>
</html>