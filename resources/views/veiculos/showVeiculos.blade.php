@extends('layouts.adm')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}" />
<div class="container-fluid">
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-md-12 text-center">
            <h5 style="font-size: 18px;"><b>CADASTRO DE VEÍCULOS:</b></h5>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-success">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <table class="table" id="table_pesq">
                <form action="{{ route('pesquisaVeiculos') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <tr>
                        <td style="width: 400px;">
                            <input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control form-control-sm" />
                        </td>
                        <td style="width: 150px;">
                            <select id="pesq2" name="pesq2" style="width: 150px;" class="form-control form-control-sm">
                                <option id="pesq2" name="pesq2" value="id">Id</option>
								<option id="pesq2" name="pesq2" value="matricula">Matricula</option>
                                <option id="pesq2" name="pesq2" value="nome">Colaborador</option>
                                <option id="pesq2" name="pesq2" value="placa">Placa</option>
                            </select>
                        </td>
                        <td>
                            <input type="submit" id="btn" name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
                        </td>
                        <td>
                            <p align="right">
                                <a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
                            </p>
                        </td>
                    </tr>
            </table>
            <div class="responsive">
                <table class="table table-sm " id="my_table">
                    <thead class="bg-success">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Placa</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Cor veiculo</th>
							<th scope="col">Matricula</th>
                            <th scope="col">Colaborador</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Função</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($veiculos as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->placa}}</td>
                            <td>{{$v->marcamodelo}}</td>
                            <td>{{$v->cor}}</td>
							<td>{{$v->matricula}}</td>
                            <td>{{$v->nome}}</td>
                            <td>{{$v->telefone}}</td>
                            <td>{{$v->setor}}</td>
                            <td>{{$v->funcao}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <table>
                <tr>
                    <td> {{ $veiculos->appends(['pesq' => isset($pesq) ? $pesq : '','pesq2' => isset($pesq2) ? $pesq2 : ''])->links() }} </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</body>