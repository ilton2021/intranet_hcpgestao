@extends('layouts.app')

<body onselectstart="return false">

    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-start align-items-center">
                    <i class="bi bi-person-workspace" style="font-size:30px"> Acompanhamento de Experiência</i>
                </div>
            </div>
        </section>
        @if ($errors->any())
          @foreach ($errors->all() as $error)
            @if ($error == 'Avaliação de Experiência Cadastrado com Sucesso!')
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
                <form action="{{ route('avaliacaoExpStore') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <div class="border-bottom border-gray p-1">
                  <div>
                    <h5 class="modal-title text-dark">Informações do Solicitante:<?php ?></h5>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                     <label for="recipient-colaborador" class="col-form-label">Nome do Colaborador: <label style="color: red">*</label></label>
                     <input type="text" class="form-control" style="width: 700px" id="colaborador" name="colaborador" value="{{ old('colaborador') }}" placeholder="Informe o Nome Completo do Colaborador..." required>
                    </div>
                    <div class="m-2">
                      <label for="recipient-vaga" class="col-form-label">Vaga: <label style="color: red">*</label></label>
                      <input type="text" class="form-control" style="width: 400px" id="vaga" name="vaga" value="{{ old('vaga') }}" placeholder="Informe o Nome da Vaga..." required>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                     <label for="recipient-gestor" class="col-form-label">Nome do Gestor: <label style="color: red">*</label></label>
                     <input type="text" class="form-control" style="width: 700px" id="gestor" name="gestor" value="{{ old('gestor') }}" placeholder="Informe o Nome Completo do Gestor..." required>
                    </div>
                    <div class="m-2">
                      <label for="recipient-unidade" class="col-form-label">Unidade da Vaga:<label style="color: red">*</label></label>
                      <select id="unidade" name="unidade" class="form-control" style="width: 400px" required>
                        <option value=""> Selecione a Unidade...</option>
                        @foreach($unidades as $und)
                          <option value="<?php echo $und->id; ?>">{{ $und->sigla }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label">Situação do Colaborador<label style="color: red">*</label></label>  
                        <select id="continuidade" style="width: 260px" name="continuidade" class="form-control" required>
                          <option {{ old('continuidade') == '' ? 'selected' : '' }} value=""> Selecione...</option>
                          <option {{ old('continuidade') == 'Vencimento45' ? 'selected' : '' }} value="Vencimento45">Vencimento 45</option>
                          <option {{ old('continuidade') == 'Prorrogacao90' ? 'selected' : '' }} value="Prorrogacao90">Prorrogação 90</option>
                        </select>
                    </div>
                    <div class="m-2">
                      <label for="message-text" class="col-form-label">Continuidade do Colaborador<label style="color: red">*</label></label> 
                        <select id="resultado" style="width: 260px" name="resultado" class="form-control" required>
                          <option {{ old('resultado') == '' ? 'selected' : '' }} value=""> Selecione...</option>
                          <option {{ old('resultado') == 'Aprovado' ? 'selected' : '' }} value="Aprovado">Aprovado</option>
                          <option {{ old('resultado') == 'Reprovado' ? 'selected' : '' }} value="Reprovado">Reprovado</option>
                          <option {{ old('resultado') == 'Prorrogar' ? 'selected' : '' }} value="Prorrogar">Prorrogar</option>
                        </select>
                    </div>
                    <div class="m-2">
                      <label for="recipient-area" class="col-form-label">Área: <label style="color: red">*</label></label>
                      <input type="text" class="form-control" style="width: 400px" id="area" name="area" value="{{ old('area') }}"  placeholder="Informe a Área...">
                    </div>
                  </div>
                 </div> <br>
                 <div class="mt-2">
                    <div class="">
                      <h5 class="modal-title text-dark"><center>Detalhamento de Referências:</center></h5>
                    </div>
                  <div class="d-flex justify-content-center">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>0-25%: Falta de intimidade com tendência a desinteresse;</b></label> <br>
                      <label for="message-text" class="col-form-label"><b>26-50%: Pouca familiaridade com existência de interesse e tendência a desenvolver;</b></label> <br>
                      <label for="message-text" class="col-form-label"><b>51-75%: Pontos positivos pertinentes e facilidade de desenvolvimento;</b></label> <br>
                      <label for="message-text" class="col-form-label"><b>Acima de 76% : Intimidade e criatividade;</b></label>
                    </div>
                  </div>
                 </div> <br>
                 <div class="mt-2">
                    <div class="">
                      <h5 class="modal-title text-dark">Marque de Acordo com o Perfil do Colaborador:</h5>
                    </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>1) CAPACIDADE PARA APRENDER: (Habilidade em reter/assimilar informações recebidas e usá-las adequadamente)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="capacidade" name="capacidade"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="capacidade" name="capacidade"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="capacidade" name="capacidade"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="capacidade" name="capacidade"> > 76%</label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>2) PRODUTIVIDADE: (Ritmo de trabalho, aliado ao rendimento e a qualidade com que o colaborador desenvolve as tarefas)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="produtividade" name="produtividade"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="produtividade" name="produtividade"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="produtividade" name="produtividade"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="produtividade" name="produtividade"> > 76%</label>
                    </div> 
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>3) INICIATIVA: (Habilidade em agir/executar as tarefas e solucionar problemas sem necessidade de supervisão constante)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="iniciativa" name="iniciativa"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="iniciativa" name="iniciativa"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="iniciativa" name="iniciativa"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="iniciativa" name="iniciativa"> > 76%</label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>4) COLABORAÇÃO: (Disposição que o funcionário possui em ajudar a equipe e à empresa, de uma forma geral através de atitudes espontâneas)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="colaboracao" name="colaboracao"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="colaboracao" name="colaboracao"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="colaboracao" name="colaboracao"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="colaboracao" name="colaboracao"> > 76%</label>
                    </div> 
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>5) RELACIONAMENTO: (Habilidade no trato com as pessoas, independente do nível hierárquico, influenciando positivamente e obtendo aceitação pessoal)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="relacionamento" name="relacionamento"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="relacionamento" name="relacionamento"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="relacionamento" name="relacionamento"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="relacionamento" name="relacionamento"> > 76%</label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>6) PONTUALIDADE: (Cumprimento dos horários de trabalho)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="pontualidade" name="pontualidade"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="pontualidade" name="pontualidade"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="pontualidade" name="pontualidade"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="pontualidade" name="pontualidade"> > 76%</label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>7) ASSIDUIDADE: (Cumprimento da frequência de trabalho)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="assiduidade" name="assiduidade"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="assiduidade" name="assiduidade"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="assiduidade" name="assiduidade"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="assiduidade" name="assiduidade"> > 76%</label>
                    </div>
                   </div>
                  <div class="d-flex justify-content-between">
                    <div class="m-2">
                      <label for="message-text" class="col-form-label"><b>8) SEGURANÇA: (Habilidade em manter os cuidados necessários no desenvolvimento das tarefas, preservando a si e ao seu próximo para evitar acidentes)</b></label>
                      <br><input class="form-check-input" type="radio" title="Falta de intimidade com tendência a desinteresse" value="1" id="seguranca" name="seguranca"> 0-25%
                      <input class="form-check-input" type="radio" title="Pouca familiaridade com existência de interesse e tendência a desenvolver" value="2" id="seguranca" name="seguranca"> 26-50%</label> 
                      <input class="form-check-input" type="radio" title="Pontos positivos pertinentes e facilidade de desenvolvimento" value="3" id="seguranca" name="seguranca"> 51-75%</label>
                      <input class="form-check-input" type="radio" title="Intimidade e criatividade" value="4" id="seguranca" name="seguranca"> > 76%</label>
                    </div>
                  </div>
                 </div>
                </div>
                 @if (isset($token))
                   <input class="form-control" type="text" name="token" id="token" placeholder="cole aqui o TOKEN" />
                   <center><button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button></center>
                 @else
                   <center><button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button></center>
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