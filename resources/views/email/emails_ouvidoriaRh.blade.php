<div class="card text-center" style="display: flex; justify-content: center;">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="card" style="width: 40rem; border: 1px solid green; border-radius: 5px;">
            <div class="border-bottom border-gray p-1">

                <div style="display:inline; justify-content:center; margin-top:10px;">
                    <img src="{{ asset('assets/img/logo4.jpeg') }}" width="400px" style="margin-left:40px"
                        alt="Card image cap" />
                    <img src="{{ asset('assets/img/ouvidoriarh.jpeg') }}" width="50px" alt="Card image cap" />
                </div>


                <div style="display: flex; justify-content: center; margin-top:10px;">

                    <h5 class="modal-title text-dark"><strong>Informações do solicitante</strong></h5>
                </div>
                <div style="margin-left:10px;margin-top:5px;">
                    <div class="m-1">
                        <label type="hidden" for="recipient-name" class="col-form-label"><strong> Tipo de
                                colaborador:</strong></label>
                        <label type="hidden" for="recipient-name" class="col-form-label">{{ $tipocolaborador }}</label>
                    </div>
                    <div class="m-1">
                        <label type="hidden" for="recipient-name"
                            class="col-form-label"><strong>E-mail:</strong></label>
                        <label type="hidden" for="recipient-name" class="col-form-label">{{ $nome }}</label>
                    </div>
                    <div class="m-1">
                        <label type="hidden" for="recipient-name" class="col-form-label"><strong> Telefone(Ramal):
                            </strong></label>
                        <label type="hidden" for="recipient-name" class="col-form-label">{{ $telefone }}</label>
                    </div>
                </div>
                <div style="margin-left:10px;margin-top:5px;">
                    <div class="m-1">
                        <label type="hidden" for="recipient-name"
                            class="col-form-label"><strong>Celular:</strong></label>
                        <label type="hidden" for="recipient-name" class="col-form-label">{{ $celular }}</label>
                    </div>
                    <div class="m-1">
                        <label for="recipient-name" class="col-form-label"><strong>Setor:</strong></label>
                        <label for="recipient-name" class="col-form-label">{{ $setor }}</label>
                    </div>
                    <div class="m-1">
                        <label for="recipient-name" class="col-form-label"><strong>Dara da ocorrência:</strong></label>
                        <label for="recipient-name" class="col-form-label">{{ $dtocorren }}</label>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <div style="display: flex; justify-content: center;margin-top:10px;">
                    <h5 class="modal-title text-dark"><strong>Informações do atendimento</strong></h5>
                </div>
                <div style="margin-left:10px">
                    <div class="m-2">
                        <label for="message-text" class="col-form-label"><strong>Qual a natureza desta
                                solicitação:</strong> </label>
                        <label for="message-text" class="col-form-label">{{ $solicitacao }}</label>
                    </div>
                    <div class="m-2">
                        <label for="message-text" class="col-form-label"><strong>Escreva uma mensagem descrevendo
                                o ocorrido:</strong></label>
                        <p for="message-text" class="col-form-label">{{ $texto }}</p>
                        <input type="hidden" class="form-control" id="texto" name="texto"
                            value="{{ $texto }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
