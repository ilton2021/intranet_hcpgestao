@extends('layouts.app')
<link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}" />

<body>
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $unidade[0]->sigla }} - {{ $unidade[0]->nome }} </h4>
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Unidades Detalhes</li>
                    </ol>
                </div>
            </div>
        </section>

        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-wrapper align-items-center">
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage') }}/{{ $unidade[0]->caminho }}" alt=""
                                        width="100px">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="portfolio-info">
                            <h3>Informações da Unidade</h3>
                            <ul>
                                <li><strong>Horário</strong>: {{ $unidade[0]->horario }}</li>
                                <li><strong>Telefone</strong>: {{ $unidade[0]->telefone }} </li>
                                <li><strong>Ouvidoria</strong>: {{ $unidade[0]->ouvidoria }} </li>
                                <li><strong>Endereço</strong>: {{ $unidade[0]->endereco }} </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <p align="justify">
                            {{ $unidade[0]->texto }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- SEÇÃO DE DESTAQUES -->
        <?php $qtdDestaques = sizeof($destaques); ?>
        @if ($qtdDestaques > 0)
            <section id="testimonials" class="text-center"
                style="background-image: url('../public/assets/img/destaque_fundo.jpg')">
                <div class="section-title">
                    <h2>Destaques</h2>
                </div>
                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($destaques as $destaque)
                            <?php $data_a = date('d-m-Y', strtotime('now'));
                            $data_f = date('d-m-Y', strtotime($destaque->data_fim));
                            $data_i = date('d-m-Y', strtotime($destaque->data_inicio));
                            ?>
                            @if (strtotime($data_a) >= strtotime($data_i) && strtotime($data_a) <= strtotime($data_f))
                                <div class="swiper-slide">

                                    <div class="testimonial-item"><br><br>
                                        <div class="text-center" style="height:320px; margin-top:-90px;">
                                            @if ($destaque->caminho !== '')
                                                <a
                                                    href="{{ route('destaquesDetalhes', [$unidade[0]->id, $destaque->id]) }}"><img
                                                        class="rounded" style="height:320px"
                                                        src="{{ asset('storage') }}/{{ $destaque->caminho }}"
                                                        alt=""></a>
                                            @else
                                                <iframe class="rounded" width="527" height="280"
                                                    src="{{ $destaque->video }}" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                            @endif
                                        </div>
                                        <h3>{{ $destaque->titulo }}</h3><br>
                                        <div style="margin-left:250px; margin-right:250px;">
                                            <p align="justify">
                                                {{ substr($destaque->subtitulo, 0, 300) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div> <br><br><br><br><br>
                    <div class="swiper-pagination"></div>
                </div>
                </div>
            </section>
        @endif
        <?php $a = 0; ?>
        <section id="team" class="team section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Mural de Avisos</h2>
                </div>
                <div class="row">
                    @foreach ($murais as $mural)
                        <?php $data_a = date('d-m-Y', strtotime('now'));
                        $data_f = date('d-m-Y', strtotime($mural->data_fim));
                        $data_i = date('d-m-Y', strtotime($mural->data_inicio));
                        ?>
                        @if (strtotime($data_a) >= strtotime($data_i) && strtotime($data_a) <= strtotime($data_f))
                            @if ($a < 4)
                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                                    <div class="member">
                                    <div class="member-img text-center" style="height:200px;">
                                            @if ($mural->tipo == 1)
                                                @if ($mural->caminho !== '')
                                                    <a href="{{ asset('storage') }}/{{ $mural->caminho }}"
                                                        data-gallery="portfolioGallery" class="portfolio-lightbox"
                                                        title="<?php echo $mural->titulo; ?>">
                                                        <img src="{{ asset('storage') }}/{{ $mural->caminho }}"
                                                            class="img-fluid" alt="" style="height:200px;">
                                                    </a>
                                                @endif
                                            @else
                                                @if ($mural->video !== '')
                                                    <a href="{{ $mural->video }}" type="button" data-toggle="modal"
                                                        data-gallery="portfolioGallery" class="portfolio-lightbox">
                                                        @if ($mural->videominiatura == '')
                                                            <img style="width:300px;"
                                                                src="http://img.youtube.com/vi/<?php echo explode('/', $mural->video)[4]; ?>/0.jpg"
                                                                class="img-fluid" alt="">
                                                        @else
                                                            <img style="width:300px;"
                                                                src="{{ asset('storage') }}/{{ $mural->videominiatura }}"
                                                                class="img-fluid" alt="">
                                                        @endif
                                                    </a>
                                                @endif
                                            @endif
                                            <div class="social"> </div>
                                        </div>
                                        <div class="member-info">
                                            <h4>{{ $mural->titulo }}</h4>
                                            <span>{{ $mural->texto }}</span>
                                        </div>
                                    </div>
                                </div>
								<?php $a++; ?>
                            @endif
                        @endif
                    @endforeach
                </div>
                @if ($a > 3)
                    <center><a href="{{ route('muraisDetalhes',$murais[0]->id) }}" target="_blank"
                            class="btn btn-sm btn-info">Mais...</a>
                    </center>
                @endif
        </section>
        @if($unidade[0]->id == 2 || $unidade[0]->id == 6 || $unidade[0]->id == 7 || $unidade[0]->id == 8)
        <section id="team" class="team section-bg">
         <div class="container">
            <div class="section-title">
            <h2>CARDÁPIO</h2>
            </div>
            <div class="row mt-5">
             <center>
              <div class="col-lg-4">
                <div class="info">
                 <div class="email">
                    <a href="{{ route('cardapio', $unidade[0]->id) }}">
                    <h4><i class="bi bi-calendar-day-fill"> Cardápio do Dia</i></h4>
                    </a>
                 </div>
                </div>
              </div>
             </center>
            </div>
         </div>
        </section>
        @endif
        @if ($unidade[0]->id == 7)
            <section id="team" class="team section-bg">
            <div class="container">
                <div class="section-title">
                <h2>Pesquisa de Clima</h2>
                </div>
                <div class="row mt-5">
                <center>
                <div class="col-lg-4">
                    <div class="info">
                    <div class="email">
                        <a href="{{ route('iniciarForm') }}">
                        <h4><i class="bi bi-calendar-day-fill"> Pesquisa de Clima</i></h4>
                        </a>
                    </div>
                    </div>
                </div>
                </center>
                </div>
            </div>
            </section>
            <section id="team" class="team section-bg">
                <div class="container">
                    <div class="section-title">
                        <h2>Manual da Farmácia HSS</h2>
                    </div>
                    <div class="row mt-5">
                        <center>
                            <div class="col-lg-4">
                                <div class="info">
                                    <div class="email">
                                        <a href="{{ route('manualFarmacia') }}">
                                            <h4><i class="bi bi-clipboard-plus"> Manual da Farmácia HSS</i></h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </section>
        @endif
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>Ouvidoria {{ $unidade[0]->sigla }}</h2>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        <div class="info">
                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>E-mail:</h4>
                                <p>{{ $unidade[0]->ouvidoria }}</p>
                            </div>
                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Telefone:</h4>
                                <p>{{ $unidade[0]->telefone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mt-5 mt-lg-0">
                        <form action="{{ \Request::route('enviarEmail', $unidade[0]->id) }}" method="post"
                            role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Seu Nome" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Seu E-mail" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Assunto" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Mensagem" required></textarea>
                            </div><br><br>
                            <div class="text-center">
                                <input type="submit" id="enviar" name="enviar" class="btn btn-sm btn-info"
                                    value="Enviar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="{{route('storeVeiculo',$id_und)}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <p class="m-3 p-2 bg-secondary text-white text-center rounded">
                            Bem-vindo(a), este é um canal para você, integrante do HMR, efetuar o cadastro do seu
                            veiculo.
                        </p>
                        <p class="m-2 p-2 text-center">
                            Ao preecher esse formulário, garantimos a todos o direito de total sigilo.
                        </p>
                    </div>

                    <div class="modal-body">

                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        @if ($error == 'Veiculo Cadastrado com Sucesso!')
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
                                <h5 class="modal-title text-dark">Dados do colaborador</h5>
                            </div>
                            <div class="d-flex justify-content-around flex-wrap">
                                <div class="">
                                    <label for="recipient-name" class="col-form-label">Setor:</label>
                                    <input type="text" class="form-control" id="setor" name="setor" value="{{ old('setor') }}">
                                </div>
                                <div class="">
                                    <label for="recipient-name" class="col-form-label">Função:</label>
                                    <input type="text" class="form-control" id="funcao" name="funcao" value="{{ old('funcao') }}">
                                </div>
								<div class="">
                                    <label for="recipient-name" class="col-form-label">Matricula:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                                </div>
                                <div class="">
                                    <label for="recipient-name" class="col-form-label">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                                </div>
                                <div class="">
                                    <label for="recipient-name" class="col-form-label">Telefone:</label>
                                    <input type="text" class="form-control" name="telefone" id="telefone" maxlength="15" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="">
                                <h5 class="modal-title text-dark">Dados do veiculo:</h5>
                            </div>
                            <div class="d-flex justify-content-around flex-wrap">
                                <div class="m-1">
                                    <label for="message-text" class="col-form-label"><label style="color: red">*</label>Placa:</label>
                                    <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa') }}" maxlength="7" style="text-transform: uppercase;">
                                </div>
                                <div class="d-flex flex-column m-1">
                                    <label for="message-text" class="col-form-label"><label style="color: red">*</label>Tipo:</label>

                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option {{ old('tipo') == 'carro' ? 'selected' : '' }} value="carro">
                                            Carro</option>
                                        <option {{ old('tipo') == 'moto' ? 'selected' : '' }} value="moto">
                                            Moto</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column m-1">
                                    <label for="message-text" class="col-form-label"><label style="color: red">*</label>Marca/modelo:</label>
                                    <div id="carro">
                                        <select class="form-control" id="marca" name="marca" style="width: 250px">
                                            <option {{ old('marca') == 'ACURA-INTEGRA' ? 'selected' : '' }} value='ACURA-INTEGRA'>ACURA-INTEGRA </option>
                                            <option {{ old('marca') == 'ACURA-LEGEND' ? 'selected' : '' }} value='ACURA-LEGEND'>ACURA-LEGEND </option>
                                            <option {{ old('marca') == 'ACURA-NSX' ? 'selected' : '' }} value='ACURA-NSX'>ACURA-NSX </option>
                                            <option {{ old('marca') == 'AGRALE-MARRUA' ? 'selected' : '' }} value='AGRALE-MARRUA'>AGRALE-MARRUA </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-145' ? 'selected' : '' }} value='ALFA ROMEO-145'>ALFA ROMEO-145 </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-147' ? 'selected' : '' }} value='ALFA ROMEO-147'>ALFA ROMEO-147 </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-155' ? 'selected' : '' }} value='ALFA ROMEO-155'>ALFA ROMEO-155 </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-156' ? 'selected' : '' }} value='ALFA ROMEO-156'>ALFA ROMEO-156 </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-164' ? 'selected' : '' }} value='ALFA ROMEO-164'>ALFA ROMEO-164 </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-166' ? 'selected' : '' }} value='ALFA ROMEO-166'>ALFA ROMEO-166 </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-2300' ? 'selected' : '' }} value='ALFA ROMEO-2300'>ALFA ROMEO-2300 </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-SPIDER' ? 'selected' : '' }} value='ALFA ROMEO-SPIDER'>ALFA ROMEO-SPIDER </option>
                                            <option {{ old('marca') == 'AM GEN-HUMMER' ? 'selected' : '' }} value='AM GEN-HUMMER'>AM GEN-HUMMER </option>
                                            <option {{ old('marca') == 'KIA-AM-825' ? 'selected' : '' }} value='KIA-AM-825'>KIA-AM-825 </option>
                                            <option {{ old('marca') == 'KIA-HI-TOPIC' ? 'selected' : '' }} value='KIA-HI-TOPIC'>KIA-HI-TOPIC </option>
                                            <option {{ old('marca') == 'KIA-ROCSTA' ? 'selected' : '' }} value='KIA-ROCSTA'>KIA-ROCSTA </option>
                                            <option {{ old('marca') == 'KIA-TOPIC' ? 'selected' : '' }} value='KIA-TOPIC'>KIA-TOPIC </option>
                                            <option {{ old('marca') == 'KIA-TOWNER' ? 'selected' : '' }} value='KIA-TOWNER'>KIA-TOWNER </option>
                                            <option {{ old('marca') == 'AUDI-100' ? 'selected' : '' }} value='AUDI-100'>AUDI-100 </option>
                                            <option {{ old('marca') == 'AUDI-80' ? 'selected' : '' }} value='AUDI-80'>
                                                AUDI-80 </option>
                                            <option {{ old('marca') == 'AUDI-A1' ? 'selected' : '' }} value='AUDI-A1'>
                                                AUDI-A1 </option>
                                            <option {{ old('marca') == 'AUDI-A3' ? 'selected' : '' }} value='AUDI-A3'>
                                                AUDI-A3 </option>
                                            <option {{ old('marca') == 'AUDI-A4 SEDAN' ? 'selected' : '' }} value='AUDI-A4 SEDAN'>AUDI-A4 SEDAN </option>
                                            <option {{ old('marca') == 'AUDI-A5 COUPE' ? 'selected' : '' }} value='AUDI-A5 COUPE'>AUDI-A5 COUPE </option>
                                            <option {{ old('marca') == 'AUDI-A6 SEDAN' ? 'selected' : '' }} value='AUDI-A6 SEDAN'>AUDI-A6 SEDAN </option>
                                            <option {{ old('marca') == 'AUDI-A7' ? 'selected' : '' }} value='AUDI-A7'>
                                                AUDI-A7 </option>
                                            <option {{ old('marca') == 'AUDI-A8' ? 'selected' : '' }} value='AUDI-A8'>
                                                AUDI-A8 </option>
                                            <option {{ old('marca') == 'AUDI-Q3' ? 'selected' : '' }} value='AUDI-Q3'>
                                                AUDI-Q3 </option>
                                            <option {{ old('marca') == 'AUDI-Q5' ? 'selected' : '' }} value='AUDI-Q5'>
                                                AUDI-Q5 </option>
                                            <option {{ old('marca') == 'AUDI-Q7' ? 'selected' : '' }} value='AUDI-Q7'>
                                                AUDI-Q7 </option>
                                            <option {{ old('marca') == 'AUDI-R8' ? 'selected' : '' }} value='AUDI-R8'>
                                                AUDI-R8 </option>
                                            <option {{ old('marca') == 'AUDI-RS3' ? 'selected' : '' }} value='AUDI-RS3'>AUDI-RS3 </option>
                                            <option {{ old('marca') == 'AUDI-RS4' ? 'selected' : '' }} value='AUDI-RS4'>AUDI-RS4 </option>
                                            <option {{ old('marca') == 'AUDI-RS5' ? 'selected' : '' }} value='AUDI-RS5'>AUDI-RS5 </option>
                                            <option {{ old('marca') == 'AUDI-RS6' ? 'selected' : '' }} value='AUDI-RS6'>AUDI-RS6 </option>
                                            <option {{ old('marca') == 'AUDI-S3' ? 'selected' : '' }} value='AUDI-S3'>
                                                AUDI-S3 </option>
                                            <option {{ old('marca') == 'AUDI-S4 SEDAN' ? 'selected' : '' }} value='AUDI-S4 SEDAN'>AUDI-S4 SEDAN </option>
                                            <option {{ old('marca') == 'AUDI-S6 SEDAN' ? 'selected' : '' }} value='AUDI-S6 SEDAN'>AUDI-S6 SEDAN </option>
                                            <option {{ old('marca') == 'AUDI-S8' ? 'selected' : '' }} value='AUDI-S8'>
                                                AUDI-S8 </option>
                                            <option {{ old('marca') == 'AUDI-TT' ? 'selected' : '' }} value='AUDI-TT'>
                                                AUDI-TT </option>
                                            <option {{ old('marca') == 'AUDI-TTS' ? 'selected' : '' }} value='AUDI-TTS'>AUDI-TTS </option>
                                            <option {{ old('marca') == 'BUGGY-BUGGY' ? 'selected' : '' }} value='BUGGY-BUGGY'>BUGGY-BUGGY </option>
                                            <option {{ old('marca') == 'CADILLAC-DEVILLE' ? 'selected' : '' }} value='CADILLAC-DEVILLE'>CADILLAC-DEVILLE </option>
                                            <option {{ old('marca') == 'CADILLAC-ELDORADO' ? 'selected' : '' }} value='CADILLAC-ELDORADO'>CADILLAC-ELDORADO </option>
                                            <option {{ old('marca') == 'CADILLAC-SEVILLE' ? 'selected' : '' }} value='CADILLAC-SEVILLE'>CADILLAC-SEVILLE </option>
                                            <option {{ old('marca') == 'CBT-JAVALI' ? 'selected' : '' }} value='CBT-JAVALI'>CBT-JAVALI </option>
                                            <option {{ old('marca') == 'CHANA-MINI STAR FAMILY' ? 'selected' : '' }} value='CHANA-MINI STAR FAMILY'>CHANA-MINI STAR FAMILY </option>
                                            <option {{ old('marca') == 'CHANA-MINI STAR UTILITY' ? 'selected' : '' }} value='CHANA-MINI STAR UTILITY'>CHANA-MINI STAR UTILITY </option>
                                            <option {{ old('marca') == 'CHERY-CIELO' ? 'selected' : '' }} value='CHERY-CIELO'>CHERY-CIELO </option>
                                            <option {{ old('marca') == 'CHERY-FACE' ? 'selected' : '' }} value='CHERY-FACE'>CHERY-FACE </option>
                                            <option {{ old('marca') == 'CHERY-QQ' ? 'selected' : '' }} value='CHERY-QQ'>CHERY-QQ </option>
                                            <option {{ old('marca') == 'CHERY-S-18' ? 'selected' : '' }} value='CHERY-S-18'>CHERY-S-18 </option>
                                            <option {{ old('marca') == 'CHERY-TIGGO' ? 'selected' : '' }} value='CHERY-TIGGO'>CHERY-TIGGO </option>
                                            <option {{ old('marca') == 'CHRYSLER-300C' ? 'selected' : '' }} value='CHRYSLER-300C'>CHRYSLER-300C </option>
                                            <option {{ old('marca') == 'CHRYSLER-CARAVAN' ? 'selected' : '' }} value='CHRYSLER-CARAVAN'>CHRYSLER-CARAVAN </option>
                                            <option {{ old('marca') == 'CHRYSLER-CIRRUS' ? 'selected' : '' }} value='CHRYSLER-CIRRUS'>CHRYSLER-CIRRUS </option>
                                            <option {{ old('marca') == 'CHRYSLER-GRAN CARAVAN' ? 'selected' : '' }} value='CHRYSLER-GRAN CARAVAN'>CHRYSLER-GRAN CARAVAN </option>
                                            <option {{ old('marca') == 'CHRYSLER-LE BARON' ? 'selected' : '' }} value='CHRYSLER-LE BARON'>CHRYSLER-LE BARON </option>
                                            <option {{ old('marca') == 'CHRYSLER-NEON' ? 'selected' : '' }} value='CHRYSLER-NEON'>CHRYSLER-NEON </option>
                                            <option {{ old('marca') == 'CHRYSLER-PT CRUISER' ? 'selected' : '' }} value='CHRYSLER-PT CRUISER'>CHRYSLER-PT CRUISER </option>
                                            <option {{ old('marca') == 'CHRYSLER-SEBRING' ? 'selected' : '' }} value='CHRYSLER-SEBRING'>CHRYSLER-SEBRING </option>
                                            <option {{ old('marca') == 'CHRYSLER-STRATUS' ? 'selected' : '' }} value='CHRYSLER-STRATUS'>CHRYSLER-STRATUS </option>
                                            <option {{ old('marca') == 'CHRYSLER-TOWN E COUNTRY' ? 'selected' : '' }} value='CHRYSLER-TOWN E COUNTRY'>CHRYSLER-TOWN E COUNTRY </option>
                                            <option {{ old('marca') == 'CHRYSLER-VISION' ? 'selected' : '' }} value='CHRYSLER-VISION'>CHRYSLER-VISION </option>
                                            <option {{ old('marca') == 'CITROEN-AIRCROSS' ? 'selected' : '' }} value='CITROEN-AIRCROSS'>CITROEN-AIRCROSS </option>
                                            <option {{ old('marca') == 'CITROEN-AX' ? 'selected' : '' }} value='CITROEN-AX'>CITROEN-AX </option>
                                            <option {{ old('marca') == 'CITROEN-BERLINGO' ? 'selected' : '' }} value='CITROEN-BERLINGO'>CITROEN-BERLINGO </option>
                                            <option {{ old('marca') == 'CITROEN-BX' ? 'selected' : '' }} value='CITROEN-BX'>CITROEN-BX </option>
                                            <option {{ old('marca') == 'CITROEN-C3' ? 'selected' : '' }} value='CITROEN-C3'>CITROEN-C3 </option>
                                            <option {{ old('marca') == 'CITROEN-C4' ? 'selected' : '' }} value='CITROEN-C4'>CITROEN-C4 </option>
                                            <option {{ old('marca') == 'CITROEN-C5' ? 'selected' : '' }} value='CITROEN-C5'>CITROEN-C5 </option>
                                            <option {{ old('marca') == 'CITROEN-C6' ? 'selected' : '' }} value='CITROEN-C6'>CITROEN-C6 </option>
                                            <option {{ old('marca') == 'CITROEN-C8' ? 'selected' : '' }} value='CITROEN-C8'>CITROEN-C8 </option>
                                            <option {{ old('marca') == 'CITROEN-DS3' ? 'selected' : '' }} value='CITROEN-DS3'>CITROEN-DS3 </option>
                                            <option {{ old('marca') == 'CITROEN-EVASION' ? 'selected' : '' }} value='CITROEN-EVASION'>CITROEN-EVASION </option>
                                            <option {{ old('marca') == 'CITROEN-JUMPER' ? 'selected' : '' }} value='CITROEN-JUMPER'>CITROEN-JUMPER </option>
                                            <option {{ old('marca') == 'CITROEN-XANTIA' ? 'selected' : '' }} value='CITROEN-XANTIA'>CITROEN-XANTIA </option>
                                            <option {{ old('marca') == 'CITROEN-XM' ? 'selected' : '' }} value='CITROEN-XM'>CITROEN-XM </option>
                                            <option {{ old('marca') == 'CITROEN-XSARA' ? 'selected' : '' }} value='CITROEN-XSARA'>CITROEN-XSARA </option>
                                            <option {{ old('marca') == 'CITROEN-ZX' ? 'selected' : '' }} value='CITROEN-ZX'>CITROEN-ZX </option>
                                            <option {{ old('marca') == 'CROSS LANDER-CL-244' ? 'selected' : '' }} value='CROSS LANDER-CL-244'>CROSS LANDER-CL-244 </option>
                                            <option {{ old('marca') == 'CROSS LANDER-CL-330' ? 'selected' : '' }} value='CROSS LANDER-CL-330'>CROSS LANDER-CL-330 </option>
                                            <option {{ old('marca') == 'DAEWOO-ESPERO' ? 'selected' : '' }} value='DAEWOO-ESPERO'>DAEWOO-ESPERO </option>
                                            <option {{ old('marca') == 'DAEWOO-LANOS' ? 'selected' : '' }} value='DAEWOO-LANOS'>DAEWOO-LANOS </option>
                                            <option {{ old('marca') == 'DAEWOO-LEGANZA' ? 'selected' : '' }} value='DAEWOO-LEGANZA'>DAEWOO-LEGANZA </option>
                                            <option {{ old('marca') == 'DAEWOO-NUBIRA' ? 'selected' : '' }} value='DAEWOO-NUBIRA'>DAEWOO-NUBIRA </option>
                                            <option {{ old('marca') == 'DAEWOO-PRINCE' ? 'selected' : '' }} value='DAEWOO-PRINCE'>DAEWOO-PRINCE </option>
                                            <option {{ old('marca') == 'DAEWOO-RACER' ? 'selected' : '' }} value='DAEWOO-RACER'>DAEWOO-RACER </option>
                                            <option {{ old('marca') == 'DAEWOO-SUPER SALON' ? 'selected' : '' }} value='DAEWOO-SUPER SALON'>DAEWOO-SUPER SALON </option>
                                            <option {{ old('marca') == 'DAEWOO-TICO' ? 'selected' : '' }} value='DAEWOO-TICO'>DAEWOO-TICO </option>
                                            <option {{ old('marca') == 'DAIHATSU-APPLAUSE' ? 'selected' : '' }} value='DAIHATSU-APPLAUSE'>DAIHATSU-APPLAUSE </option>
                                            <option {{ old('marca') == 'DAIHATSU-CHARADE' ? 'selected' : '' }} value='DAIHATSU-CHARADE'>DAIHATSU-CHARADE </option>
                                            <option {{ old('marca') == 'DAIHATSU-CUORE' ? 'selected' : '' }} value='DAIHATSU-CUORE'>DAIHATSU-CUORE </option>
                                            <option {{ old('marca') == 'DAIHATSU-FEROZA' ? 'selected' : '' }} value='DAIHATSU-FEROZA'>DAIHATSU-FEROZA </option>
                                            <option {{ old('marca') == 'DAIHATSU-GRAN MOVE' ? 'selected' : '' }} value='DAIHATSU-GRAN MOVE'>DAIHATSU-GRAN MOVE </option>
                                            <option {{ old('marca') == 'DAIHATSU-MOVE VAN' ? 'selected' : '' }} value='DAIHATSU-MOVE VAN'>DAIHATSU-MOVE VAN </option>
                                            <option {{ old('marca') == 'DAIHATSU-TERIOS' ? 'selected' : '' }} value='DAIHATSU-TERIOS'>DAIHATSU-TERIOS </option>
                                            <option {{ old('marca') == 'DODGE-AVENGER' ? 'selected' : '' }} value='DODGE-AVENGER'>DODGE-AVENGER </option>
                                            <option {{ old('marca') == 'DODGE-DAKOTA' ? 'selected' : '' }} value='DODGE-DAKOTA'>DODGE-DAKOTA </option>
                                            <option {{ old('marca') == 'DODGE-JOURNEY' ? 'selected' : '' }} value='DODGE-JOURNEY'>DODGE-JOURNEY </option>
                                            <option {{ old('marca') == 'DODGE-RAM' ? 'selected' : '' }} value='DODGE-RAM'>DODGE-RAM </option>
                                            <option {{ old('marca') == 'DODGE-STEALTH' ? 'selected' : '' }} value='DODGE-STEALTH'>DODGE-STEALTH </option>
                                            <option {{ old('marca') == 'EFFA-M-100' ? 'selected' : '' }} value='EFFA-M-100'>EFFA-M-100 </option>
                                            <option {{ old('marca') == 'EFFA-PLUTUS' ? 'selected' : '' }} value='EFFA-PLUTUS'>EFFA-PLUTUS </option>
                                            <option {{ old('marca') == 'EFFA-START' ? 'selected' : '' }} value='EFFA-START'>EFFA-START </option>
                                            <option {{ old('marca') == 'EFFA-ULC' ? 'selected' : '' }} value='EFFA-ULC'>EFFA-ULC </option>
                                            <option {{ old('marca') == 'ENGESA-ENGESA' ? 'selected' : '' }} value='ENGESA-ENGESA'>ENGESA-ENGESA </option>
                                            <option {{ old('marca') == 'ENVEMO-CAMPER' ? 'selected' : '' }} value='ENVEMO-CAMPER'>ENVEMO-CAMPER </option>
                                            <option {{ old('marca') == 'ENVEMO-MASTER' ? 'selected' : '' }} value='ENVEMO-MASTER'>ENVEMO-MASTER </option>
                                            <option {{ old('marca') == 'FERRARI-348' ? 'selected' : '' }} value='FERRARI-348'>FERRARI-348 </option>
                                            <option {{ old('marca') == 'FERRARI-355' ? 'selected' : '' }} value='FERRARI-355'>FERRARI-355 </option>
                                            <option {{ old('marca') == 'FERRARI-360' ? 'selected' : '' }} value='FERRARI-360'>FERRARI-360 </option>
                                            <option {{ old('marca') == 'FERRARI-456' ? 'selected' : '' }} value='FERRARI-456'>FERRARI-456 </option>
                                            <option {{ old('marca') == 'FERRARI-550' ? 'selected' : '' }} value='FERRARI-550'>FERRARI-550 </option>
                                            <option {{ old('marca') == 'FERRARI-575M' ? 'selected' : '' }} value='FERRARI-575M'>FERRARI-575M </option>
                                            <option {{ old('marca') == 'FERRARI-612' ? 'selected' : '' }} value='FERRARI-612'>FERRARI-612 </option>
                                            <option {{ old('marca') == 'FERRARI-CALIFORNIA' ? 'selected' : '' }} value='FERRARI-CALIFORNIA'>FERRARI-CALIFORNIA </option>
                                            <option {{ old('marca') == 'FERRARI-F430' ? 'selected' : '' }} value='FERRARI-F430'>FERRARI-F430 </option>
                                            <option {{ old('marca') == 'FERRARI-F599' ? 'selected' : '' }} value='FERRARI-F599'>FERRARI-F599 </option>
                                            <option {{ old('marca') == 'FIAT-147' ? 'selected' : '' }} value='FIAT-147'>FIAT-147 </option>
                                            <option {{ old('marca') == 'FIAT-500' ? 'selected' : '' }} value='FIAT-500'>FIAT-500 </option>
                                            <option {{ old('marca') == 'FIAT-BRAVA' ? 'selected' : '' }} value='FIAT-BRAVA'>FIAT-BRAVA </option>
                                            <option {{ old('marca') == 'FIAT-BRAVO' ? 'selected' : '' }} value='FIAT-BRAVO'>FIAT-BRAVO </option>
                                            <option {{ old('marca') == 'FIAT-COUPE' ? 'selected' : '' }} value='FIAT-COUPE'>FIAT-COUPE </option>
                                            <option {{ old('marca') == 'FIAT-DOBLO' ? 'selected' : '' }} value='FIAT-DOBLO'>FIAT-DOBLO </option>
                                            <option {{ old('marca') == 'FIAT-DUCATO CARGO' ? 'selected' : '' }} value='FIAT-DUCATO CARGO'>FIAT-DUCATO CARGO </option>
                                            <option {{ old('marca') == 'FIAT-DUNA' ? 'selected' : '' }} value='FIAT-DUNA'>FIAT-DUNA </option>
                                            <option {{ old('marca') == 'FIAT-ELBA' ? 'selected' : '' }} value='FIAT-ELBA'>FIAT-ELBA </option>
                                            <option {{ old('marca') == 'FIAT-FIORINO' ? 'selected' : '' }} value='FIAT-FIORINO'>FIAT-FIORINO </option>
                                            <option {{ old('marca') == 'FIAT-FREEMONT' ? 'selected' : '' }} value='FIAT-FREEMONT'>FIAT-FREEMONT </option>
                                            <option {{ old('marca') == 'FIAT-GRAND SIENA' ? 'selected' : '' }} value='FIAT-GRAND SIENA'>FIAT-GRAND SIENA </option>
                                            <option {{ old('marca') == 'FIAT-IDEA' ? 'selected' : '' }} value='FIAT-IDEA'>FIAT-IDEA </option>
                                            <option {{ old('marca') == 'FIAT-LINEA' ? 'selected' : '' }} value='FIAT-LINEA'>FIAT-LINEA </option>
                                            <option {{ old('marca') == 'FIAT-MAREA' ? 'selected' : '' }} value='FIAT-MAREA'>FIAT-MAREA </option>
                                            <option {{ old('marca') == 'FIAT-OGGI' ? 'selected' : '' }} value='FIAT-OGGI'>FIAT-OGGI </option>
                                            <option {{ old('marca') == 'FIAT-PALIO' ? 'selected' : '' }} value='FIAT-PALIO'>FIAT-PALIO </option>
                                            <option {{ old('marca') == 'FIAT-PANORAMA' ? 'selected' : '' }} value='FIAT-PANORAMA'>FIAT-PANORAMA </option>
                                            <option {{ old('marca') == 'FIAT-PREMIO' ? 'selected' : '' }} value='FIAT-PREMIO'>FIAT-PREMIO </option>
                                            <option {{ old('marca') == 'FIAT-PUNTO' ? 'selected' : '' }} value='FIAT-PUNTO'>FIAT-PUNTO </option>
                                            <option {{ old('marca') == 'FIAT-SIENA' ? 'selected' : '' }} value='FIAT-SIENA'>FIAT-SIENA </option>
                                            <option {{ old('marca') == 'FIAT-STILO' ? 'selected' : '' }} value='FIAT-STILO'>FIAT-STILO </option>
                                            <option {{ old('marca') == 'FIAT-STRADA' ? 'selected' : '' }} value='FIAT-STRADA'>FIAT-STRADA </option>
                                            <option {{ old('marca') == 'FIAT-TEMPRA' ? 'selected' : '' }} value='FIAT-TEMPRA'>FIAT-TEMPRA </option>
                                            <option {{ old('marca') == 'FIAT-TIPO' ? 'selected' : '' }} value='FIAT-TIPO'>FIAT-TIPO </option>
                                            <option {{ old('marca') == 'FIAT-UNO' ? 'selected' : '' }} value='FIAT-UNO'>FIAT-UNO </option>
                                            <option {{ old('marca') == 'FORD-AEROSTAR' ? 'selected' : '' }} value='FORD-AEROSTAR'>FORD-AEROSTAR </option>
                                            <option {{ old('marca') == 'FORD-ASPIRE' ? 'selected' : '' }} value='FORD-ASPIRE'>FORD-ASPIRE </option>
                                            <option {{ old('marca') == 'FORD-BELINA' ? 'selected' : '' }} value='FORD-BELINA'>FORD-BELINA </option>
                                            <option {{ old('marca') == 'FORD-CLUB WAGON' ? 'selected' : '' }} value='FORD-CLUB WAGON'>FORD-CLUB WAGON </option>
                                            <option {{ old('marca') == 'FORD-CONTOUR' ? 'selected' : '' }} value='FORD-CONTOUR'>FORD-CONTOUR </option>
                                            <option {{ old('marca') == 'FORD-CORCEL II' ? 'selected' : '' }} value='FORD-CORCEL II'>FORD-CORCEL II </option>
                                            <option {{ old('marca') == 'FORD-COURIER' ? 'selected' : '' }} value='FORD-COURIER'>FORD-COURIER </option>
                                            <option {{ old('marca') == 'FORD-CROWN VICTORIA' ? 'selected' : '' }} value='FORD-CROWN VICTORIA'>FORD-CROWN VICTORIA </option>
                                            <option {{ old('marca') == 'FORD-DEL REY' ? 'selected' : '' }} value='FORD-DEL REY'>FORD-DEL REY </option>
                                            <option {{ old('marca') == 'FORD-ECOSPORT' ? 'selected' : '' }} value='FORD-ECOSPORT'>FORD-ECOSPORT </option>
                                            <option {{ old('marca') == 'FORD-EDGE' ? 'selected' : '' }} value='FORD-EDGE'>FORD-EDGE </option>
                                            <option {{ old('marca') == 'FORD-ESCORT' ? 'selected' : '' }} value='FORD-ESCORT'>FORD-ESCORT </option>
                                            <option {{ old('marca') == 'FORD-EXPEDITION' ? 'selected' : '' }} value='FORD-EXPEDITION'>FORD-EXPEDITION </option>
                                            <option {{ old('marca') == 'FORD-EXPLORER' ? 'selected' : '' }} value='FORD-EXPLORER'>FORD-EXPLORER </option>
                                            <option {{ old('marca') == 'FORD-F-100' ? 'selected' : '' }} value='FORD-F-100'>FORD-F-100 </option>
                                            <option {{ old('marca') == 'FORD-F-1000' ? 'selected' : '' }} value='FORD-F-1000'>FORD-F-1000 </option>
                                            <option {{ old('marca') == 'FORD-F-150' ? 'selected' : '' }} value='FORD-F-150'>FORD-F-150 </option>
                                            <option {{ old('marca') == 'FORD-F-250' ? 'selected' : '' }} value='FORD-F-250'>FORD-F-250 </option>
                                            <option {{ old('marca') == 'FORD-FIESTA' ? 'selected' : '' }} value='FORD-FIESTA'>FORD-FIESTA </option>
                                            <option {{ old('marca') == 'FORD-FOCUS' ? 'selected' : '' }} value='FORD-FOCUS'>FORD-FOCUS </option>
                                            <option {{ old('marca') == 'FORD-FURGLAINE' ? 'selected' : '' }} value='FORD-FURGLAINE'>FORD-FURGLAINE </option>
                                            <option {{ old('marca') == 'FORD-FUSION' ? 'selected' : '' }} value='FORD-FUSION'>FORD-FUSION </option>
                                            <option {{ old('marca') == 'FORD-IBIZA' ? 'selected' : '' }} value='FORD-IBIZA'>FORD-IBIZA </option>
                                            <option {{ old('marca') == 'FORD-KA' ? 'selected' : '' }} value='FORD-KA'>FORD-KA </option>
                                            <option {{ old('marca') == 'FORD-MONDEO' ? 'selected' : '' }} value='FORD-MONDEO'>FORD-MONDEO </option>
                                            <option {{ old('marca') == 'FORD-MUSTANG' ? 'selected' : '' }} value='FORD-MUSTANG'>FORD-MUSTANG </option>
                                            <option {{ old('marca') == 'FORD-PAMPA' ? 'selected' : '' }} value='FORD-PAMPA'>FORD-PAMPA </option>
                                            <option {{ old('marca') == 'FORD-PROBE' ? 'selected' : '' }} value='FORD-PROBE'>FORD-PROBE </option>
                                            <option {{ old('marca') == 'FORD-RANGER' ? 'selected' : '' }} value='FORD-RANGER'>FORD-RANGER </option>
                                            <option {{ old('marca') == 'FORD-VERSAILLES ROYALE' ? 'selected' : '' }} value='FORD-VERSAILLES ROYALE'>FORD-VERSAILLES ROYALE </option>
                                            <option {{ old('marca') == 'FORD-TAURUS' ? 'selected' : '' }} value='FORD-TAURUS'>FORD-TAURUS </option>
                                            <option {{ old('marca') == 'FORD-THUNDERBIRD' ? 'selected' : '' }} value='FORD-THUNDERBIRD'>FORD-THUNDERBIRD </option>
                                            <option {{ old('marca') == 'FORD-TRANSIT' ? 'selected' : '' }} value='FORD-TRANSIT'>FORD-TRANSIT </option>
                                            <option {{ old('marca') == 'FORD-VERONA' ? 'selected' : '' }} value='FORD-VERONA'>FORD-VERONA </option>
                                            <option {{ old('marca') == 'FORD-VERSAILLES' ? 'selected' : '' }} value='FORD-VERSAILLES'>FORD-VERSAILLES </option>
                                            <option {{ old('marca') == 'FORD-WINDSTAR' ? 'selected' : '' }} value='FORD-WINDSTAR'>FORD-WINDSTAR </option>
                                            <option {{ old('marca') == 'CHEVROLET-A-10' ? 'selected' : '' }} value='CHEVROLET-A-10'>CHEVROLET-A-10 </option>
                                            <option {{ old('marca') == 'CHEVROLET-A-20' ? 'selected' : '' }} value='CHEVROLET-A-20'>CHEVROLET-A-20 </option>
                                            <option {{ old('marca') == 'CHEVROLET-AGILE' ? 'selected' : '' }} value='CHEVROLET-AGILE'>CHEVROLET-AGILE </option>
                                            <option {{ old('marca') == 'CHEVROLET-ASTRA' ? 'selected' : '' }} value='CHEVROLET-ASTRA'>CHEVROLET-ASTRA </option>
                                            <option {{ old('marca') == 'CHEVROLET-BLAZER' ? 'selected' : '' }} value='CHEVROLET-BLAZER'>CHEVROLET-BLAZER </option>
                                            <option {{ old('marca') == 'CHEVROLET-BONANZA' ? 'selected' : '' }} value='CHEVROLET-BONANZA'>CHEVROLET-BONANZA </option>
                                            <option {{ old('marca') == 'CHEVROLET-C-10' ? 'selected' : '' }} value='CHEVROLET-C-10'>CHEVROLET-C-10 </option>
                                            <option {{ old('marca') == 'CHEVROLET-C-20' ? 'selected' : '' }} value='CHEVROLET-C-20'>CHEVROLET-C-20 </option>
                                            <option {{ old('marca') == 'CHEVROLET-CALIBRA' ? 'selected' : '' }} value='CHEVROLET-CALIBRA'>CHEVROLET-CALIBRA </option>
                                            <option {{ old('marca') == 'CHEVROLET-CAMARO' ? 'selected' : '' }} value='CHEVROLET-CAMARO'>CHEVROLET-CAMARO </option>
                                            <option {{ old('marca') == 'CHEVROLET-CAPRICE' ? 'selected' : '' }} value='CHEVROLET-CAPRICE'>CHEVROLET-CAPRICE </option>
                                            <option {{ old('marca') == 'CHEVROLET-CAPTIVA' ? 'selected' : '' }} value='CHEVROLET-CAPTIVA'>CHEVROLET-CAPTIVA </option>
                                            <option {{ old('marca') == 'CHEVROLET-CARAVAN' ? 'selected' : '' }} value='CHEVROLET-CARAVAN'>CHEVROLET-CARAVAN </option>
                                            <option {{ old('marca') == 'CHEVROLET-CAVALIER' ? 'selected' : '' }} value='CHEVROLET-CAVALIER'>CHEVROLET-CAVALIER </option>
                                            <option {{ old('marca') == 'CHEVROLET-CELTA' ? 'selected' : '' }} value='CHEVROLET-CELTA'>CHEVROLET-CELTA </option>
                                            <option {{ old('marca') == 'CHEVROLET-CHEVY' ? 'selected' : '' }} value='CHEVROLET-CHEVY'>CHEVROLET-CHEVY </option>
                                            <option {{ old('marca') == 'CHEVROLET-CHEYNNE' ? 'selected' : '' }} value='CHEVROLET-CHEYNNE'>CHEVROLET-CHEYNNE </option>
                                            <option {{ old('marca') == 'CHEVROLET-COBALT' ? 'selected' : '' }} value='CHEVROLET-COBALT'>CHEVROLET-COBALT </option>
                                            <option {{ old('marca') == 'CHEVROLET-CORSA' ? 'selected' : '' }} value='CHEVROLET-CORSA'>CHEVROLET-CORSA </option>
                                            <option {{ old('marca') == 'CHEVROLET-CORVETTE' ? 'selected' : '' }} value='CHEVROLET-CORVETTE'>CHEVROLET-CORVETTE </option>
                                            <option {{ old('marca') == 'CHEVROLET-CRUZE' ? 'selected' : '' }} value='CHEVROLET-CRUZE'>CHEVROLET-CRUZE </option>
                                            <option {{ old('marca') == 'CHEVROLET-D-10' ? 'selected' : '' }} value='CHEVROLET-D-10'>CHEVROLET-D-10 </option>
                                            <option {{ old('marca') == 'CHEVROLET-D-20' ? 'selected' : '' }} value='CHEVROLET-D-20'>CHEVROLET-D-20 </option>
                                            <option {{ old('marca') == 'CHEVROLET-IPANEMA' ? 'selected' : '' }} value='CHEVROLET-IPANEMA'>CHEVROLET-IPANEMA </option>
                                            <option {{ old('marca') == 'CHEVROLET-KADETT' ? 'selected' : '' }} value='CHEVROLET-KADETT'>CHEVROLET-KADETT </option>
                                            <option {{ old('marca') == 'CHEVROLET-LUMINA' ? 'selected' : '' }} value='CHEVROLET-LUMINA'>CHEVROLET-LUMINA </option>
                                            <option {{ old('marca') == 'CHEVROLET-MALIBU' ? 'selected' : '' }} value='CHEVROLET-MALIBU'>CHEVROLET-MALIBU </option>
                                            <option {{ old('marca') == 'CHEVROLET-MERIVA' ? 'selected' : '' }} value='CHEVROLET-MERIVA'>CHEVROLET-MERIVA </option>
                                            <option {{ old('marca') == 'CHEVROLET-MONTANA' ? 'selected' : '' }} value='CHEVROLET-MONTANA'>CHEVROLET-MONTANA </option>
                                            <option {{ old('marca') == 'CHEVROLET-OMEGA' ? 'selected' : '' }} value='CHEVROLET-OMEGA'>CHEVROLET-OMEGA </option>
                                            <option {{ old('marca') == 'CHEVROLET-OPALA' ? 'selected' : '' }} value='CHEVROLET-OPALA'>CHEVROLET-OPALA </option>
                                            <option {{ old('marca') == 'CHEVROLET-PRISMA' ? 'selected' : '' }} value='CHEVROLET-PRISMA'>CHEVROLET-PRISMA </option>
                                            <option {{ old('marca') == 'CHEVROLET-S10' ? 'selected' : '' }} value='CHEVROLET-S10'>CHEVROLET-S10 </option>
                                            <option {{ old('marca') == 'CHEVROLET-SILVERADO' ? 'selected' : '' }} value='CHEVROLET-SILVERADO'>CHEVROLET-SILVERADO </option>
                                            <option {{ old('marca') == 'CHEVROLET-SONIC' ? 'selected' : '' }} value='CHEVROLET-SONIC'>CHEVROLET-SONIC </option>
                                            <option {{ old('marca') == 'CHEVROLET-SONOMA' ? 'selected' : '' }} value='CHEVROLET-SONOMA'>CHEVROLET-SONOMA </option>
                                            <option {{ old('marca') == 'CHEVROLET-SPACEVAN' ? 'selected' : '' }} value='CHEVROLET-SPACEVAN'>CHEVROLET-SPACEVAN </option>
                                            <option {{ old('marca') == 'CHEVROLET-SS10' ? 'selected' : '' }} value='CHEVROLET-SS10'>CHEVROLET-SS10 </option>
                                            <option {{ old('marca') == 'CHEVROLET-SUBURBAN' ? 'selected' : '' }} value='CHEVROLET-SUBURBAN'>CHEVROLET-SUBURBAN </option>
                                            <option {{ old('marca') == 'CHEVROLET-SYCLONE' ? 'selected' : '' }} value='CHEVROLET-SYCLONE'>CHEVROLET-SYCLONE </option>
                                            <option {{ old('marca') == 'CHEVROLET-TIGRA' ? 'selected' : '' }} value='CHEVROLET-TIGRA'>CHEVROLET-TIGRA </option>
                                            <option {{ old('marca') == 'CHEVROLET-TRACKER' ? 'selected' : '' }} value='CHEVROLET-TRACKER'>CHEVROLET-TRACKER </option>
                                            <option {{ old('marca') == 'CHEVROLET-TRAFIC' ? 'selected' : '' }} value='CHEVROLET-TRAFIC'>CHEVROLET-TRAFIC </option>
                                            <option {{ old('marca') == 'CHEVROLET-VECTRA' ? 'selected' : '' }} value='CHEVROLET-VECTRA'>CHEVROLET-VECTRA </option>
                                            <option {{ old('marca') == 'CHEVROLET-VERANEIO' ? 'selected' : '' }} value='CHEVROLET-VERANEIO'>CHEVROLET-VERANEIO </option>
                                            <option {{ old('marca') == 'CHEVROLET-ZAFIRA' ? 'selected' : '' }} value='CHEVROLET-ZAFIRA'>CHEVROLET-ZAFIRA </option>
                                            <option {{ old('marca') == 'GREAT WALL-HOVER' ? 'selected' : '' }} value='GREAT WALL-HOVER'>GREAT WALL-HOVER </option>
                                            <option {{ old('marca') == 'GURGEL-BR-800' ? 'selected' : '' }} value='GURGEL-BR-800'>GURGEL-BR-800 </option>
                                            <option {{ old('marca') == 'GURGEL-CARAJAS' ? 'selected' : '' }} value='GURGEL-CARAJAS'>GURGEL-CARAJAS </option>
                                            <option {{ old('marca') == 'GURGEL-TOCANTINS' ? 'selected' : '' }} value='GURGEL-TOCANTINS'>GURGEL-TOCANTINS </option>
                                            <option {{ old('marca') == 'GURGEL-XAVANTE' ? 'selected' : '' }} value='GURGEL-XAVANTE'>GURGEL-XAVANTE </option>
                                            <option {{ old('marca') == 'GURGEL-VIP' ? 'selected' : '' }} value='GURGEL-VIP'>GURGEL-VIP </option>
                                            <option {{ old('marca') == 'HAFEI-TOWNER' ? 'selected' : '' }} value='HAFEI-TOWNER'>HAFEI-TOWNER </option>
                                            <option {{ old('marca') == 'HONDA-ACCORD' ? 'selected' : '' }} value='HONDA-ACCORD'>HONDA-ACCORD </option>
                                            <option {{ old('marca') == 'HONDA-CITY' ? 'selected' : '' }} value='HONDA-CITY'>HONDA-CITY </option>
                                            <option {{ old('marca') == 'HONDA-CIVIC' ? 'selected' : '' }} value='HONDA-CIVIC'>HONDA-CIVIC </option>
                                            <option {{ old('marca') == 'HONDA-CR-V' ? 'selected' : '' }} value='HONDA-CR-V'>HONDA-CR-V </option>
                                            <option {{ old('marca') == 'HONDA-FIT' ? 'selected' : '' }} value='HONDA-FIT'>HONDA-FIT </option>
                                            <option {{ old('marca') == 'HONDA-ODYSSEY' ? 'selected' : '' }} value='HONDA-ODYSSEY'>HONDA-ODYSSEY </option>
                                            <option {{ old('marca') == 'HONDA-PASSPORT' ? 'selected' : '' }} value='HONDA-PASSPORT'>HONDA-PASSPORT </option>
                                            <option {{ old('marca') == 'HONDA-PRELUDE' ? 'selected' : '' }} value='HONDA-PRELUDE'>HONDA-PRELUDE </option>
                                            <option {{ old('marca') == 'HYUNDAI-ACCENT' ? 'selected' : '' }} value='HYUNDAI-ACCENT'>HYUNDAI-ACCENT </option>
                                            <option {{ old('marca') == 'HYUNDAI-ATOS' ? 'selected' : '' }} value='HYUNDAI-ATOS'>HYUNDAI-ATOS </option>
                                            <option {{ old('marca') == 'HYUNDAI-AZERA' ? 'selected' : '' }} value='HYUNDAI-AZERA'>HYUNDAI-AZERA </option>
                                            <option {{ old('marca') == 'HYUNDAI-COUPE' ? 'selected' : '' }} value='HYUNDAI-COUPE'>HYUNDAI-COUPE </option>
                                            <option {{ old('marca') == 'HYUNDAI-ELANTRA' ? 'selected' : '' }} value='HYUNDAI-ELANTRA'>HYUNDAI-ELANTRA </option>
                                            <option {{ old('marca') == 'HYUNDAI-EXCEL' ? 'selected' : '' }} value='HYUNDAI-EXCEL'>HYUNDAI-EXCEL </option>
                                            <option {{ old('marca') == 'HYUNDAI-GALLOPER' ? 'selected' : '' }} value='HYUNDAI-GALLOPER'>HYUNDAI-GALLOPER </option>
                                            <option {{ old('marca') == 'HYUNDAI-GENESIS' ? 'selected' : '' }} value='HYUNDAI-GENESIS'>HYUNDAI-GENESIS </option>
                                            <option {{ old('marca') == 'HYUNDAI-H1' ? 'selected' : '' }} value='HYUNDAI-H1'>HYUNDAI-H1 </option>
                                            <option {{ old('marca') == 'HYUNDAI-H100' ? 'selected' : '' }} value='HYUNDAI-H100'>HYUNDAI-H100 </option>
                                            <option {{ old('marca') == 'HYUNDAI-I30' ? 'selected' : '' }} value='HYUNDAI-I30'>HYUNDAI-I30 </option>
                                            <option {{ old('marca') == 'HYUNDAI-IX35' ? 'selected' : '' }} value='HYUNDAI-IX35'>HYUNDAI-IX35 </option>
                                            <option {{ old('marca') == 'HYUNDAI-MATRIX' ? 'selected' : '' }} value='HYUNDAI-MATRIX'>HYUNDAI-MATRIX </option>
                                            <option {{ old('marca') == 'HYUNDAI-PORTER' ? 'selected' : '' }} value='HYUNDAI-PORTER'>HYUNDAI-PORTER </option>
                                            <option {{ old('marca') == 'HYUNDAI-SANTA FE' ? 'selected' : '' }} value='HYUNDAI-SANTA FE'>HYUNDAI-SANTA FE </option>
                                            <option {{ old('marca') == 'HYUNDAI-SCOUPE' ? 'selected' : '' }} value='HYUNDAI-SCOUPE'>HYUNDAI-SCOUPE </option>
                                            <option {{ old('marca') == 'HYUNDAI-SONATA' ? 'selected' : '' }} value='HYUNDAI-SONATA'>HYUNDAI-SONATA </option>
                                            <option {{ old('marca') == 'HYUNDAI-TERRACAN' ? 'selected' : '' }} value='HYUNDAI-TERRACAN'>HYUNDAI-TERRACAN </option>
                                            <option {{ old('marca') == 'HYUNDAI-TRAJET' ? 'selected' : '' }} value='HYUNDAI-TRAJET'>HYUNDAI-TRAJET </option>
                                            <option {{ old('marca') == 'HYUNDAI-TUCSON' ? 'selected' : '' }} value='HYUNDAI-TUCSON'>HYUNDAI-TUCSON </option>
                                            <option {{ old('marca') == 'HYUNDAI-VELOSTER' ? 'selected' : '' }} value='HYUNDAI-VELOSTER'>HYUNDAI-VELOSTER </option>
                                            <option {{ old('marca') == 'HYUNDAI-VERACRUZ' ? 'selected' : '' }} value='HYUNDAI-VERACRUZ'>HYUNDAI-VERACRUZ </option>
                                            <option {{ old('marca') == '-AMIGO' ? 'selected' : '' }} value='-AMIGO'>
                                                -AMIGO </option>
                                            <option {{ old('marca') == '-HOMBRE' ? 'selected' : '' }} value='-HOMBRE'>-HOMBRE </option>
                                            <option {{ old('marca') == '-RODEO' ? 'selected' : '' }} value='-RODEO'>
                                                -RODEO </option>
                                            <option {{ old('marca') == 'JAC-J3' ? 'selected' : '' }} value='JAC-J3'>
                                                JAC-J3 </option>
                                            <option {{ old('marca') == 'JAC-J5' ? 'selected' : '' }} value='JAC-J5'>
                                                JAC-J5 </option>
                                            <option {{ old('marca') == 'JAC-J6' ? 'selected' : '' }} value='JAC-J6'>
                                                JAC-J6 </option>
                                            <option {{ old('marca') == 'JAGUAR-DAIMLER' ? 'selected' : '' }} value='JAGUAR-DAIMLER'>JAGUAR-DAIMLER </option>
                                            <option {{ old('marca') == 'JAGUAR-S-TYPE' ? 'selected' : '' }} value='JAGUAR-S-TYPE'>JAGUAR-S-TYPE </option>
                                            <option {{ old('marca') == 'JAGUAR-X-TYPE' ? 'selected' : '' }} value='JAGUAR-X-TYPE'>JAGUAR-X-TYPE </option>
                                            <option {{ old('marca') == 'JAGUAR-MODELOS XJ' ? 'selected' : '' }} value='JAGUAR-MODELOS XJ'>JAGUAR-MODELOS XJ </option>
                                            <option {{ old('marca') == 'JAGUAR-MODELOS XK' ? 'selected' : '' }} value='JAGUAR-MODELOS XK'>JAGUAR-MODELOS XK </option>
                                            <option {{ old('marca') == 'JEEP-CHEROKEE' ? 'selected' : '' }} value='JEEP-CHEROKEE'>JEEP-CHEROKEE </option>
                                            <option {{ old('marca') == 'JEEP-COMMANDER' ? 'selected' : '' }} value='JEEP-COMMANDER'>JEEP-COMMANDER </option>
                                            <option {{ old('marca') == 'JEEP-COMPASS' ? 'selected' : '' }} value='JEEP-COMPASS'>JEEP-COMPASS </option>

                                            <option {{ old('marca') == 'JEEP-GRAND CHEROKEE' ? 'selected' : '' }} value='JEEP-GRAND CHEROKEE'>JEEP-GRAND CHEROKEE </option>
                                            <option {{ old('marca') == 'JEEP-WRANGLER' ? 'selected' : '' }} value='JEEP-WRANGLER'>JEEP-WRANGLER </option>
                                            <option {{ old('marca') == 'JINBEI-TOPIC VAN' ? 'selected' : '' }} value='JINBEI-TOPIC VAN'>JINBEI-TOPIC VAN </option>
                                            <option {{ old('marca') == 'JPX-JIPE MONTEZ' ? 'selected' : '' }} value='JPX-JIPE MONTEZ'>JPX-JIPE MONTEZ </option>
                                            <option {{ old('marca') == 'JPX-PICAPE MONTEZ' ? 'selected' : '' }} value='JPX-PICAPE MONTEZ'>JPX-PICAPE MONTEZ </option>
                                            <option {{ old('marca') == 'KIA-BESTA' ? 'selected' : '' }} value='KIA-BESTA'>KIA-BESTA </option>
                                            <option {{ old('marca') == 'KIA-BONGO' ? 'selected' : '' }} value='KIA-BONGO'>KIA-BONGO </option>
                                            <option {{ old('marca') == 'KIA-CADENZA' ? 'selected' : '' }} value='KIA-CADENZA'>KIA-CADENZA </option>
                                            <option {{ old('marca') == 'KIA-CARENS' ? 'selected' : '' }} value='KIA-CARENS'>KIA-CARENS </option>
                                            <option {{ old('marca') == 'KIA-CARNIVAL' ? 'selected' : '' }} value='KIA-CARNIVAL'>KIA-CARNIVAL </option>
                                            <option {{ old('marca') == 'KIA-CERATO' ? 'selected' : '' }} value='KIA-CERATO'>KIA-CERATO </option>
                                            <option {{ old('marca') == 'KIA-CERES' ? 'selected' : '' }} value='KIA-CERES'>KIA-CERES </option>
                                            <option {{ old('marca') == 'KIA-CLARUS' ? 'selected' : '' }} value='KIA-CLARUS'>KIA-CLARUS </option>
                                            <option {{ old('marca') == 'KIA-MAGENTIS' ? 'selected' : '' }} value='KIA-MAGENTIS'>KIA-MAGENTIS </option>
                                            <option {{ old('marca') == 'KIA-MOHAVE' ? 'selected' : '' }} value='KIA-MOHAVE'>KIA-MOHAVE </option>
                                            <option {{ old('marca') == 'KIA-OPIRUS' ? 'selected' : '' }} value='KIA-OPIRUS'>KIA-OPIRUS </option>
                                            <option {{ old('marca') == 'KIA-OPTIMA' ? 'selected' : '' }} value='KIA-OPTIMA'>KIA-OPTIMA </option>
                                            <option {{ old('marca') == 'KIA-PICANTO' ? 'selected' : '' }} value='KIA-PICANTO'>KIA-PICANTO </option>
                                            <option {{ old('marca') == 'KIA-SEPHIA' ? 'selected' : '' }} value='KIA-SEPHIA'>KIA-SEPHIA </option>
                                            <option {{ old('marca') == 'KIA-SHUMA' ? 'selected' : '' }} value='KIA-SHUMA'>KIA-SHUMA </option>
                                            <option {{ old('marca') == 'KIA-SORENTO' ? 'selected' : '' }} value='KIA-SORENTO'>KIA-SORENTO </option>
                                            <option {{ old('marca') == 'KIA-SOUL' ? 'selected' : '' }} value='KIA-SOUL'>KIA-SOUL </option>
                                            <option {{ old('marca') == 'KIA-SPORTAGE' ? 'selected' : '' }} value='KIA-SPORTAGE'>KIA-SPORTAGE </option>
                                            <option {{ old('marca') == 'LADA-LAIKA' ? 'selected' : '' }} value='LADA-LAIKA'>LADA-LAIKA </option>
                                            <option {{ old('marca') == 'LADA-NIVA' ? 'selected' : '' }} value='LADA-NIVA'>LADA-NIVA </option>
                                            <option {{ old('marca') == 'LADA-SAMARA' ? 'selected' : '' }} value='LADA-SAMARA'>LADA-SAMARA </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-GALLARDO' ? 'selected' : '' }} value='LAMBORGHINI-GALLARDO'>LAMBORGHINI-GALLARDO </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-MURCIELAGO' ? 'selected' : '' }} value='LAMBORGHINI-MURCIELAGO'>LAMBORGHINI-MURCIELAGO </option>
                                            <option {{ old('marca') == 'LAND ROVER-DEFENDER' ? 'selected' : '' }} value='LAND ROVER-DEFENDER'>LAND ROVER-DEFENDER </option>
                                            <option {{ old('marca') == 'LAND ROVER-DISCOVERY' ? 'selected' : '' }} value='LAND ROVER-DISCOVERY'>LAND ROVER-DISCOVERY </option>
                                            <option {{ old('marca') == 'LAND ROVER-FREELANDER' ? 'selected' : '' }} value='LAND ROVER-FREELANDER'>LAND ROVER-FREELANDER </option>
                                            <option {{ old('marca') == 'LAND ROVER-NEW RANGE' ? 'selected' : '' }} value='LAND ROVER-NEW RANGE'>LAND ROVER-NEW RANGE </option>
                                            <option {{ old('marca') == 'LAND ROVER-RANGE ROVER' ? 'selected' : '' }} value='LAND ROVER-RANGE ROVER'>LAND ROVER-RANGE ROVER </option>
                                            <option {{ old('marca') == 'LEXUS-ES' ? 'selected' : '' }} value='LEXUS-ES'>LEXUS-ES </option>
                                            <option {{ old('marca') == 'LEXUS-GS' ? 'selected' : '' }} value='LEXUS-GS'>LEXUS-GS </option>
                                            <option {{ old('marca') == 'LEXUS-IS-300' ? 'selected' : '' }} value='LEXUS-IS-300'>LEXUS-IS-300 </option>
                                            <option {{ old('marca') == 'LEXUS-LS' ? 'selected' : '' }} value='LEXUS-LS'>LEXUS-LS </option>
                                            <option {{ old('marca') == 'LEXUS-RX' ? 'selected' : '' }} value='LEXUS-RX'>LEXUS-RX </option>
                                            <option {{ old('marca') == 'LEXUS-SC' ? 'selected' : '' }} value='LEXUS-SC'>LEXUS-SC </option>
                                            <option {{ old('marca') == 'LIFAN-320' ? 'selected' : '' }} value='LIFAN-320'>LIFAN-320 </option>
                                            <option {{ old('marca') == 'LIFAN-620' ? 'selected' : '' }} value='LIFAN-620'>LIFAN-620 </option>
                                            <option {{ old('marca') == 'LOBINI-H1' ? 'selected' : '' }} value='LOBINI-H1'>LOBINI-H1 </option>
                                            <option {{ old('marca') == 'LOTUS-ELAN' ? 'selected' : '' }} value='LOTUS-ELAN'>LOTUS-ELAN </option>
                                            <option {{ old('marca') == 'LOTUS-ESPRIT' ? 'selected' : '' }} value='LOTUS-ESPRIT'>LOTUS-ESPRIT </option>
                                            <option {{ old('marca') == 'MAHINDRA-SCORPIO' ? 'selected' : '' }} value='MAHINDRA-SCORPIO'>MAHINDRA-SCORPIO </option>
                                            <option {{ old('marca') == 'MASERATI-222' ? 'selected' : '' }} value='MASERATI-222'>MASERATI-222 </option>
                                            <option {{ old('marca') == 'MASERATI-228' ? 'selected' : '' }} value='MASERATI-228'>MASERATI-228 </option>
                                            <option {{ old('marca') == 'MASERATI-3200' ? 'selected' : '' }} value='MASERATI-3200'>MASERATI-3200 </option>
                                            <option {{ old('marca') == 'MASERATI-430' ? 'selected' : '' }} value='MASERATI-430'>MASERATI-430 </option>
                                            <option {{ old('marca') == 'MASERATI-COUPE' ? 'selected' : '' }} value='MASERATI-COUPE'>MASERATI-COUPE </option>
                                            <option {{ old('marca') == 'MASERATI-GHIBLI' ? 'selected' : '' }} value='MASERATI-GHIBLI'>MASERATI-GHIBLI </option>
                                            <option {{ old('marca') == 'MASERATI-GRANCABRIO' ? 'selected' : '' }} value='MASERATI-GRANCABRIO'>MASERATI-GRANCABRIO </option>
                                            <option {{ old('marca') == 'MASERATI-GRANSPORT' ? 'selected' : '' }} value='MASERATI-GRANSPORT'>MASERATI-GRANSPORT </option>
                                            <option {{ old('marca') == 'MASERATI-GRANTURISMO' ? 'selected' : '' }} value='MASERATI-GRANTURISMO'>MASERATI-GRANTURISMO </option>
                                            <option {{ old('marca') == 'MASERATI-QUATTROPORTE' ? 'selected' : '' }} value='MASERATI-QUATTROPORTE'>MASERATI-QUATTROPORTE </option>
                                            <option {{ old('marca') == 'MASERATI-SHAMAL' ? 'selected' : '' }} value='MASERATI-SHAMAL'>MASERATI-SHAMAL </option>
                                            <option {{ old('marca') == 'MASERATI-SPIDER' ? 'selected' : '' }} value='MASERATI-SPIDER'>MASERATI-SPIDER </option>
                                            <option {{ old('marca') == 'MATRA-PICK-UP' ? 'selected' : '' }} value='MATRA-PICK-UP'>MATRA-PICK-UP </option>
                                            <option {{ old('marca') == 'MAZDA-323' ? 'selected' : '' }} value='MAZDA-323'>MAZDA-323 </option>
                                            <option {{ old('marca') == 'MAZDA-626' ? 'selected' : '' }} value='MAZDA-626'>MAZDA-626 </option>
                                            <option {{ old('marca') == 'MAZDA-929' ? 'selected' : '' }} value='MAZDA-929'>MAZDA-929 </option>
                                            <option {{ old('marca') == 'MAZDA-B-2500' ? 'selected' : '' }} value='MAZDA-B-2500'>MAZDA-B-2500 </option>
                                            <option {{ old('marca') == 'MAZDA-B2200' ? 'selected' : '' }} value='MAZDA-B2200'>MAZDA-B2200 </option>
                                            <option {{ old('marca') == 'MAZDA-MILLENIA' ? 'selected' : '' }} value='MAZDA-MILLENIA'>MAZDA-MILLENIA </option>
                                            <option {{ old('marca') == 'MAZDA-MPV' ? 'selected' : '' }} value='MAZDA-MPV'>MAZDA-MPV </option>
                                            <option {{ old('marca') == 'MAZDA-MX-3' ? 'selected' : '' }} value='MAZDA-MX-3'>MAZDA-MX-3 </option>
                                            <option {{ old('marca') == 'MAZDA-MX-5' ? 'selected' : '' }} value='MAZDA-MX-5'>MAZDA-MX-5 </option>
                                            <option {{ old('marca') == 'MAZDA-NAVAJO' ? 'selected' : '' }} value='MAZDA-NAVAJO'>MAZDA-NAVAJO </option>
                                            <option {{ old('marca') == 'MAZDA-PROTEGE' ? 'selected' : '' }} value='MAZDA-PROTEGE'>MAZDA-PROTEGE </option>
                                            <option {{ old('marca') == 'MAZDA-RX' ? 'selected' : '' }} value='MAZDA-RX'>MAZDA-RX </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE A' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE A'>MERCEDES-BENZ-CLASSE A </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE B' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE B'>MERCEDES-BENZ-CLASSE B </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE R' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE R'>MERCEDES-BENZ-CLASSE R </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE GLK' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE GLK'>MERCEDES-BENZ-CLASSE GLK </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-SPRINTER' ? 'selected' : '' }} value='MERCEDES-BENZ-SPRINTER'>MERCEDES-BENZ-SPRINTER </option>
                                            <option {{ old('marca') == 'MERCURY-MYSTIQUE' ? 'selected' : '' }} value='MERCURY-MYSTIQUE'>MERCURY-MYSTIQUE </option>
                                            <option {{ old('marca') == 'MERCURY-SABLE' ? 'selected' : '' }} value='MERCURY-SABLE'>MERCURY-SABLE </option>
                                            <option {{ old('marca') == 'MG-550' ? 'selected' : '' }} value='MG-550'>
                                                MG-550 </option>
                                            <option {{ old('marca') == 'MG-MG6' ? 'selected' : '' }} value='MG-MG6'>
                                                MG-MG6 </option>
                                            <option {{ old('marca') == 'MINI-COOPER' ? 'selected' : '' }} value='MINI-COOPER'>MINI-COOPER </option>
                                            <option {{ old('marca') == 'MINI-ONE' ? 'selected' : '' }} value='MINI-ONE'>MINI-ONE </option>
                                            <option {{ old('marca') == 'MITSUBISHI-3000' ? 'selected' : '' }} value='MITSUBISHI-3000'>MITSUBISHI-3000 </option>
                                            <option {{ old('marca') == 'MITSUBISHI-AIRTREK' ? 'selected' : '' }} value='MITSUBISHI-AIRTREK'>MITSUBISHI-AIRTREK </option>
                                            <option {{ old('marca') == 'MITSUBISHI-ASX' ? 'selected' : '' }} value='MITSUBISHI-ASX'>MITSUBISHI-ASX </option>
                                            <option {{ old('marca') == 'MITSUBISHI-COLT' ? 'selected' : '' }} value='MITSUBISHI-COLT'>MITSUBISHI-COLT </option>
                                            <option {{ old('marca') == 'MITSUBISHI-DIAMANT' ? 'selected' : '' }} value='MITSUBISHI-DIAMANT'>MITSUBISHI-DIAMANT </option>
                                            <option {{ old('marca') == 'MITSUBISHI-ECLIPSE' ? 'selected' : '' }} value='MITSUBISHI-ECLIPSE'>MITSUBISHI-ECLIPSE </option>
                                            <option {{ old('marca') == 'MITSUBISHI-EXPO' ? 'selected' : '' }} value='MITSUBISHI-EXPO'>MITSUBISHI-EXPO </option>
                                            <option {{ old('marca') == 'MITSUBISHI-GALANT' ? 'selected' : '' }} value='MITSUBISHI-GALANT'>MITSUBISHI-GALANT </option>
                                            <option {{ old('marca') == 'MITSUBISHI-GRANDIS' ? 'selected' : '' }} value='MITSUBISHI-GRANDIS'>MITSUBISHI-GRANDIS </option>
                                            <option {{ old('marca') == 'MITSUBISHI-L200' ? 'selected' : '' }} value='MITSUBISHI-L200'>MITSUBISHI-L200 </option>
                                            <option {{ old('marca') == 'MITSUBISHI-L300' ? 'selected' : '' }} value='MITSUBISHI-L300'>MITSUBISHI-L300 </option>
                                            <option {{ old('marca') == 'MITSUBISHI-LANCER' ? 'selected' : '' }} value='MITSUBISHI-LANCER'>MITSUBISHI-LANCER </option>
                                            <option {{ old('marca') == 'MITSUBISHI-MIRAGE' ? 'selected' : '' }} value='MITSUBISHI-MIRAGE'>MITSUBISHI-MIRAGE </option>
                                            <option {{ old('marca') == 'MITSUBISHI-MONTERO' ? 'selected' : '' }} value='MITSUBISHI-MONTERO'>MITSUBISHI-MONTERO </option>
                                            <option {{ old('marca') == 'MITSUBISHI-OUTLANDER' ? 'selected' : '' }} value='MITSUBISHI-OUTLANDER'>MITSUBISHI-OUTLANDER </option>
                                            <option {{ old('marca') == 'MITSUBISHI-PAJERO' ? 'selected' : '' }} value='MITSUBISHI-PAJERO'>MITSUBISHI-PAJERO </option>
                                            <option {{ old('marca') == 'MITSUBISHI-SPACE WAGON' ? 'selected' : '' }} value='MITSUBISHI-SPACE WAGON'>MITSUBISHI-SPACE WAGON </option>
                                            <option {{ old('marca') == 'MIURA-BG-TRUCK' ? 'selected' : '' }} value='MIURA-BG-TRUCK'>MIURA-BG-TRUCK </option>
                                            <option {{ old('marca') == 'NISSAN-350Z' ? 'selected' : '' }} value='NISSAN-350Z'>NISSAN-350Z </option>
                                            <option {{ old('marca') == 'NISSAN-ALTIMA' ? 'selected' : '' }} value='NISSAN-ALTIMA'>NISSAN-ALTIMA </option>
                                            <option {{ old('marca') == 'NISSAN-AX' ? 'selected' : '' }} value='NISSAN-AX'>NISSAN-AX </option>
                                            <option {{ old('marca') == 'NISSAN-D-21' ? 'selected' : '' }} value='NISSAN-D-21'>NISSAN-D-21 </option>
                                            <option {{ old('marca') == 'NISSAN-FRONTIER' ? 'selected' : '' }} value='NISSAN-FRONTIER'>NISSAN-FRONTIER </option>
                                            <option {{ old('marca') == 'NISSAN-KING-CAB' ? 'selected' : '' }} value='NISSAN-KING-CAB'>NISSAN-KING-CAB </option>
                                            <option {{ old('marca') == 'NISSAN-LIVINA' ? 'selected' : '' }} value='NISSAN-LIVINA'>NISSAN-LIVINA </option>
                                            <option {{ old('marca') == 'NISSAN-MARCH' ? 'selected' : '' }} value='NISSAN-MARCH'>NISSAN-MARCH </option>
                                            <option {{ old('marca') == 'NISSAN-MAXIMA' ? 'selected' : '' }} value='NISSAN-MAXIMA'>NISSAN-MAXIMA </option>
                                            <option {{ old('marca') == 'NISSAN-MURANO' ? 'selected' : '' }} value='NISSAN-MURANO'>NISSAN-MURANO </option>
                                            <option {{ old('marca') == 'NISSAN-NX' ? 'selected' : '' }} value='NISSAN-NX'>NISSAN-NX </option>
                                            <option {{ old('marca') == 'NISSAN-PATHFINDER' ? 'selected' : '' }} value='NISSAN-PATHFINDER'>NISSAN-PATHFINDER </option>
                                            <option {{ old('marca') == 'NISSAN-PRIMERA' ? 'selected' : '' }} value='NISSAN-PRIMERA'>NISSAN-PRIMERA </option>
                                            <option {{ old('marca') == 'NISSAN-QUEST' ? 'selected' : '' }} value='NISSAN-QUEST'>NISSAN-QUEST </option>
                                            <option {{ old('marca') == 'NISSAN-SENTRA' ? 'selected' : '' }} value='NISSAN-SENTRA'>NISSAN-SENTRA </option>
                                            <option {{ old('marca') == 'NISSAN-STANZA' ? 'selected' : '' }} value='NISSAN-STANZA'>NISSAN-STANZA </option>
                                            <option {{ old('marca') == 'NISSAN-180SX' ? 'selected' : '' }} value='NISSAN-180SX'>NISSAN-180SX </option>
                                            <option {{ old('marca') == 'NISSAN-TERRANO' ? 'selected' : '' }} value='NISSAN-TERRANO'>NISSAN-TERRANO </option>
                                            <option {{ old('marca') == 'NISSAN-TIIDA' ? 'selected' : '' }} value='NISSAN-TIIDA'>NISSAN-TIIDA </option>
                                            <option {{ old('marca') == 'NISSAN-VERSA' ? 'selected' : '' }} value='NISSAN-VERSA'>NISSAN-VERSA </option>
                                            <option {{ old('marca') == 'NISSAN-X-TRAIL' ? 'selected' : '' }} value='NISSAN-X-TRAIL'>NISSAN-X-TRAIL </option>
                                            <option {{ old('marca') == 'NISSAN-XTERRA' ? 'selected' : '' }} value='NISSAN-XTERRA'>NISSAN-XTERRA </option>
                                            <option {{ old('marca') == 'NISSAN-ZX' ? 'selected' : '' }} value='NISSAN-ZX'>NISSAN-ZX </option>
                                            <option {{ old('marca') == 'PEUGEOT-106' ? 'selected' : '' }} value='PEUGEOT-106'>PEUGEOT-106 </option>
                                            <option {{ old('marca') == 'PEUGEOT-205' ? 'selected' : '' }} value='PEUGEOT-205'>PEUGEOT-205 </option>
                                            <option {{ old('marca') == 'PEUGEOT-206' ? 'selected' : '' }} value='PEUGEOT-206'>PEUGEOT-206 </option>
                                            <option {{ old('marca') == 'PEUGEOT-207' ? 'selected' : '' }} value='PEUGEOT-207'>PEUGEOT-207 </option>
                                            <option {{ old('marca') == 'PEUGEOT-3008' ? 'selected' : '' }} value='PEUGEOT-3008'>PEUGEOT-3008 </option>
                                            <option {{ old('marca') == 'PEUGEOT-306' ? 'selected' : '' }} value='PEUGEOT-306'>PEUGEOT-306 </option>
                                            <option {{ old('marca') == 'PEUGEOT-307' ? 'selected' : '' }} value='PEUGEOT-307'>PEUGEOT-307 </option>
                                            <option {{ old('marca') == 'PEUGEOT-308' ? 'selected' : '' }} value='PEUGEOT-308'>PEUGEOT-308 </option>
                                            <option {{ old('marca') == 'PEUGEOT-405' ? 'selected' : '' }} value='PEUGEOT-405'>PEUGEOT-405 </option>
                                            <option {{ old('marca') == 'PEUGEOT-406' ? 'selected' : '' }} value='PEUGEOT-406'>PEUGEOT-406 </option>
                                            <option {{ old('marca') == 'PEUGEOT-407' ? 'selected' : '' }} value='PEUGEOT-407'>PEUGEOT-407 </option>
                                            <option {{ old('marca') == 'PEUGEOT-408' ? 'selected' : '' }} value='PEUGEOT-408'>PEUGEOT-408 </option>
                                            <option {{ old('marca') == 'PEUGEOT-504' ? 'selected' : '' }} value='PEUGEOT-504'>PEUGEOT-504 </option>
                                            <option {{ old('marca') == 'PEUGEOT-505' ? 'selected' : '' }} value='PEUGEOT-505'>PEUGEOT-505 </option>
                                            <option {{ old('marca') == 'PEUGEOT-508' ? 'selected' : '' }} value='PEUGEOT-508'>PEUGEOT-508 </option>
                                            <option {{ old('marca') == 'PEUGEOT-605' ? 'selected' : '' }} value='PEUGEOT-605'>PEUGEOT-605 </option>
                                            <option {{ old('marca') == 'PEUGEOT-607' ? 'selected' : '' }} value='PEUGEOT-607'>PEUGEOT-607 </option>
                                            <option {{ old('marca') == 'PEUGEOT-806' ? 'selected' : '' }} value='PEUGEOT-806'>PEUGEOT-806 </option>
                                            <option {{ old('marca') == 'PEUGEOT-807' ? 'selected' : '' }} value='PEUGEOT-807'>PEUGEOT-807 </option>
                                            <option {{ old('marca') == 'PEUGEOT-BOXER' ? 'selected' : '' }} value='PEUGEOT-BOXER'>PEUGEOT-BOXER </option>
                                            <option {{ old('marca') == 'PEUGEOT-HOGGAR' ? 'selected' : '' }} value='PEUGEOT-HOGGAR'>PEUGEOT-HOGGAR </option>
                                            <option {{ old('marca') == 'PEUGEOT-PARTNER' ? 'selected' : '' }} value='PEUGEOT-PARTNER'>PEUGEOT-PARTNER </option>
                                            <option {{ old('marca') == 'PEUGEOT-RCZ' ? 'selected' : '' }} value='PEUGEOT-RCZ'>PEUGEOT-RCZ </option>
                                            <option {{ old('marca') == 'PLYMOUTH-GRAN VOYAGER' ? 'selected' : '' }} value='PLYMOUTH-GRAN VOYAGER'>PLYMOUTH-GRAN VOYAGER </option>
                                            <option {{ old('marca') == 'PLYMOUTH-SUNDANCE' ? 'selected' : '' }} value='PLYMOUTH-SUNDANCE'>PLYMOUTH-SUNDANCE </option>
                                            <option {{ old('marca') == 'PONTIAC-TRANS-AM' ? 'selected' : '' }} value='PONTIAC-TRANS-AM'>PONTIAC-TRANS-AM </option>
                                            <option {{ old('marca') == 'PONTIAC-TRANS-SPORT' ? 'selected' : '' }} value='PONTIAC-TRANS-SPORT'>PONTIAC-TRANS-SPORT </option>
                                            <option {{ old('marca') == 'PORSCHE-911' ? 'selected' : '' }} value='PORSCHE-911'>PORSCHE-911 </option>
                                            <option {{ old('marca') == 'PORSCHE-BOXSTER' ? 'selected' : '' }} value='PORSCHE-BOXSTER'>PORSCHE-BOXSTER </option>
                                            <option {{ old('marca') == 'PORSCHE-CAYENNE' ? 'selected' : '' }} value='PORSCHE-CAYENNE'>PORSCHE-CAYENNE </option>
                                            <option {{ old('marca') == 'PORSCHE-CAYMAN' ? 'selected' : '' }} value='PORSCHE-CAYMAN'>PORSCHE-CAYMAN </option>
                                            <option {{ old('marca') == 'PORSCHE-PANAMERA' ? 'selected' : '' }} value='PORSCHE-PANAMERA'>PORSCHE-PANAMERA </option>
                                            <option {{ old('marca') == 'RENAULT-21 SEDAN' ? 'selected' : '' }} value='RENAULT-21 SEDAN'>RENAULT-21 SEDAN </option>
                                            <option {{ old('marca') == 'RENAULT-CLIO' ? 'selected' : '' }} value='RENAULT-CLIO'>RENAULT-CLIO </option>
                                            <option {{ old('marca') == 'RENAULT-DUSTER' ? 'selected' : '' }} value='RENAULT-DUSTER'>RENAULT-DUSTER </option>
                                            <option {{ old('marca') == 'RENAULT-EXPRESS' ? 'selected' : '' }} value='RENAULT-EXPRESS'>RENAULT-EXPRESS </option>
                                            <option {{ old('marca') == 'RENAULT-FLUENCE' ? 'selected' : '' }} value='RENAULT-FLUENCE'>RENAULT-FLUENCE </option>
                                            <option {{ old('marca') == 'RENAULT-KANGOO' ? 'selected' : '' }} value='RENAULT-KANGOO'>RENAULT-KANGOO </option>
                                            <option {{ old('marca') == 'RENAULT-LAGUNA' ? 'selected' : '' }} value='RENAULT-LAGUNA'>RENAULT-LAGUNA </option>
                                            <option {{ old('marca') == 'RENAULT-LOGAN' ? 'selected' : '' }} value='RENAULT-LOGAN'>RENAULT-LOGAN </option>
                                            <option {{ old('marca') == 'RENAULT-MASTER' ? 'selected' : '' }} value='RENAULT-MASTER'>RENAULT-MASTER </option>
                                            <option {{ old('marca') == 'RENAULT-MEGANE' ? 'selected' : '' }} value='RENAULT-MEGANE'>RENAULT-MEGANE </option>
                                            <option {{ old('marca') == 'RENAULT-SAFRANE' ? 'selected' : '' }} value='RENAULT-SAFRANE'>RENAULT-SAFRANE </option>
                                            <option {{ old('marca') == 'RENAULT-SANDERO' ? 'selected' : '' }} value='RENAULT-SANDERO'>RENAULT-SANDERO </option>
                                            <option {{ old('marca') == 'RENAULT-SCENIC' ? 'selected' : '' }} value='RENAULT-SCENIC'>RENAULT-SCENIC </option>
                                            <option {{ old('marca') == 'RENAULT-SYMBOL' ? 'selected' : '' }} value='RENAULT-SYMBOL'>RENAULT-SYMBOL </option>
                                            <option {{ old('marca') == 'RENAULT-TRAFIC' ? 'selected' : '' }} value='RENAULT-TRAFIC'>RENAULT-TRAFIC </option>
                                            <option {{ old('marca') == 'RENAULT-TWINGO' ? 'selected' : '' }} value='RENAULT-TWINGO'>RENAULT-TWINGO </option>
                                            <option {{ old('marca') == 'SAAB-9000' ? 'selected' : '' }} value='SAAB-9000'>SAAB-9000 </option>
                                            <option {{ old('marca') == 'SATURN-SL-2' ? 'selected' : '' }} value='SATURN-SL-2'>SATURN-SL-2 </option>
                                            <option {{ old('marca') == 'SEAT-CORDOBA' ? 'selected' : '' }} value='SEAT-CORDOBA'>SEAT-CORDOBA </option>
                                            <option {{ old('marca') == 'SEAT-IBIZA' ? 'selected' : '' }} value='SEAT-IBIZA'>SEAT-IBIZA </option>
                                            <option {{ old('marca') == 'SEAT-INCA' ? 'selected' : '' }} value='SEAT-INCA'>SEAT-INCA </option>
                                            <option {{ old('marca') == 'SMART-FORTWO' ? 'selected' : '' }} value='SMART-FORTWO'>SMART-FORTWO </option>
                                            <option {{ old('marca') == 'SSANGYONG-ACTYON SPORTS' ? 'selected' : '' }} value='SSANGYONG-ACTYON SPORTS'>SSANGYONG-ACTYON SPORTS </option>
                                            <option {{ old('marca') == 'SSANGYONG-CHAIRMAN' ? 'selected' : '' }} value='SSANGYONG-CHAIRMAN'>SSANGYONG-CHAIRMAN </option>
                                            <option {{ old('marca') == 'SSANGYONG-ISTANA' ? 'selected' : '' }} value='SSANGYONG-ISTANA'>SSANGYONG-ISTANA </option>
                                            <option {{ old('marca') == 'SSANGYONG-KORANDO' ? 'selected' : '' }} value='SSANGYONG-KORANDO'>SSANGYONG-KORANDO </option>
                                            <option {{ old('marca') == 'SSANGYONG-KYRON' ? 'selected' : '' }} value='SSANGYONG-KYRON'>SSANGYONG-KYRON </option>
                                            <option {{ old('marca') == 'SSANGYONG-MUSSO' ? 'selected' : '' }} value='SSANGYONG-MUSSO'>SSANGYONG-MUSSO </option>
                                            <option {{ old('marca') == 'SSANGYONG-REXTON' ? 'selected' : '' }} value='SSANGYONG-REXTON'>SSANGYONG-REXTON </option>
                                            <option {{ old('marca') == 'SUBARU-FORESTER' ? 'selected' : '' }} value='SUBARU-FORESTER'>SUBARU-FORESTER </option>
                                            <option {{ old('marca') == 'SUBARU-IMPREZA' ? 'selected' : '' }} value='SUBARU-IMPREZA'>SUBARU-IMPREZA </option>
                                            <option {{ old('marca') == 'SUBARU-LEGACY' ? 'selected' : '' }} value='SUBARU-LEGACY'>SUBARU-LEGACY </option>
                                            <option {{ old('marca') == 'SUBARU-OUTBACK' ? 'selected' : '' }} value='SUBARU-OUTBACK'>SUBARU-OUTBACK </option>
                                            <option {{ old('marca') == 'SUBARU-SVX' ? 'selected' : '' }} value='SUBARU-SVX'>SUBARU-SVX </option>
                                            <option {{ old('marca') == 'SUBARU-TRIBECA' ? 'selected' : '' }} value='SUBARU-TRIBECA'>SUBARU-TRIBECA </option>
                                            <option {{ old('marca') == 'SUBARU-VIVIO' ? 'selected' : '' }} value='SUBARU-VIVIO'>SUBARU-VIVIO </option>
                                            <option {{ old('marca') == 'SUZUKI-BALENO' ? 'selected' : '' }} value='SUZUKI-BALENO'>SUZUKI-BALENO </option>
                                            <option {{ old('marca') == 'SUZUKI-GRAND VITARA' ? 'selected' : '' }} value='SUZUKI-GRAND VITARA'>SUZUKI-GRAND VITARA </option>
                                            <option {{ old('marca') == 'SUZUKI-IGNIS' ? 'selected' : '' }} value='SUZUKI-IGNIS'>SUZUKI-IGNIS </option>
                                            <option {{ old('marca') == 'SUZUKI-JIMNY' ? 'selected' : '' }} value='SUZUKI-JIMNY'>SUZUKI-JIMNY </option>
                                            <option {{ old('marca') == 'SUZUKI-SUPER CARRY' ? 'selected' : '' }} value='SUZUKI-SUPER CARRY'>SUZUKI-SUPER CARRY </option>
                                            <option {{ old('marca') == 'SUZUKI-SWIFT' ? 'selected' : '' }} value='SUZUKI-SWIFT'>SUZUKI-SWIFT </option>
                                            <option {{ old('marca') == 'SUZUKI-SX4' ? 'selected' : '' }} value='SUZUKI-SX4'>SUZUKI-SX4 </option>
                                            <option {{ old('marca') == 'SUZUKI-VITARA' ? 'selected' : '' }} value='SUZUKI-VITARA'>SUZUKI-VITARA </option>
                                            <option {{ old('marca') == 'SUZUKI-WAGON R' ? 'selected' : '' }} value='SUZUKI-WAGON R'>SUZUKI-WAGON R </option>
                                            <option {{ old('marca') == 'TAC-STARK' ? 'selected' : '' }} value='TAC-STARK'>TAC-STARK </option>
                                            <option {{ old('marca') == 'TOYOTA-AVALON' ? 'selected' : '' }} value='TOYOTA-AVALON'>TOYOTA-AVALON </option>
                                            <option {{ old('marca') == 'TOYOTA-BANDEIRANTE' ? 'selected' : '' }} value='TOYOTA-BANDEIRANTE'>TOYOTA-BANDEIRANTE </option>
                                            <option {{ old('marca') == 'TOYOTA-CAMRY' ? 'selected' : '' }} value='TOYOTA-CAMRY'>TOYOTA-CAMRY </option>
                                            <option {{ old('marca') == 'TOYOTA-CELICA' ? 'selected' : '' }} value='TOYOTA-CELICA'>TOYOTA-CELICA </option>
                                            <option {{ old('marca') == 'TOYOTA-COROLLA' ? 'selected' : '' }} value='TOYOTA-COROLLA'>TOYOTA-COROLLA </option>
                                            <option {{ old('marca') == 'TOYOTA-CORONA' ? 'selected' : '' }} value='TOYOTA-CORONA'>TOYOTA-CORONA </option>
                                            <option {{ old('marca') == 'TOYOTA-HILUX' ? 'selected' : '' }} value='TOYOTA-HILUX'>TOYOTA-HILUX </option>
                                            <option {{ old('marca') == 'TOYOTA-LAND CRUISER' ? 'selected' : '' }} value='TOYOTA-LAND CRUISER'>TOYOTA-LAND CRUISER </option>
                                            <option {{ old('marca') == 'TOYOTA-MR-2' ? 'selected' : '' }} value='TOYOTA-MR-2'>TOYOTA-MR-2 </option>
                                            <option {{ old('marca') == 'TOYOTA-PASEO' ? 'selected' : '' }} value='TOYOTA-PASEO'>TOYOTA-PASEO </option>
                                            <option {{ old('marca') == 'TOYOTA-PREVIA' ? 'selected' : '' }} value='TOYOTA-PREVIA'>TOYOTA-PREVIA </option>
                                            <option {{ old('marca') == 'TOYOTA-RAV4' ? 'selected' : '' }} value='TOYOTA-RAV4'>TOYOTA-RAV4 </option>
                                            <option {{ old('marca') == 'TOYOTA-SUPRA' ? 'selected' : '' }} value='TOYOTA-SUPRA'>TOYOTA-SUPRA </option>
                                            <option {{ old('marca') == 'TROLLER-PANTANAL' ? 'selected' : '' }} value='TROLLER-PANTANAL'>TROLLER-PANTANAL </option>
                                            <option {{ old('marca') == 'TROLLER-T-4' ? 'selected' : '' }} value='TROLLER-T-4'>TROLLER-T-4 </option>
                                            <option {{ old('marca') == 'VOLVO-400 SERIES' ? 'selected' : '' }} value='VOLVO-400 SERIES'>VOLVO-400 SERIES </option>
                                            <option {{ old('marca') == 'VOLVO-850' ? 'selected' : '' }} value='VOLVO-850'>VOLVO-850 </option>
                                            <option {{ old('marca') == 'VOLVO-900 SERIES' ? 'selected' : '' }} value='VOLVO-900 SERIES'>VOLVO-900 SERIES </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-AMAROK' ? 'selected' : '' }} value='VOLKSWAGEN-AMAROK'>VOLKSWAGEN-AMAROK </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-APOLLO' ? 'selected' : '' }} value='VOLKSWAGEN-APOLLO'>VOLKSWAGEN-APOLLO </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-BORA' ? 'selected' : '' }} value='VOLKSWAGEN-BORA'>VOLKSWAGEN-BORA </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-CARAVELLE' ? 'selected' : '' }} value='VOLKSWAGEN-CARAVELLE'>VOLKSWAGEN-CARAVELLE </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-CORRADO' ? 'selected' : '' }} value='VOLKSWAGEN-CORRADO'>VOLKSWAGEN-CORRADO </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-EOS' ? 'selected' : '' }} value='VOLKSWAGEN-EOS'>VOLKSWAGEN-EOS </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-EUROVAN' ? 'selected' : '' }} value='VOLKSWAGEN-EUROVAN'>VOLKSWAGEN-EUROVAN </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-FOX' ? 'selected' : '' }} value='VOLKSWAGEN-FOX'>VOLKSWAGEN-FOX </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-FUSCA' ? 'selected' : '' }} value='VOLKSWAGEN-FUSCA'>VOLKSWAGEN-FUSCA </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-GOL' ? 'selected' : '' }} value='VOLKSWAGEN-GOL'>VOLKSWAGEN-GOL </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-GOLF' ? 'selected' : '' }} value='VOLKSWAGEN-GOLF'>VOLKSWAGEN-GOLF </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-JETTA' ? 'selected' : '' }} value='VOLKSWAGEN-JETTA'>VOLKSWAGEN-JETTA </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-KOMBI' ? 'selected' : '' }} value='VOLKSWAGEN-KOMBI'>VOLKSWAGEN-KOMBI </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-LOGUS' ? 'selected' : '' }} value='VOLKSWAGEN-LOGUS'>VOLKSWAGEN-LOGUS </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-PARATI' ? 'selected' : '' }} value='VOLKSWAGEN-PARATI'>VOLKSWAGEN-PARATI </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-PASSAT' ? 'selected' : '' }} value='VOLKSWAGEN-PASSAT'>VOLKSWAGEN-PASSAT </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-POINTER' ? 'selected' : '' }} value='VOLKSWAGEN-POINTER'>VOLKSWAGEN-POINTER </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-POLO' ? 'selected' : '' }} value='VOLKSWAGEN-POLO'>VOLKSWAGEN-POLO </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-SANTANA' ? 'selected' : '' }} value='VOLKSWAGEN-SANTANA'>VOLKSWAGEN-SANTANA </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-SAVEIRO' ? 'selected' : '' }} value='VOLKSWAGEN-SAVEIRO'>VOLKSWAGEN-SAVEIRO </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-SPACEFOX' ? 'selected' : '' }} value='VOLKSWAGEN-SPACEFOX'>VOLKSWAGEN-SPACEFOX </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-TIGUAN' ? 'selected' : '' }} value='VOLKSWAGEN-TIGUAN'>VOLKSWAGEN-TIGUAN </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-TOUAREG' ? 'selected' : '' }} value='VOLKSWAGEN-TOUAREG'>VOLKSWAGEN-TOUAREG </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-VOYAGE' ? 'selected' : '' }} value='VOLKSWAGEN-VOYAGE'>VOLKSWAGEN-VOYAGE </option>
                                            <option {{ old('marca') == 'ACURA-ZDX' ? 'selected' : '' }} value='ACURA-ZDX'>ACURA-ZDX </option>
                                            <option {{ old('marca') == 'FIAT-140' ? 'selected' : '' }} value='FIAT-140'>FIAT-140 </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-BRASILIA' ? 'selected' : '' }} value='VOLKSWAGEN-BRASILIA'>VOLKSWAGEN-BRASILIA </option>
                                            <option {{ old('marca') == 'FORD-BRASILVAN' ? 'selected' : '' }} value='FORD-BRASILVAN'>FORD-BRASILVAN </option>
                                            <option {{ old('marca') == 'FORD-CORCEL' ? 'selected' : '' }} value='FORD-CORCEL'>FORD-CORCEL </option>
                                            <option {{ old('marca') == 'FIAT-PALIO WEEKEND' ? 'selected' : '' }} value='FIAT-PALIO WEEKEND'>FIAT-PALIO WEEKEND </option>
                                            <option {{ old('marca') == 'FORD-FOCUS SEDAN' ? 'selected' : '' }} value='FORD-FOCUS SEDAN'>FORD-FOCUS SEDAN </option>
                                            <option {{ old('marca') == 'FORD-FIESTA SEDAN' ? 'selected' : '' }} value='FORD-FIESTA SEDAN'>FORD-FIESTA SEDAN </option>
                                            <option {{ old('marca') == 'FORD-FIESTA TRAIL' ? 'selected' : '' }} value='FORD-FIESTA TRAIL'>FORD-FIESTA TRAIL </option>
                                            <option {{ old('marca') == 'PEUGEOT-207 SW' ? 'selected' : '' }} value='PEUGEOT-207 SW'>PEUGEOT-207 SW </option>
                                            <option {{ old('marca') == 'FORD-ESCORT SW' ? 'selected' : '' }} value='FORD-ESCORT SW'>FORD-ESCORT SW </option>
                                            <option {{ old('marca') == 'PEUGEOT-307 SEDAN' ? 'selected' : '' }} value='PEUGEOT-307 SEDAN'>PEUGEOT-307 SEDAN </option>
                                            <option {{ old('marca') == 'PEUGEOT-307 SW' ? 'selected' : '' }} value='PEUGEOT-307 SW'>PEUGEOT-307 SW </option>
                                            <option {{ old('marca') == 'CITROEN-C4 PALLAS' ? 'selected' : '' }} value='CITROEN-C4 PALLAS'>CITROEN-C4 PALLAS </option>
                                            <option {{ old('marca') == 'CITROEN-C4 PICASSO' ? 'selected' : '' }} value='CITROEN-C4 PICASSO'>CITROEN-C4 PICASSO </option>
                                            <option {{ old('marca') == 'CITROEN-C4 VTR' ? 'selected' : '' }} value='CITROEN-C4 VTR'>CITROEN-C4 VTR </option>
                                            <option {{ old('marca') == 'RENAULT-CLIO SEDAN' ? 'selected' : '' }} value='RENAULT-CLIO SEDAN'>RENAULT-CLIO SEDAN </option>
                                            <option {{ old('marca') == 'TOYOTA-COROLLA FIELDER' ? 'selected' : '' }} value='TOYOTA-COROLLA FIELDER'>TOYOTA-COROLLA FIELDER </option>
                                            <option {{ old('marca') == 'TOYOTA-HILUX SW4' ? 'selected' : '' }} value='TOYOTA-HILUX SW4'>TOYOTA-HILUX SW4 </option>
                                            <option {{ old('marca') == 'RENAULT-MEGANE GRAND TOUR' ? 'selected' : '' }} value='RENAULT-MEGANE GRAND TOUR'>RENAULT-MEGANE GRAND TOUR </option>
                                            <option {{ old('marca') == 'RENAULT-SANDERO STEPWAY' ? 'selected' : '' }} value='RENAULT-SANDERO STEPWAY'>RENAULT-SANDERO STEPWAY </option>
                                            <option {{ old('marca') == 'CITROEN-XSARA PICASSO' ? 'selected' : '' }} value='CITROEN-XSARA PICASSO'>CITROEN-XSARA PICASSO </option>
                                            <option {{ old('marca') == 'UTILITARIOS AGRICOLAS-COLHEITADEIRA' ? 'selected' : '' }} value='UTILITARIOS AGRICOLAS-COLHEITADEIRA'>UTILITARIOS
                                                AGRICOLAS-COLHEITADEIRA </option>
                                            <option {{ old('marca') == 'WILLYS OVERLAND-PICKUP F75' ? 'selected' : '' }} value='WILLYS OVERLAND-PICKUP F75'>WILLYS OVERLAND-PICKUP F75 </option>
                                            <option {{ old('marca') == 'GURGEL-X12' ? 'selected' : '' }} value='GURGEL-X12'>GURGEL-X12 </option>
                                            <option {{ old('marca') == 'CHEVROLET-BEL AIR' ? 'selected' : '' }} value='CHEVROLET-BEL AIR'>CHEVROLET-BEL AIR </option>
                                            <option {{ old('marca') == 'BMW-RX' ? 'selected' : '' }} value='BMW-RX'>
                                                BMW-RX </option>
                                            <option {{ old('marca') == 'CHEVROLET-C-14' ? 'selected' : '' }} value='CHEVROLET-C-14'>CHEVROLET-C-14 </option>
                                            <option {{ old('marca') == 'CADILLAC-SRX4' ? 'selected' : '' }} value='CADILLAC-SRX4'>CADILLAC-SRX4 </option>
                                            <option {{ old('marca') == 'CHEVROLET-C-15' ? 'selected' : '' }} value='CHEVROLET-C-15'>CHEVROLET-C-15 </option>
                                            <option {{ old('marca') == 'CHEVROLET-BRASIL' ? 'selected' : '' }} value='CHEVROLET-BRASIL'>CHEVROLET-BRASIL </option>
                                            <option {{ old('marca') == 'DODGE-POLARA' ? 'selected' : '' }} value='DODGE-POLARA'>DODGE-POLARA </option>
                                            <option {{ old('marca') == 'FIAT-600' ? 'selected' : '' }} value='FIAT-600'>FIAT-600 </option>
                                            <option {{ old('marca') == 'FORD-F-01' ? 'selected' : '' }} value='FORD-F-01'>FORD-F-01 </option>
                                            <option {{ old('marca') == 'FORD-FALCON' ? 'selected' : '' }} value='FORD-FALCON'>FORD-FALCON </option>
                                            <option {{ old('marca') == 'FORD-GALAXIE' ? 'selected' : '' }} value='FORD-GALAXIE'>FORD-GALAXIE </option>
                                            <option {{ old('marca') == 'FORD-MAVERICK' ? 'selected' : '' }} value='FORD-MAVERICK'>FORD-MAVERICK </option>
                                            <option {{ old('marca') == 'FORD-MODELO A' ? 'selected' : '' }} value='FORD-MODELO A'>FORD-MODELO A </option>
                                            <option {{ old('marca') == 'FORD-NEW FIESTA' ? 'selected' : '' }} value='FORD-NEW FIESTA'>FORD-NEW FIESTA </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA FX' ? 'selected' : '' }} value='INFINITI-LINHA FX'>INFINITI-LINHA FX </option>
                                            <option {{ old('marca') == 'PUMA-GTS' ? 'selected' : '' }} value='PUMA-GTS'>PUMA-GTS </option>
                                            <option {{ old('marca') == 'HUMMER-H3' ? 'selected' : '' }} value='HUMMER-H3'>HUMMER-H3 </option>
                                            <option {{ old('marca') == 'HYUNDAI-PRIME' ? 'selected' : '' }} value='HYUNDAI-PRIME'>HYUNDAI-PRIME </option>
                                            <option {{ old('marca') == 'HYUNDAI-TIBURON' ? 'selected' : '' }} value='HYUNDAI-TIBURON'>HYUNDAI-TIBURON </option>
                                            <option {{ old('marca') == 'JEEP-JEEP' ? 'selected' : '' }} value='JEEP-JEEP'>JEEP-JEEP </option>
                                            <option {{ old('marca') == 'JEEP-CJ5' ? 'selected' : '' }} value='JEEP-CJ5'>JEEP-CJ5 </option>
                                            <option {{ old('marca') == 'KARMANN GHIA-TC' ? 'selected' : '' }} value='KARMANN GHIA-TC'>KARMANN GHIA-TC </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE CLC' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE CLC'>MERCEDES-BENZ-CLASSE CLC </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE CLS' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE CLS'>MERCEDES-BENZ-CLASSE CLS </option>
                                            <option {{ old('marca') == 'MERCURY-MONTEREY' ? 'selected' : '' }} value='MERCURY-MONTEREY'>MERCURY-MONTEREY </option>
                                            <option {{ old('marca') == 'MIURA-TOPSPORT' ? 'selected' : '' }} value='MIURA-TOPSPORT'>MIURA-TOPSPORT </option>
                                            <option {{ old('marca') == 'MIURA-TARGA' ? 'selected' : '' }} value='MIURA-TARGA'>MIURA-TARGA </option>
                                            <option {{ old('marca') == 'MIURA-X8' ? 'selected' : '' }} value='MIURA-X8'>MIURA-X8 </option>
                                            <option {{ old('marca') == 'NISSAN-370Z' ? 'selected' : '' }} value='NISSAN-370Z'>NISSAN-370Z </option>
                                            <option {{ old('marca') == 'PUMA-GTB' ? 'selected' : '' }} value='PUMA-GTB'>PUMA-GTB </option>
                                            <option {{ old('marca') == 'PUMA-GTC' ? 'selected' : '' }} value='PUMA-GTC'>PUMA-GTC </option>
                                            <option {{ old('marca') == 'PUMA-GTE' ? 'selected' : '' }} value='PUMA-GTE'>PUMA-GTE </option>
                                            <option {{ old('marca') == 'MORRIS-AUSTIN' ? 'selected' : '' }} value='MORRIS-AUSTIN'>MORRIS-AUSTIN </option>
                                            <option {{ old('marca') == 'RENAULT-7TL' ? 'selected' : '' }} value='RENAULT-7TL'>RENAULT-7TL </option>
                                            <option {{ old('marca') == 'RENAULT-19' ? 'selected' : '' }} value='RENAULT-19'>RENAULT-19 </option>
                                            <option {{ old('marca') == 'SKODA-CONVERSÍVEL' ? 'selected' : '' }} value='SKODA-CONVERSÍVEL'>SKODA-CONVERSÍVEL </option>
                                            <option {{ old('marca') == 'GURGEL-SUPERMINI' ? 'selected' : '' }} value='GURGEL-SUPERMINI'>GURGEL-SUPERMINI </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-TL' ? 'selected' : '' }} value='VOLKSWAGEN-TL'>VOLKSWAGEN-TL </option>
                                            <option {{ old('marca') == 'FIAT-TOPOLINO' ? 'selected' : '' }} value='FIAT-TOPOLINO'>FIAT-TOPOLINO </option>
                                            <option {{ old('marca') == 'TOYOTA-SR5' ? 'selected' : '' }} value='TOYOTA-SR5'>TOYOTA-SR5 </option>
                                            <option {{ old('marca') == 'TOYOTA-VITZ' ? 'selected' : '' }} value='TOYOTA-VITZ'>TOYOTA-VITZ </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-VARIANT' ? 'selected' : '' }} value='VOLKSWAGEN-VARIANT'>VOLKSWAGEN-VARIANT </option>
                                            <option {{ old('marca') == 'DKW-VEMAG-CANDANGO' ? 'selected' : '' }} value='DKW-VEMAG-CANDANGO'>DKW-VEMAG-CANDANGO </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-SP2' ? 'selected' : '' }} value='VOLKSWAGEN-SP2'>VOLKSWAGEN-SP2 </option>
                                            <option {{ old('marca') == 'HANOMAG-RECORB' ? 'selected' : '' }} value='HANOMAG-RECORB'>HANOMAG-RECORB </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-POLAUTO' ? 'selected' : '' }} value='VOLKSWAGEN-POLAUTO'>VOLKSWAGEN-POLAUTO </option>
                                            <option {{ old('marca') == 'RENAULT-GORDINI' ? 'selected' : '' }} value='RENAULT-GORDINI'>RENAULT-GORDINI </option>
                                            <option {{ old('marca') == 'HILLMAN-MINX' ? 'selected' : '' }} value='HILLMAN-MINX'>HILLMAN-MINX </option>
                                            <option {{ old('marca') == 'TOYOTA-ETIOS' ? 'selected' : '' }} value='TOYOTA-ETIOS'>TOYOTA-ETIOS </option>
                                            <option {{ old('marca') == 'CHEVROLET-ONIX' ? 'selected' : '' }} value='CHEVROLET-ONIX'>CHEVROLET-ONIX </option>
                                            <option {{ old('marca') == 'HYUNDAI-HB20' ? 'selected' : '' }} value='HYUNDAI-HB20'>HYUNDAI-HB20 </option>
                                            <option {{ old('marca') == 'BMW-330' ? 'selected' : '' }} value='BMW-330'>BMW-330 </option>
                                            <option {{ old('marca') == 'BMW-520' ? 'selected' : '' }} value='BMW-520'>BMW-520 </option>
                                            <option {{ old('marca') == 'BMW-730' ? 'selected' : '' }} value='BMW-730'>BMW-730 </option>
                                            <option {{ old('marca') == 'BMW-M1' ? 'selected' : '' }} value='BMW-M1'>
                                                BMW-M1 </option>
                                            <option {{ old('marca') == 'BMW-SERIE Z' ? 'selected' : '' }} value='BMW-SERIE Z'>BMW-SERIE Z </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE SLK' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE SLK'>MERCEDES-BENZ-CLASSE SLK </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE C' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE C'>MERCEDES-BENZ-CLASSE C </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE E' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE E'>MERCEDES-BENZ-CLASSE E </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE CL' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE CL'>MERCEDES-BENZ-CLASSE CL </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE CLK' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE CLK'>MERCEDES-BENZ-CLASSE CLK </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE S' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE S'>MERCEDES-BENZ-CLASSE S </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE SL' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE SL'>MERCEDES-BENZ-CLASSE SL </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE SLS' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE SLS'>MERCEDES-BENZ-CLASSE SLS </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE G' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE G'>MERCEDES-BENZ-CLASSE G </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE GL' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE GL'>MERCEDES-BENZ-CLASSE GL </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE M' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE M'>MERCEDES-BENZ-CLASSE M </option>
                                            <option {{ old('marca') == 'HRG-1500' ? 'selected' : '' }} value='HRG-1500'>HRG-1500 </option>
                                            <option {{ old('marca') == 'HYUNDAI-EQUUS' ? 'selected' : '' }} value='HYUNDAI-EQUUS'>HYUNDAI-EQUUS </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-350 GT' ? 'selected' : '' }} value='LAMBORGHINI-350 GT'>LAMBORGHINI-350 GT </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-400 GT' ? 'selected' : '' }} value='LAMBORGHINI-400 GT'>LAMBORGHINI-400 GT </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-MIURA' ? 'selected' : '' }} value='LAMBORGHINI-MIURA'>LAMBORGHINI-MIURA </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-ISLERO' ? 'selected' : '' }} value='LAMBORGHINI-ISLERO'>LAMBORGHINI-ISLERO </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-ESPADA' ? 'selected' : '' }} value='LAMBORGHINI-ESPADA'>LAMBORGHINI-ESPADA </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-COUNTACH' ? 'selected' : '' }} value='LAMBORGHINI-COUNTACH'>LAMBORGHINI-COUNTACH </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-DIABLO' ? 'selected' : '' }} value='LAMBORGHINI-DIABLO'>LAMBORGHINI-DIABLO </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-ZAGATO' ? 'selected' : '' }} value='LAMBORGHINI-ZAGATO'>LAMBORGHINI-ZAGATO </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-ALAR' ? 'selected' : '' }} value='LAMBORGHINI-ALAR'>LAMBORGHINI-ALAR </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-LM002' ? 'selected' : '' }} value='LAMBORGHINI-LM002'>LAMBORGHINI-LM002 </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-REVENTON' ? 'selected' : '' }} value='LAMBORGHINI-REVENTON'>LAMBORGHINI-REVENTON </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-ANKONIAN' ? 'selected' : '' }} value='LAMBORGHINI-ANKONIAN'>LAMBORGHINI-ANKONIAN </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-AVENTADOR' ? 'selected' : '' }} value='LAMBORGHINI-AVENTADOR'>LAMBORGHINI-AVENTADOR </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-SESTO ELEMENTO' ? 'selected' : '' }} value='LAMBORGHINI-SESTO ELEMENTO'>LAMBORGHINI-SESTO ELEMENTO </option>
                                            <option {{ old('marca') == 'JAC-J3 TURIN' ? 'selected' : '' }} value='JAC-J3 TURIN'>JAC-J3 TURIN </option>
                                            <option {{ old('marca') == 'JAC-J2' ? 'selected' : '' }} value='JAC-J2'>
                                                JAC-J2 </option>
                                            <option {{ old('marca') == 'RENAULT-SANDERO GT' ? 'selected' : '' }} value='RENAULT-SANDERO GT'>RENAULT-SANDERO GT </option>
                                            <option {{ old('marca') == 'CHEVROLET-SPIN' ? 'selected' : '' }} value='CHEVROLET-SPIN'>CHEVROLET-SPIN </option>
                                            <option {{ old('marca') == 'CHEVROLET-TRAILBLAZER' ? 'selected' : '' }} value='CHEVROLET-TRAILBLAZER'>CHEVROLET-TRAILBLAZER </option>
                                            <option {{ old('marca') == 'CITROEN-C3 PICASSO' ? 'selected' : '' }} value='CITROEN-C3 PICASSO'>CITROEN-C3 PICASSO </option>
                                            <option {{ old('marca') == 'CITROEN-GRAND C4 PICASSO' ? 'selected' : '' }} value='CITROEN-GRAND C4 PICASSO'>CITROEN-GRAND C4 PICASSO </option>
                                            <option {{ old('marca') == 'CITROEN-JUMPER MINIBUS' ? 'selected' : '' }} value='CITROEN-JUMPER MINIBUS'>CITROEN-JUMPER MINIBUS </option>
                                            <option {{ old('marca') == 'CITROEN-JUMPER VETRATO' ? 'selected' : '' }} value='CITROEN-JUMPER VETRATO'>CITROEN-JUMPER VETRATO </option>
                                            <option {{ old('marca') == 'PEUGEOT-207 SEDAN' ? 'selected' : '' }} value='PEUGEOT-207 SEDAN'>PEUGEOT-207 SEDAN </option>
                                            <option {{ old('marca') == 'PEUGEOT-207 QUIKSILVER' ? 'selected' : '' }} value='PEUGEOT-207 QUIKSILVER'>PEUGEOT-207 QUIKSILVER </option>
                                            <option {{ old('marca') == 'PEUGEOT-207 ESCAPADE' ? 'selected' : '' }} value='PEUGEOT-207 ESCAPADE'>PEUGEOT-207 ESCAPADE </option>
                                            <option {{ old('marca') == 'PEUGEOT-308 CC' ? 'selected' : '' }} value='PEUGEOT-308 CC'>PEUGEOT-308 CC </option>
                                            <option {{ old('marca') == 'PEUGEOT-BOXER PASSAGEIRO' ? 'selected' : '' }} value='PEUGEOT-BOXER PASSAGEIRO'>PEUGEOT-BOXER PASSAGEIRO </option>
                                            <option {{ old('marca') == 'FORD-NEW FIESTA SEDAN' ? 'selected' : '' }} value='FORD-NEW FIESTA SEDAN'>FORD-NEW FIESTA SEDAN </option>
                                            <option {{ old('marca') == 'FORD-TRANSIT PASSAGEIRO' ? 'selected' : '' }} value='FORD-TRANSIT PASSAGEIRO'>FORD-TRANSIT PASSAGEIRO </option>
                                            <option {{ old('marca') == 'FORD-TRANSIT CHASSI' ? 'selected' : '' }} value='FORD-TRANSIT CHASSI'>FORD-TRANSIT CHASSI </option>
                                            <option {{ old('marca') == 'AUDI-A4 AVANT' ? 'selected' : '' }} value='AUDI-A4 AVANT'>AUDI-A4 AVANT </option>
                                            <option {{ old('marca') == 'AUDI-S4 AVANT' ? 'selected' : '' }} value='AUDI-S4 AVANT'>AUDI-S4 AVANT </option>
                                            <option {{ old('marca') == 'AUDI-A5 SPORTBACK' ? 'selected' : '' }} value='AUDI-A5 SPORTBACK'>AUDI-A5 SPORTBACK </option>
                                            <option {{ old('marca') == 'AUDI-A5 CABRIOLET' ? 'selected' : '' }} value='AUDI-A5 CABRIOLET'>AUDI-A5 CABRIOLET </option>
                                            <option {{ old('marca') == 'AUDI-S5 COUPE' ? 'selected' : '' }} value='AUDI-S5 COUPE'>AUDI-S5 COUPE </option>
                                            <option {{ old('marca') == 'AUDI-S5 SPORTBACK' ? 'selected' : '' }} value='AUDI-S5 SPORTBACK'>AUDI-S5 SPORTBACK </option>
                                            <option {{ old('marca') == 'AUDI-S5 CABRIOLET' ? 'selected' : '' }} value='AUDI-S5 CABRIOLET'>AUDI-S5 CABRIOLET </option>
                                            <option {{ old('marca') == 'AUDI-A6 AVANT' ? 'selected' : '' }} value='AUDI-A6 AVANT'>AUDI-A6 AVANT </option>
                                            <option {{ old('marca') == 'AUDI-A6 ALLROAD' ? 'selected' : '' }} value='AUDI-A6 ALLROAD'>AUDI-A6 ALLROAD </option>
                                            <option {{ old('marca') == 'AUDI-S6 AVANT' ? 'selected' : '' }} value='AUDI-S6 AVANT'>AUDI-S6 AVANT </option>
                                            <option {{ old('marca') == 'AUDI-S7' ? 'selected' : '' }} value='AUDI-S7'>AUDI-S7 </option>
                                            <option {{ old('marca') == 'AUDI-TT ROADSTER' ? 'selected' : '' }} value='AUDI-TT ROADSTER'>AUDI-TT ROADSTER </option>
                                            <option {{ old('marca') == 'AUDI-TT RS' ? 'selected' : '' }} value='AUDI-TT RS'>AUDI-TT RS </option>
                                            <option {{ old('marca') == 'AUDI-TT RS ROADSTER' ? 'selected' : '' }} value='AUDI-TT RS ROADSTER'>AUDI-TT RS ROADSTER </option>
                                            <option {{ old('marca') == 'AUDI-TTS ROADSTER' ? 'selected' : '' }} value='AUDI-TTS ROADSTER'>AUDI-TTS ROADSTER </option>
                                            <option {{ old('marca') == 'AUDI-R8 SPYDER' ? 'selected' : '' }} value='AUDI-R8 SPYDER'>AUDI-R8 SPYDER </option>
                                            <option {{ old('marca') == 'AUDI-R8 GT' ? 'selected' : '' }} value='AUDI-R8 GT'>AUDI-R8 GT </option>
                                            <option {{ old('marca') == 'AUDI-R8 GT SPYDER' ? 'selected' : '' }} value='AUDI-R8 GT SPYDER'>AUDI-R8 GT SPYDER </option>
                                            <option {{ old('marca') == 'FERRARI-F12' ? 'selected' : '' }} value='FERRARI-F12'>FERRARI-F12 </option>
                                            <option {{ old('marca') == 'FERRARI-458 SPIDER' ? 'selected' : '' }} value='FERRARI-458 SPIDER'>FERRARI-458 SPIDER </option>
                                            <option {{ old('marca') == 'FERRARI-458 ITALIA' ? 'selected' : '' }} value='FERRARI-458 ITALIA'>FERRARI-458 ITALIA </option>
                                            <option {{ old('marca') == 'FERRARI-FF' ? 'selected' : '' }} value='FERRARI-FF'>FERRARI-FF </option>
                                            <option {{ old('marca') == 'FERRARI-599' ? 'selected' : '' }} value='FERRARI-599'>FERRARI-599 </option>
                                            <option {{ old('marca') == 'FERRARI-SA' ? 'selected' : '' }} value='FERRARI-SA'>FERRARI-SA </option>
                                            <option {{ old('marca') == 'FERRARI-CHALLENGE' ? 'selected' : '' }} value='FERRARI-CHALLENGE'>FERRARI-CHALLENGE </option>
                                            <option {{ old('marca') == 'FERRARI-SUPERAMERICA' ? 'selected' : '' }} value='FERRARI-SUPERAMERICA'>FERRARI-SUPERAMERICA </option>
                                            <option {{ old('marca') == 'FERRARI-F430 SPIDER' ? 'selected' : '' }} value='FERRARI-F430 SPIDER'>FERRARI-F430 SPIDER </option>
                                            <option {{ old('marca') == 'FERRARI-430' ? 'selected' : '' }} value='FERRARI-430'>FERRARI-430 </option>
                                            <option {{ old('marca') == 'FERRARI-612 SESSANTA' ? 'selected' : '' }} value='FERRARI-612 SESSANTA'>FERRARI-612 SESSANTA </option>
                                            <option {{ old('marca') == 'FERRARI-599 GTB' ? 'selected' : '' }} value='FERRARI-599 GTB'>FERRARI-599 GTB </option>
                                            <option {{ old('marca') == 'FERRARI-SCUDERIA SPIDER' ? 'selected' : '' }} value='FERRARI-SCUDERIA SPIDER'>FERRARI-SCUDERIA SPIDER </option>
                                            <option {{ old('marca') == 'FERRARI-512' ? 'selected' : '' }} value='FERRARI-512'>FERRARI-512 </option>
                                            <option {{ old('marca') == 'FERRARI-456 GT' ? 'selected' : '' }} value='FERRARI-456 GT'>FERRARI-456 GT </option>
                                            <option {{ old('marca') == 'FERRARI-348 GTS' ? 'selected' : '' }} value='FERRARI-348 GTS'>FERRARI-348 GTS </option>
                                            <option {{ old('marca') == 'FERRARI-348 SPIDER' ? 'selected' : '' }} value='FERRARI-348 SPIDER'>FERRARI-348 SPIDER </option>
                                            <option {{ old('marca') == 'FERRARI-F355' ? 'selected' : '' }} value='FERRARI-F355'>FERRARI-F355 </option>
                                            <option {{ old('marca') == 'FERRARI-F355 SPIDER' ? 'selected' : '' }} value='FERRARI-F355 SPIDER'>FERRARI-F355 SPIDER </option>
                                            <option {{ old('marca') == 'FERRARI-F50' ? 'selected' : '' }} value='FERRARI-F50'>FERRARI-F50 </option>
                                            <option {{ old('marca') == 'FERRARI-355 SPIDER' ? 'selected' : '' }} value='FERRARI-355 SPIDER'>FERRARI-355 SPIDER </option>
                                            <option {{ old('marca') == 'FERRARI-360 MODENA' ? 'selected' : '' }} value='FERRARI-360 MODENA'>FERRARI-360 MODENA </option>
                                            <option {{ old('marca') == 'MITSUBISHI-PAJERO FULL' ? 'selected' : '' }} value='MITSUBISHI-PAJERO FULL'>MITSUBISHI-PAJERO FULL </option>
                                            <option {{ old('marca') == 'MITSUBISHI-PAJERO DAKAR' ? 'selected' : '' }} value='MITSUBISHI-PAJERO DAKAR'>MITSUBISHI-PAJERO DAKAR </option>
                                            <option {{ old('marca') == 'MITSUBISHI-PAJERO TR4' ? 'selected' : '' }} value='MITSUBISHI-PAJERO TR4'>MITSUBISHI-PAJERO TR4 </option>
                                            <option {{ old('marca') == 'MITSUBISHI-LANCER SPORTBACK' ? 'selected' : '' }} value='MITSUBISHI-LANCER SPORTBACK'>MITSUBISHI-LANCER SPORTBACK
                                            </option>
                                            <option {{ old('marca') == 'MITSUBISHI-LANCER EVOLUTION' ? 'selected' : '' }} value='MITSUBISHI-LANCER EVOLUTION'>MITSUBISHI-LANCER EVOLUTION
                                            </option>
                                            <option {{ old('marca') == 'MITSUBISHI-L200 TRITON SAVANA' ? 'selected' : '' }} value='MITSUBISHI-L200 TRITON SAVANA'>MITSUBISHI-L200 TRITON SAVANA
                                            </option>
                                            <option {{ old('marca') == 'MITSUBISHI-L200 TRITON' ? 'selected' : '' }} value='MITSUBISHI-L200 TRITON'>MITSUBISHI-L200 TRITON </option>
                                            <option {{ old('marca') == 'NISSAN-LIVINA X-GEAR' ? 'selected' : '' }} value='NISSAN-LIVINA X-GEAR'>NISSAN-LIVINA X-GEAR </option>
                                            <option {{ old('marca') == 'NISSAN-GRAND LIVINA' ? 'selected' : '' }} value='NISSAN-GRAND LIVINA'>NISSAN-GRAND LIVINA </option>
                                            <option {{ old('marca') == 'SSANGYONG-NEW ACTYON SPORTS' ? 'selected' : '' }} value='SSANGYONG-NEW ACTYON SPORTS'>SSANGYONG-NEW ACTYON SPORTS
                                            </option>
                                            <option {{ old('marca') == 'TOYOTA-PRIUS' ? 'selected' : '' }} value='TOYOTA-PRIUS'>TOYOTA-PRIUS </option>
                                            <option {{ old('marca') == 'MIURA-SPORT' ? 'selected' : '' }} value='MIURA-SPORT'>MIURA-SPORT </option>
                                            <option {{ old('marca') == 'MIURA-MTS' ? 'selected' : '' }} value='MIURA-MTS'>MIURA-MTS </option>
                                            <option {{ old('marca') == 'MIURA-SPIDER' ? 'selected' : '' }} value='MIURA-SPIDER'>MIURA-SPIDER </option>
                                            <option {{ old('marca') == 'MIURA-KABRIO' ? 'selected' : '' }} value='MIURA-KABRIO'>MIURA-KABRIO </option>
                                            <option {{ old('marca') == 'MIURA-SAGA' ? 'selected' : '' }} value='MIURA-SAGA'>MIURA-SAGA </option>
                                            <option {{ old('marca') == 'MIURA-SAGA II' ? 'selected' : '' }} value='MIURA-SAGA II'>MIURA-SAGA II </option>
                                            <option {{ old('marca') == 'MIURA-787' ? 'selected' : '' }} value='MIURA-787'>MIURA-787 </option>
                                            <option {{ old('marca') == 'MIURA-X11' ? 'selected' : '' }} value='MIURA-X11'>MIURA-X11 </option>
                                            <option {{ old('marca') == 'GAIOLA-GAIOLA' ? 'selected' : '' }} value='GAIOLA-GAIOLA'>GAIOLA-GAIOLA </option>
                                            <option {{ old('marca') == 'DODGE-NITRO' ? 'selected' : '' }} value='DODGE-NITRO'>DODGE-NITRO </option>
                                            <option {{ old('marca') == 'DODGE-CHALLENGER' ? 'selected' : '' }} value='DODGE-CHALLENGER'>DODGE-CHALLENGER </option>
                                            <option {{ old('marca') == 'DODGE-DART' ? 'selected' : '' }} value='DODGE-DART'>DODGE-DART </option>
                                            <option {{ old('marca') == 'DODGE-LE BARON' ? 'selected' : '' }} value='DODGE-LE BARON'>DODGE-LE BARON </option>
                                            <option {{ old('marca') == 'DODGE-CORDOBA' ? 'selected' : '' }} value='DODGE-CORDOBA'>DODGE-CORDOBA </option>
                                            <option {{ old('marca') == 'DODGE-CHARGER' ? 'selected' : '' }} value='DODGE-CHARGER'>DODGE-CHARGER </option>
                                            <option {{ old('marca') == 'CHRYSLER-WINDSOR' ? 'selected' : '' }} value='CHRYSLER-WINDSOR'>CHRYSLER-WINDSOR </option>
                                            <option {{ old('marca') == 'CHRYSLER-CROSSFIRE' ? 'selected' : '' }} value='CHRYSLER-CROSSFIRE'>CHRYSLER-CROSSFIRE </option>
                                            <option {{ old('marca') == 'CHRYSLER-CORDOBA' ? 'selected' : '' }} value='CHRYSLER-CORDOBA'>CHRYSLER-CORDOBA </option>
                                            <option {{ old('marca') == 'CADILLAC-ESCALADE' ? 'selected' : '' }} value='CADILLAC-ESCALADE'>CADILLAC-ESCALADE </option>
                                            <option {{ old('marca') == 'BUICK-RIVIERA' ? 'selected' : '' }} value='BUICK-RIVIERA'>BUICK-RIVIERA </option>
                                            <option {{ old('marca') == 'BUICK-COUPE' ? 'selected' : '' }} value='BUICK-COUPE'>BUICK-COUPE </option>
                                            <option {{ old('marca') == 'BUICK-CENTURY' ? 'selected' : '' }} value='BUICK-CENTURY'>BUICK-CENTURY </option>
                                            <option {{ old('marca') == 'BUICK-APOLLO' ? 'selected' : '' }} value='BUICK-APOLLO'>BUICK-APOLLO </option>
                                            <option {{ old('marca') == 'BUICK-CENTURION' ? 'selected' : '' }} value='BUICK-CENTURION'>BUICK-CENTURION </option>
                                            <option {{ old('marca') == 'BUICK-EIGHT' ? 'selected' : '' }} value='BUICK-EIGHT'>BUICK-EIGHT </option>
                                            <option {{ old('marca') == 'BUICK-ELECTRA' ? 'selected' : '' }} value='BUICK-ELECTRA'>BUICK-ELECTRA </option>
                                            <option {{ old('marca') == 'BUICK-ESTATE WAGON' ? 'selected' : '' }} value='BUICK-ESTATE WAGON'>BUICK-ESTATE WAGON </option>
                                            <option {{ old('marca') == 'BUICK-GRAN SPORT' ? 'selected' : '' }} value='BUICK-GRAN SPORT'>BUICK-GRAN SPORT </option>
                                            <option {{ old('marca') == 'BUICK-GSX' ? 'selected' : '' }} value='BUICK-GSX'>BUICK-GSX </option>
                                            <option {{ old('marca') == 'BUICK-INVICTA' ? 'selected' : '' }} value='BUICK-INVICTA'>BUICK-INVICTA </option>
                                            <option {{ old('marca') == 'BUICK-LESABRE' ? 'selected' : '' }} value='BUICK-LESABRE'>BUICK-LESABRE </option>
                                            <option {{ old('marca') == 'BUICK-LIMITED' ? 'selected' : '' }} value='BUICK-LIMITED'>BUICK-LIMITED </option>
                                            <option {{ old('marca') == 'BUICK-PARK AVENUE' ? 'selected' : '' }} value='BUICK-PARK AVENUE'>BUICK-PARK AVENUE </option>
                                            <option {{ old('marca') == 'BUICK-RAINIER' ? 'selected' : '' }} value='BUICK-RAINIER'>BUICK-RAINIER </option>
                                            <option {{ old('marca') == 'BUICK-REATTA' ? 'selected' : '' }} value='BUICK-REATTA'>BUICK-REATTA </option>
                                            <option {{ old('marca') == 'BUICK-REGAL' ? 'selected' : '' }} value='BUICK-REGAL'>BUICK-REGAL </option>
                                            <option {{ old('marca') == 'BUICK-RENDEZVOUS' ? 'selected' : '' }} value='BUICK-RENDEZVOUS'>BUICK-RENDEZVOUS </option>
                                            <option {{ old('marca') == 'BUICK-ROADMASTER' ? 'selected' : '' }} value='BUICK-ROADMASTER'>BUICK-ROADMASTER </option>
                                            <option {{ old('marca') == 'BUICK-ROYAUM' ? 'selected' : '' }} value='BUICK-ROYAUM'>BUICK-ROYAUM </option>
                                            <option {{ old('marca') == 'BUICK-SKYHAWK' ? 'selected' : '' }} value='BUICK-SKYHAWK'>BUICK-SKYHAWK </option>
                                            <option {{ old('marca') == 'BUICK-SKYLARK' ? 'selected' : '' }} value='BUICK-SKYLARK'>BUICK-SKYLARK </option>
                                            <option {{ old('marca') == 'BUICK-SOMERSET' ? 'selected' : '' }} value='BUICK-SOMERSET'>BUICK-SOMERSET </option>
                                            <option {{ old('marca') == 'BUICK-SPECIAL' ? 'selected' : '' }} value='BUICK-SPECIAL'>BUICK-SPECIAL </option>
                                            <option {{ old('marca') == 'BUICK-SPORT WAGON' ? 'selected' : '' }} value='BUICK-SPORT WAGON'>BUICK-SPORT WAGON </option>
                                            <option {{ old('marca') == 'BUICK-SUPER' ? 'selected' : '' }} value='BUICK-SUPER'>BUICK-SUPER </option>
                                            <option {{ old('marca') == 'BUICK-TERRAZA' ? 'selected' : '' }} value='BUICK-TERRAZA'>BUICK-TERRAZA </option>
                                            <option {{ old('marca') == 'BUICK-WILDCAT' ? 'selected' : '' }} value='BUICK-WILDCAT'>BUICK-WILDCAT </option>
                                            <option {{ old('marca') == 'BUICK-LACROSSE' ? 'selected' : '' }} value='BUICK-LACROSSE'>BUICK-LACROSSE </option>
                                            <option {{ old('marca') == 'BUICK-ENCLAVE' ? 'selected' : '' }} value='BUICK-ENCLAVE'>BUICK-ENCLAVE </option>
                                            <option {{ old('marca') == 'BUICK-GL8' ? 'selected' : '' }} value='BUICK-GL8'>BUICK-GL8 </option>
                                            <option {{ old('marca') == 'BUICK-HRV' ? 'selected' : '' }} value='BUICK-HRV'>BUICK-HRV </option>
                                            <option {{ old('marca') == 'BUICK-LUCERNE' ? 'selected' : '' }} value='BUICK-LUCERNE'>BUICK-LUCERNE </option>
                                            <option {{ old('marca') == 'FORD-SIERRA' ? 'selected' : '' }} value='FORD-SIERRA'>FORD-SIERRA </option>
                                            <option {{ old('marca') == 'DAEWOO-BROUGHAM' ? 'selected' : '' }} value='DAEWOO-BROUGHAM'>DAEWOO-BROUGHAM </option>
                                            <option {{ old('marca') == 'DAEWOO-CHAIRMAN' ? 'selected' : '' }} value='DAEWOO-CHAIRMAN'>DAEWOO-CHAIRMAN </option>
                                            <option {{ old('marca') == 'DAEWOO-DAMAS' ? 'selected' : '' }} value='DAEWOO-DAMAS'>DAEWOO-DAMAS </option>
                                            <option {{ old('marca') == 'DAEWOO-GENTRA' ? 'selected' : '' }} value='DAEWOO-GENTRA'>DAEWOO-GENTRA </option>
                                            <option {{ old('marca') == 'DAEWOO-MAEPSY' ? 'selected' : '' }} value='DAEWOO-MAEPSY'>DAEWOO-MAEPSY </option>
                                            <option {{ old('marca') == 'DAEWOO-ISTANA' ? 'selected' : '' }} value='DAEWOO-ISTANA'>DAEWOO-ISTANA </option>
                                            <option {{ old('marca') == 'DAEWOO-KALOS' ? 'selected' : '' }} value='DAEWOO-KALOS'>DAEWOO-KALOS </option>
                                            <option {{ old('marca') == 'DAEWOO-KORANDO' ? 'selected' : '' }} value='DAEWOO-KORANDO'>DAEWOO-KORANDO </option>
                                            <option {{ old('marca') == 'DAEWOO-LACETTI' ? 'selected' : '' }} value='DAEWOO-LACETTI'>DAEWOO-LACETTI </option>
                                            <option {{ old('marca') == 'DAEWOO-LEMANS' ? 'selected' : '' }} value='DAEWOO-LEMANS'>DAEWOO-LEMANS </option>
                                            <option {{ old('marca') == 'DAEWOO-MATIZ' ? 'selected' : '' }} value='DAEWOO-MATIZ'>DAEWOO-MATIZ </option>
                                            <option {{ old('marca') == 'DAEWOO-MUSSO' ? 'selected' : '' }} value='DAEWOO-MUSSO'>DAEWOO-MUSSO </option>
                                            <option {{ old('marca') == 'DAEWOO-NEXIA' ? 'selected' : '' }} value='DAEWOO-NEXIA'>DAEWOO-NEXIA </option>
                                            <option {{ old('marca') == 'DAEWOO-REZZO' ? 'selected' : '' }} value='DAEWOO-REZZO'>DAEWOO-REZZO </option>
                                            <option {{ old('marca') == 'DAEWOO-ROYALE PRINCE' ? 'selected' : '' }} value='DAEWOO-ROYALE PRINCE'>DAEWOO-ROYALE PRINCE </option>
                                            <option {{ old('marca') == 'DAEWOO-ROYALE SALON' ? 'selected' : '' }} value='DAEWOO-ROYALE SALON'>DAEWOO-ROYALE SALON </option>
                                            <option {{ old('marca') == 'DAEWOO-STATESMAN' ? 'selected' : '' }} value='DAEWOO-STATESMAN'>DAEWOO-STATESMAN </option>
                                            <option {{ old('marca') == 'DAEWOO-TOSCA' ? 'selected' : '' }} value='DAEWOO-TOSCA'>DAEWOO-TOSCA </option>
                                            <option {{ old('marca') == 'DAEWOO-WINSTORM' ? 'selected' : '' }} value='DAEWOO-WINSTORM'>DAEWOO-WINSTORM </option>
                                            <option {{ old('marca') == 'WILLYS OVERLAND-RURAL' ? 'selected' : '' }} value='WILLYS OVERLAND-RURAL'>WILLYS OVERLAND-RURAL </option>
                                            <option {{ old('marca') == 'DODGE-D100' ? 'selected' : '' }} value='DODGE-D100'>DODGE-D100 </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-170' ? 'selected' : '' }} value='MERCEDES-BENZ-170'>MERCEDES-BENZ-170 </option>
                                            <option {{ old('marca') == 'DODGE-CUSTOM ROYAL' ? 'selected' : '' }} value='DODGE-CUSTOM ROYAL'>DODGE-CUSTOM ROYAL </option>
                                            <option {{ old('marca') == 'CHEVROLET-CLUB COUPE' ? 'selected' : '' }} value='CHEVROLET-CLUB COUPE'>CHEVROLET-CLUB COUPE </option>
                                            <option {{ old('marca') == 'DODGE-MAGNUM' ? 'selected' : '' }} value='DODGE-MAGNUM'>DODGE-MAGNUM </option>
                                            <option {{ old('marca') == 'CHEVROLET-GMC 100' ? 'selected' : '' }} value='CHEVROLET-GMC 100'>CHEVROLET-GMC 100 </option>
                                            <option {{ old('marca') == 'PONTIAC-SOLSTICE' ? 'selected' : '' }} value='PONTIAC-SOLSTICE'>PONTIAC-SOLSTICE </option>
                                            <option {{ old('marca') == 'WILLYS OVERLAND-ITAMARATY' ? 'selected' : '' }} value='WILLYS OVERLAND-ITAMARATY'>WILLYS OVERLAND-ITAMARATY </option>
                                            <option {{ old('marca') == 'JAGUAR-MARK V' ? 'selected' : '' }} value='JAGUAR-MARK V'>JAGUAR-MARK V </option>
                                            <option {{ old('marca') == 'PUMA-GT' ? 'selected' : '' }} value='PUMA-GT'>PUMA-GT </option>
                                            <option {{ old('marca') == 'STUDEBAKER-CHAMPION' ? 'selected' : '' }} value='STUDEBAKER-CHAMPION'>STUDEBAKER-CHAMPION </option>
                                            <option {{ old('marca') == 'FIAT-BALILLA' ? 'selected' : '' }} value='FIAT-BALILLA'>FIAT-BALILLA </option>
                                            <option {{ old('marca') == 'WILLYS OVERLAND-INTERLAGOS' ? 'selected' : '' }} value='WILLYS OVERLAND-INTERLAGOS'>WILLYS OVERLAND-INTERLAGOS
                                            </option>
                                            <option {{ old('marca') == 'GURGEL-X15' ? 'selected' : '' }} value='GURGEL-X15'>GURGEL-X15 </option>
                                            <option {{ old('marca') == 'FORD-F-85' ? 'selected' : '' }} value='FORD-F-85'>FORD-F-85 </option>
                                            <option {{ old('marca') == 'PORSCHE-SPEEDSTER 356' ? 'selected' : '' }} value='PORSCHE-SPEEDSTER 356'>PORSCHE-SPEEDSTER 356 </option>
                                            <option {{ old('marca') == 'JINBEI-TOPIC FURGAO' ? 'selected' : '' }} value='JINBEI-TOPIC FURGAO'>JINBEI-TOPIC FURGAO </option>
                                            <option {{ old('marca') == 'JINBEI-TOPIC ESCOLAR' ? 'selected' : '' }} value='JINBEI-TOPIC ESCOLAR'>JINBEI-TOPIC ESCOLAR </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-300D' ? 'selected' : '' }} value='MERCEDES-BENZ-300D'>MERCEDES-BENZ-300D </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE TE' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE TE'>MERCEDES-BENZ-CLASSE TE </option>
                                            <option {{ old('marca') == 'TOYOTA-T-100' ? 'selected' : '' }} value='TOYOTA-T-100'>TOYOTA-T-100 </option>
                                            <option {{ old('marca') == 'RENAULT-MEGANE SEDAN' ? 'selected' : '' }} value='RENAULT-MEGANE SEDAN'>RENAULT-MEGANE SEDAN </option>
                                            <option {{ old('marca') == 'AUDI-A4 CABRIOLET' ? 'selected' : '' }} value='AUDI-A4 CABRIOLET'>AUDI-A4 CABRIOLET </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA G' ? 'selected' : '' }} value='INFINITI-LINHA G'>INFINITI-LINHA G </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA G COUPE' ? 'selected' : '' }} value='INFINITI-LINHA G COUPE'>INFINITI-LINHA G COUPE </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA G CONVERSIVEL' ? 'selected' : '' }} value='INFINITI-LINHA G CONVERSIVEL'>INFINITI-LINHA G CONVERSIVEL
                                            </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA M' ? 'selected' : '' }} value='INFINITI-LINHA M'>INFINITI-LINHA M </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA EX' ? 'selected' : '' }} value='INFINITI-LINHA EX'>INFINITI-LINHA EX </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA JX' ? 'selected' : '' }} value='INFINITI-LINHA JX'>INFINITI-LINHA JX </option>
                                            <option {{ old('marca') == 'INFINITI-LINHA QX' ? 'selected' : '' }} value='INFINITI-LINHA QX'>INFINITI-LINHA QX </option>
                                            <option {{ old('marca') == 'JAGUAR-MODELOS XF' ? 'selected' : '' }} value='JAGUAR-MODELOS XF'>JAGUAR-MODELOS XF </option>
                                            <option {{ old('marca') == 'JAGUAR-F-TYPE' ? 'selected' : '' }} value='JAGUAR-F-TYPE'>JAGUAR-F-TYPE </option>
                                            <option {{ old('marca') == 'JAGUAR-MARK VII' ? 'selected' : '' }} value='JAGUAR-MARK VII'>JAGUAR-MARK VII </option>
                                            <option {{ old('marca') == 'JAGUAR-MARK VIII' ? 'selected' : '' }} value='JAGUAR-MARK VIII'>JAGUAR-MARK VIII </option>
                                            <option {{ old('marca') == 'JAGUAR-MARK IX' ? 'selected' : '' }} value='JAGUAR-MARK IX'>JAGUAR-MARK IX </option>
                                            <option {{ old('marca') == 'JAGUAR-MARK X' ? 'selected' : '' }} value='JAGUAR-MARK X'>JAGUAR-MARK X </option>
                                            <option {{ old('marca') == 'JAGUAR-E-TYPE' ? 'selected' : '' }} value='JAGUAR-E-TYPE'>JAGUAR-E-TYPE </option>
                                            <option {{ old('marca') == 'JAGUAR-C-TYPE' ? 'selected' : '' }} value='JAGUAR-C-TYPE'>JAGUAR-C-TYPE </option>
                                            <option {{ old('marca') == 'JAGUAR-D-TYPE' ? 'selected' : '' }} value='JAGUAR-D-TYPE'>JAGUAR-D-TYPE </option>
                                            <option {{ old('marca') == 'JAGUAR-MARK I' ? 'selected' : '' }} value='JAGUAR-MARK I'>JAGUAR-MARK I </option>
                                            <option {{ old('marca') == 'JAGUAR-MARK II' ? 'selected' : '' }} value='JAGUAR-MARK II'>JAGUAR-MARK II </option>
                                            <option {{ old('marca') == 'PUMA-GT4R' ? 'selected' : '' }} value='PUMA-GT4R'>PUMA-GT4R </option>
                                            <option {{ old('marca') == 'PUMA-SPYDER' ? 'selected' : '' }} value='PUMA-SPYDER'>PUMA-SPYDER </option>
                                            <option {{ old('marca') == 'PUMA-GTI' ? 'selected' : '' }} value='PUMA-GTI'>PUMA-GTI </option>
                                            <option {{ old('marca') == 'PUMA-AM1' ? 'selected' : '' }} value='PUMA-AM1'>PUMA-AM1 </option>
                                            <option {{ old('marca') == 'PUMA-AM2' ? 'selected' : '' }} value='PUMA-AM2'>PUMA-AM2 </option>
                                            <option {{ old('marca') == 'PUMA-AM3' ? 'selected' : '' }} value='PUMA-AM3'>PUMA-AM3 </option>
                                            <option {{ old('marca') == 'PUMA-AM4' ? 'selected' : '' }} value='PUMA-AM4'>PUMA-AM4 </option>
                                            <option {{ old('marca') == 'PUMA-AMV' ? 'selected' : '' }} value='PUMA-AMV'>PUMA-AMV </option>
                                            <option {{ old('marca') == 'HONDA-ACTY' ? 'selected' : '' }} value='HONDA-ACTY'>HONDA-ACTY </option>
                                            <option {{ old('marca') == 'HONDA-AIRWAVE' ? 'selected' : '' }} value='HONDA-AIRWAVE'>HONDA-AIRWAVE </option>
                                            <option {{ old('marca') == 'HONDA-ASCOT' ? 'selected' : '' }} value='HONDA-ASCOT'>HONDA-ASCOT </option>
                                            <option {{ old('marca') == 'HONDA-BALLADE' ? 'selected' : '' }} value='HONDA-BALLADE'>HONDA-BALLADE </option>
                                            <option {{ old('marca') == 'HONDA-BEAT' ? 'selected' : '' }} value='HONDA-BEAT'>HONDA-BEAT </option>
                                            <option {{ old('marca') == 'HONDA-CR-X' ? 'selected' : '' }} value='HONDA-CR-X'>HONDA-CR-X </option>
                                            <option {{ old('marca') == 'HONDA-CONCERTO' ? 'selected' : '' }} value='HONDA-CONCERTO'>HONDA-CONCERTO </option>
                                            <option {{ old('marca') == 'HONDA-CR-Z' ? 'selected' : '' }} value='HONDA-CR-Z'>HONDA-CR-Z </option>
                                            <option {{ old('marca') == 'HONDA-DOMANI' ? 'selected' : '' }} value='HONDA-DOMANI'>HONDA-DOMANI </option>
                                            <option {{ old('marca') == 'HONDA-EDIX' ? 'selected' : '' }} value='HONDA-EDIX'>HONDA-EDIX </option>
                                            <option {{ old('marca') == 'HONDA-ELEMENT' ? 'selected' : '' }} value='HONDA-ELEMENT'>HONDA-ELEMENT </option>
                                            <option {{ old('marca') == 'HONDA-EV PLUS' ? 'selected' : '' }} value='HONDA-EV PLUS'>HONDA-EV PLUS </option>
                                            <option {{ old('marca') == 'HONDA-FCX' ? 'selected' : '' }} value='HONDA-FCX'>HONDA-FCX </option>
                                            <option {{ old('marca') == 'HONDA-FR-V' ? 'selected' : '' }} value='HONDA-FR-V'>HONDA-FR-V </option>
                                            <option {{ old('marca') == 'HONDA-HR-V' ? 'selected' : '' }} value='HONDA-HR-V'>HONDA-HR-V </option>
                                            <option {{ old('marca') == 'HONDA-HSC' ? 'selected' : '' }} value='HONDA-HSC'>HONDA-HSC </option>
                                            <option {{ old('marca') == 'HONDA-INSIGHT' ? 'selected' : '' }} value='HONDA-INSIGHT'>HONDA-INSIGHT </option>
                                            <option {{ old('marca') == 'ACURA-TL' ? 'selected' : '' }} value='ACURA-TL'>ACURA-TL </option>
                                            <option {{ old('marca') == 'HONDA-LIFE DUNK' ? 'selected' : '' }} value='HONDA-LIFE DUNK'>HONDA-LIFE DUNK </option>
                                            <option {{ old('marca') == 'HONDA-LOGO' ? 'selected' : '' }} value='HONDA-LOGO'>HONDA-LOGO </option>
                                            <option {{ old('marca') == 'HONDA-MOBILIO' ? 'selected' : '' }} value='HONDA-MOBILIO'>HONDA-MOBILIO </option>
                                            <option {{ old('marca') == 'ACURA-MDX' ? 'selected' : '' }} value='ACURA-MDX'>ACURA-MDX </option>
                                            <option {{ old('marca') == 'HONDA-ORTHIA' ? 'selected' : '' }} value='HONDA-ORTHIA'>HONDA-ORTHIA </option>
                                            <option {{ old('marca') == 'HONDA-PARTNER VAN' ? 'selected' : '' }} value='HONDA-PARTNER VAN'>HONDA-PARTNER VAN </option>
                                            <option {{ old('marca') == 'HONDA-PILOT' ? 'selected' : '' }} value='HONDA-PILOT'>HONDA-PILOT </option>
                                            <option {{ old('marca') == 'HONDA-RIDGELINE' ? 'selected' : '' }} value='HONDA-RIDGELINE'>HONDA-RIDGELINE </option>
                                            <option {{ old('marca') == 'HONDA-S2000' ? 'selected' : '' }} value='HONDA-S2000'>HONDA-S2000 </option>
                                            <option {{ old('marca') == 'HONDA-S600' ? 'selected' : '' }} value='HONDA-S600'>HONDA-S600 </option>
                                            <option {{ old('marca') == 'HONDA-S500' ? 'selected' : '' }} value='HONDA-S500'>HONDA-S500 </option>
                                            <option {{ old('marca') == 'HONDA-S800' ? 'selected' : '' }} value='HONDA-S800'>HONDA-S800 </option>
                                            <option {{ old('marca') == 'HONDA-STEPWGN' ? 'selected' : '' }} value='HONDA-STEPWGN'>HONDA-STEPWGN </option>
                                            <option {{ old('marca') == 'HONDA-STREAM' ? 'selected' : '' }} value='HONDA-STREAM'>HONDA-STREAM </option>
                                            <option {{ old('marca') == 'HONDA-THATS' ? 'selected' : '' }} value='HONDA-THATS'>HONDA-THATS </option>
                                            <option {{ old('marca') == 'HONDA-VAMOZ' ? 'selected' : '' }} value='HONDA-VAMOZ'>HONDA-VAMOZ </option>
                                            <option {{ old('marca') == 'HONDA-Z' ? 'selected' : '' }} value='HONDA-Z'>HONDA-Z </option>
                                            <option {{ old('marca') == 'HONDA-ZEST' ? 'selected' : '' }} value='HONDA-ZEST'>HONDA-ZEST </option>
                                            <option {{ old('marca') == 'SUZUKI-AERIO' ? 'selected' : '' }} value='SUZUKI-AERIO'>SUZUKI-AERIO </option>
                                            <option {{ old('marca') == 'SUZUKI-ALTO' ? 'selected' : '' }} value='SUZUKI-ALTO'>SUZUKI-ALTO </option>
                                            <option {{ old('marca') == 'SUZUKI-APV' ? 'selected' : '' }} value='SUZUKI-APV'>SUZUKI-APV </option>
                                            <option {{ old('marca') == 'SUZUKI-KEI' ? 'selected' : '' }} value='SUZUKI-KEI'>SUZUKI-KEI </option>
                                            <option {{ old('marca') == 'SUZUKI-LAPIN' ? 'selected' : '' }} value='SUZUKI-LAPIN'>SUZUKI-LAPIN </option>
                                            <option {{ old('marca') == 'SUZUKI-MR WAGON' ? 'selected' : '' }} value='SUZUKI-MR WAGON'>SUZUKI-MR WAGON </option>
                                            <option {{ old('marca') == 'SUZUKI-XL-7' ? 'selected' : '' }} value='SUZUKI-XL-7'>SUZUKI-XL-7 </option>
                                            <option {{ old('marca') == 'SUZUKI-VERONA' ? 'selected' : '' }} value='SUZUKI-VERONA'>SUZUKI-VERONA </option>
                                            <option {{ old('marca') == 'WILLYS OVERLAND-JEEP CJ' ? 'selected' : '' }} value='WILLYS OVERLAND-JEEP CJ'>WILLYS OVERLAND-JEEP CJ </option>
                                            <option {{ old('marca') == 'PEUGEOT-306 CABRIOLET' ? 'selected' : '' }} value='PEUGEOT-306 CABRIOLET'>PEUGEOT-306 CABRIOLET </option>
                                            <option {{ old('marca') == 'DKW-VEMAG-BELCAR' ? 'selected' : '' }} value='DKW-VEMAG-BELCAR'>DKW-VEMAG-BELCAR </option>
                                            <option {{ old('marca') == 'KAISER-M715' ? 'selected' : '' }} value='KAISER-M715'>KAISER-M715 </option>
                                            <option {{ old('marca') == 'PEUGEOT-407 SW' ? 'selected' : '' }} value='PEUGEOT-407 SW'>PEUGEOT-407 SW </option>
                                            <option {{ old('marca') == 'PEUGEOT-307 CC' ? 'selected' : '' }} value='PEUGEOT-307 CC'>PEUGEOT-307 CC </option>
                                            <option {{ old('marca') == 'CHEVROLET-STYLELINE' ? 'selected' : '' }} value='CHEVROLET-STYLELINE'>CHEVROLET-STYLELINE </option>
                                            <option {{ old('marca') == 'FORD-ANGLIA' ? 'selected' : '' }} value='FORD-ANGLIA'>FORD-ANGLIA </option>
                                            <option {{ old('marca') == 'ADAMO-GT2' ? 'selected' : '' }} value='ADAMO-GT2'>ADAMO-GT2 </option>
                                            <option {{ old('marca') == 'CHEVROLET-YUKON' ? 'selected' : '' }} value='CHEVROLET-YUKON'>CHEVROLET-YUKON </option>
                                            <option {{ old('marca') == 'DE SOTO-SPORTSMAN' ? 'selected' : '' }} value='DE SOTO-SPORTSMAN'>DE SOTO-SPORTSMAN </option>
                                            <option {{ old('marca') == 'RENAULT-21 NEVADA' ? 'selected' : '' }} value='RENAULT-21 NEVADA'>RENAULT-21 NEVADA </option>
                                            <option {{ old('marca') == 'BUGATTI-VEYRON' ? 'selected' : '' }} value='BUGATTI-VEYRON'>BUGATTI-VEYRON </option>
                                            <option {{ old('marca') == 'FERRARI-ENZO' ? 'selected' : '' }} value='FERRARI-ENZO'>FERRARI-ENZO </option>
                                            <option {{ old('marca') == 'PEUGEOT-306 SW' ? 'selected' : '' }} value='PEUGEOT-306 SW'>PEUGEOT-306 SW </option>
                                            <option {{ old('marca') == 'ALFA ROMEO-TI 80' ? 'selected' : '' }} value='ALFA ROMEO-TI 80'>ALFA ROMEO-TI 80 </option>
                                            <option {{ old('marca') == 'PORSCHE-SPYDER 550' ? 'selected' : '' }} value='PORSCHE-SPYDER 550'>PORSCHE-SPYDER 550 </option>
                                            <option {{ old('marca') == 'FERRARI-380 GTB' ? 'selected' : '' }} value='FERRARI-380 GTB'>FERRARI-380 GTB </option>
                                            <option {{ old('marca') == 'TROLLER-T-5' ? 'selected' : '' }} value='TROLLER-T-5'>TROLLER-T-5 </option>
                                            <option {{ old('marca') == 'DODGE-KINGSWAY' ? 'selected' : '' }} value='DODGE-KINGSWAY'>DODGE-KINGSWAY </option>
                                            <option {{ old('marca') == 'CHEVROLET-SSR' ? 'selected' : '' }} value='CHEVROLET-SSR'>CHEVROLET-SSR </option>
                                            <option {{ old('marca') == 'CHEVROLET-IMPALA' ? 'selected' : '' }} value='CHEVROLET-IMPALA'>CHEVROLET-IMPALA </option>
                                            <option {{ old('marca') == 'PEUGEOT-208' ? 'selected' : '' }} value='PEUGEOT-208'>PEUGEOT-208 </option>
                                            <option {{ old('marca') == 'CHEVROLET-GRAND BLAZER' ? 'selected' : '' }} value='CHEVROLET-GRAND BLAZER'>CHEVROLET-GRAND BLAZER </option>
                                            <option {{ old('marca') == 'VOLVO-100 SERIES' ? 'selected' : '' }} value='VOLVO-100 SERIES'>VOLVO-100 SERIES </option>
                                            <option {{ old('marca') == 'VOLVO-200 SERIES' ? 'selected' : '' }} value='VOLVO-200 SERIES'>VOLVO-200 SERIES </option>
                                            <option {{ old('marca') == 'VOLVO-300 SERIES' ? 'selected' : '' }} value='VOLVO-300 SERIES'>VOLVO-300 SERIES </option>
                                            <option {{ old('marca') == 'VOLVO-66' ? 'selected' : '' }} value='VOLVO-66'>VOLVO-66 </option>
                                            <option {{ old('marca') == 'VOLVO-700 SERIES' ? 'selected' : '' }} value='VOLVO-700 SERIES'>VOLVO-700 SERIES </option>
                                            <option {{ old('marca') == 'VOLVO-AMAZON' ? 'selected' : '' }} value='VOLVO-AMAZON'>VOLVO-AMAZON </option>
                                            <option {{ old('marca') == 'VOLVO-C303' ? 'selected' : '' }} value='VOLVO-C303'>VOLVO-C303 </option>
                                            <option {{ old('marca') == 'VOLVO-DUETT' ? 'selected' : '' }} value='VOLVO-DUETT'>VOLVO-DUETT </option>
                                            <option {{ old('marca') == 'VOLVO-L3314' ? 'selected' : '' }} value='VOLVO-L3314'>VOLVO-L3314 </option>
                                            <option {{ old('marca') == 'VOLVO-OV 4' ? 'selected' : '' }} value='VOLVO-OV 4'>VOLVO-OV 4 </option>
                                            <option {{ old('marca') == 'VOLVO-P1800' ? 'selected' : '' }} value='VOLVO-P1800'>VOLVO-P1800 </option>
                                            <option {{ old('marca') == 'VOLVO-SUGGA' ? 'selected' : '' }} value='VOLVO-SUGGA'>VOLVO-SUGGA </option>
                                            <option {{ old('marca') == 'FORD-TT' ? 'selected' : '' }} value='FORD-TT'>FORD-TT </option>
                                            <option {{ old('marca') == 'CITROEN-ONCE' ? 'selected' : '' }} value='CITROEN-ONCE'>CITROEN-ONCE </option>
                                            <option {{ old('marca') == 'FORD-DE LUXE' ? 'selected' : '' }} value='FORD-DE LUXE'>FORD-DE LUXE </option>
                                            <option {{ old('marca') == 'FORD-CUSTOM' ? 'selected' : '' }} value='FORD-CUSTOM'>FORD-CUSTOM </option>
                                            <option {{ old('marca') == 'FORD-T-BUCKET' ? 'selected' : '' }} value='FORD-T-BUCKET'>FORD-T-BUCKET </option>
                                            <option {{ old('marca') == 'GURGEL-G15' ? 'selected' : '' }} value='GURGEL-G15'>GURGEL-G15 </option>
                                            <option {{ old('marca') == 'MITSUBISHI-PAJERO FULL 3D' ? 'selected' : '' }} value='MITSUBISHI-PAJERO FULL 3D'>MITSUBISHI-PAJERO FULL 3D </option>
                                            <option {{ old('marca') == 'MITSUBISHI-PAJERO SPORT' ? 'selected' : '' }} value='MITSUBISHI-PAJERO SPORT'>MITSUBISHI-PAJERO SPORT </option>
                                            <option {{ old('marca') == 'BMW-120 CABRIO' ? 'selected' : '' }} value='BMW-120 CABRIO'>BMW-120 CABRIO </option>
                                            <option {{ old('marca') == 'BMW-320 TOURING' ? 'selected' : '' }} value='BMW-320 TOURING'>BMW-320 TOURING </option>
                                            <option {{ old('marca') == 'BMW-330 CABRIO' ? 'selected' : '' }} value='BMW-330 CABRIO'>BMW-330 CABRIO </option>
                                            <option {{ old('marca') == 'BMW-SERIE 5 TOURING' ? 'selected' : '' }} value='BMW-SERIE 5 TOURING'>BMW-SERIE 5 TOURING </option>
                                            <option {{ old('marca') == 'BMW-SERIE 6 CABRIO' ? 'selected' : '' }} value='BMW-SERIE 6 CABRIO'>BMW-SERIE 6 CABRIO </option>
                                            <option {{ old('marca') == 'BMW-SERIE M CONVERSIVEL' ? 'selected' : '' }} value='BMW-SERIE M CONVERSIVEL'>BMW-SERIE M CONVERSIVEL </option>
                                            <option {{ old('marca') == 'BMW-M5 TOURING' ? 'selected' : '' }} value='BMW-M5 TOURING'>BMW-M5 TOURING </option>
                                            <option {{ old('marca') == 'BMW-SERIE Z ROADSTER' ? 'selected' : '' }} value='BMW-SERIE Z ROADSTER'>BMW-SERIE Z ROADSTER </option>
                                            <option {{ old('marca') == 'FORD-KA SPORT' ? 'selected' : '' }} value='FORD-KA SPORT'>FORD-KA SPORT </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-CC' ? 'selected' : '' }} value='VOLKSWAGEN-CC'>VOLKSWAGEN-CC </option>
                                            <option {{ old('marca') == 'KIA-CERATO KOUP' ? 'selected' : '' }} value='KIA-CERATO KOUP'>KIA-CERATO KOUP </option>
                                            <option {{ old('marca') == 'CHEVROLET-ASTRO' ? 'selected' : '' }} value='CHEVROLET-ASTRO'>CHEVROLET-ASTRO </option>
                                            <option {{ old('marca') == 'TOYOTA-COROLLA XRS' ? 'selected' : '' }} value='TOYOTA-COROLLA XRS'>TOYOTA-COROLLA XRS </option>
                                            <option {{ old('marca') == 'TOYOTA-ETIOS SEDAN' ? 'selected' : '' }} value='TOYOTA-ETIOS SEDAN'>TOYOTA-ETIOS SEDAN </option>
                                            <option {{ old('marca') == 'FORD-FREESTYLE' ? 'selected' : '' }} value='FORD-FREESTYLE'>FORD-FREESTYLE </option>
                                            <option {{ old('marca') == 'MERCURY-COUGAR' ? 'selected' : '' }} value='MERCURY-COUGAR'>MERCURY-COUGAR </option>
                                            <option {{ old('marca') == 'MAHINDRA-XUV 500' ? 'selected' : '' }} value='MAHINDRA-XUV 500'>MAHINDRA-XUV 500 </option>
                                            <option {{ old('marca') == 'MAHINDRA-XYLO' ? 'selected' : '' }} value='MAHINDRA-XYLO'>MAHINDRA-XYLO </option>
                                            <option {{ old('marca') == 'MAHINDRA-BOLERO' ? 'selected' : '' }} value='MAHINDRA-BOLERO'>MAHINDRA-BOLERO </option>
                                            <option {{ old('marca') == 'MAHINDRA-THAR' ? 'selected' : '' }} value='MAHINDRA-THAR'>MAHINDRA-THAR </option>
                                            <option {{ old('marca') == 'MAHINDRA-AXE' ? 'selected' : '' }} value='MAHINDRA-AXE'>MAHINDRA-AXE </option>
                                            <option {{ old('marca') == 'MAHINDRA-LEGEND' ? 'selected' : '' }} value='MAHINDRA-LEGEND'>MAHINDRA-LEGEND </option>
                                            <option {{ old('marca') == 'JEEP-CJ3' ? 'selected' : '' }} value='JEEP-CJ3'>JEEP-CJ3 </option>
                                            <option {{ old('marca') == 'MAHINDRA-ARMADA' ? 'selected' : '' }} value='MAHINDRA-ARMADA'>MAHINDRA-ARMADA </option>
                                            <option {{ old('marca') == 'MAHINDRA-CHASSI' ? 'selected' : '' }} value='MAHINDRA-CHASSI'>MAHINDRA-CHASSI </option>
                                            <option {{ old('marca') == 'MAHINDRA-SCORPIO PICK-UP' ? 'selected' : '' }} value='MAHINDRA-SCORPIO PICK-UP'>MAHINDRA-SCORPIO PICK-UP </option>
                                            <option {{ old('marca') == 'CHANA-STAR TRUCK' ? 'selected' : '' }} value='CHANA-STAR TRUCK'>CHANA-STAR TRUCK </option>
                                            <option {{ old('marca') == 'CHANA-STAR' ? 'selected' : '' }} value='CHANA-STAR'>CHANA-STAR </option>
                                            <option {{ old('marca') == 'CHANA-STAR VAN CARGO' ? 'selected' : '' }} value='CHANA-STAR VAN CARGO'>CHANA-STAR VAN CARGO </option>
                                            <option {{ old('marca') == 'CHANA-STAR VAN PASSAGEIROS' ? 'selected' : '' }} value='CHANA-STAR VAN PASSAGEIROS'>CHANA-STAR VAN PASSAGEIROS
                                            </option>
                                            <option {{ old('marca') == 'SIMCA-ALVORADA' ? 'selected' : '' }} value='SIMCA-ALVORADA'>SIMCA-ALVORADA </option>
                                            <option {{ old('marca') == 'SIMCA-CHAMBORD' ? 'selected' : '' }} value='SIMCA-CHAMBORD'>SIMCA-CHAMBORD </option>
                                            <option {{ old('marca') == 'SIMCA-PROFISSIONAL' ? 'selected' : '' }} value='SIMCA-PROFISSIONAL'>SIMCA-PROFISSIONAL </option>
                                            <option {{ old('marca') == 'SIMCA-VEDETTE' ? 'selected' : '' }} value='SIMCA-VEDETTE'>SIMCA-VEDETTE </option>
                                            <option {{ old('marca') == 'SIMCA-ARONDE' ? 'selected' : '' }} value='SIMCA-ARONDE'>SIMCA-ARONDE </option>
                                            <option {{ old('marca') == 'SIMCA-1200S' ? 'selected' : '' }} value='SIMCA-1200S'>SIMCA-1200S </option>
                                            <option {{ old('marca') == 'SIMCA-1000' ? 'selected' : '' }} value='SIMCA-1000'>SIMCA-1000 </option>
                                            <option {{ old('marca') == 'HYUNDAI-HB20X' ? 'selected' : '' }} value='HYUNDAI-HB20X'>HYUNDAI-HB20X </option>
                                            <option {{ old('marca') == 'HYUNDAI-HB20S' ? 'selected' : '' }} value='HYUNDAI-HB20S'>HYUNDAI-HB20S </option>
                                            <option {{ old('marca') == 'CHEVROLET-MONZA' ? 'selected' : '' }} value='CHEVROLET-MONZA'>CHEVROLET-MONZA </option>
                                            <option {{ old('marca') == 'CHEVROLET-CHEVETTE' ? 'selected' : '' }} value='CHEVROLET-CHEVETTE'>CHEVROLET-CHEVETTE </option>
                                            <option {{ old('marca') == 'LIFAN-X60' ? 'selected' : '' }} value='LIFAN-X60'>LIFAN-X60 </option>
                                            <option {{ old('marca') == 'CHEVROLET-TRAX' ? 'selected' : '' }} value='CHEVROLET-TRAX'>CHEVROLET-TRAX </option>
                                            <option {{ old('marca') == 'BMW-118' ? 'selected' : '' }} value='BMW-118'>BMW-118 </option>
                                            <option {{ old('marca') == 'BMW-120' ? 'selected' : '' }} value='BMW-120'>BMW-120 </option>
                                            <option {{ old('marca') == 'BMW-130' ? 'selected' : '' }} value='BMW-130'>BMW-130 </option>
                                            <option {{ old('marca') == 'BMW-BAVARIA' ? 'selected' : '' }} value='BMW-BAVARIA'>BMW-BAVARIA </option>
                                            <option {{ old('marca') == 'BMW-C-2800' ? 'selected' : '' }} value='BMW-C-2800'>BMW-C-2800 </option>
                                            <option {{ old('marca') == 'BMW-318' ? 'selected' : '' }} value='BMW-318'>BMW-318 </option>
                                            <option {{ old('marca') == 'BMW-320' ? 'selected' : '' }} value='BMW-320'>BMW-320 </option>
                                            <option {{ old('marca') == 'BMW-318 CABRIO' ? 'selected' : '' }} value='BMW-318 CABRIO'>BMW-318 CABRIO </option>
                                            <option {{ old('marca') == 'BMW-325 CABRIO' ? 'selected' : '' }} value='BMW-325 CABRIO'>BMW-325 CABRIO </option>
                                            <option {{ old('marca') == 'BMW-530' ? 'selected' : '' }} value='BMW-530'>BMW-530 </option>
                                            <option {{ old('marca') == 'BMW-540' ? 'selected' : '' }} value='BMW-540'>BMW-540 </option>
                                            <option {{ old('marca') == 'BMW-550' ? 'selected' : '' }} value='BMW-550'>BMW-550 </option>
                                            <option {{ old('marca') == 'BMW-740' ? 'selected' : '' }} value='BMW-740'>BMW-740 </option>
                                            <option {{ old('marca') == 'BMW-750' ? 'selected' : '' }} value='BMW-750'>BMW-750 </option>
                                            <option {{ old('marca') == 'BMW-760' ? 'selected' : '' }} value='BMW-760'>BMW-760 </option>
                                            <option {{ old('marca') == 'DITALLY-MATRIX 4X4' ? 'selected' : '' }} value='DITALLY-MATRIX 4X4'>DITALLY-MATRIX 4X4 </option>
                                            <option {{ old('marca') == 'SHINERAY-A7' ? 'selected' : '' }} value='SHINERAY-A7'>SHINERAY-A7 </option>
                                            <option {{ old('marca') == 'SHINERAY-A9' ? 'selected' : '' }} value='SHINERAY-A9'>SHINERAY-A9 </option>
                                            <option {{ old('marca') == 'SHINERAY-A9 CARGO' ? 'selected' : '' }} value='SHINERAY-A9 CARGO'>SHINERAY-A9 CARGO </option>
                                            <option {{ old('marca') == 'SHINERAY-T20' ? 'selected' : '' }} value='SHINERAY-T20'>SHINERAY-T20 </option>
                                            <option {{ old('marca') == 'SHINERAY-T20 BAU' ? 'selected' : '' }} value='SHINERAY-T20 BAU'>SHINERAY-T20 BAU </option>
                                            <option {{ old('marca') == 'SHINERAY-T22' ? 'selected' : '' }} value='SHINERAY-T22'>SHINERAY-T22 </option>
                                            <option {{ old('marca') == 'ENVEMO-SUPER 90 COUPE' ? 'selected' : '' }} value='ENVEMO-SUPER 90 COUPE'>ENVEMO-SUPER 90 COUPE </option>
                                            <option {{ old('marca') == 'GURGEL-X20' ? 'selected' : '' }} value='GURGEL-X20'>GURGEL-X20 </option>
                                            <option {{ old('marca') == 'GURGEL-ITAIPU' ? 'selected' : '' }} value='GURGEL-ITAIPU'>GURGEL-ITAIPU </option>
                                            <option {{ old('marca') == 'GURGEL-G800' ? 'selected' : '' }} value='GURGEL-G800'>GURGEL-G800 </option>
                                            <option {{ old('marca') == 'GURGEL-XEF' ? 'selected' : '' }} value='GURGEL-XEF'>GURGEL-XEF </option>
                                            <option {{ old('marca') == 'GURGEL-MOTOMACHINE' ? 'selected' : '' }} value='GURGEL-MOTOMACHINE'>GURGEL-MOTOMACHINE </option>
                                            <option {{ old('marca') == 'GURGEL-BUGATO' ? 'selected' : '' }} value='GURGEL-BUGATO'>GURGEL-BUGATO </option>
                                            <option {{ old('marca') == 'GURGEL-QT' ? 'selected' : '' }} value='GURGEL-QT'>GURGEL-QT </option>
                                            <option {{ old('marca') == 'DKW-VEMAG-CAICARA' ? 'selected' : '' }} value='DKW-VEMAG-CAICARA'>DKW-VEMAG-CAICARA </option>
                                            <option {{ old('marca') == 'DKW-VEMAG-CARCARA' ? 'selected' : '' }} value='DKW-VEMAG-CARCARA'>DKW-VEMAG-CARCARA </option>
                                            <option {{ old('marca') == 'DKW-VEMAG-FISSORE' ? 'selected' : '' }} value='DKW-VEMAG-FISSORE'>DKW-VEMAG-FISSORE </option>
                                            <option {{ old('marca') == 'DKW-VEMAG-MALZONI' ? 'selected' : '' }} value='DKW-VEMAG-MALZONI'>DKW-VEMAG-MALZONI </option>
                                            <option {{ old('marca') == 'DKW-VEMAG-VEMAGUET' ? 'selected' : '' }} value='DKW-VEMAG-VEMAGUET'>DKW-VEMAG-VEMAGUET </option>
                                            <option {{ old('marca') == 'CITROEN-C4 LOUNGE' ? 'selected' : '' }} value='CITROEN-C4 LOUNGE'>CITROEN-C4 LOUNGE </option>
                                            <option {{ old('marca') == 'MAZDA-CX-7' ? 'selected' : '' }} value='MAZDA-CX-7'>MAZDA-CX-7 </option>
                                            <option {{ old('marca') == 'TANGER-TR' ? 'selected' : '' }} value='TANGER-TR'>TANGER-TR </option>
                                            <option {{ old('marca') == 'TANGER-LUCENA' ? 'selected' : '' }} value='TANGER-LUCENA'>TANGER-LUCENA </option>
                                            <option {{ old('marca') == 'TANGER-SEVETSE' ? 'selected' : '' }} value='TANGER-SEVETSE'>TANGER-SEVETSE </option>
                                            <option {{ old('marca') == 'TANGER-RAGGE' ? 'selected' : '' }} value='TANGER-RAGGE'>TANGER-RAGGE </option>
                                            <option {{ old('marca') == 'VOLVO-C70' ? 'selected' : '' }} value='VOLVO-C70'>VOLVO-C70 </option>
                                            <option {{ old('marca') == 'VOLVO-C30' ? 'selected' : '' }} value='VOLVO-C30'>VOLVO-C30 </option>
                                            <option {{ old('marca') == 'VOLVO-544' ? 'selected' : '' }} value='VOLVO-544'>VOLVO-544 </option>
                                            <option {{ old('marca') == 'VOLVO-S40' ? 'selected' : '' }} value='VOLVO-S40'>VOLVO-S40 </option>
                                            <option {{ old('marca') == 'VOLVO-S60' ? 'selected' : '' }} value='VOLVO-S60'>VOLVO-S60 </option>
                                            <option {{ old('marca') == 'VOLVO-S70' ? 'selected' : '' }} value='VOLVO-S70'>VOLVO-S70 </option>
                                            <option {{ old('marca') == 'VOLVO-S80' ? 'selected' : '' }} value='VOLVO-S80'>VOLVO-S80 </option>
                                            <option {{ old('marca') == 'VOLVO-V40' ? 'selected' : '' }} value='VOLVO-V40'>VOLVO-V40 </option>
                                            <option {{ old('marca') == 'VOLVO-V50' ? 'selected' : '' }} value='VOLVO-V50'>VOLVO-V50 </option>
                                            <option {{ old('marca') == 'VOLVO-V60' ? 'selected' : '' }} value='VOLVO-V60'>VOLVO-V60 </option>
                                            <option {{ old('marca') == 'VOLVO-V70' ? 'selected' : '' }} value='VOLVO-V70'>VOLVO-V70 </option>
                                            <option {{ old('marca') == 'VOLVO-S90' ? 'selected' : '' }} value='VOLVO-S90'>VOLVO-S90 </option>
                                            <option {{ old('marca') == 'VOLVO-XC60' ? 'selected' : '' }} value='VOLVO-XC60'>VOLVO-XC60 </option>
                                            <option {{ old('marca') == 'VOLVO-XC70' ? 'selected' : '' }} value='VOLVO-XC70'>VOLVO-XC70 </option>
                                            <option {{ old('marca') == 'VOLVO-XC90' ? 'selected' : '' }} value='VOLVO-XC90'>VOLVO-XC90 </option>
                                            <option {{ old('marca') == 'VOLVO-P1900' ? 'selected' : '' }} value='VOLVO-P1900'>VOLVO-P1900 </option>
                                            <option {{ old('marca') == 'VOLVO-PV36' ? 'selected' : '' }} value='VOLVO-PV36'>VOLVO-PV36 </option>
                                            <option {{ old('marca') == 'VOLVO-PV444' ? 'selected' : '' }} value='VOLVO-PV444'>VOLVO-PV444 </option>
                                            <option {{ old('marca') == 'VOLVO-PV544' ? 'selected' : '' }} value='VOLVO-PV544'>VOLVO-PV544 </option>
                                            <option {{ old('marca') == 'VOLVO-PV51' ? 'selected' : '' }} value='VOLVO-PV51'>VOLVO-PV51 </option>
                                            <option {{ old('marca') == 'VOLVO-PV654' ? 'selected' : '' }} value='VOLVO-PV654'>VOLVO-PV654 </option>
                                            <option {{ old('marca') == 'VOLVO-C50' ? 'selected' : '' }} value='VOLVO-C50'>VOLVO-C50 </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-190' ? 'selected' : '' }} value='MERCEDES-BENZ-190'>MERCEDES-BENZ-190 </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE CLA' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE CLA'>MERCEDES-BENZ-CLASSE CLA </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE V' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE V'>MERCEDES-BENZ-CLASSE V </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-VANEO' ? 'selected' : '' }} value='MERCEDES-BENZ-VANEO'>MERCEDES-BENZ-VANEO </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CITAN' ? 'selected' : '' }} value='MERCEDES-BENZ-CITAN'>MERCEDES-BENZ-CITAN </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-VARIO' ? 'selected' : '' }} value='MERCEDES-BENZ-VARIO'>MERCEDES-BENZ-VARIO </option>
                                            <option {{ old('marca') == 'MERCEDES-BENZ-CLASSE S CLASSICO' ? 'selected' : '' }} value='MERCEDES-BENZ-CLASSE S CLASSICO'>MERCEDES-BENZ-CLASSE S
                                                CLASSICO </option>
                                            <option {{ old('marca') == 'JAC-J3S' ? 'selected' : '' }} value='JAC-J3S'>JAC-J3S </option>
                                            <option {{ old('marca') == 'RELY-PICK-UP' ? 'selected' : '' }} value='RELY-PICK-UP'>RELY-PICK-UP </option>
                                            <option {{ old('marca') == 'RELY-VAN' ? 'selected' : '' }} value='RELY-VAN'>RELY-VAN </option>
                                            <option {{ old('marca') == 'CITROEN-C3 SOLARIS' ? 'selected' : '' }} value='CITROEN-C3 SOLARIS'>CITROEN-C3 SOLARIS </option>
                                            <option {{ old('marca') == 'CITROEN-C3 XTR' ? 'selected' : '' }} value='CITROEN-C3 XTR'>CITROEN-C3 XTR </option>
                                            <option {{ old('marca') == 'CITROEN-C4 SOLARIS' ? 'selected' : '' }} value='CITROEN-C4 SOLARIS'>CITROEN-C4 SOLARIS </option>
                                            <option {{ old('marca') == 'CITROEN-C5 BREAK/TOURER' ? 'selected' : '' }} value='CITROEN-C5 BREAK/TOURER'>CITROEN-C5 BREAK/TOURER </option>
                                            <option {{ old('marca') == 'CITROEN-XSARA BREAK' ? 'selected' : '' }} value='CITROEN-XSARA BREAK'>CITROEN-XSARA BREAK </option>
                                            <option {{ old('marca') == 'CITROEN-XSARA VTS' ? 'selected' : '' }} value='CITROEN-XSARA VTS'>CITROEN-XSARA VTS </option>
                                            <option {{ old('marca') == 'CITROEN-XANTIA BREAK' ? 'selected' : '' }} value='CITROEN-XANTIA BREAK'>CITROEN-XANTIA BREAK </option>
                                            <option {{ old('marca') == 'CITROEN-XM BREAK' ? 'selected' : '' }} value='CITROEN-XM BREAK'>CITROEN-XM BREAK </option>
                                            <option {{ old('marca') == 'CITROEN-C15' ? 'selected' : '' }} value='CITROEN-C15'>CITROEN-C15 </option>
                                            <option {{ old('marca') == 'CITROEN-NEMO' ? 'selected' : '' }} value='CITROEN-NEMO'>CITROEN-NEMO </option>
                                            <option {{ old('marca') == 'CITROEN-VISA' ? 'selected' : '' }} value='CITROEN-VISA'>CITROEN-VISA </option>
                                            <option {{ old('marca') == 'CITROEN-C1' ? 'selected' : '' }} value='CITROEN-C1'>CITROEN-C1 </option>
                                            <option {{ old('marca') == 'CITROEN-C2' ? 'selected' : '' }} value='CITROEN-C2'>CITROEN-C2 </option>
                                            <option {{ old('marca') == 'CITROEN-C3 PLURIEL' ? 'selected' : '' }} value='CITROEN-C3 PLURIEL'>CITROEN-C3 PLURIEL </option>
                                            <option {{ old('marca') == 'CITROEN-DS4' ? 'selected' : '' }} value='CITROEN-DS4'>CITROEN-DS4 </option>
                                            <option {{ old('marca') == 'CITROEN-DS5' ? 'selected' : '' }} value='CITROEN-DS5'>CITROEN-DS5 </option>
                                            <option {{ old('marca') == 'CITROEN-JUMPY' ? 'selected' : '' }} value='CITROEN-JUMPY'>CITROEN-JUMPY </option>
                                            <option {{ old('marca') == 'CITROEN-C-CROSSER' ? 'selected' : '' }} value='CITROEN-C-CROSSER'>CITROEN-C-CROSSER </option>
                                            <option {{ old('marca') == 'CITROEN-C35' ? 'selected' : '' }} value='CITROEN-C35'>CITROEN-C35 </option>
                                            <option {{ old('marca') == 'CITROEN-C25' ? 'selected' : '' }} value='CITROEN-C25'>CITROEN-C25 </option>
                                            <option {{ old('marca') == 'CITROEN-CX' ? 'selected' : '' }} value='CITROEN-CX'>CITROEN-CX </option>
                                            <option {{ old('marca') == 'CITROEN-CX BREAK' ? 'selected' : '' }} value='CITROEN-CX BREAK'>CITROEN-CX BREAK </option>
                                            <option {{ old('marca') == 'CITROEN-AXEL' ? 'selected' : '' }} value='CITROEN-AXEL'>CITROEN-AXEL </option>
                                            <option {{ old('marca') == 'CITROEN-DYANE' ? 'selected' : '' }} value='CITROEN-DYANE'>CITROEN-DYANE </option>
                                            <option {{ old('marca') == 'CITROEN-GS/GSA' ? 'selected' : '' }} value='CITROEN-GS/GSA'>CITROEN-GS/GSA </option>
                                            <option {{ old('marca') == 'CITROEN-GS/GSA BREAK' ? 'selected' : '' }} value='CITROEN-GS/GSA BREAK'>CITROEN-GS/GSA BREAK </option>
                                            <option {{ old('marca') == 'CITROEN-MEHARI' ? 'selected' : '' }} value='CITROEN-MEHARI'>CITROEN-MEHARI </option>
                                            <option {{ old('marca') == 'CITROEN-SAXO' ? 'selected' : '' }} value='CITROEN-SAXO'>CITROEN-SAXO </option>
                                            <option {{ old('marca') == 'CITROEN-SM' ? 'selected' : '' }} value='CITROEN-SM'>CITROEN-SM </option>
                                            <option {{ old('marca') == 'CITROEN-ELYSEE' ? 'selected' : '' }} value='CITROEN-ELYSEE'>CITROEN-ELYSEE </option>
                                            <option {{ old('marca') == 'RENAULT-MASTER MINIBUS' ? 'selected' : '' }} value='RENAULT-MASTER MINIBUS'>RENAULT-MASTER MINIBUS </option>
                                            <option {{ old('marca') == 'CHERY-CELER' ? 'selected' : '' }} value='CHERY-CELER'>CHERY-CELER </option>
                                            <option {{ old('marca') == 'CHERY-CELER SEDAN' ? 'selected' : '' }} value='CHERY-CELER SEDAN'>CHERY-CELER SEDAN </option>
                                            <option {{ old('marca') == 'CHERY-CIELO SEDAN' ? 'selected' : '' }} value='CHERY-CIELO SEDAN'>CHERY-CIELO SEDAN </option>
                                            <option {{ old('marca') == 'AUDI-A1 SPORTBACK' ? 'selected' : '' }} value='AUDI-A1 SPORTBACK'>AUDI-A1 SPORTBACK </option>
                                            <option {{ old('marca') == 'AUDI-A1 QUATTRO' ? 'selected' : '' }} value='AUDI-A1 QUATTRO'>AUDI-A1 QUATTRO </option>
                                            <option {{ old('marca') == 'AUDI-A3 SPORTBACK' ? 'selected' : '' }} value='AUDI-A3 SPORTBACK'>AUDI-A3 SPORTBACK </option>
                                            <option {{ old('marca') == 'AUDI-RS4 AVANT' ? 'selected' : '' }} value='AUDI-RS4 AVANT'>AUDI-RS4 AVANT </option>
                                            <option {{ old('marca') == 'AUDI-A8L W12' ? 'selected' : '' }} value='AUDI-A8L W12'>AUDI-A8L W12 </option>
                                            <option {{ old('marca') == 'AUDI-R8 V10' ? 'selected' : '' }} value='AUDI-R8 V10'>AUDI-R8 V10 </option>
                                            <option {{ old('marca') == 'FORD-RANGER CD' ? 'selected' : '' }} value='FORD-RANGER CD'>FORD-RANGER CD </option>
                                            <option {{ old('marca') == 'JAC-T140' ? 'selected' : '' }} value='JAC-T140'>JAC-T140 </option>
                                            <option {{ old('marca') == 'BMW-X1' ? 'selected' : '' }} value='BMW-X1'>BMW-X1 </option>
                                            <option {{ old('marca') == 'BMW-X3' ? 'selected' : '' }} value='BMW-X3'>BMW-X3 </option>
                                            <option {{ old('marca') == 'BMW-X5' ? 'selected' : '' }} value='BMW-X5'>BMW-X5 </option>
                                            <option {{ old('marca') == 'BMW-X6' ? 'selected' : '' }} value='BMW-X6'>BMW-X6 </option>
                                            <option {{ old('marca') == 'BMW-840' ? 'selected' : '' }} value='BMW-840'>BMW-840 </option>
                                            <option {{ old('marca') == 'BMW-850' ? 'selected' : '' }} value='BMW-850'>BMW-850 </option>
                                            <option {{ old('marca') == 'BMW-645' ? 'selected' : '' }} value='BMW-645'>BMW-645 </option>
                                            <option {{ old('marca') == 'BMW-650' ? 'selected' : '' }} value='BMW-650'>BMW-650 </option>
                                            <option {{ old('marca') == 'HONDA-FIT TWIST' ? 'selected' : '' }} value='HONDA-FIT TWIST'>HONDA-FIT TWIST </option>
                                            <option {{ old('marca') == 'MCLAREN-MP4' ? 'selected' : '' }} value='MCLAREN-MP4'>MCLAREN-MP4 </option>
                                            <option {{ old('marca') == 'MCLAREN-F1' ? 'selected' : '' }} value='MCLAREN-F1'>MCLAREN-F1 </option>
                                            <option {{ old('marca') == 'FORD-MONDEO SW' ? 'selected' : '' }} value='FORD-MONDEO SW'>FORD-MONDEO SW </option>
                                            <option {{ old('marca') == 'FORD-ESCORT SEDAN' ? 'selected' : '' }} value='FORD-ESCORT SEDAN'>FORD-ESCORT SEDAN </option>
                                            <option {{ old('marca') == 'FORD-ESCORT CONVERSIVEL' ? 'selected' : '' }} value='FORD-ESCORT CONVERSIVEL'>FORD-ESCORT CONVERSIVEL </option>
                                            <option {{ old('marca') == 'MAZDA-MX-6' ? 'selected' : '' }} value='MAZDA-MX-6'>MAZDA-MX-6 </option>
                                            <option {{ old('marca') == 'CHEVROLET-CORISCO' ? 'selected' : '' }} value='CHEVROLET-CORISCO'>CHEVROLET-CORISCO </option>
                                            <option {{ old('marca') == 'CHEVROLET-CHEVELLE' ? 'selected' : '' }} value='CHEVROLET-CHEVELLE'>CHEVROLET-CHEVELLE </option>
                                            <option {{ old('marca') == 'FORD-EXCURSION' ? 'selected' : '' }} value='FORD-EXCURSION'>FORD-EXCURSION </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-TOURAN' ? 'selected' : '' }} value='VOLKSWAGEN-TOURAN'>VOLKSWAGEN-TOURAN </option>
                                            <option {{ old('marca') == 'FORD-F-10000' ? 'selected' : '' }} value='FORD-F-10000'>FORD-F-10000 </option>
                                            <option {{ old('marca') == 'PEUGEOT-HOGGAR ESCAPADE' ? 'selected' : '' }} value='PEUGEOT-HOGGAR ESCAPADE'>PEUGEOT-HOGGAR ESCAPADE </option>
                                            <option {{ old('marca') == 'FORD-PHAETON' ? 'selected' : '' }} value='FORD-PHAETON'>FORD-PHAETON </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-TRANSPORTER' ? 'selected' : '' }} value='VOLKSWAGEN-TRANSPORTER'>VOLKSWAGEN-TRANSPORTER </option>
                                            <option {{ old('marca') == 'KIA-GRAND BESTA' ? 'selected' : '' }} value='KIA-GRAND BESTA'>KIA-GRAND BESTA </option>
                                            <option {{ old('marca') == 'NISSAN-200SX' ? 'selected' : '' }} value='NISSAN-200SX'>NISSAN-200SX </option>
                                            <option {{ old('marca') == 'NISSAN-240SX' ? 'selected' : '' }} value='NISSAN-240SX'>NISSAN-240SX </option>
                                            <option {{ old('marca') == 'CHRYSLER-300M' ? 'selected' : '' }} value='CHRYSLER-300M'>CHRYSLER-300M </option>
                                            <option {{ old('marca') == 'CHRYSLER-300C TOURING' ? 'selected' : '' }} value='CHRYSLER-300C TOURING'>CHRYSLER-300C TOURING </option>
                                            <option {{ old('marca') == 'FORD-TORINO' ? 'selected' : '' }} value='FORD-TORINO'>FORD-TORINO </option>
                                            <option {{ old('marca') == 'CHEVROLET-VENTURE' ? 'selected' : '' }} value='CHEVROLET-VENTURE'>CHEVROLET-VENTURE </option>
                                            <option {{ old('marca') == 'CHEVROLET-FLEETLINE' ? 'selected' : '' }} value='CHEVROLET-FLEETLINE'>CHEVROLET-FLEETLINE </option>
                                            <option {{ old('marca') == 'CHEVROLET-FLEETMASTER' ? 'selected' : '' }} value='CHEVROLET-FLEETMASTER'>CHEVROLET-FLEETMASTER </option>
                                            <option {{ old('marca') == 'CHEVROLET-DELUXE' ? 'selected' : '' }} value='CHEVROLET-DELUXE'>CHEVROLET-DELUXE </option>
                                            <option {{ old('marca') == 'FORD-ESCORT XR3' ? 'selected' : '' }} value='FORD-ESCORT XR3'>FORD-ESCORT XR3 </option>
                                            <option {{ old('marca') == 'CHEVROLET-MASTER' ? 'selected' : '' }} value='CHEVROLET-MASTER'>CHEVROLET-MASTER </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-TORONADO' ? 'selected' : '' }} value='OLDSMOBILE-TORONADO'>OLDSMOBILE-TORONADO </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-SIX' ? 'selected' : '' }} value='OLDSMOBILE-SIX'>OLDSMOBILE-SIX </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-EIGHT' ? 'selected' : '' }} value='OLDSMOBILE-EIGHT'>OLDSMOBILE-EIGHT </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-DELUXE' ? 'selected' : '' }} value='OLDSMOBILE-DELUXE'>OLDSMOBILE-DELUXE </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-SERIES 60' ? 'selected' : '' }} value='OLDSMOBILE-SERIES 60'>OLDSMOBILE-SERIES 60 </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-SERIES 70' ? 'selected' : '' }} value='OLDSMOBILE-SERIES 70'>OLDSMOBILE-SERIES 70 </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-SERIES 80' ? 'selected' : '' }} value='OLDSMOBILE-SERIES 80'>OLDSMOBILE-SERIES 80 </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-SERIES 90' ? 'selected' : '' }} value='OLDSMOBILE-SERIES 90'>OLDSMOBILE-SERIES 90 </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-STARFIRE' ? 'selected' : '' }} value='OLDSMOBILE-STARFIRE'>OLDSMOBILE-STARFIRE </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-442' ? 'selected' : '' }} value='OLDSMOBILE-442'>OLDSMOBILE-442 </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-CUTLASS' ? 'selected' : '' }} value='OLDSMOBILE-CUTLASS'>OLDSMOBILE-CUTLASS </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-CUTLASS SUPREME' ? 'selected' : '' }} value='OLDSMOBILE-CUTLASS SUPREME'>OLDSMOBILE-CUTLASS SUPREME
                                            </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-CUTLASS SALON' ? 'selected' : '' }} value='OLDSMOBILE-CUTLASS SALON'>OLDSMOBILE-CUTLASS SALON </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-CUTLASS CALAIS' ? 'selected' : '' }} value='OLDSMOBILE-CUTLASS CALAIS'>OLDSMOBILE-CUTLASS CALAIS </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-CUTLASS CIERA' ? 'selected' : '' }} value='OLDSMOBILE-CUTLASS CIERA'>OLDSMOBILE-CUTLASS CIERA </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-CUSTOM CRUISER' ? 'selected' : '' }} value='OLDSMOBILE-CUSTOM CRUISER'>OLDSMOBILE-CUSTOM CRUISER </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-VISTA CRUISER' ? 'selected' : '' }} value='OLDSMOBILE-VISTA CRUISER'>OLDSMOBILE-VISTA CRUISER </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-F-85' ? 'selected' : '' }} value='OLDSMOBILE-F-85'>OLDSMOBILE-F-85 </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-FIRENZA' ? 'selected' : '' }} value='OLDSMOBILE-FIRENZA'>OLDSMOBILE-FIRENZA </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-ACHIEVA' ? 'selected' : '' }} value='OLDSMOBILE-ACHIEVA'>OLDSMOBILE-ACHIEVA </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-ALERO' ? 'selected' : '' }} value='OLDSMOBILE-ALERO'>OLDSMOBILE-ALERO </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-AURORA' ? 'selected' : '' }} value='OLDSMOBILE-AURORA'>OLDSMOBILE-AURORA </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-BRAVADA' ? 'selected' : '' }} value='OLDSMOBILE-BRAVADA'>OLDSMOBILE-BRAVADA </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-INTRIGUE' ? 'selected' : '' }} value='OLDSMOBILE-INTRIGUE'>OLDSMOBILE-INTRIGUE </option>
                                            <option {{ old('marca') == 'OLDSMOBILE-SILHOUETTE' ? 'selected' : '' }} value='OLDSMOBILE-SILHOUETTE'>OLDSMOBILE-SILHOUETTE </option>
                                            <option {{ old('marca') == 'PLYMOUTH-SUPERBIRD' ? 'selected' : '' }} value='PLYMOUTH-SUPERBIRD'>PLYMOUTH-SUPERBIRD </option>
                                            <option {{ old('marca') == 'PLYMOUTH-FURY' ? 'selected' : '' }} value='PLYMOUTH-FURY'>PLYMOUTH-FURY </option>
                                            <option {{ old('marca') == 'PLYMOUTH-SPECIAL' ? 'selected' : '' }} value='PLYMOUTH-SPECIAL'>PLYMOUTH-SPECIAL </option>
                                            <option {{ old('marca') == 'PLYMOUTH-PROWLER' ? 'selected' : '' }} value='PLYMOUTH-PROWLER'>PLYMOUTH-PROWLER </option>
                                            <option {{ old('marca') == 'PLYMOUTH-TRAIL DUSTER' ? 'selected' : '' }} value='PLYMOUTH-TRAIL DUSTER'>PLYMOUTH-TRAIL DUSTER </option>
                                            <option {{ old('marca') == 'PLYMOUTH-VOYAGER' ? 'selected' : '' }} value='PLYMOUTH-VOYAGER'>PLYMOUTH-VOYAGER </option>
                                            <option {{ old('marca') == 'PLYMOUTH-SCAMP' ? 'selected' : '' }} value='PLYMOUTH-SCAMP'>PLYMOUTH-SCAMP </option>
                                            <option {{ old('marca') == 'PLYMOUTH-ARROW' ? 'selected' : '' }} value='PLYMOUTH-ARROW'>PLYMOUTH-ARROW </option>
                                            <option {{ old('marca') == 'PLYMOUTH-PT50' ? 'selected' : '' }} value='PLYMOUTH-PT50'>PLYMOUTH-PT50 </option>
                                            <option {{ old('marca') == 'PLYMOUTH-PT57' ? 'selected' : '' }} value='PLYMOUTH-PT57'>PLYMOUTH-PT57 </option>
                                            <option {{ old('marca') == 'PLYMOUTH-PT81' ? 'selected' : '' }} value='PLYMOUTH-PT81'>PLYMOUTH-PT81 </option>
                                            <option {{ old('marca') == 'PLYMOUTH-PT105' ? 'selected' : '' }} value='PLYMOUTH-PT105'>PLYMOUTH-PT105 </option>
                                            <option {{ old('marca') == 'PLYMOUTH-PT125' ? 'selected' : '' }} value='PLYMOUTH-PT125'>PLYMOUTH-PT125 </option>
                                            <option {{ old('marca') == 'PLYMOUTH-EXPRESS' ? 'selected' : '' }} value='PLYMOUTH-EXPRESS'>PLYMOUTH-EXPRESS </option>
                                            <option {{ old('marca') == 'PLYMOUTH-VOYAGER EXPRESSO' ? 'selected' : '' }} value='PLYMOUTH-VOYAGER EXPRESSO'>PLYMOUTH-VOYAGER EXPRESSO </option>
                                            <option {{ old('marca') == 'PLYMOUTH-NEON' ? 'selected' : '' }} value='PLYMOUTH-NEON'>PLYMOUTH-NEON </option>
                                            <option {{ old('marca') == 'PLYMOUTH-LASER' ? 'selected' : '' }} value='PLYMOUTH-LASER'>PLYMOUTH-LASER </option>
                                            <option {{ old('marca') == 'PLYMOUTH-CARAVELLE' ? 'selected' : '' }} value='PLYMOUTH-CARAVELLE'>PLYMOUTH-CARAVELLE </option>
                                            <option {{ old('marca') == 'PLYMOUTH-STATION WAGON' ? 'selected' : '' }} value='PLYMOUTH-STATION WAGON'>PLYMOUTH-STATION WAGON </option>
                                            <option {{ old('marca') == 'PLYMOUTH-MODEL Q' ? 'selected' : '' }} value='PLYMOUTH-MODEL Q'>PLYMOUTH-MODEL Q </option>
                                            <option {{ old('marca') == 'PLYMOUTH-MODEL P6' ? 'selected' : '' }} value='PLYMOUTH-MODEL P6'>PLYMOUTH-MODEL P6 </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-DB9 COUPE' ? 'selected' : '' }} value='ASTON MARTIN-DB9 COUPE'>ASTON MARTIN-DB9 COUPE </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-DB9 VOLANTE' ? 'selected' : '' }} value='ASTON MARTIN-DB9 VOLANTE'>ASTON MARTIN-DB9 VOLANTE </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-VIRAGE COUPE' ? 'selected' : '' }} value='ASTON MARTIN-VIRAGE COUPE'>ASTON MARTIN-VIRAGE COUPE </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-RAPIDE S' ? 'selected' : '' }} value='ASTON MARTIN-RAPIDE S'>ASTON MARTIN-RAPIDE S </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-V12 VANTAGE' ? 'selected' : '' }} value='ASTON MARTIN-V12 VANTAGE'>ASTON MARTIN-V12 VANTAGE </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-V8 VANTAGE COUPE' ? 'selected' : '' }} value='ASTON MARTIN-V8 VANTAGE COUPE'>ASTON MARTIN-V8 VANTAGE COUPE
                                            </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-V8 VANTAGE ROADSTER' ? 'selected' : '' }} value='ASTON MARTIN-V8 VANTAGE ROADSTER'>ASTON MARTIN-V8 VANTAGE
                                                ROADSTER </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-V8 VANTAGE S COUPE' ? 'selected' : '' }} value='ASTON MARTIN-V8 VANTAGE S COUPE'>ASTON MARTIN-V8 VANTAGE S
                                                COUPE </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-V8 VANTAGE S ROADSTER' ? 'selected' : '' }} value='ASTON MARTIN-V8 VANTAGE S ROADSTER'>ASTON MARTIN-V8 VANTAGE S
                                                ROADSTER </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-VANQUISH COUPE' ? 'selected' : '' }} value='ASTON MARTIN-VANQUISH COUPE'>ASTON MARTIN-VANQUISH COUPE
                                            </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-VANQUISH VOLANTE' ? 'selected' : '' }} value='ASTON MARTIN-VANQUISH VOLANTE'>ASTON MARTIN-VANQUISH VOLANTE
                                            </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-V12 ZAGATO' ? 'selected' : '' }} value='ASTON MARTIN-V12 ZAGATO'>ASTON MARTIN-V12 ZAGATO </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-DB5' ? 'selected' : '' }} value='ASTON MARTIN-DB5'>ASTON MARTIN-DB5 </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-DBS' ? 'selected' : '' }} value='ASTON MARTIN-DBS'>ASTON MARTIN-DBS </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-DBS VOLANTE' ? 'selected' : '' }} value='ASTON MARTIN-DBS VOLANTE'>ASTON MARTIN-DBS VOLANTE </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-CYGNET' ? 'selected' : '' }} value='ASTON MARTIN-CYGNET'>ASTON MARTIN-CYGNET </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-ONE-77' ? 'selected' : '' }} value='ASTON MARTIN-ONE-77'>ASTON MARTIN-ONE-77 </option>
                                            <option {{ old('marca') == 'ASTON MARTIN-DBR9' ? 'selected' : '' }} value='ASTON MARTIN-DBR9'>ASTON MARTIN-DBR9 </option>
                                            <option {{ old('marca') == 'BMW-M3' ? 'selected' : '' }} value='BMW-M3'>BMW-M3 </option>
                                            <option {{ old('marca') == 'BMW-M5' ? 'selected' : '' }} value='BMW-M5'>BMW-M5 </option>
                                            <option {{ old('marca') == 'BMW-M6' ? 'selected' : '' }} value='BMW-M6'>BMW-M6 </option>
                                            <option {{ old('marca') == 'BMW-X6 M' ? 'selected' : '' }} value='BMW-X6 M'>BMW-X6 M </option>
                                            <option {{ old('marca') == 'MINI-CABRIO' ? 'selected' : '' }} value='MINI-CABRIO'>MINI-CABRIO </option>
                                            <option {{ old('marca') == 'MINI-COUPE' ? 'selected' : '' }} value='MINI-COUPE'>MINI-COUPE </option>
                                            <option {{ old('marca') == 'MINI-ROADSTER' ? 'selected' : '' }} value='MINI-ROADSTER'>MINI-ROADSTER </option>
                                            <option {{ old('marca') == 'MINI-COUNTRYMAN' ? 'selected' : '' }} value='MINI-COUNTRYMAN'>MINI-COUNTRYMAN </option>
                                            <option {{ old('marca') == 'MINI-PACEMAN' ? 'selected' : '' }} value='MINI-PACEMAN'>MINI-PACEMAN </option>
                                            <option {{ old('marca') == 'MINI-JOHN COOPER WORKS' ? 'selected' : '' }} value='MINI-JOHN COOPER WORKS'>MINI-JOHN COOPER WORKS </option>
                                            <option {{ old('marca') == 'PAGANI-ZONDA' ? 'selected' : '' }} value='PAGANI-ZONDA'>PAGANI-ZONDA </option>
                                            <option {{ old('marca') == 'SUBARU-NEW XV' ? 'selected' : '' }} value='SUBARU-NEW XV'>SUBARU-NEW XV </option>
                                            <option {{ old('marca') == 'SUBARU-IMPREZA WRX HATCH' ? 'selected' : '' }} value='SUBARU-IMPREZA WRX HATCH'>SUBARU-IMPREZA WRX HATCH </option>
                                            <option {{ old('marca') == 'SUBARU-IMPREZA WRX STI HATCH' ? 'selected' : '' }} value='SUBARU-IMPREZA WRX STI HATCH'>SUBARU-IMPREZA WRX STI HATCH
                                            </option>
                                            <option {{ old('marca') == 'SUBARU-IMPREZA WRX STI SEDAN' ? 'selected' : '' }} value='SUBARU-IMPREZA WRX STI SEDAN'>SUBARU-IMPREZA WRX STI SEDAN
                                            </option>
                                            <option {{ old('marca') == 'SUBARU-IMPREZA WRX SEDAN' ? 'selected' : '' }} value='SUBARU-IMPREZA WRX SEDAN'>SUBARU-IMPREZA WRX SEDAN </option>
                                            <option {{ old('marca') == 'TOYOTA-ETIOS CROSS' ? 'selected' : '' }} value='TOYOTA-ETIOS CROSS'>TOYOTA-ETIOS CROSS </option>
                                            <option {{ old('marca') == 'LAMBORGHINI-HURACAN' ? 'selected' : '' }} value='LAMBORGHINI-HURACAN'>LAMBORGHINI-HURACAN </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-UP' ? 'selected' : '' }} value='VOLKSWAGEN-UP'>VOLKSWAGEN-UP </option>
                                            <option {{ old('marca') == '-EXPLORER' ? 'selected' : '' }} value='-EXPLORER'>-EXPLORER </option>
                                            <option {{ old('marca') == 'SMART-FORTWO CABRIO' ? 'selected' : '' }} value='SMART-FORTWO CABRIO'>SMART-FORTWO CABRIO </option>
                                            <option {{ old('marca') == 'ADAMO-GT' ? 'selected' : '' }} value='ADAMO-GT'>ADAMO-GT </option>
                                            <option {{ old('marca') == 'ADAMO-GTL' ? 'selected' : '' }} value='ADAMO-GTL'>ADAMO-GTL </option>
                                            <option {{ old('marca') == 'ADAMO-GTM' ? 'selected' : '' }} value='ADAMO-GTM'>ADAMO-GTM </option>
                                            <option {{ old('marca') == 'ADAMO-C2' ? 'selected' : '' }} value='ADAMO-C2'>ADAMO-C2 </option>
                                            <option {{ old('marca') == 'ADAMO-CRX' ? 'selected' : '' }} value='ADAMO-CRX'>ADAMO-CRX </option>
                                            <option {{ old('marca') == 'ADAMO-AC 2000' ? 'selected' : '' }} value='ADAMO-AC 2000'>ADAMO-AC 2000 </option>
                                            <option {{ old('marca') == 'LINCOLN-AVIATOR' ? 'selected' : '' }} value='LINCOLN-AVIATOR'>LINCOLN-AVIATOR </option>
                                            <option {{ old('marca') == 'LINCOLN-BLACKWOOD' ? 'selected' : '' }} value='LINCOLN-BLACKWOOD'>LINCOLN-BLACKWOOD </option>
                                            <option {{ old('marca') == 'LINCOLN-CAPRI' ? 'selected' : '' }} value='LINCOLN-CAPRI'>LINCOLN-CAPRI </option>
                                            <option {{ old('marca') == 'LINCOLN-CONTINENTAL' ? 'selected' : '' }} value='LINCOLN-CONTINENTAL'>LINCOLN-CONTINENTAL </option>
                                            <option {{ old('marca') == 'LINCOLN-LS' ? 'selected' : '' }} value='LINCOLN-LS'>LINCOLN-LS </option>
                                            <option {{ old('marca') == 'LINCOLN-MARK' ? 'selected' : '' }} value='LINCOLN-MARK'>LINCOLN-MARK </option>
                                            <option {{ old('marca') == 'LINCOLN-MARK LT' ? 'selected' : '' }} value='LINCOLN-MARK LT'>LINCOLN-MARK LT </option>
                                            <option {{ old('marca') == 'LINCOLN-MKR' ? 'selected' : '' }} value='LINCOLN-MKR'>LINCOLN-MKR </option>
                                            <option {{ old('marca') == 'LINCOLN-MKS' ? 'selected' : '' }} value='LINCOLN-MKS'>LINCOLN-MKS </option>
                                            <option {{ old('marca') == 'LINCOLN-MKX' ? 'selected' : '' }} value='LINCOLN-MKX'>LINCOLN-MKX </option>
                                            <option {{ old('marca') == 'LINCOLN-MKZ' ? 'selected' : '' }} value='LINCOLN-MKZ'>LINCOLN-MKZ </option>
                                            <option {{ old('marca') == 'LINCOLN-NAVIGATOR' ? 'selected' : '' }} value='LINCOLN-NAVIGATOR'>LINCOLN-NAVIGATOR </option>
                                            <option {{ old('marca') == 'LINCOLN-PREMIERE' ? 'selected' : '' }} value='LINCOLN-PREMIERE'>LINCOLN-PREMIERE </option>
                                            <option {{ old('marca') == 'LINCOLN-TOWN CAR' ? 'selected' : '' }} value='LINCOLN-TOWN CAR'>LINCOLN-TOWN CAR </option>
                                            <option {{ old('marca') == 'LINCOLN-VERSAILLES' ? 'selected' : '' }} value='LINCOLN-VERSAILLES'>LINCOLN-VERSAILLES </option>
                                            <option {{ old('marca') == 'LINCOLN-ZEPHYR' ? 'selected' : '' }} value='LINCOLN-ZEPHYR'>LINCOLN-ZEPHYR </option>
                                            <option {{ old('marca') == 'CHEVROLET-CLASSIC' ? 'selected' : '' }} value='CHEVROLET-CLASSIC'>CHEVROLET-CLASSIC </option>
                                            <option {{ old('marca') == 'SSANGYONG-ACTYON' ? 'selected' : '' }} value='SSANGYONG-ACTYON'>SSANGYONG-ACTYON </option>
                                            <option {{ old('marca') == 'CHEVROLET-MARAJO' ? 'selected' : '' }} value='CHEVROLET-MARAJO'>CHEVROLET-MARAJO </option>
                                            <option {{ old('marca') == 'CHEVROLET-SUPREMA' ? 'selected' : '' }} value='CHEVROLET-SUPREMA'>CHEVROLET-SUPREMA </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-NEW BEETLE' ? 'selected' : '' }} value='VOLKSWAGEN-NEW BEETLE'>VOLKSWAGEN-NEW BEETLE </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-QUANTUM' ? 'selected' : '' }} value='VOLKSWAGEN-QUANTUM'>VOLKSWAGEN-QUANTUM </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-CROSSFOX' ? 'selected' : '' }} value='VOLKSWAGEN-CROSSFOX'>VOLKSWAGEN-CROSSFOX </option>
                                            <option {{ old('marca') == 'FIAT-MILLE' ? 'selected' : '' }} value='FIAT-MILLE'>FIAT-MILLE </option>
                                            <option {{ old('marca') == 'GEELY-GC2' ? 'selected' : '' }} value='GEELY-GC2'>GEELY-GC2 </option>
                                            <option {{ old('marca') == 'GEELY-EC7' ? 'selected' : '' }} value='GEELY-EC7'>GEELY-EC7 </option>
                                            <option {{ old('marca') == 'LIFAN-530' ? 'selected' : '' }} value='LIFAN-530'>LIFAN-530 </option>
                                            <option {{ old('marca') == 'FIAT-MOBI' ? 'selected' : '' }} value='FIAT-MOBI'>FIAT-MOBI </option>
                                            <option {{ old('marca') == 'FIAT-TORO' ? 'selected' : '' }} value='FIAT-TORO'>FIAT-TORO </option>
                                            <option {{ old('marca') == 'JEEP-RENEGADE' ? 'selected' : '' }} value='JEEP-RENEGADE'>JEEP-RENEGADE </option>
                                            <option {{ old('marca') == 'RENAULT-DUSTER OROCH' ? 'selected' : '' }} value='RENAULT-DUSTER OROCH'>RENAULT-DUSTER OROCH </option>
                                            <option {{ old('marca') == 'RENAULT-SANDERO RS' ? 'selected' : '' }} value='RENAULT-SANDERO RS'>RENAULT-SANDERO RS </option>
                                            <option {{ old('marca') == 'HYUNDAI-HB20R' ? 'selected' : '' }} value='HYUNDAI-HB20R'>HYUNDAI-HB20R </option>
                                            <option {{ old('marca') == 'HYUNDAI-GRAND SANTA FE' ? 'selected' : '' }} value='HYUNDAI-GRAND SANTA FE'>HYUNDAI-GRAND SANTA FE </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-GOLF VARIANT' ? 'selected' : '' }} value='VOLKSWAGEN-GOLF VARIANT'>VOLKSWAGEN-GOLF VARIANT </option>
                                            <option {{ old('marca') == 'VOLKSWAGEN-SPACE CROSS' ? 'selected' : '' }} value='VOLKSWAGEN-SPACE CROSS'>VOLKSWAGEN-SPACE CROSS </option>
                                            <option {{ old('marca') == 'PEUGEOT-2008' ? 'selected' : '' }} value='PEUGEOT-2008'>PEUGEOT-2008 </option>
                                            <option {{ old('marca') == 'KIA-QUORIS' ? 'selected' : '' }} value='KIA-QUORIS'>KIA-QUORIS </option>
                                            <option {{ old('marca') == 'KIA-GRAND CARNIVAL' ? 'selected' : '' }} value='KIA-GRAND CARNIVAL'>KIA-GRAND CARNIVAL </option>
                                            <option {{ old('marca') == 'JAC-T8' ? 'selected' : '' }} value='JAC-T8'>JAC-T8 </option>
                                            <option {{ old('marca') == 'JAC-T6' ? 'selected' : '' }} value='JAC-T6'>JAC-T6 </option>
                                            <option {{ old('marca') == 'JAC-T5' ? 'selected' : '' }} value='JAC-T5'>JAC-T5 </option>
                                            <option {{ old('marca') == 'FORD-KA SEDAN' ? 'selected' : '' }} value='FORD-KA SEDAN'>FORD-KA SEDAN </option>
                                            <option {{ old('marca') == 'FORD-FOCUS FASTBACK' ? 'selected' : '' }} value='FORD-FOCUS FASTBACK'>FORD-FOCUS FASTBACK </option>
                                        </select>
                                    </div>
                                    <div id="moto" style="display: none">
                                        <select class="form-control" id="marcaMoto" name="marcaMoto" style="width: 250px">
                                            <option {{ old('marcaMoto') == 'HONDA-BIZ' ? 'selected' : '' }} value='HONDA-BIZ'>HONDA-BIZ </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 300R' ? 'selected' : '' }} value='HONDA-CB 300R'>HONDA-CB 300R </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 400' ? 'selected' : '' }} value='HONDA-CB 400'>HONDA-CB 400 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 500' ? 'selected' : '' }} value='HONDA-CB 500'>HONDA-CB 500 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 600 HORNET' ? 'selected' : '' }} value='HONDA-CB 600 HORNET'>HONDA-CB 600 HORNET </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBR 1000F' ? 'selected' : '' }} value='HONDA-CBR 1000F'>HONDA-CBR 1000F </option>
                                            <option {{ old('marcaMoto') == 'HONDA-FIREBLADE CBR' ? 'selected' : '' }} value='HONDA-FIREBLADE CBR'>HONDA-FIREBLADE CBR </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBR 450' ? 'selected' : '' }} value='HONDA-CBR 450'>HONDA-CBR 450 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBR 600' ? 'selected' : '' }} value='HONDA-CBR 600'>HONDA-CBR 600 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-TWISTER CBX 250' ? 'selected' : '' }} value='HONDA-TWISTER CBX 250'>HONDA-TWISTER CBX 250 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBX 750F' ? 'selected' : '' }} value='HONDA-CBX 750F'>HONDA-CBX 750F </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CG FAN' ? 'selected' : '' }} value='HONDA-CG FAN'>HONDA-CG FAN </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CG TITAN' ? 'selected' : '' }} value='HONDA-CG TITAN'>HONDA-CG TITAN </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-CRYPTON T115' ? 'selected' : '' }} value='YAMAHA-CRYPTON T115'>YAMAHA-CRYPTON T115 </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-CRZ' ? 'selected' : '' }} value='KASINSKI-CRZ'>KASINSKI-CRZ </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-V-STROM DL' ? 'selected' : '' }} value='SUZUKI-V-STROM DL'>SUZUKI-V-STROM DL </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-DT 200' ? 'selected' : '' }} value='YAMAHA-DT 200'>YAMAHA-DT 200 </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-ELEFANTRE' ? 'selected' : '' }} value='AGRALE-ELEFANTRE'>AGRALE-ELEFANTRE </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-FUTURE' ? 'selected' : '' }} value='SUNDOWN-FUTURE'>SUNDOWN-FUTURE </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR 500' ? 'selected' : '' }} value='GARINNI-GR 500'>GARINNI-GR 500 </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GRI 50' ? 'selected' : '' }} value='GARINNI-GRI 50'>GARINNI-GRI 50 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-GSX' ? 'selected' : '' }} value='SUZUKI-GSX'>SUZUKI-GSX </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-GSX-R GIXXER/SRAD' ? 'selected' : '' }} value='SUZUKI-GSX-R GIXXER/SRAD'>SUZUKI-GSX-R GIXXER/SRAD </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FAZER YS250' ? 'selected' : '' }} value='YAMAHA-FAZER YS250'>YAMAHA-FAZER YS250 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FACTOR YBR125' ? 'selected' : '' }} value='YAMAHA-FACTOR YBR125'>YAMAHA-FACTOR YBR125 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZF R1' ? 'selected' : '' }} value='YAMAHA-YZF R1'>YAMAHA-YZF R1 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-VIRAGO 250' ? 'selected' : '' }} value='YAMAHA-VIRAGO 250'>YAMAHA-VIRAGO 250 </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-CITY' ? 'selected' : '' }} value='AGRALE-CITY'>AGRALE-CITY </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-DAKAR' ? 'selected' : '' }} value='AGRALE-DAKAR'>AGRALE-DAKAR </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-ELEFANT' ? 'selected' : '' }} value='AGRALE-ELEFANT'>AGRALE-ELEFANT </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-FORCE' ? 'selected' : '' }} value='AGRALE-FORCE'>AGRALE-FORCE </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-JUNIOR' ? 'selected' : '' }} value='AGRALE-JUNIOR'>AGRALE-JUNIOR </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-SST' ? 'selected' : '' }} value='AGRALE-SST'>AGRALE-SST </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-SUPER CITY' ? 'selected' : '' }} value='AGRALE-SUPER CITY'>AGRALE-SUPER CITY </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-SXT' ? 'selected' : '' }} value='AGRALE-SXT'>AGRALE-SXT </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-TCHAU' ? 'selected' : '' }} value='AGRALE-TCHAU'>AGRALE-TCHAU </option>
                                            <option {{ old('marcaMoto') == 'AMAZONAS-AME-110' ? 'selected' : '' }} value='AMAZONAS-AME-110'>AMAZONAS-AME-110 </option>
                                            <option {{ old('marcaMoto') == 'AMAZONAS-AME-150' ? 'selected' : '' }} value='AMAZONAS-AME-150'>AMAZONAS-AME-150 </option>
                                            <option {{ old('marcaMoto') == 'AMAZONAS-AME-250' ? 'selected' : '' }} value='AMAZONAS-AME-250'>AMAZONAS-AME-250 </option>
                                            <option {{ old('marcaMoto') == 'AMAZONAS-AME-LX' ? 'selected' : '' }} value='AMAZONAS-AME-LX'>AMAZONAS-AME-LX </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-AREA-51' ? 'selected' : '' }} value='APRILIA-AREA-51'>APRILIA-AREA-51 </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-CLASSIC' ? 'selected' : '' }} value='APRILIA-CLASSIC'>APRILIA-CLASSIC </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-LEONARDO' ? 'selected' : '' }} value='APRILIA-LEONARDO'>APRILIA-LEONARDO </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-MOTO' ? 'selected' : '' }} value='APRILIA-MOTO'>APRILIA-MOTO </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-PEGASO' ? 'selected' : '' }} value='APRILIA-PEGASO'>APRILIA-PEGASO </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-RALLY' ? 'selected' : '' }} value='APRILIA-RALLY'>APRILIA-RALLY </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-RS' ? 'selected' : '' }} value='APRILIA-RS'>APRILIA-RS </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-RSV MILLE' ? 'selected' : '' }} value='APRILIA-RSV MILLE'>APRILIA-RSV MILLE </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-RX' ? 'selected' : '' }} value='APRILIA-RX'>APRILIA-RX </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-SCARABEO' ? 'selected' : '' }} value='APRILIA-SCARABEO'>APRILIA-SCARABEO </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-SONIC' ? 'selected' : '' }} value='APRILIA-SONIC'>APRILIA-SONIC </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-SR RACING' ? 'selected' : '' }} value='APRILIA-SR RACING'>APRILIA-SR RACING </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-SR WWW' ? 'selected' : '' }} value='APRILIA-SR WWW'>APRILIA-SR WWW </option>
                                            <option {{ old('marcaMoto') == 'ATALA-CALIFFONE' ? 'selected' : '' }} value='ATALA-CALIFFONE'>ATALA-CALIFFONE </option>
                                            <option {{ old('marcaMoto') == 'ATALA-MASTER' ? 'selected' : '' }} value='ATALA-MASTER'>ATALA-MASTER </option>
                                            <option {{ old('marcaMoto') == 'ATALA-SKEGIA' ? 'selected' : '' }} value='ATALA-SKEGIA'>ATALA-SKEGIA </option>
                                            <option {{ old('marcaMoto') == 'BAJAJ-CHAMPION' ? 'selected' : '' }} value='BAJAJ-CHAMPION'>BAJAJ-CHAMPION </option>
                                            <option {{ old('marcaMoto') == 'BAJAJ-CLASSIC' ? 'selected' : '' }} value='BAJAJ-CLASSIC'>BAJAJ-CLASSIC </option>
                                            <option {{ old('marcaMoto') == 'BENELLI-TNT' ? 'selected' : '' }} value='BENELLI-TNT'>BENELLI-TNT </option>
                                            <option {{ old('marcaMoto') == 'BENELLI-TRE' ? 'selected' : '' }} value='BENELLI-TRE'>BENELLI-TRE </option>
                                            <option {{ old('marcaMoto') == 'BETA-MX-50' ? 'selected' : '' }} value='BETA-MX-50'>BETA-MX-50 </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-DB4' ? 'selected' : '' }} value='BIMOTA-DB4'>BIMOTA-DB4 </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-DB5R' ? 'selected' : '' }} value='BIMOTA-DB5R'>BIMOTA-DB5R </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-DB6' ? 'selected' : '' }} value='BIMOTA-DB6'>BIMOTA-DB6 </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-DB6R' ? 'selected' : '' }} value='BIMOTA-DB6R'>BIMOTA-DB6R </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-DB7' ? 'selected' : '' }} value='BIMOTA-DB7'>BIMOTA-DB7 </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-MANTRA' ? 'selected' : '' }} value='BIMOTA-MANTRA'>BIMOTA-MANTRA </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-SBR8' ? 'selected' : '' }} value='BIMOTA-SBR8'>BIMOTA-SBR8 </option>
                                            <option {{ old('marcaMoto') == 'BIMOTA-TESI' ? 'selected' : '' }} value='BIMOTA-TESI'>BIMOTA-TESI </option>
                                            <option {{ old('marcaMoto') == 'BMW-G650GS' ? 'selected' : '' }} value='BMW-G650GS'>BMW-G650GS </option>
                                            <option {{ old('marcaMoto') == 'BMW-S1000RR' ? 'selected' : '' }} value='BMW-S1000RR'>BMW-S1000RR </option>
                                            <option {{ old('marcaMoto') == 'BRANDY-ELEGANT' ? 'selected' : '' }} value='BRANDY-ELEGANT'>BRANDY-ELEGANT </option>
                                            <option {{ old('marcaMoto') == 'BRANDY-FOSTI' ? 'selected' : '' }} value='BRANDY-FOSTI'>BRANDY-FOSTI </option>
                                            <option {{ old('marcaMoto') == 'BRANDY-PISTA' ? 'selected' : '' }} value='BRANDY-PISTA'>BRANDY-PISTA </option>
                                            <option {{ old('marcaMoto') == 'BRANDY-TURBO' ? 'selected' : '' }} value='BRANDY-TURBO'>BRANDY-TURBO </option>
                                            <option {{ old('marcaMoto') == 'BRANDY-ZANELLA' ? 'selected' : '' }} value='BRANDY-ZANELLA'>BRANDY-ZANELLA </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-YB' ? 'selected' : '' }} value='BRAVA-YB'>BRAVA-YB </option>
                                            <option {{ old('marcaMoto') == 'BRP-CAN-AM' ? 'selected' : '' }} value='BRP-CAN-AM'>BRP-CAN-AM </option>
                                            <option {{ old('marcaMoto') == 'BUELL-1125' ? 'selected' : '' }} value='BUELL-1125'>BUELL-1125 </option>
                                            <option {{ old('marcaMoto') == 'BUELL-FIREBOLT' ? 'selected' : '' }} value='BUELL-FIREBOLT'>BUELL-FIREBOLT </option>
                                            <option {{ old('marcaMoto') == 'BUELL-LIGHTNING' ? 'selected' : '' }} value='BUELL-LIGHTNING'>BUELL-LIGHTNING </option>
                                            <option {{ old('marcaMoto') == 'BUELL-ULYSSES' ? 'selected' : '' }} value='BUELL-ULYSSES'>BUELL-ULYSSES </option>
                                            <option {{ old('marcaMoto') == 'BUENO-JBR' ? 'selected' : '' }} value='BUENO-JBR'>BUENO-JBR </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-CANYON' ? 'selected' : '' }} value='CAGIVA-CANYON'>CAGIVA-CANYON </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-ELEFANT' ? 'selected' : '' }} value='CAGIVA-ELEFANT'>CAGIVA-ELEFANT </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-GRAN CANYON' ? 'selected' : '' }} value='CAGIVA-GRAN CANYON'>CAGIVA-GRAN CANYON </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-MITO' ? 'selected' : '' }} value='CAGIVA-MITO'>CAGIVA-MITO </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-NAVIGATOR' ? 'selected' : '' }} value='CAGIVA-NAVIGATOR'>CAGIVA-NAVIGATOR </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-PLANET' ? 'selected' : '' }} value='CAGIVA-PLANET'>CAGIVA-PLANET </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-ROADSTER' ? 'selected' : '' }} value='CAGIVA-ROADSTER'>CAGIVA-ROADSTER </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-V-RAPTOR' ? 'selected' : '' }} value='CAGIVA-V-RAPTOR'>CAGIVA-V-RAPTOR </option>
                                            <option {{ old('marcaMoto') == 'CAGIVA-W-16' ? 'selected' : '' }} value='CAGIVA-W-16'>CAGIVA-W-16 </option>
                                            <option {{ old('marcaMoto') == 'MOBILETE-MOBILETE' ? 'selected' : '' }} value='MOBILETE-MOBILETE'>MOBILETE-MOBILETE </option>
                                            <option {{ old('marcaMoto') == 'DAELIM-ALTINO' ? 'selected' : '' }} value='DAELIM-ALTINO'>DAELIM-ALTINO </option>
                                            <option {{ old('marcaMoto') == 'DAELIM-MESSAGE' ? 'selected' : '' }} value='DAELIM-MESSAGE'>DAELIM-MESSAGE </option>
                                            <option {{ old('marcaMoto') == 'DAELIM-VC' ? 'selected' : '' }} value='DAELIM-VC'>DAELIM-VC </option>
                                            <option {{ old('marcaMoto') == 'DAELIM-VF' ? 'selected' : '' }} value='DAELIM-VF'>DAELIM-VF </option>
                                            <option {{ old('marcaMoto') == 'DAELIM-VS' ? 'selected' : '' }} value='DAELIM-VS'>DAELIM-VS </option>
                                            <option {{ old('marcaMoto') == 'DAELIM-VT' ? 'selected' : '' }} value='DAELIM-VT'>DAELIM-VT </option>
                                            <option {{ old('marcaMoto') == 'DAELIM-VX' ? 'selected' : '' }} value='DAELIM-VX'>DAELIM-VX </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-APACHE' ? 'selected' : '' }} value='DAFRA-APACHE'>DAFRA-APACHE </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-CITYCOM' ? 'selected' : '' }} value='DAFRA-CITYCOM'>DAFRA-CITYCOM </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-KANSAS' ? 'selected' : '' }} value='DAFRA-KANSAS'>DAFRA-KANSAS </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-LASER' ? 'selected' : '' }} value='DAFRA-LASER'>DAFRA-LASER </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-NEXT' ? 'selected' : '' }} value='DAFRA-NEXT'>DAFRA-NEXT </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-RIVA' ? 'selected' : '' }} value='DAFRA-RIVA'>DAFRA-RIVA </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-ROADWIN' ? 'selected' : '' }} value='DAFRA-ROADWIN'>DAFRA-ROADWIN </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-SMART' ? 'selected' : '' }} value='DAFRA-SMART'>DAFRA-SMART </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-SPEED' ? 'selected' : '' }} value='DAFRA-SPEED'>DAFRA-SPEED </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-SUPER' ? 'selected' : '' }} value='DAFRA-SUPER'>DAFRA-SUPER </option>
                                            <option {{ old('marcaMoto') == 'DAFRA-ZIG' ? 'selected' : '' }} value='DAFRA-ZIG'>DAFRA-ZIG </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY100-31' ? 'selected' : '' }} value='DAYANG-DY100-31'>DAYANG-DY100-31 </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY110-20' ? 'selected' : '' }} value='DAYANG-DY110-20'>DAYANG-DY110-20 </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY125-18' ? 'selected' : '' }} value='DAYANG-DY125-18'>DAYANG-DY125-18 </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY125-36A' ? 'selected' : '' }} value='DAYANG-DY125-36A'>DAYANG-DY125-36A </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY125-37' ? 'selected' : '' }} value='DAYANG-DY125-37'>DAYANG-DY125-37 </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY125-5' ? 'selected' : '' }} value='DAYANG-DY125-5'>DAYANG-DY125-5 </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY125-52' ? 'selected' : '' }} value='DAYANG-DY125-52'>DAYANG-DY125-52 </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY150-12' ? 'selected' : '' }} value='DAYANG-DY150-12'>DAYANG-DY150-12 </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY200' ? 'selected' : '' }} value='DAYANG-DY200'>DAYANG-DY200 </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-SUMMER' ? 'selected' : '' }} value='DAYUN-SUMMER'>DAYUN-SUMMER </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-DY125-8' ? 'selected' : '' }} value='DAYUN-DY125-8'>DAYUN-DY125-8 </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-SPACE' ? 'selected' : '' }} value='DAYUN-SPACE'>DAYUN-SPACE </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-PHANTON' ? 'selected' : '' }} value='DAYUN-PHANTON'>DAYUN-PHANTON </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-CITY' ? 'selected' : '' }} value='DAYUN-CITY'>DAYUN-CITY </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-DY150GY' ? 'selected' : '' }} value='DAYUN-DY150GY'>DAYUN-DY150GY </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-CARGO 150' ? 'selected' : '' }} value='DAYUN-CARGO 150'>DAYUN-CARGO 150 </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-CARGO 200' ? 'selected' : '' }} value='DAYUN-CARGO 200'>DAYUN-CARGO 200 </option>
                                            <option {{ old('marcaMoto') == 'DAYUN-DY250-2' ? 'selected' : '' }} value='DAYUN-DY250-2'>DAYUN-DY250-2 </option>
                                            <option {{ old('marcaMoto') == 'DERBI-ATLANTIS' ? 'selected' : '' }} value='DERBI-ATLANTIS'>DERBI-ATLANTIS </option>
                                            <option {{ old('marcaMoto') == 'DERBI-GPR' ? 'selected' : '' }} value='DERBI-GPR'>DERBI-GPR </option>
                                            <option {{ old('marcaMoto') == 'DERBI-PREDATOR' ? 'selected' : '' }} value='DERBI-PREDATOR'>DERBI-PREDATOR </option>
                                            <option {{ old('marcaMoto') == 'DERBI-RED BULLET' ? 'selected' : '' }} value='DERBI-RED BULLET'>DERBI-RED BULLET </option>
                                            <option {{ old('marcaMoto') == 'DERBI-REPLICAS' ? 'selected' : '' }} value='DERBI-REPLICAS'>DERBI-REPLICAS </option>
                                            <option {{ old('marcaMoto') == 'DERBI-SENDA' ? 'selected' : '' }} value='DERBI-SENDA'>DERBI-SENDA </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-1098' ? 'selected' : '' }} value='DUCATI-1098'>DUCATI-1098 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-1198' ? 'selected' : '' }} value='DUCATI-1198'>DUCATI-1198 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-749' ? 'selected' : '' }} value='DUCATI-749'>DUCATI-749 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-848' ? 'selected' : '' }} value='DUCATI-848'>DUCATI-848 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-996' ? 'selected' : '' }} value='DUCATI-996'>DUCATI-996 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-998' ? 'selected' : '' }} value='DUCATI-998'>DUCATI-998 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-999' ? 'selected' : '' }} value='DUCATI-999'>DUCATI-999 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-999R' ? 'selected' : '' }} value='DUCATI-999R'>DUCATI-999R </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-DESMOSEDICI' ? 'selected' : '' }} value='DUCATI-DESMOSEDICI'>DUCATI-DESMOSEDICI </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-DIAVEL' ? 'selected' : '' }} value='DUCATI-DIAVEL'>DUCATI-DIAVEL </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-HYPERMOTARD' ? 'selected' : '' }} value='DUCATI-HYPERMOTARD'>DUCATI-HYPERMOTARD </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-MONSTER' ? 'selected' : '' }} value='DUCATI-MONSTER'>DUCATI-MONSTER </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-MULTISTRADA' ? 'selected' : '' }} value='DUCATI-MULTISTRADA'>DUCATI-MULTISTRADA </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-SPORTCLASSIC' ? 'selected' : '' }} value='DUCATI-SPORTCLASSIC'>DUCATI-SPORTCLASSIC </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-SS' ? 'selected' : '' }} value='DUCATI-SS'>DUCATI-SS </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-ST-2' ? 'selected' : '' }} value='DUCATI-ST-2'>DUCATI-ST-2 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-ST-4' ? 'selected' : '' }} value='DUCATI-ST-4'>DUCATI-ST-4 </option>
                                            <option {{ old('marcaMoto') == 'DUCATI-STREETFIGHTER' ? 'selected' : '' }} value='DUCATI-STREETFIGHTER'>DUCATI-STREETFIGHTER </option>
                                            <option {{ old('marcaMoto') == 'EMME-MIRAGE' ? 'selected' : '' }} value='EMME-MIRAGE'>EMME-MIRAGE </option>
                                            <option {{ old('marcaMoto') == 'EMME-ONE' ? 'selected' : '' }} value='EMME-ONE'>EMME-ONE </option>
                                            <option {{ old('marcaMoto') == 'EMME-ONE RACING' ? 'selected' : '' }} value='EMME-ONE RACING'>EMME-ONE RACING </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY100-10A' ? 'selected' : '' }} value='FYM-FY100-10A'>FYM-FY100-10A </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY125-19' ? 'selected' : '' }} value='FYM-FY125-19'>FYM-FY125-19 </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY125-20' ? 'selected' : '' }} value='FYM-FY125-20'>FYM-FY125-20 </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY125EY-2' ? 'selected' : '' }} value='FYM-FY125EY-2'>FYM-FY125EY-2 </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY125Y-3' ? 'selected' : '' }} value='FYM-FY125Y-3'>FYM-FY125Y-3 </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY150-3' ? 'selected' : '' }} value='FYM-FY150-3'>FYM-FY150-3 </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY150T-18' ? 'selected' : '' }} value='FYM-FY150T-18'>FYM-FY150T-18 </option>
                                            <option {{ old('marcaMoto') == 'FYM-FY250' ? 'selected' : '' }} value='FYM-FY250'>FYM-FY250 </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR08T4' ? 'selected' : '' }} value='GARINNI-GR08T4'>GARINNI-GR08T4 </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR 125S/ST' ? 'selected' : '' }} value='GARINNI-GR 125S/ST'>GARINNI-GR 125S/ST </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR125T3' ? 'selected' : '' }} value='GARINNI-GR125T3'>GARINNI-GR125T3 </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR125U' ? 'selected' : '' }} value='GARINNI-GR125U'>GARINNI-GR125U </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR 125Z' ? 'selected' : '' }} value='GARINNI-GR 125Z'>GARINNI-GR 125Z </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR 150P/PI' ? 'selected' : '' }} value='GARINNI-GR 150P/PI'>GARINNI-GR 150P/PI </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR150ST' ? 'selected' : '' }} value='GARINNI-GR150ST'>GARINNI-GR150ST </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR150T3' ? 'selected' : '' }} value='GARINNI-GR150T3'>GARINNI-GR150T3 </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR150TI' ? 'selected' : '' }} value='GARINNI-GR150TI'>GARINNI-GR150TI </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR150U' ? 'selected' : '' }} value='GARINNI-GR150U'>GARINNI-GR150U </option>
                                            <option {{ old('marcaMoto') == 'GARINNI-GR250T3' ? 'selected' : '' }} value='GARINNI-GR250T3'>GARINNI-GR250T3 </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-ENDUCROSS' ? 'selected' : '' }} value='GAS GAS-ENDUCROSS'>GAS GAS-ENDUCROSS </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-ROOKIE ENDURO' ? 'selected' : '' }} value='GAS GAS-ROOKIE ENDURO'>GAS GAS-ROOKIE ENDURO </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-BOY' ? 'selected' : '' }} value='GAS GAS-BOY'>GAS GAS-BOY </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-MC' ? 'selected' : '' }} value='GAS GAS-MC'>GAS GAS-MC </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-PAMPERA' ? 'selected' : '' }} value='GAS GAS-PAMPERA'>GAS GAS-PAMPERA </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-TX BOY' ? 'selected' : '' }} value='GAS GAS-TX BOY'>GAS GAS-TX BOY </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-TXT' ? 'selected' : '' }} value='GAS GAS-TXT'>GAS GAS-TXT </option>
                                            <option {{ old('marcaMoto') == 'GAS GAS-TXT ROOKIE' ? 'selected' : '' }} value='GAS GAS-TXT ROOKIE'>GAS GAS-TXT ROOKIE </option>
                                            <option {{ old('marcaMoto') == 'GREEN-EASY' ? 'selected' : '' }} value='GREEN-EASY'>GREEN-EASY </option>
                                            <option {{ old('marcaMoto') == 'GREEN-RUNNER' ? 'selected' : '' }} value='GREEN-RUNNER'>GREEN-RUNNER </option>
                                            <option {{ old('marcaMoto') == 'GREEN-SAFARI' ? 'selected' : '' }} value='GREEN-SAFARI'>GREEN-SAFARI </option>
                                            <option {{ old('marcaMoto') == 'GREEN-SPORT' ? 'selected' : '' }} value='GREEN-SPORT'>GREEN-SPORT </option>
                                            <option {{ old('marcaMoto') == 'HAOBAO-HB-110' ? 'selected' : '' }} value='HAOBAO-HB-110'>HAOBAO-HB-110 </option>
                                            <option {{ old('marcaMoto') == 'HAOBAO-HB-125' ? 'selected' : '' }} value='HAOBAO-HB-125'>HAOBAO-HB-125 </option>
                                            <option {{ old('marcaMoto') == 'HAOBAO-HB-150' ? 'selected' : '' }} value='HAOBAO-HB-150'>HAOBAO-HB-150 </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-SOFTAIL' ? 'selected' : '' }} value='HARLEY-DAVIDSON-SOFTAIL'>HARLEY-DAVIDSON-SOFTAIL </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-TOURING ROAD KING' ? 'selected' : '' }} value='HARLEY-DAVIDSON-TOURING ROAD KING'>HARLEY-DAVIDSON-TOURING ROAD
                                                KING </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-TOURING ELECTRA GLIDE' ? 'selected' : '' }} value='HARLEY-DAVIDSON-TOURING ELECTRA GLIDE'>HARLEY-DAVIDSON-TOURING
                                                ELECTRA GLIDE </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-DYNA' ? 'selected' : '' }} value='HARLEY-DAVIDSON-DYNA'>HARLEY-DAVIDSON-DYNA </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-V-ROD' ? 'selected' : '' }} value='HARLEY-DAVIDSON-V-ROD'>HARLEY-DAVIDSON-V-ROD </option>
                                            <option {{ old('marcaMoto') == 'HARTFORD-LEGION' ? 'selected' : '' }} value='HARTFORD-LEGION'>HARTFORD-LEGION </option>
                                            <option {{ old('marcaMoto') == 'HERO-ANKUR' ? 'selected' : '' }} value='HERO-ANKUR'>HERO-ANKUR </option>
                                            <option {{ old('marcaMoto') == 'HERO-PUCH' ? 'selected' : '' }} value='HERO-PUCH'>HERO-PUCH </option>
                                            <option {{ old('marcaMoto') == 'HERO-STREAM' ? 'selected' : '' }} value='HERO-STREAM'>HERO-STREAM </option>
                                            <option {{ old('marcaMoto') == 'HONDA-AMERICA' ? 'selected' : '' }} value='HONDA-AMERICA'>HONDA-AMERICA </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 1000R' ? 'selected' : '' }} value='HONDA-CB 1000R'>HONDA-CB 1000R </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 1300' ? 'selected' : '' }} value='HONDA-CB 1300'>HONDA-CB 1300 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-SUPERBLACKBIRD CBR 1100XX' ? 'selected' : '' }} value='HONDA-SUPERBLACKBIRD CBR 1100XX'>HONDA-SUPERBLACKBIRD CBR
                                                1100XX </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBR 250' ? 'selected' : '' }} value='HONDA-CBR 250'>HONDA-CBR 250 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-AERO CBX 150' ? 'selected' : '' }} value='HONDA-AERO CBX 150'>HONDA-AERO CBX 150 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-STRADA CBX 200' ? 'selected' : '' }} value='HONDA-STRADA CBX 200'>HONDA-STRADA CBX 200 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CH 125R' ? 'selected' : '' }} value='HONDA-CH 125R'>HONDA-CH 125R </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CR 85' ? 'selected' : '' }} value='HONDA-CR 85'>HONDA-CR 85 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-GL GOLD WING' ? 'selected' : '' }} value='HONDA-GL GOLD WING'>HONDA-GL GOLD WING </option>
                                            <option {{ old('marcaMoto') == 'HONDA-LEAD' ? 'selected' : '' }} value='HONDA-LEAD'>HONDA-LEAD </option>
                                            <option {{ old('marcaMoto') == 'HONDA-MAGNA VF 750C' ? 'selected' : '' }} value='HONDA-MAGNA VF 750C'>HONDA-MAGNA VF 750C </option>
                                            <option {{ old('marcaMoto') == 'HONDA-NX 200/250' ? 'selected' : '' }} value='HONDA-NX 200/250'>HONDA-NX 200/250 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-NX 350 SAHARA' ? 'selected' : '' }} value='HONDA-NX 350 SAHARA'>HONDA-NX 350 SAHARA </option>
                                            <option {{ old('marcaMoto') == 'HONDA-NX 400 FALCON' ? 'selected' : '' }} value='HONDA-NX 400 FALCON'>HONDA-NX 400 FALCON </option>
                                            <option {{ old('marcaMoto') == 'HONDA-NXR BROS' ? 'selected' : '' }} value='HONDA-NXR BROS'>HONDA-NXR BROS </option>
                                            <option {{ old('marcaMoto') == 'HONDA-POP 100' ? 'selected' : '' }} value='HONDA-POP 100'>HONDA-POP 100 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-SUPER HAWK' ? 'selected' : '' }} value='HONDA-SUPER HAWK'>HONDA-SUPER HAWK </option>
                                            <option {{ old('marcaMoto') == 'HONDA-TRX' ? 'selected' : '' }} value='HONDA-TRX'>HONDA-TRX </option>
                                            <option {{ old('marcaMoto') == 'HONDA-VALKYRIE' ? 'selected' : '' }} value='HONDA-VALKYRIE'>HONDA-VALKYRIE </option>
                                            <option {{ old('marcaMoto') == 'HONDA-VFR 1200' ? 'selected' : '' }} value='HONDA-VFR 1200'>HONDA-VFR 1200 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-VTX' ? 'selected' : '' }} value='HONDA-VTX'>HONDA-VTX </option>
                                            <option {{ old('marcaMoto') == 'HONDA-VARADERO XL 1000V' ? 'selected' : '' }} value='HONDA-VARADERO XL 1000V'>HONDA-VARADERO XL 1000V </option>
                                            <option {{ old('marcaMoto') == 'HONDA-XL' ? 'selected' : '' }} value='HONDA-XL'>HONDA-XL </option>
                                            <option {{ old('marcaMoto') == 'HONDA-XL 700V TRANSALP' ? 'selected' : '' }} value='HONDA-XL 700V TRANSALP'>HONDA-XL 700V TRANSALP </option>
                                            <option {{ old('marcaMoto') == 'HONDA-XLR' ? 'selected' : '' }} value='HONDA-XLR'>HONDA-XLR </option>
                                            <option {{ old('marcaMoto') == 'HONDA-XLX' ? 'selected' : '' }} value='HONDA-XLX'>HONDA-XLX </option>
                                            <option {{ old('marcaMoto') == 'HONDA-VLR 350' ? 'selected' : '' }} value='HONDA-VLR 350'>HONDA-VLR 350 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-XR' ? 'selected' : '' }} value='HONDA-XR'>HONDA-XR </option>
                                            <option {{ old('marcaMoto') == 'HONDA-TORNADO XR 250' ? 'selected' : '' }} value='HONDA-TORNADO XR 250'>HONDA-TORNADO XR 250 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-XRE 300' ? 'selected' : '' }} value='HONDA-XRE 300'>HONDA-XRE 300 </option>
                                            <option {{ old('marcaMoto') == 'HUSABERG-FE' ? 'selected' : '' }} value='HUSABERG-FE'>HUSABERG-FE </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-CR' ? 'selected' : '' }} value='HUSQVARNA-CR'>HUSQVARNA-CR </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-HUSQY' ? 'selected' : '' }} value='HUSQVARNA-HUSQY'>HUSQVARNA-HUSQY </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-SM' ? 'selected' : '' }} value='HUSQVARNA-SM'>HUSQVARNA-SM </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-SMR' ? 'selected' : '' }} value='HUSQVARNA-SMR'>HUSQVARNA-SMR </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-TC' ? 'selected' : '' }} value='HUSQVARNA-TC'>HUSQVARNA-TC </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-TE' ? 'selected' : '' }} value='HUSQVARNA-TE'>HUSQVARNA-TE </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-WR' ? 'selected' : '' }} value='HUSQVARNA-WR'>HUSQVARNA-WR </option>
                                            <option {{ old('marcaMoto') == 'HUSQVARNA-WRE' ? 'selected' : '' }} value='HUSQVARNA-WRE'>HUSQVARNA-WRE </option>
                                            <option {{ old('marcaMoto') == 'IROS-ACTION' ? 'selected' : '' }} value='IROS-ACTION'>IROS-ACTION </option>
                                            <option {{ old('marcaMoto') == 'IROS-BRAVE' ? 'selected' : '' }} value='IROS-BRAVE'>IROS-BRAVE </option>
                                            <option {{ old('marcaMoto') == 'IROS-MATRIX' ? 'selected' : '' }} value='IROS-MATRIX'>IROS-MATRIX </option>
                                            <option {{ old('marcaMoto') == 'IROS-MOVING' ? 'selected' : '' }} value='IROS-MOVING'>IROS-MOVING </option>
                                            <option {{ old('marcaMoto') == 'IROS-ONE' ? 'selected' : '' }} value='IROS-ONE'>IROS-ONE </option>
                                            <option {{ old('marcaMoto') == 'IROS-VINTAGE' ? 'selected' : '' }} value='IROS-VINTAGE'>IROS-VINTAGE </option>
                                            <option {{ old('marcaMoto') == 'IROS-WARRIOR' ? 'selected' : '' }} value='IROS-WARRIOR'>IROS-WARRIOR </option>
                                            <option {{ old('marcaMoto') == 'JIAPENG VOLCANO-JP' ? 'selected' : '' }} value='JIAPENG VOLCANO-JP'>JIAPENG VOLCANO-JP </option>
                                            <option {{ old('marcaMoto') == 'JOHNNYPAG-BARHOG' ? 'selected' : '' }} value='JOHNNYPAG-BARHOG'>JOHNNYPAG-BARHOG </option>
                                            <option {{ old('marcaMoto') == 'JOHNNYPAG-PROSTREET' ? 'selected' : '' }} value='JOHNNYPAG-PROSTREET'>JOHNNYPAG-PROSTREET </option>
                                            <option {{ old('marcaMoto') == 'JOHNNYPAG-SPYDER' ? 'selected' : '' }} value='JOHNNYPAG-SPYDER'>JOHNNYPAG-SPYDER </option>
                                            <option {{ old('marcaMoto') == 'JONNY-ATLANTIC' ? 'selected' : '' }} value='JONNY-ATLANTIC'>JONNY-ATLANTIC </option>
                                            <option {{ old('marcaMoto') == 'JONNY-HYPE' ? 'selected' : '' }} value='JONNY-HYPE'>JONNY-HYPE </option>
                                            <option {{ old('marcaMoto') == 'JONNY-JONNY' ? 'selected' : '' }} value='JONNY-JONNY'>JONNY-JONNY </option>
                                            <option {{ old('marcaMoto') == 'JONNY-ORBIT' ? 'selected' : '' }} value='JONNY-ORBIT'>JONNY-ORBIT </option>
                                            <option {{ old('marcaMoto') == 'JONNY-PEGASUS' ? 'selected' : '' }} value='JONNY-PEGASUS'>JONNY-PEGASUS </option>
                                            <option {{ old('marcaMoto') == 'JONNY-QUICK' ? 'selected' : '' }} value='JONNY-QUICK'>JONNY-QUICK </option>
                                            <option {{ old('marcaMoto') == 'JONNY-TR' ? 'selected' : '' }} value='JONNY-TR'>JONNY-TR </option>
                                            <option {{ old('marcaMoto') == 'KAHENA-TOP' ? 'selected' : '' }} value='KAHENA-TOP'>KAHENA-TOP </option>
                                            <option {{ old('marcaMoto') == 'KAHENA-DUAL' ? 'selected' : '' }} value='KAHENA-DUAL'>KAHENA-DUAL </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-COMET GT 650' ? 'selected' : '' }} value='KASINSKI-COMET GT 650'>KASINSKI-COMET GT 650 </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-COMET GT-R 650' ? 'selected' : '' }} value='KASINSKI-COMET GT-R 650'>KASINSKI-COMET GT-R 650 </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-CRUISE' ? 'selected' : '' }} value='KASINSKI-CRUISE'>KASINSKI-CRUISE </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-ERO' ? 'selected' : '' }} value='KASINSKI-ERO'>KASINSKI-ERO </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-FLASH' ? 'selected' : '' }} value='KASINSKI-FLASH'>KASINSKI-FLASH </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-FURIA' ? 'selected' : '' }} value='KASINSKI-FURIA'>KASINSKI-FURIA </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-GF' ? 'selected' : '' }} value='KASINSKI-GF'>KASINSKI-GF </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-MAGIK' ? 'selected' : '' }} value='KASINSKI-MAGIK'>KASINSKI-MAGIK </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-MIDAS' ? 'selected' : '' }} value='KASINSKI-MIDAS'>KASINSKI-MIDAS </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-MIRAGE' ? 'selected' : '' }} value='KASINSKI-MIRAGE'>KASINSKI-MIRAGE </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-MOTOKAR' ? 'selected' : '' }} value='KASINSKI-MOTOKAR'>KASINSKI-MOTOKAR </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-PRIMA' ? 'selected' : '' }} value='KASINSKI-PRIMA'>KASINSKI-PRIMA </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-RX' ? 'selected' : '' }} value='KASINSKI-RX'>KASINSKI-RX </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-SETA' ? 'selected' : '' }} value='KASINSKI-SETA'>KASINSKI-SETA </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-SOFT' ? 'selected' : '' }} value='KASINSKI-SOFT'>KASINSKI-SOFT </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-SUPER CAB' ? 'selected' : '' }} value='KASINSKI-SUPER CAB'>KASINSKI-SUPER CAB </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-TN' ? 'selected' : '' }} value='KASINSKI-TN'>KASINSKI-TN </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-WAY' ? 'selected' : '' }} value='KASINSKI-WAY'>KASINSKI-WAY </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-WIN' ? 'selected' : '' }} value='KASINSKI-WIN'>KASINSKI-WIN </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-AVAJET' ? 'selected' : '' }} value='KAWASAKI-AVAJET'>KAWASAKI-AVAJET </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-CONCOURS' ? 'selected' : '' }} value='KAWASAKI-CONCOURS'>KAWASAKI-CONCOURS </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-D-TRACKER' ? 'selected' : '' }} value='KAWASAKI-D-TRACKER'>KAWASAKI-D-TRACKER </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-ER-6N' ? 'selected' : '' }} value='KAWASAKI-ER-6N'>KAWASAKI-ER-6N </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KLX 110/140' ? 'selected' : '' }} value='KAWASAKI-KLX 110/140'>KAWASAKI-KLX 110/140 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KX 100/125' ? 'selected' : '' }} value='KAWASAKI-KX 100/125'>KAWASAKI-KX 100/125 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KZ' ? 'selected' : '' }} value='KAWASAKI-KZ'>KAWASAKI-KZ </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-MAXI' ? 'selected' : '' }} value='KAWASAKI-MAXI'>KAWASAKI-MAXI </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 250' ? 'selected' : '' }} value='KAWASAKI-NINJA 250'>KAWASAKI-NINJA 250 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-VERSYS' ? 'selected' : '' }} value='KAWASAKI-VERSYS'>KAWASAKI-VERSYS </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-VOYAGER' ? 'selected' : '' }} value='KAWASAKI-VOYAGER'>KAWASAKI-VOYAGER </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-VULCAN' ? 'selected' : '' }} value='KAWASAKI-VULCAN'>KAWASAKI-VULCAN </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-ZZR' ? 'selected' : '' }} value='KAWASAKI-ZZR'>KAWASAKI-ZZR </option>
                                            <option {{ old('marcaMoto') == 'KIMCO-DJW' ? 'selected' : '' }} value='KIMCO-DJW'>KIMCO-DJW </option>
                                            <option {{ old('marcaMoto') == 'KIMCO-MBOY' ? 'selected' : '' }} value='KIMCO-MBOY'>KIMCO-MBOY </option>
                                            <option {{ old('marcaMoto') == 'KIMCO-PEOPLE' ? 'selected' : '' }} value='KIMCO-PEOPLE'>KIMCO-PEOPLE </option>
                                            <option {{ old('marcaMoto') == 'KIMCO-ZING' ? 'selected' : '' }} value='KIMCO-ZING'>KIMCO-ZING </option>
                                            <option {{ old('marcaMoto') == 'LAQUILA-AKROS' ? 'selected' : '' }} value='LAQUILA-AKROS'>LAQUILA-AKROS </option>
                                            <option {{ old('marcaMoto') == 'LAQUILA-ERGON' ? 'selected' : '' }} value='LAQUILA-ERGON'>LAQUILA-ERGON </option>
                                            <option {{ old('marcaMoto') == 'LAQUILA-NIX' ? 'selected' : '' }} value='LAQUILA-NIX'>LAQUILA-NIX </option>
                                            <option {{ old('marcaMoto') == 'LANDUM-MOTO TRUCK' ? 'selected' : '' }} value='LANDUM-MOTO TRUCK'>LANDUM-MOTO TRUCK </option>
                                            <option {{ old('marcaMoto') == 'LAVRALE-QUATTOR' ? 'selected' : '' }} value='LAVRALE-QUATTOR'>LAVRALE-QUATTOR </option>
                                            <option {{ old('marcaMoto') == 'LERIVO-FORMIGAO' ? 'selected' : '' }} value='LERIVO-FORMIGAO'>LERIVO-FORMIGAO </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-CARGO' ? 'selected' : '' }} value='LIFAN-CARGO'>LIFAN-CARGO </option>
                                            <option {{ old('marcaMoto') == 'LON-V-DE LUXE' ? 'selected' : '' }} value='LON-V-DE LUXE'>LON-V-DE LUXE </option>
                                            <option {{ old('marcaMoto') == 'LON-V-E RETRO' ? 'selected' : '' }} value='LON-V-E RETRO'>LON-V-E RETRO </option>
                                            <option {{ old('marcaMoto') == 'LON-V-LY' ? 'selected' : '' }} value='LON-V-LY'>LON-V-LY </option>
                                            <option {{ old('marcaMoto') == 'TRICICLO-TRICICLO' ? 'selected' : '' }} value='TRICICLO-TRICICLO'>TRICICLO-TRICICLO </option>
                                            <option {{ old('marcaMoto') == 'MALAGUTI-CIAK' ? 'selected' : '' }} value='MALAGUTI-CIAK'>MALAGUTI-CIAK </option>
                                            <option {{ old('marcaMoto') == 'MALAGUTI-SPIDER' ? 'selected' : '' }} value='MALAGUTI-SPIDER'>MALAGUTI-SPIDER </option>
                                            <option {{ old('marcaMoto') == 'MIZA-DRAGO' ? 'selected' : '' }} value='MIZA-DRAGO'>MIZA-DRAGO </option>
                                            <option {{ old('marcaMoto') == 'MIZA-EASY' ? 'selected' : '' }} value='MIZA-EASY'>MIZA-EASY </option>
                                            <option {{ old('marcaMoto') == 'MIZA-FAST' ? 'selected' : '' }} value='MIZA-FAST'>MIZA-FAST </option>
                                            <option {{ old('marcaMoto') == 'MIZA-SKEMA' ? 'selected' : '' }} value='MIZA-SKEMA'>MIZA-SKEMA </option>
                                            <option {{ old('marcaMoto') == 'MIZA-VITE' ? 'selected' : '' }} value='MIZA-VITE'>MIZA-VITE </option>
                                            <option {{ old('marcaMoto') == 'MOTO GUZZI-CALIFORNIA' ? 'selected' : '' }} value='MOTO GUZZI-CALIFORNIA'>MOTO GUZZI-CALIFORNIA </option>
                                            <option {{ old('marcaMoto') == 'MOTO GUZZI-QUOTA' ? 'selected' : '' }} value='MOTO GUZZI-QUOTA'>MOTO GUZZI-QUOTA </option>
                                            <option {{ old('marcaMoto') == 'MOTO GUZZI-V11' ? 'selected' : '' }} value='MOTO GUZZI-V11'>MOTO GUZZI-V11 </option>
                                            <option {{ old('marcaMoto') == 'MOTO GUZZI-LE MANS' ? 'selected' : '' }} value='MOTO GUZZI-LE MANS'>MOTO GUZZI-LE MANS </option>
                                            <option {{ old('marcaMoto') == 'MRX-230R' ? 'selected' : '' }} value='MRX-230R'>MRX-230R </option>
                                            <option {{ old('marcaMoto') == 'MV AUGUSTA-BRUTALE' ? 'selected' : '' }} value='MV AUGUSTA-BRUTALE'>MV AUGUSTA-BRUTALE </option>
                                            <option {{ old('marcaMoto') == 'MV AUGUSTA-F4' ? 'selected' : '' }} value='MV AUGUSTA-F4'>MV AUGUSTA-F4 </option>
                                            <option {{ old('marcaMoto') == 'MVK-BIG FORCE' ? 'selected' : '' }} value='MVK-BIG FORCE'>MVK-BIG FORCE </option>
                                            <option {{ old('marcaMoto') == 'MVK-BLACK STAR' ? 'selected' : '' }} value='MVK-BLACK STAR'>MVK-BLACK STAR </option>
                                            <option {{ old('marcaMoto') == 'MVK-BRX' ? 'selected' : '' }} value='MVK-BRX'>MVK-BRX </option>
                                            <option {{ old('marcaMoto') == 'MVK-DUAL' ? 'selected' : '' }} value='MVK-DUAL'>MVK-DUAL </option>
                                            <option {{ old('marcaMoto') == 'MVK-FENIX GOLD' ? 'selected' : '' }} value='MVK-FENIX GOLD'>MVK-FENIX GOLD </option>
                                            <option {{ old('marcaMoto') == 'MVK-FOX' ? 'selected' : '' }} value='MVK-FOX'>MVK-FOX </option>
                                            <option {{ old('marcaMoto') == 'MVK-GO' ? 'selected' : '' }} value='MVK-GO'>MVK-GO </option>
                                            <option {{ old('marcaMoto') == 'MVK-HALLEY' ? 'selected' : '' }} value='MVK-HALLEY'>MVK-HALLEY </option>
                                            <option {{ old('marcaMoto') == 'MVK-FENIX' ? 'selected' : '' }} value='MVK-FENIX'>MVK-FENIX </option>
                                            <option {{ old('marcaMoto') == 'MVK-JURASIC' ? 'selected' : '' }} value='MVK-JURASIC'>MVK-JURASIC </option>
                                            <option {{ old('marcaMoto') == 'MVK-MA' ? 'selected' : '' }} value='MVK-MA'>MVK-MA </option>
                                            <option {{ old('marcaMoto') == 'MVK-SIMBA' ? 'selected' : '' }} value='MVK-SIMBA'>MVK-SIMBA </option>
                                            <option {{ old('marcaMoto') == 'MVK-SPORT' ? 'selected' : '' }} value='MVK-SPORT'>MVK-SPORT </option>
                                            <option {{ old('marcaMoto') == 'MVK-SPYDER' ? 'selected' : '' }} value='MVK-SPYDER'>MVK-SPYDER </option>
                                            <option {{ old('marcaMoto') == 'MVK-STREET' ? 'selected' : '' }} value='MVK-STREET'>MVK-STREET </option>
                                            <option {{ old('marcaMoto') == 'MVK-SUPER' ? 'selected' : '' }} value='MVK-SUPER'>MVK-SUPER </option>
                                            <option {{ old('marcaMoto') == 'MVK-XRT' ? 'selected' : '' }} value='MVK-XRT'>MVK-XRT </option>
                                            <option {{ old('marcaMoto') == 'ORCA-AX' ? 'selected' : '' }} value='ORCA-AX'>ORCA-AX </option>
                                            <option {{ old('marcaMoto') == 'ORCA-JC' ? 'selected' : '' }} value='ORCA-JC'>ORCA-JC </option>
                                            <option {{ old('marcaMoto') == 'ORCA-QM' ? 'selected' : '' }} value='ORCA-QM'>ORCA-QM </option>
                                            <option {{ old('marcaMoto') == 'PEGASSI-BR III' ? 'selected' : '' }} value='PEGASSI-BR III'>PEGASSI-BR III </option>
                                            <option {{ old('marcaMoto') == '-BUXY' ? 'selected' : '' }} value='-BUXY'>-BUXY </option>
                                            <option {{ old('marcaMoto') == '-ELYSEO' ? 'selected' : '' }} value='-ELYSEO'>-ELYSEO </option>
                                            <option {{ old('marcaMoto') == '-SCOOTELEC' ? 'selected' : '' }} value='-SCOOTELEC'>-SCOOTELEC </option>
                                            <option {{ old('marcaMoto') == '-SPEEDAKE' ? 'selected' : '' }} value='-SPEEDAKE'>-SPEEDAKE </option>
                                            <option {{ old('marcaMoto') == '-SPEEDFIGHT' ? 'selected' : '' }} value='-SPEEDFIGHT'>-SPEEDFIGHT </option>
                                            <option {{ old('marcaMoto') == '-SQUAB' ? 'selected' : '' }} value='-SQUAB'>-SQUAB </option>
                                            <option {{ old('marcaMoto') == '-TREKKER' ? 'selected' : '' }} value='-TREKKER'>-TREKKER </option>
                                            <option {{ old('marcaMoto') == '-VIVACITY' ? 'selected' : '' }} value='-VIVACITY'>-VIVACITY </option>
                                            <option {{ old('marcaMoto') == '-ZENITH' ? 'selected' : '' }} value='-ZENITH'>-ZENITH </option>
                                            <option {{ old('marcaMoto') == 'PIAGGIO-BEVERLY' ? 'selected' : '' }} value='PIAGGIO-BEVERLY'>PIAGGIO-BEVERLY </option>
                                            <option {{ old('marcaMoto') == 'PIAGGIO-LIBERTY' ? 'selected' : '' }} value='PIAGGIO-LIBERTY'>PIAGGIO-LIBERTY </option>
                                            <option {{ old('marcaMoto') == 'PIAGGIO-MP3' ? 'selected' : '' }} value='PIAGGIO-MP3'>PIAGGIO-MP3 </option>
                                            <option {{ old('marcaMoto') == 'PIAGGIO-NRG' ? 'selected' : '' }} value='PIAGGIO-NRG'>PIAGGIO-NRG </option>
                                            <option {{ old('marcaMoto') == 'PIAGGIO-RUNNER' ? 'selected' : '' }} value='PIAGGIO-RUNNER'>PIAGGIO-RUNNER </option>
                                            <option {{ old('marcaMoto') == 'PIAGGIO-VESPA' ? 'selected' : '' }} value='PIAGGIO-VESPA'>PIAGGIO-VESPA </option>
                                            <option {{ old('marcaMoto') == 'PIAGGIO-ZIP' ? 'selected' : '' }} value='PIAGGIO-ZIP'>PIAGGIO-ZIP </option>
                                            <option {{ old('marcaMoto') == 'REGAL RAPTOR-BLACK JACK' ? 'selected' : '' }} value='REGAL RAPTOR-BLACK JACK'>REGAL RAPTOR-BLACK JACK </option>
                                            <option {{ old('marcaMoto') == 'REGAL RAPTOR-FENIX GOLD' ? 'selected' : '' }} value='REGAL RAPTOR-FENIX GOLD'>REGAL RAPTOR-FENIX GOLD </option>
                                            <option {{ old('marcaMoto') == 'REGAL RAPTOR-GHOST' ? 'selected' : '' }} value='REGAL RAPTOR-GHOST'>REGAL RAPTOR-GHOST </option>
                                            <option {{ old('marcaMoto') == 'REGAL RAPTOR-SPYDER' ? 'selected' : '' }} value='REGAL RAPTOR-SPYDER'>REGAL RAPTOR-SPYDER </option>
                                            <option {{ old('marcaMoto') == 'SANYANG-ENJOY' ? 'selected' : '' }} value='SANYANG-ENJOY'>SANYANG-ENJOY </option>
                                            <option {{ old('marcaMoto') == 'SANYANG-HUSKY' ? 'selected' : '' }} value='SANYANG-HUSKY'>SANYANG-HUSKY </option>
                                            <option {{ old('marcaMoto') == 'SANYANG-PASSING' ? 'selected' : '' }} value='SANYANG-PASSING'>SANYANG-PASSING </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-RACING 200' ? 'selected' : '' }} value='SHINERAY-RACING 200'>SHINERAY-RACING 200 </option>
                                            <option {{ old('marcaMoto') == 'SIAMOTO-SCROSS' ? 'selected' : '' }} value='SIAMOTO-SCROSS'>SIAMOTO-SCROSS </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-AKROS' ? 'selected' : '' }} value='SUNDOWN-AKROS'>SUNDOWN-AKROS </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-ERGON' ? 'selected' : '' }} value='SUNDOWN-ERGON'>SUNDOWN-ERGON </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-FIFTY' ? 'selected' : '' }} value='SUNDOWN-FIFTY'>SUNDOWN-FIFTY </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-HUNTER' ? 'selected' : '' }} value='SUNDOWN-HUNTER'>SUNDOWN-HUNTER </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-MAX' ? 'selected' : '' }} value='SUNDOWN-MAX'>SUNDOWN-MAX </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-PALIO' ? 'selected' : '' }} value='SUNDOWN-PALIO'>SUNDOWN-PALIO </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-PGO' ? 'selected' : '' }} value='SUNDOWN-PGO'>SUNDOWN-PGO </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-STX' ? 'selected' : '' }} value='SUNDOWN-STX'>SUNDOWN-STX </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-STX MOTARD' ? 'selected' : '' }} value='SUNDOWN-STX MOTARD'>SUNDOWN-STX MOTARD </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-SUPER FIFTY' ? 'selected' : '' }} value='SUNDOWN-SUPER FIFTY'>SUNDOWN-SUPER FIFTY </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-VBLADE' ? 'selected' : '' }} value='SUNDOWN-VBLADE'>SUNDOWN-VBLADE </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-WEB' ? 'selected' : '' }} value='SUNDOWN-WEB'>SUNDOWN-WEB </option>
                                            <option {{ old('marcaMoto') == 'SUNDOWN-WEB EVO' ? 'selected' : '' }} value='SUNDOWN-WEB EVO'>SUNDOWN-WEB EVO </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-ADDRESS' ? 'selected' : '' }} value='SUZUKI-ADDRESS'>SUZUKI-ADDRESS </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-BANDIT 250' ? 'selected' : '' }} value='SUZUKI-BANDIT 250'>SUZUKI-BANDIT 250 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-BOULEVARD' ? 'selected' : '' }} value='SUZUKI-BOULEVARD'>SUZUKI-BOULEVARD </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-BURGMAN AN' ? 'selected' : '' }} value='SUZUKI-BURGMAN AN'>SUZUKI-BURGMAN AN </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-DR' ? 'selected' : '' }} value='SUZUKI-DR'>SUZUKI-DR </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-FREEWIND 650' ? 'selected' : '' }} value='SUZUKI-FREEWIND 650'>SUZUKI-FREEWIND 650 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-GS 500' ? 'selected' : '' }} value='SUZUKI-GS 500'>SUZUKI-GS 500 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-GSR' ? 'selected' : '' }} value='SUZUKI-GSR'>SUZUKI-GSR </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-INTRUDER' ? 'selected' : '' }} value='SUZUKI-INTRUDER'>SUZUKI-INTRUDER </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-KATANA' ? 'selected' : '' }} value='SUZUKI-KATANA'>SUZUKI-KATANA </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-LETS II' ? 'selected' : '' }} value='SUZUKI-LETS II'>SUZUKI-LETS II </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-LT' ? 'selected' : '' }} value='SUZUKI-LT'>SUZUKI-LT </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-MARAUDER GZ' ? 'selected' : '' }} value='SUZUKI-MARAUDER GZ'>SUZUKI-MARAUDER GZ </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-RF' ? 'selected' : '' }} value='SUZUKI-RF'>SUZUKI-RF </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-RM 250' ? 'selected' : '' }} value='SUZUKI-RM 250'>SUZUKI-RM 250 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-SAVAGE' ? 'selected' : '' }} value='SUZUKI-SAVAGE'>SUZUKI-SAVAGE </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-TL' ? 'selected' : '' }} value='SUZUKI-TL'>SUZUKI-TL </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-VX 800' ? 'selected' : '' }} value='SUZUKI-VX 800'>SUZUKI-VX 800 </option>
                                            <option {{ old('marcaMoto') == 'TARGOS-TRIMOTO' ? 'selected' : '' }} value='TARGOS-TRIMOTO'>TARGOS-TRIMOTO </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-CJ' ? 'selected' : '' }} value='TRAXX-CJ'>TRAXX-CJ </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-JH' ? 'selected' : '' }} value='TRAXX-JH'>TRAXX-JH </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-JL' ? 'selected' : '' }} value='TRAXX-JL'>TRAXX-JL </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-STAR 50' ? 'selected' : '' }} value='TRAXX-STAR 50'>TRAXX-STAR 50 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-WORK 125' ? 'selected' : '' }} value='TRAXX-WORK 125'>TRAXX-WORK 125 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-SKY 125' ? 'selected' : '' }} value='TRAXX-SKY 125'>TRAXX-SKY 125 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-FLY 135' ? 'selected' : '' }} value='TRAXX-FLY 135'>TRAXX-FLY 135 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-BEST' ? 'selected' : '' }} value='TRAXX-BEST'>TRAXX-BEST </option>
                                            <option {{ old('marcaMoto') == '-ADVENTURER' ? 'selected' : '' }} value='-ADVENTURER'>-ADVENTURER </option>
                                            <option {{ old('marcaMoto') == '-BONNEVILLE' ? 'selected' : '' }} value='-BONNEVILLE'>-BONNEVILLE </option>
                                            <option {{ old('marcaMoto') == '-DAYTONA' ? 'selected' : '' }} value='-DAYTONA'>-DAYTONA </option>
                                            <option {{ old('marcaMoto') == '-LEGEND' ? 'selected' : '' }} value='-LEGEND'>-LEGEND </option>
                                            <option {{ old('marcaMoto') == '-ROCKET' ? 'selected' : '' }} value='-ROCKET'>-ROCKET </option>
                                            <option {{ old('marcaMoto') == '-SCRAMBLER' ? 'selected' : '' }} value='-SCRAMBLER'>-SCRAMBLER </option>
                                            <option {{ old('marcaMoto') == '-SPEED TRIPLE' ? 'selected' : '' }} value='-SPEED TRIPLE'>-SPEED TRIPLE </option>
                                            <option {{ old('marcaMoto') == '-SPRINT' ? 'selected' : '' }} value='-SPRINT'>-SPRINT </option>
                                            <option {{ old('marcaMoto') == '-STREET TRIPLE' ? 'selected' : '' }} value='-STREET TRIPLE'>-STREET TRIPLE </option>
                                            <option {{ old('marcaMoto') == '-THRUXTON' ? 'selected' : '' }} value='-THRUXTON'>-THRUXTON </option>
                                            <option {{ old('marcaMoto') == '-THUNDERBIRD' ? 'selected' : '' }} value='-THUNDERBIRD'>-THUNDERBIRD </option>
                                            <option {{ old('marcaMoto') == '-TIGER' ? 'selected' : '' }} value='-TIGER'>-TIGER </option>
                                            <option {{ old('marcaMoto') == '-TRIDENT' ? 'selected' : '' }} value='-TRIDENT'>-TRIDENT </option>
                                            <option {{ old('marcaMoto') == '-TROPHY' ? 'selected' : '' }} value='-TROPHY'>-TROPHY </option>
                                            <option {{ old('marcaMoto') == '-TT-600' ? 'selected' : '' }} value='-TT-600'>-TT-600 </option>
                                            <option {{ old('marcaMoto') == 'VENTO-REBELLIAN' ? 'selected' : '' }} value='VENTO-REBELLIAN'>VENTO-REBELLIAN </option>
                                            <option {{ old('marcaMoto') == 'VENTO-TRITON' ? 'selected' : '' }} value='VENTO-TRITON'>VENTO-TRITON </option>
                                            <option {{ old('marcaMoto') == 'VENTO-VTHUNDER' ? 'selected' : '' }} value='VENTO-VTHUNDER'>VENTO-VTHUNDER </option>
                                            <option {{ old('marcaMoto') == 'WUYANG-WY' ? 'selected' : '' }} value='WUYANG-WY'>WUYANG-WY </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-AXIS' ? 'selected' : '' }} value='YAMAHA-AXIS'>YAMAHA-AXIS </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-BWS' ? 'selected' : '' }} value='YAMAHA-BWS'>YAMAHA-BWS </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-JOG' ? 'selected' : '' }} value='YAMAHA-JOG'>YAMAHA-JOG </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-MAJESTY' ? 'selected' : '' }} value='YAMAHA-MAJESTY'>YAMAHA-MAJESTY </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-MT-03' ? 'selected' : '' }} value='YAMAHA-MT-03'>YAMAHA-MT-03 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-NEO AT' ? 'selected' : '' }} value='YAMAHA-NEO AT'>YAMAHA-NEO AT </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-RD 135' ? 'selected' : '' }} value='YAMAHA-RD 135'>YAMAHA-RD 135 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-ROYAL STAR' ? 'selected' : '' }} value='YAMAHA-ROYAL STAR'>YAMAHA-ROYAL STAR </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TDM' ? 'selected' : '' }} value='YAMAHA-TDM'>YAMAHA-TDM </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TDR 180' ? 'selected' : '' }} value='YAMAHA-TDR 180'>YAMAHA-TDR 180 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TRX' ? 'selected' : '' }} value='YAMAHA-TRX'>YAMAHA-TRX </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TT-R' ? 'selected' : '' }} value='YAMAHA-TT-R'>YAMAHA-TT-R </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-V-MAX 1200' ? 'selected' : '' }} value='YAMAHA-V-MAX 1200'>YAMAHA-V-MAX 1200 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-WR 250F' ? 'selected' : '' }} value='YAMAHA-WR 250F'>YAMAHA-WR 250F </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XJR' ? 'selected' : '' }} value='YAMAHA-XJR'>YAMAHA-XJR </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XT 660R' ? 'selected' : '' }} value='YAMAHA-XT 660R'>YAMAHA-XT 660R </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XTZ 125' ? 'selected' : '' }} value='YAMAHA-XTZ 125'>YAMAHA-XTZ 125 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-MIDNIGHT STAR XVS' ? 'selected' : '' }} value='YAMAHA-MIDNIGHT STAR XVS'>YAMAHA-MIDNIGHT STAR XVS </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YFS' ? 'selected' : '' }} value='YAMAHA-YFS'>YAMAHA-YFS </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-YES EN 125' ? 'selected' : '' }} value='SUZUKI-YES EN 125'>SUZUKI-YES EN 125 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-SHADOW' ? 'selected' : '' }} value='HONDA-SHADOW'>HONDA-SHADOW </option>
                                            <option {{ old('marcaMoto') == 'X MOTOS-XM' ? 'selected' : '' }} value='X MOTOS-XM'>X MOTOS-XM </option>
                                            <option {{ old('marcaMoto') == 'LAMBRETA-LAMBRETA' ? 'selected' : '' }} value='LAMBRETA-LAMBRETA'>LAMBRETA-LAMBRETA </option>
                                            <option {{ old('marcaMoto') == 'SCOOTER-SCOOTER' ? 'selected' : '' }} value='SCOOTER-SCOOTER'>SCOOTER-SCOOTER </option>
                                            <option {{ old('marcaMoto') == 'ADLY-ATV' ? 'selected' : '' }} value='ADLY-ATV'>ADLY-ATV </option>
                                            <option {{ old('marcaMoto') == 'ADLY-JAGUAR' ? 'selected' : '' }} value='ADLY-JAGUAR'>ADLY-JAGUAR </option>
                                            <option {{ old('marcaMoto') == 'ADLY-RT' ? 'selected' : '' }} value='ADLY-RT'>ADLY-RT </option>
                                            <option {{ old('marcaMoto') == 'ZONGSHEN-ZS 200' ? 'selected' : '' }} value='ZONGSHEN-ZS 200'>ZONGSHEN-ZS 200 </option>
                                            <option {{ old('marcaMoto') == 'BIRELLI-BW 125' ? 'selected' : '' }} value='BIRELLI-BW 125'>BIRELLI-BW 125 </option>
                                            <option {{ old('marcaMoto') == '-KART' ? 'selected' : '' }} value='-KART'>-KART </option>
                                            <option {{ old('marcaMoto') == 'HONDA-DREAM' ? 'selected' : '' }} value='HONDA-DREAM'>HONDA-DREAM </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-RX' ? 'selected' : '' }} value='YAMAHA-RX'>YAMAHA-RX </option>
                                            <option {{ old('marcaMoto') == 'WALK MACHINE-WALK MACHINE' ? 'selected' : '' }} value='WALK MACHINE-WALK MACHINE'>WALK MACHINE-WALK MACHINE </option>
                                            <option {{ old('marcaMoto') == 'HONDA-HERO' ? 'selected' : '' }} value='HONDA-HERO'>HONDA-HERO </option>
                                            <option {{ old('marcaMoto') == 'HONDA-NC 700X' ? 'selected' : '' }} value='HONDA-NC 700X'>HONDA-NC 700X </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-DRAG STAR' ? 'selected' : '' }} value='YAMAHA-DRAG STAR'>YAMAHA-DRAG STAR </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-BAIO' ? 'selected' : '' }} value='KAWASAKI-BAIO'>KAWASAKI-BAIO </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KDX' ? 'selected' : '' }} value='KAWASAKI-KDX'>KAWASAKI-KDX </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-B-KING GSX 1300' ? 'selected' : '' }} value='SUZUKI-B-KING GSX 1300'>SUZUKI-B-KING GSX 1300 </option>
                                            <option {{ old('marcaMoto') == 'ZONGSHEN-125 ZS' ? 'selected' : '' }} value='ZONGSHEN-125 ZS'>ZONGSHEN-125 ZS </option>
                                            <option {{ old('marcaMoto') == 'APRILIA-SR' ? 'selected' : '' }} value='APRILIA-SR'>APRILIA-SR </option>
                                            <option {{ old('marcaMoto') == 'DAYANG-DY50' ? 'selected' : '' }} value='DAYANG-DY50'>DAYANG-DY50 </option>
                                            <option {{ old('marcaMoto') == 'JONNY-NAKED' ? 'selected' : '' }} value='JONNY-NAKED'>JONNY-NAKED </option>
                                            <option {{ old('marcaMoto') == 'JONNY-RACER' ? 'selected' : '' }} value='JONNY-RACER'>JONNY-RACER </option>
                                            <option {{ old('marcaMoto') == 'JONNY-TEXAS' ? 'selected' : '' }} value='JONNY-TEXAS'>JONNY-TEXAS </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CRF 110/150' ? 'selected' : '' }} value='HONDA-CRF 110/150'>HONDA-CRF 110/150 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XJ6' ? 'selected' : '' }} value='YAMAHA-XJ6'>YAMAHA-XJ6 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-LANDER XTZ 250' ? 'selected' : '' }} value='YAMAHA-LANDER XTZ 250'>YAMAHA-LANDER XTZ 250 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-ALBA' ? 'selected' : '' }} value='YAMAHA-ALBA'>YAMAHA-ALBA </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FROG' ? 'selected' : '' }} value='YAMAHA-FROG'>YAMAHA-FROG </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-LIBERO' ? 'selected' : '' }} value='YAMAHA-LIBERO'>YAMAHA-LIBERO </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-GLADIATOR' ? 'selected' : '' }} value='YAMAHA-GLADIATOR'>YAMAHA-GLADIATOR </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-MEST' ? 'selected' : '' }} value='YAMAHA-MEST'>YAMAHA-MEST </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-ECCY' ? 'selected' : '' }} value='YAMAHA-ECCY'>YAMAHA-ECCY </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-PASSOL' ? 'selected' : '' }} value='YAMAHA-PASSOL'>YAMAHA-PASSOL </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-EC-02' ? 'selected' : '' }} value='YAMAHA-EC-02'>YAMAHA-EC-02 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZ 85LW' ? 'selected' : '' }} value='YAMAHA-YZ 85LW'>YAMAHA-YZ 85LW </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-V-STAR' ? 'selected' : '' }} value='YAMAHA-V-STAR'>YAMAHA-V-STAR </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-PAS' ? 'selected' : '' }} value='YAMAHA-PAS'>YAMAHA-PAS </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-AEROX' ? 'selected' : '' }} value='YAMAHA-AEROX'>YAMAHA-AEROX </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-MORPHOUS' ? 'selected' : '' }} value='YAMAHA-MORPHOUS'>YAMAHA-MORPHOUS </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XF50X' ? 'selected' : '' }} value='YAMAHA-XF50X'>YAMAHA-XF50X </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-LAGEND' ? 'selected' : '' }} value='YAMAHA-LAGEND'>YAMAHA-LAGEND </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TZR' ? 'selected' : '' }} value='YAMAHA-TZR'>YAMAHA-TZR </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-QT50' ? 'selected' : '' }} value='YAMAHA-QT50'>YAMAHA-QT50 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-SHARK' ? 'selected' : '' }} value='TRAXX-SHARK'>TRAXX-SHARK </option>
                                            <option {{ old('marcaMoto') == 'HONDA-FURY' ? 'selected' : '' }} value='HONDA-FURY'>HONDA-FURY </option>
                                            <option {{ old('marcaMoto') == 'HONDA-STUNNER' ? 'selected' : '' }} value='HONDA-STUNNER'>HONDA-STUNNER </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 50' ? 'selected' : '' }} value='HONDA-CB 50'>HONDA-CB 50 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-BOLDOR CB 900' ? 'selected' : '' }} value='HONDA-BOLDOR CB 900'>HONDA-BOLDOR CB 900 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBF 600' ? 'selected' : '' }} value='HONDA-CBF 600'>HONDA-CBF 600 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBR 400RR' ? 'selected' : '' }} value='HONDA-CBR 400RR'>HONDA-CBR 400RR </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CBX 1000' ? 'selected' : '' }} value='HONDA-CBX 1000'>HONDA-CBX 1000 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CD 125' ? 'selected' : '' }} value='HONDA-CD 125'>HONDA-CD 125 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-ML 125' ? 'selected' : '' }} value='HONDA-ML 125'>HONDA-ML 125 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-NSR 500' ? 'selected' : '' }} value='HONDA-NSR 500'>HONDA-NSR 500 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-RC' ? 'selected' : '' }} value='HONDA-RC'>HONDA-RC </option>
                                            <option {{ old('marcaMoto') == 'HONDA-PAN-EUROPEAN ST' ? 'selected' : '' }} value='HONDA-PAN-EUROPEAN ST'>HONDA-PAN-EUROPEAN ST </option>
                                            <option {{ old('marcaMoto') == 'HONDA-TURUNA 125' ? 'selected' : '' }} value='HONDA-TURUNA 125'>HONDA-TURUNA 125 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-VTR' ? 'selected' : '' }} value='HONDA-VTR'>HONDA-VTR </option>
                                            <option {{ old('marcaMoto') == 'HONDA-AFRICA TWIN XRV 750' ? 'selected' : '' }} value='HONDA-AFRICA TWIN XRV 750'>HONDA-AFRICA TWIN XRV 750 </option>
                                            <option {{ old('marcaMoto') == 'FBM-MZ 250' ? 'selected' : '' }} value='FBM-MZ 250'>FBM-MZ 250 </option>
                                            <option {{ old('marcaMoto') == 'FBM-KAPRA' ? 'selected' : '' }} value='FBM-KAPRA'>FBM-KAPRA </option>
                                            <option {{ old('marcaMoto') == 'FBM-RALLYE' ? 'selected' : '' }} value='FBM-RALLYE'>FBM-RALLYE </option>
                                            <option {{ old('marcaMoto') == 'FBM-PASSEIO' ? 'selected' : '' }} value='FBM-PASSEIO'>FBM-PASSEIO </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-BANDIT 400' ? 'selected' : '' }} value='SUZUKI-BANDIT 400'>SUZUKI-BANDIT 400 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-BANDIT 600' ? 'selected' : '' }} value='SUZUKI-BANDIT 600'>SUZUKI-BANDIT 600 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-BANDIT GSF 750' ? 'selected' : '' }} value='SUZUKI-BANDIT GSF 750'>SUZUKI-BANDIT GSF 750 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-BANDIT 1200' ? 'selected' : '' }} value='SUZUKI-BANDIT 1200'>SUZUKI-BANDIT 1200 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-HAYABUSA' ? 'selected' : '' }} value='SUZUKI-HAYABUSA'>SUZUKI-HAYABUSA </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-INTRUDER CUSTOM' ? 'selected' : '' }} value='SUZUKI-INTRUDER CUSTOM'>SUZUKI-INTRUDER CUSTOM </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-RV' ? 'selected' : '' }} value='SUZUKI-RV'>SUZUKI-RV </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-SV' ? 'selected' : '' }} value='SUZUKI-SV'>SUZUKI-SV </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-MARAUDER VZ' ? 'selected' : '' }} value='SUZUKI-MARAUDER VZ'>SUZUKI-MARAUDER VZ </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CG CARGO/JOB' ? 'selected' : '' }} value='HONDA-CG CARGO/JOB'>HONDA-CG CARGO/JOB </option>
                                            <option {{ old('marcaMoto') == 'AGRALE-EXPLORER' ? 'selected' : '' }} value='AGRALE-EXPLORER'>AGRALE-EXPLORER </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-ELIMINATOR' ? 'selected' : '' }} value='KAWASAKI-ELIMINATOR'>KAWASAKI-ELIMINATOR </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-GTR' ? 'selected' : '' }} value='KAWASAKI-GTR'>KAWASAKI-GTR </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KLE' ? 'selected' : '' }} value='KAWASAKI-KLE'>KAWASAKI-KLE </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KLR' ? 'selected' : '' }} value='KAWASAKI-KLR'>KAWASAKI-KLR </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-SUPER SHERPA' ? 'selected' : '' }} value='KAWASAKI-SUPER SHERPA'>KAWASAKI-SUPER SHERPA </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-ZRX' ? 'selected' : '' }} value='KAWASAKI-ZRX'>KAWASAKI-ZRX </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-ZR' ? 'selected' : '' }} value='KAWASAKI-ZR'>KAWASAKI-ZR </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 1400' ? 'selected' : '' }} value='KAWASAKI-NINJA 1400'>KAWASAKI-NINJA 1400 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FS1' ? 'selected' : '' }} value='YAMAHA-FS1'>YAMAHA-FS1 </option>
                                            <option {{ old('marcaMoto') == 'HAOBAO-HB-50' ? 'selected' : '' }} value='HAOBAO-HB-50'>HAOBAO-HB-50 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-PC 50' ? 'selected' : '' }} value='HONDA-PC 50'>HONDA-PC 50 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CG 125' ? 'selected' : '' }} value='HONDA-CG 125'>HONDA-CG 125 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-PACIFIC COAST' ? 'selected' : '' }} value='HONDA-PACIFIC COAST'>HONDA-PACIFIC COAST </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CG TODAY' ? 'selected' : '' }} value='HONDA-CG TODAY'>HONDA-CG TODAY </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-GT' ? 'selected' : '' }} value='SUZUKI-GT'>SUZUKI-GT </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FZR1000' ? 'selected' : '' }} value='YAMAHA-FZR1000'>YAMAHA-FZR1000 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-GSI' ? 'selected' : '' }} value='SUZUKI-GSI'>SUZUKI-GSI </option>
                                            <option {{ old('marcaMoto') == 'KAHENA-AMAZONAS' ? 'selected' : '' }} value='KAHENA-AMAZONAS'>KAHENA-AMAZONAS </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CB 125' ? 'selected' : '' }} value='HONDA-CB 125'>HONDA-CB 125 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-PHOENIX 50' ? 'selected' : '' }} value='SHINERAY-PHOENIX 50'>SHINERAY-PHOENIX 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-INDIANAPOLIS 200' ? 'selected' : '' }} value='SHINERAY-INDIANAPOLIS 200'>SHINERAY-INDIANAPOLIS 200 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-F35/F40' ? 'selected' : '' }} value='SHINERAY-F35/F40'>SHINERAY-F35/F40 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-X2 250' ? 'selected' : '' }} value='SHINERAY-X2 250'>SHINERAY-X2 250 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-MAX 150' ? 'selected' : '' }} value='SHINERAY-MAX 150'>SHINERAY-MAX 150 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-NEW WAVE 125' ? 'selected' : '' }} value='SHINERAY-NEW WAVE 125'>SHINERAY-NEW WAVE 125 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-EXPLORER 150' ? 'selected' : '' }} value='SHINERAY-EXPLORER 150'>SHINERAY-EXPLORER 150 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XS400' ? 'selected' : '' }} value='YAMAHA-XS400'>YAMAHA-XS400 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-RD 350 VIUVA NEGRA' ? 'selected' : '' }} value='YAMAHA-RD 350 VIUVA NEGRA'>YAMAHA-RD 350 VIUVA NEGRA </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-XY 250' ? 'selected' : '' }} value='SHINERAY-XY 250'>SHINERAY-XY 250 </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-JOB' ? 'selected' : '' }} value='SUZUKI-JOB'>SUZUKI-JOB </option>
                                            <option {{ old('marcaMoto') == 'ARIEL-RED HUNTER' ? 'selected' : '' }} value='ARIEL-RED HUNTER'>ARIEL-RED HUNTER </option>
                                            <option {{ old('marcaMoto') == 'ARIEL-W/NG' ? 'selected' : '' }} value='ARIEL-W/NG'>ARIEL-W/NG </option>
                                            <option {{ old('marcaMoto') == 'ARIEL-M2F' ? 'selected' : '' }} value='ARIEL-M2F'>ARIEL-M2F </option>
                                            <option {{ old('marcaMoto') == 'ARIEL-GOLDEN ARROW' ? 'selected' : '' }} value='ARIEL-GOLDEN ARROW'>ARIEL-GOLDEN ARROW </option>
                                            <option {{ old('marcaMoto') == 'SUZUKI-AE 50' ? 'selected' : '' }} value='SUZUKI-AE 50'>SUZUKI-AE 50 </option>
                                            <option {{ old('marcaMoto') == 'MAHINDRA-RODEO' ? 'selected' : '' }} value='MAHINDRA-RODEO'>MAHINDRA-RODEO </option>
                                            <option {{ old('marcaMoto') == 'MAHINDRA-DURO' ? 'selected' : '' }} value='MAHINDRA-DURO'>MAHINDRA-DURO </option>
                                            <option {{ old('marcaMoto') == 'HONDA-DUTY' ? 'selected' : '' }} value='HONDA-DUTY'>HONDA-DUTY </option>
                                            <option {{ old('marcaMoto') == 'DUCAR-150' ? 'selected' : '' }} value='DUCAR-150'>DUCAR-150 </option>
                                            <option {{ old('marcaMoto') == 'DITALLY-WAKE 500' ? 'selected' : '' }} value='DITALLY-WAKE 500'>DITALLY-WAKE 500 </option>
                                            <option {{ old('marcaMoto') == 'DITALLY-OUTCROSS' ? 'selected' : '' }} value='DITALLY-OUTCROSS'>DITALLY-OUTCROSS </option>
                                            <option {{ old('marcaMoto') == 'DITALLY-JOY PLUS' ? 'selected' : '' }} value='DITALLY-JOY PLUS'>DITALLY-JOY PLUS </option>
                                            <option {{ old('marcaMoto') == 'DITALLY-PASSION' ? 'selected' : '' }} value='DITALLY-PASSION'>DITALLY-PASSION </option>
                                            <option {{ old('marcaMoto') == 'DITALLY-TREND' ? 'selected' : '' }} value='DITALLY-TREND'>DITALLY-TREND </option>
                                            <option {{ old('marcaMoto') == 'DITALLY-PIT BULL' ? 'selected' : '' }} value='DITALLY-PIT BULL'>DITALLY-PIT BULL </option>
                                            <option {{ old('marcaMoto') == 'DITALLY-BRUTTUS' ? 'selected' : '' }} value='DITALLY-BRUTTUS'>DITALLY-BRUTTUS </option>
                                            <option {{ old('marcaMoto') == 'MARVA-UFO 50' ? 'selected' : '' }} value='MARVA-UFO 50'>MARVA-UFO 50 </option>
                                            <option {{ old('marcaMoto') == 'MARVA-LF250ST' ? 'selected' : '' }} value='MARVA-LF250ST'>MARVA-LF250ST </option>
                                            <option {{ old('marcaMoto') == 'MARVA-FOX 150R' ? 'selected' : '' }} value='MARVA-FOX 150R'>MARVA-FOX 150R </option>
                                            <option {{ old('marcaMoto') == 'MARVA-LF400ST' ? 'selected' : '' }} value='MARVA-LF400ST'>MARVA-LF400ST </option>
                                            <option {{ old('marcaMoto') == 'MARVA-VR 150 WIND' ? 'selected' : '' }} value='MARVA-VR 150 WIND'>MARVA-VR 150 WIND </option>
                                            <option {{ old('marcaMoto') == 'MARVA-HERCULES 200' ? 'selected' : '' }} value='MARVA-HERCULES 200'>MARVA-HERCULES 200 </option>
                                            <option {{ old('marcaMoto') == 'MARVA-ONIX 50R' ? 'selected' : '' }} value='MARVA-ONIX 50R'>MARVA-ONIX 50R </option>
                                            <option {{ old('marcaMoto') == 'MARVA-HS 150 FIRE' ? 'selected' : '' }} value='MARVA-HS 150 FIRE'>MARVA-HS 150 FIRE </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-JET 50' ? 'selected' : '' }} value='SHINERAY-JET 50'>SHINERAY-JET 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-RETRO 50' ? 'selected' : '' }} value='SHINERAY-RETRO 50'>SHINERAY-RETRO 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-NEW 50' ? 'selected' : '' }} value='SHINERAY-NEW 50'>SHINERAY-NEW 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-EAGLE 50' ? 'selected' : '' }} value='SHINERAY-EAGLE 50'>SHINERAY-EAGLE 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-SUPER SMART 50' ? 'selected' : '' }} value='SHINERAY-SUPER SMART 50'>SHINERAY-SUPER SMART 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-NEW 200' ? 'selected' : '' }} value='SHINERAY-NEW 200'>SHINERAY-NEW 200 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-CARGO 200' ? 'selected' : '' }} value='SHINERAY-CARGO 200'>SHINERAY-CARGO 200 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-BRAVO 200' ? 'selected' : '' }} value='SHINERAY-BRAVO 200'>SHINERAY-BRAVO 200 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-STRONG 250' ? 'selected' : '' }} value='SHINERAY-STRONG 250'>SHINERAY-STRONG 250 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-FUTURE 150' ? 'selected' : '' }} value='SHINERAY-FUTURE 150'>SHINERAY-FUTURE 150 </option>
                                            <option {{ old('marcaMoto') == 'WOLVER-KN 150' ? 'selected' : '' }} value='WOLVER-KN 150'>WOLVER-KN 150 </option>
                                            <option {{ old('marcaMoto') == 'WOLVER-KN 125 S' ? 'selected' : '' }} value='WOLVER-KN 125 S'>WOLVER-KN 125 S </option>
                                            <option {{ old('marcaMoto') == 'WOLVER-KN 50 S' ? 'selected' : '' }} value='WOLVER-KN 50 S'>WOLVER-KN 50 S </option>
                                            <option {{ old('marcaMoto') == 'IROS-IZY 50' ? 'selected' : '' }} value='IROS-IZY 50'>IROS-IZY 50 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-PCX' ? 'selected' : '' }} value='HONDA-PCX'>HONDA-PCX </option>
                                            <option {{ old('marcaMoto') == 'BMW-AIRHEAD' ? 'selected' : '' }} value='BMW-AIRHEAD'>BMW-AIRHEAD </option>
                                            <option {{ old('marcaMoto') == 'BMW-C1' ? 'selected' : '' }} value='BMW-C1'>BMW-C1 </option>
                                            <option {{ old('marcaMoto') == 'BMW-F650GS' ? 'selected' : '' }} value='BMW-F650GS'>BMW-F650GS </option>
                                            <option {{ old('marcaMoto') == 'BMW-F650CS' ? 'selected' : '' }} value='BMW-F650CS'>BMW-F650CS </option>
                                            <option {{ old('marcaMoto') == 'BMW-F800GS' ? 'selected' : '' }} value='BMW-F800GS'>BMW-F800GS </option>
                                            <option {{ old('marcaMoto') == 'BMW-K75' ? 'selected' : '' }} value='BMW-K75'>BMW-K75 </option>
                                            <option {{ old('marcaMoto') == 'BMW-K100' ? 'selected' : '' }} value='BMW-K100'>BMW-K100 </option>
                                            <option {{ old('marcaMoto') == 'BMW-K1200R' ? 'selected' : '' }} value='BMW-K1200R'>BMW-K1200R </option>
                                            <option {{ old('marcaMoto') == 'BMW-K1300R' ? 'selected' : '' }} value='BMW-K1300R'>BMW-K1300R </option>
                                            <option {{ old('marcaMoto') == 'BMW-K1200GT' ? 'selected' : '' }} value='BMW-K1200GT'>BMW-K1200GT </option>
                                            <option {{ old('marcaMoto') == 'BMW-K1300GT' ? 'selected' : '' }} value='BMW-K1300GT'>BMW-K1300GT </option>
                                            <option {{ old('marcaMoto') == 'BMW-K1200GS' ? 'selected' : '' }} value='BMW-K1200GS'>BMW-K1200GS </option>
                                            <option {{ old('marcaMoto') == 'BMW-K1200S' ? 'selected' : '' }} value='BMW-K1200S'>BMW-K1200S </option>
                                            <option {{ old('marcaMoto') == 'BMW-R32' ? 'selected' : '' }} value='BMW-R32'>BMW-R32 </option>
                                            <option {{ old('marcaMoto') == 'BMW-R51/3' ? 'selected' : '' }} value='BMW-R51/3'>BMW-R51/3 </option>
                                            <option {{ old('marcaMoto') == 'BMW-R27' ? 'selected' : '' }} value='BMW-R27'>BMW-R27 </option>
                                            <option {{ old('marcaMoto') == 'BMW-R60' ? 'selected' : '' }} value='BMW-R60'>BMW-R60 </option>
                                            <option {{ old('marcaMoto') == 'BMW-R75' ? 'selected' : '' }} value='BMW-R75'>BMW-R75 </option>
                                            <option {{ old('marcaMoto') == 'BMW-R75/5' ? 'selected' : '' }} value='BMW-R75/5'>BMW-R75/5 </option>
                                            <option {{ old('marcaMoto') == 'BMW-R90S' ? 'selected' : '' }} value='BMW-R90S'>BMW-R90S </option>
                                            <option {{ old('marcaMoto') == 'BMW-R1200C' ? 'selected' : '' }} value='BMW-R1200C'>BMW-R1200C </option>
                                            <option {{ old('marcaMoto') == 'BMW-R1150GS' ? 'selected' : '' }} value='BMW-R1150GS'>BMW-R1150GS </option>
                                            <option {{ old('marcaMoto') == 'BMW-R1200RT' ? 'selected' : '' }} value='BMW-R1200RT'>BMW-R1200RT </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-SPORTSTER' ? 'selected' : '' }} value='HARLEY-DAVIDSON-SPORTSTER'>HARLEY-DAVIDSON-SPORTSTER </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-TOURING STREET GLIDE' ? 'selected' : '' }} value='HARLEY-DAVIDSON-TOURING STREET GLIDE'>HARLEY-DAVIDSON-TOURING
                                                STREET GLIDE </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XTZ 250 TENERE' ? 'selected' : '' }} value='YAMAHA-XTZ 250 TENERE'>YAMAHA-XTZ 250 TENERE </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XT 225' ? 'selected' : '' }} value='YAMAHA-XT 225'>YAMAHA-XT 225 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XT 660Z TENERE' ? 'selected' : '' }} value='YAMAHA-XT 660Z TENERE'>YAMAHA-XT 660Z TENERE </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XT 1200Z SUPER TENERE' ? 'selected' : '' }} value='YAMAHA-XT 1200Z SUPER TENERE'>YAMAHA-XT 1200Z SUPER TENERE
                                            </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-MOBY 50' ? 'selected' : '' }} value='TRAXX-MOBY 50'>TRAXX-MOBY 50 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-JOTO 135' ? 'selected' : '' }} value='TRAXX-JOTO 135'>TRAXX-JOTO 135 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-MONTEZ 250' ? 'selected' : '' }} value='TRAXX-MONTEZ 250'>TRAXX-MONTEZ 250 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-DUNNA 600' ? 'selected' : '' }} value='TRAXX-DUNNA 600'>TRAXX-DUNNA 600 </option>
                                            <option {{ old('marcaMoto') == 'TRAXX-VICO' ? 'selected' : '' }} value='TRAXX-VICO'>TRAXX-VICO </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FAZER FZ6' ? 'selected' : '' }} value='YAMAHA-FAZER FZ6'>YAMAHA-FAZER FZ6 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FAZER YS150' ? 'selected' : '' }} value='YAMAHA-FAZER YS150'>YAMAHA-FAZER YS150 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FAZER FZ1' ? 'selected' : '' }} value='YAMAHA-FAZER FZ1'>YAMAHA-FAZER FZ1 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZF 600R' ? 'selected' : '' }} value='YAMAHA-YZF 600R'>YAMAHA-YZF 600R </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZF R6' ? 'selected' : '' }} value='YAMAHA-YZF R6'>YAMAHA-YZF R6 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CRF 230/250' ? 'selected' : '' }} value='HONDA-CRF 230/250'>HONDA-CRF 230/250 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CRF 450' ? 'selected' : '' }} value='HONDA-CRF 450'>HONDA-CRF 450 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-NX 650 DOMINATOR' ? 'selected' : '' }} value='HONDA-NX 650 DOMINATOR'>HONDA-NX 650 DOMINATOR </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CR 250' ? 'selected' : '' }} value='HONDA-CR 250'>HONDA-CR 250 </option>
                                            <option {{ old('marcaMoto') == 'HONDA-CR 125' ? 'selected' : '' }} value='HONDA-CR 125'>HONDA-CR 125 </option>
                                            <option {{ old('marcaMoto') == 'BULL-HB' ? 'selected' : '' }} value='BULL-HB'>BULL-HB </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER 400' ? 'selected' : '' }} value='CAN-AM-OUTLANDER 400'>CAN-AM-OUTLANDER 400 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER 500' ? 'selected' : '' }} value='CAN-AM-OUTLANDER 500'>CAN-AM-OUTLANDER 500 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER 650' ? 'selected' : '' }} value='CAN-AM-OUTLANDER 650'>CAN-AM-OUTLANDER 650 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER 800R' ? 'selected' : '' }} value='CAN-AM-OUTLANDER 800R'>CAN-AM-OUTLANDER 800R </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER MAX 400' ? 'selected' : '' }} value='CAN-AM-OUTLANDER MAX 400'>CAN-AM-OUTLANDER MAX 400 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER MAX 500' ? 'selected' : '' }} value='CAN-AM-OUTLANDER MAX 500'>CAN-AM-OUTLANDER MAX 500 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER MAX 650' ? 'selected' : '' }} value='CAN-AM-OUTLANDER MAX 650'>CAN-AM-OUTLANDER MAX 650 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER MAX 800R' ? 'selected' : '' }} value='CAN-AM-OUTLANDER MAX 800R'>CAN-AM-OUTLANDER MAX 800R </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-OUTLANDER MAX LTD 800R' ? 'selected' : '' }} value='CAN-AM-OUTLANDER MAX LTD 800R'>CAN-AM-OUTLANDER MAX LTD 800R
                                            </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-RENEGADE 500' ? 'selected' : '' }} value='CAN-AM-RENEGADE 500'>CAN-AM-RENEGADE 500 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-RENEGADE 800R' ? 'selected' : '' }} value='CAN-AM-RENEGADE 800R'>CAN-AM-RENEGADE 800R </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-DS 250' ? 'selected' : '' }} value='CAN-AM-DS 250'>CAN-AM-DS 250 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-DS 450' ? 'selected' : '' }} value='CAN-AM-DS 450'>CAN-AM-DS 450 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-DS 90' ? 'selected' : '' }} value='CAN-AM-DS 90'>CAN-AM-DS 90 </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-RT' ? 'selected' : '' }} value='CAN-AM-RT'>CAN-AM-RT </option>
                                            <option {{ old('marcaMoto') == 'CAN-AM-RS' ? 'selected' : '' }} value='CAN-AM-RS'>CAN-AM-RS </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 1000' ? 'selected' : '' }} value='KAWASAKI-NINJA 1000'>KAWASAKI-NINJA 1000 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 600' ? 'selected' : '' }} value='KAWASAKI-NINJA 600'>KAWASAKI-NINJA 600 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 300' ? 'selected' : '' }} value='KAWASAKI-NINJA 300'>KAWASAKI-NINJA 300 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 1100' ? 'selected' : '' }} value='KAWASAKI-NINJA 1100'>KAWASAKI-NINJA 1100 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 900' ? 'selected' : '' }} value='KAWASAKI-NINJA 900'>KAWASAKI-NINJA 900 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 700' ? 'selected' : '' }} value='KAWASAKI-NINJA 700'>KAWASAKI-NINJA 700 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-NINJA 1200' ? 'selected' : '' }} value='KAWASAKI-NINJA 1200'>KAWASAKI-NINJA 1200 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-Z1000' ? 'selected' : '' }} value='KAWASAKI-Z1000'>KAWASAKI-Z1000 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-Z750' ? 'selected' : '' }} value='KAWASAKI-Z750'>KAWASAKI-Z750 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-Z800' ? 'selected' : '' }} value='KAWASAKI-Z800'>KAWASAKI-Z800 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-VERSYS CITY' ? 'selected' : '' }} value='KAWASAKI-VERSYS CITY'>KAWASAKI-VERSYS CITY </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-VERSYS GRAND TOURER' ? 'selected' : '' }} value='KAWASAKI-VERSYS GRAND TOURER'>KAWASAKI-VERSYS GRAND TOURER
                                            </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-VERSYS TOURER' ? 'selected' : '' }} value='KAWASAKI-VERSYS TOURER'>KAWASAKI-VERSYS TOURER </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-VERSYS 1000' ? 'selected' : '' }} value='KAWASAKI-VERSYS 1000'>KAWASAKI-VERSYS 1000 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KX 450/500' ? 'selected' : '' }} value='KAWASAKI-KX 450/500'>KAWASAKI-KX 450/500 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KX 250' ? 'selected' : '' }} value='KAWASAKI-KX 250'>KAWASAKI-KX 250 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KX 65/85' ? 'selected' : '' }} value='KAWASAKI-KX 65/85'>KAWASAKI-KX 65/85 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KLX 400/450' ? 'selected' : '' }} value='KAWASAKI-KLX 400/450'>KAWASAKI-KLX 400/450 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-KLX 250/300' ? 'selected' : '' }} value='KAWASAKI-KLX 250/300'>KAWASAKI-KLX 250/300 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TMAX' ? 'selected' : '' }} value='YAMAHA-TMAX'>YAMAHA-TMAX </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YFM 700R' ? 'selected' : '' }} value='YAMAHA-YFM 700R'>YAMAHA-YFM 700R </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-GRIZZLY' ? 'selected' : '' }} value='YAMAHA-GRIZZLY'>YAMAHA-GRIZZLY </option>
                                            <option {{ old('marcaMoto') == 'KTM-50 SX' ? 'selected' : '' }} value='KTM-50 SX'>KTM-50 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-65 SX' ? 'selected' : '' }} value='KTM-65 SX'>KTM-65 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-85 SX' ? 'selected' : '' }} value='KTM-85 SX'>KTM-85 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-125 SX' ? 'selected' : '' }} value='KTM-125 SX'>KTM-125 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-150 SX' ? 'selected' : '' }} value='KTM-150 SX'>KTM-150 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-250 SX' ? 'selected' : '' }} value='KTM-250 SX'>KTM-250 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-350 SX' ? 'selected' : '' }} value='KTM-350 SX'>KTM-350 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-450 SX-F' ? 'selected' : '' }} value='KTM-450 SX-F'>KTM-450 SX-F </option>
                                            <option {{ old('marcaMoto') == 'KTM-350 EXC' ? 'selected' : '' }} value='KTM-350 EXC'>KTM-350 EXC </option>
                                            <option {{ old('marcaMoto') == 'KTM-500 EXC' ? 'selected' : '' }} value='KTM-500 EXC'>KTM-500 EXC </option>
                                            <option {{ old('marcaMoto') == 'KTM-150 XC' ? 'selected' : '' }} value='KTM-150 XC'>KTM-150 XC </option>
                                            <option {{ old('marcaMoto') == 'KTM-250 XC' ? 'selected' : '' }} value='KTM-250 XC'>KTM-250 XC </option>
                                            <option {{ old('marcaMoto') == 'KTM-300 XC' ? 'selected' : '' }} value='KTM-300 XC'>KTM-300 XC </option>
                                            <option {{ old('marcaMoto') == 'KTM-450 XC-F/W' ? 'selected' : '' }} value='KTM-450 XC-F/W'>KTM-450 XC-F/W </option>
                                            <option {{ old('marcaMoto') == 'KTM-200 XC' ? 'selected' : '' }} value='KTM-200 XC'>KTM-200 XC </option>
                                            <option {{ old('marcaMoto') == 'KTM-690 ENDURO R' ? 'selected' : '' }} value='KTM-690 ENDURO R'>KTM-690 ENDURO R </option>
                                            <option {{ old('marcaMoto') == 'KTM-1190 ADVENTURE' ? 'selected' : '' }} value='KTM-1190 ADVENTURE'>KTM-1190 ADVENTURE </option>
                                            <option {{ old('marcaMoto') == 'KTM-990 SM T' ? 'selected' : '' }} value='KTM-990 SM T'>KTM-990 SM T </option>
                                            <option {{ old('marcaMoto') == 'KTM-990 ADVENTURE BAJA' ? 'selected' : '' }} value='KTM-990 ADVENTURE BAJA'>KTM-990 ADVENTURE BAJA </option>
                                            <option {{ old('marcaMoto') == 'KTM-690 DUKE' ? 'selected' : '' }} value='KTM-690 DUKE'>KTM-690 DUKE </option>
                                            <option {{ old('marcaMoto') == 'KTM-1190 RC8 R' ? 'selected' : '' }} value='KTM-1190 RC8 R'>KTM-1190 RC8 R </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-ACX 250F' ? 'selected' : '' }} value='ACELLERA-ACX 250F'>ACELLERA-ACX 250F </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-HOTZOO SPORT 90' ? 'selected' : '' }} value='ACELLERA-HOTZOO SPORT 90'>ACELLERA-HOTZOO SPORT 90 </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-SPORTLANDER 150R' ? 'selected' : '' }} value='ACELLERA-SPORTLANDER 150R'>ACELLERA-SPORTLANDER 150R </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-SPORTLANDER 250XR' ? 'selected' : '' }} value='ACELLERA-SPORTLANDER 250XR'>ACELLERA-SPORTLANDER 250XR
                                            </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-SPORTLANDER 350ZX' ? 'selected' : '' }} value='ACELLERA-SPORTLANDER 350ZX'>ACELLERA-SPORTLANDER 350ZX
                                            </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-SPORTLANDER 450TR' ? 'selected' : '' }} value='ACELLERA-SPORTLANDER 450TR'>ACELLERA-SPORTLANDER 450TR
                                            </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-QUADRILANDER 300' ? 'selected' : '' }} value='ACELLERA-QUADRILANDER 300'>ACELLERA-QUADRILANDER 300 </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-QUADRILANDER 400' ? 'selected' : '' }} value='ACELLERA-QUADRILANDER 400'>ACELLERA-QUADRILANDER 400 </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-QUADRILANDER 600' ? 'selected' : '' }} value='ACELLERA-QUADRILANDER 600'>ACELLERA-QUADRILANDER 600 </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-FRONTLANDER 500' ? 'selected' : '' }} value='ACELLERA-FRONTLANDER 500'>ACELLERA-FRONTLANDER 500 </option>
                                            <option {{ old('marcaMoto') == 'ACELLERA-FRONTLANDER 800 EFI' ? 'selected' : '' }} value='ACELLERA-FRONTLANDER 800 EFI'>ACELLERA-FRONTLANDER 800 EFI
                                            </option>
                                            <option {{ old('marcaMoto') == 'KTM-525 XC' ? 'selected' : '' }} value='KTM-525 XC'>KTM-525 XC </option>
                                            <option {{ old('marcaMoto') == 'KTM-505 SX' ? 'selected' : '' }} value='KTM-505 SX'>KTM-505 SX </option>
                                            <option {{ old('marcaMoto') == 'KTM-450 XC' ? 'selected' : '' }} value='KTM-450 XC'>KTM-450 XC </option>
                                            <option {{ old('marcaMoto') == 'KTM-450 SX' ? 'selected' : '' }} value='KTM-450 SX'>KTM-450 SX </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-VENICE 50' ? 'selected' : '' }} value='SHINERAY-VENICE 50'>SHINERAY-VENICE 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-LIBERTY 50' ? 'selected' : '' }} value='SHINERAY-LIBERTY 50'>SHINERAY-LIBERTY 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-BIKE 50' ? 'selected' : '' }} value='SHINERAY-BIKE 50'>SHINERAY-BIKE 50 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-JET 125' ? 'selected' : '' }} value='SHINERAY-JET 125'>SHINERAY-JET 125 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-CUSTOM 250' ? 'selected' : '' }} value='SHINERAY-CUSTOM 250'>SHINERAY-CUSTOM 250 </option>
                                            <option {{ old('marcaMoto') == 'SHINERAY-DISCOVER 250' ? 'selected' : '' }} value='SHINERAY-DISCOVER 250'>SHINERAY-DISCOVER 250 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 570' ? 'selected' : '' }} value='POLARIS-RZR 570'>POLARIS-RZR 570 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 800' ? 'selected' : '' }} value='POLARIS-RZR 800'>POLARIS-RZR 800 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 800 XC' ? 'selected' : '' }} value='POLARIS-RZR 800 XC'>POLARIS-RZR 800 XC </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR S 800' ? 'selected' : '' }} value='POLARIS-RZR S 800'>POLARIS-RZR S 800 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 900' ? 'selected' : '' }} value='POLARIS-RZR 900'>POLARIS-RZR 900 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR XP 1000' ? 'selected' : '' }} value='POLARIS-RZR XP 1000'>POLARIS-RZR XP 1000 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 4 800' ? 'selected' : '' }} value='POLARIS-RZR 4 800'>POLARIS-RZR 4 800 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 4 900' ? 'selected' : '' }} value='POLARIS-RZR 4 900'>POLARIS-RZR 4 900 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 4 1000' ? 'selected' : '' }} value='POLARIS-RZR 4 1000'>POLARIS-RZR 4 1000 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER 6X6' ? 'selected' : '' }} value='POLARIS-RANGER 6X6'>POLARIS-RANGER 6X6 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER 800' ? 'selected' : '' }} value='POLARIS-RANGER 800'>POLARIS-RANGER 800 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER DIESEL' ? 'selected' : '' }} value='POLARIS-RANGER DIESEL'>POLARIS-RANGER DIESEL </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER XP 900' ? 'selected' : '' }} value='POLARIS-RANGER XP 900'>POLARIS-RANGER XP 900 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER 400' ? 'selected' : '' }} value='POLARIS-RANGER 400'>POLARIS-RANGER 400 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER 570' ? 'selected' : '' }} value='POLARIS-RANGER 570'>POLARIS-RANGER 570 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER 800 MIDSIZE' ? 'selected' : '' }} value='POLARIS-RANGER 800 MIDSIZE'>POLARIS-RANGER 800 MIDSIZE
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER EV' ? 'selected' : '' }} value='POLARIS-RANGER EV'>POLARIS-RANGER EV </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER CREW 570' ? 'selected' : '' }} value='POLARIS-RANGER CREW 570'>POLARIS-RANGER CREW 570 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER CREW 800' ? 'selected' : '' }} value='POLARIS-RANGER CREW 800'>POLARIS-RANGER CREW 800 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER CREW DIESEL' ? 'selected' : '' }} value='POLARIS-RANGER CREW DIESEL'>POLARIS-RANGER CREW DIESEL
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RANGER CREW 900' ? 'selected' : '' }} value='POLARIS-RANGER CREW 900'>POLARIS-RANGER CREW 900 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN 550 EPS' ? 'selected' : '' }} value='POLARIS-SPORTSMAN 550 EPS'>POLARIS-SPORTSMAN 550 EPS </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN 570' ? 'selected' : '' }} value='POLARIS-SPORTSMAN 570'>POLARIS-SPORTSMAN 570 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN 400 HO' ? 'selected' : '' }} value='POLARIS-SPORTSMAN 400 HO'>POLARIS-SPORTSMAN 400 HO </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN WV850 HO' ? 'selected' : '' }} value='POLARIS-SPORTSMAN WV850 HO'>POLARIS-SPORTSMAN WV850 HO
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN XP 850' ? 'selected' : '' }} value='POLARIS-SPORTSMAN XP 850'>POLARIS-SPORTSMAN XP 850 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN 800 EFI' ? 'selected' : '' }} value='POLARIS-SPORTSMAN 800 EFI'>POLARIS-SPORTSMAN 800 EFI </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN BIG BOSS 6X6 800' ? 'selected' : '' }} value='POLARIS-SPORTSMAN BIG BOSS 6X6 800'>POLARIS-SPORTSMAN BIG BOSS
                                                6X6 800 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SCRAMBLER XP 850 HO' ? 'selected' : '' }} value='POLARIS-SCRAMBLER XP 850 HO'>POLARIS-SCRAMBLER XP 850 HO
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SCRAMBLER XP 1000 EPS' ? 'selected' : '' }} value='POLARIS-SCRAMBLER XP 1000 EPS'>POLARIS-SCRAMBLER XP 1000 EPS
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN TOURING 850' ? 'selected' : '' }} value='POLARIS-SPORTSMAN TOURING 850'>POLARIS-SPORTSMAN TOURING 850
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN TOURING 570' ? 'selected' : '' }} value='POLARIS-SPORTSMAN TOURING 570'>POLARIS-SPORTSMAN TOURING 570
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN TOURING 550' ? 'selected' : '' }} value='POLARIS-SPORTSMAN TOURING 550'>POLARIS-SPORTSMAN TOURING 550
                                            </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN X2 550' ? 'selected' : '' }} value='POLARIS-SPORTSMAN X2 550'>POLARIS-SPORTSMAN X2 550 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-PHOENIX 200' ? 'selected' : '' }} value='POLARIS-PHOENIX 200'>POLARIS-PHOENIX 200 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-RZR 170' ? 'selected' : '' }} value='POLARIS-RZR 170'>POLARIS-RZR 170 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-OUTLAW 90' ? 'selected' : '' }} value='POLARIS-OUTLAW 90'>POLARIS-OUTLAW 90 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-SPORTSMAN 90' ? 'selected' : '' }} value='POLARIS-SPORTSMAN 90'>POLARIS-SPORTSMAN 90 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-OUTLAW 50' ? 'selected' : '' }} value='POLARIS-OUTLAW 50'>POLARIS-OUTLAW 50 </option>
                                            <option {{ old('marcaMoto') == 'POLARIS-BRUTUS' ? 'selected' : '' }} value='POLARIS-BRUTUS'>POLARIS-BRUTUS </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-CROSS ROADS 8-BALL' ? 'selected' : '' }} value='VICTORY-CROSS ROADS 8-BALL'>VICTORY-CROSS ROADS 8-BALL
                                            </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-CROSS ROADS CLASSIC' ? 'selected' : '' }} value='VICTORY-CROSS ROADS CLASSIC'>VICTORY-CROSS ROADS CLASSIC
                                            </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-CROSS COUNTRY 8-BALL' ? 'selected' : '' }} value='VICTORY-CROSS COUNTRY 8-BALL'>VICTORY-CROSS COUNTRY 8-BALL
                                            </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-CROSS COUNTRY' ? 'selected' : '' }} value='VICTORY-CROSS COUNTRY'>VICTORY-CROSS COUNTRY </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-NESS CROSS COUNTRY' ? 'selected' : '' }} value='VICTORY-NESS CROSS COUNTRY'>VICTORY-NESS CROSS COUNTRY
                                            </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-VISION TOUR' ? 'selected' : '' }} value='VICTORY-VISION TOUR'>VICTORY-VISION TOUR </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-CROSS COUNTRY TOUR' ? 'selected' : '' }} value='VICTORY-CROSS COUNTRY TOUR'>VICTORY-CROSS COUNTRY TOUR
                                            </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-CROSS COUNTRY TOUR ANNIVERSARY' ? 'selected' : '' }} value='VICTORY-CROSS COUNTRY TOUR ANNIVERSARY'>VICTORY-CROSS COUNTRY
                                                TOUR ANNIVERSARY </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-VEGAS 8-BALL' ? 'selected' : '' }} value='VICTORY-VEGAS 8-BALL'>VICTORY-VEGAS 8-BALL </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-HIGH-BALL' ? 'selected' : '' }} value='VICTORY-HIGH-BALL'>VICTORY-HIGH-BALL </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-HAMMER 8-BALL' ? 'selected' : '' }} value='VICTORY-HAMMER 8-BALL'>VICTORY-HAMMER 8-BALL </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-BOARDWALK' ? 'selected' : '' }} value='VICTORY-BOARDWALK'>VICTORY-BOARDWALK </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-JACKPOT' ? 'selected' : '' }} value='VICTORY-JACKPOT'>VICTORY-JACKPOT </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-JUDGE' ? 'selected' : '' }} value='VICTORY-JUDGE'>VICTORY-JUDGE </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-ZACH NESS CROSS COUNTRY' ? 'selected' : '' }} value='VICTORY-ZACH NESS CROSS COUNTRY'>VICTORY-ZACH NESS CROSS
                                                COUNTRY </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-HARD-BALL' ? 'selected' : '' }} value='VICTORY-HARD-BALL'>VICTORY-HARD-BALL </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-NESS VISION' ? 'selected' : '' }} value='VICTORY-NESS VISION'>VICTORY-NESS VISION </option>
                                            <option {{ old('marcaMoto') == 'VICTORY-CORY NESS CROSS COUNTRY TOUR' ? 'selected' : '' }} value='VICTORY-CORY NESS CROSS COUNTRY TOUR'>VICTORY-CORY NESS CROSS
                                                COUNTRY TOUR </option>
                                            <option {{ old('marcaMoto') == 'INDIAN-CHIEF CLASSIC' ? 'selected' : '' }} value='INDIAN-CHIEF CLASSIC'>INDIAN-CHIEF CLASSIC </option>
                                            <option {{ old('marcaMoto') == 'INDIAN-CHIEF VINTAGE' ? 'selected' : '' }} value='INDIAN-CHIEF VINTAGE'>INDIAN-CHIEF VINTAGE </option>
                                            <option {{ old('marcaMoto') == 'INDIAN-CHIEFTAIN' ? 'selected' : '' }} value='INDIAN-CHIEFTAIN'>INDIAN-CHIEFTAIN </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-COOL STAR 125' ? 'selected' : '' }} value='LIFAN-COOL STAR 125'>LIFAN-COOL STAR 125 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-X3' ? 'selected' : '' }} value='LIFAN-X3'>LIFAN-X3 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-JOJO 110' ? 'selected' : '' }} value='LIFAN-JOJO 110'>LIFAN-JOJO 110 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-CC125' ? 'selected' : '' }} value='LIFAN-CC125'>LIFAN-CC125 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-CC150' ? 'selected' : '' }} value='LIFAN-CC150'>LIFAN-CC150 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-KP150F' ? 'selected' : '' }} value='LIFAN-KP150F'>LIFAN-KP150F </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-LF100' ? 'selected' : '' }} value='LIFAN-LF100'>LIFAN-LF100 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-PK125' ? 'selected' : '' }} value='LIFAN-PK125'>LIFAN-PK125 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-POWER KING' ? 'selected' : '' }} value='LIFAN-POWER KING'>LIFAN-POWER KING </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-CROSS' ? 'selected' : '' }} value='LIFAN-CROSS'>LIFAN-CROSS </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-GLOW 110S' ? 'selected' : '' }} value='LIFAN-GLOW 110S'>LIFAN-GLOW 110S </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-KP150' ? 'selected' : '' }} value='LIFAN-KP150'>LIFAN-KP150 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-POWER MAN 250' ? 'selected' : '' }} value='LIFAN-POWER MAN 250'>LIFAN-POWER MAN 250 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-HIKER' ? 'selected' : '' }} value='LIFAN-HIKER'>LIFAN-HIKER </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-IV' ? 'selected' : '' }} value='LIFAN-IV'>LIFAN-IV </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-STEED 250' ? 'selected' : '' }} value='LIFAN-STEED 250'>LIFAN-STEED 250 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-TRAVELLER' ? 'selected' : '' }} value='LIFAN-TRAVELLER'>LIFAN-TRAVELLER </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-TB125' ? 'selected' : '' }} value='LIFAN-TB125'>LIFAN-TB125 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-PK110F' ? 'selected' : '' }} value='LIFAN-PK110F'>LIFAN-PK110F </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-LF125' ? 'selected' : '' }} value='LIFAN-LF125'>LIFAN-LF125 </option>
                                            <option {{ old('marcaMoto') == 'LIFAN-LF125' ? 'selected' : '' }} value='LIFAN-LF125'>LIFAN-LF125 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-F2 PLUS' ? 'selected' : '' }} value='BRAVAX-F2 PLUS'>BRAVAX-F2 PLUS </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-SUPER F2' ? 'selected' : '' }} value='BRAVAX-SUPER F2'>BRAVAX-SUPER F2 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-SUPER F1' ? 'selected' : '' }} value='BRAVAX-SUPER F1'>BRAVAX-SUPER F1 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-SUPER F3' ? 'selected' : '' }} value='BRAVAX-SUPER F3'>BRAVAX-SUPER F3 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-BVX 125' ? 'selected' : '' }} value='BRAVAX-BVX 125'>BRAVAX-BVX 125 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-BVX 130 STREET' ? 'selected' : '' }} value='BRAVAX-BVX 130 STREET'>BRAVAX-BVX 130 STREET </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-BVX 150 S1' ? 'selected' : '' }} value='BRAVAX-BVX 150 S1'>BRAVAX-BVX 150 S1 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-TR 150 D6' ? 'selected' : '' }} value='BRAVAX-TR 150 D6'>BRAVAX-TR 150 D6 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-AX 200' ? 'selected' : '' }} value='BRAVAX-AX 200'>BRAVAX-AX 200 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-BVX 200' ? 'selected' : '' }} value='BRAVAX-BVX 200'>BRAVAX-BVX 200 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-BX 260' ? 'selected' : '' }} value='BRAVAX-BX 260'>BRAVAX-BX 260 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-BR 250 D1' ? 'selected' : '' }} value='BRAVAX-BR 250 D1'>BRAVAX-BR 250 D1 </option>
                                            <option {{ old('marcaMoto') == 'BRAVAX-CARGO 260' ? 'selected' : '' }} value='BRAVAX-CARGO 260'>BRAVAX-CARGO 260 </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-COMET GT 250' ? 'selected' : '' }} value='KASINSKI-COMET GT 250'>KASINSKI-COMET GT 250 </option>
                                            <option {{ old('marcaMoto') == 'KASINSKI-COMET GT-R 250' ? 'selected' : '' }} value='KASINSKI-COMET GT-R 250'>KASINSKI-COMET GT-R 250 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-RD 50' ? 'selected' : '' }} value='YAMAHA-RD 50'>YAMAHA-RD 50 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-DT 50' ? 'selected' : '' }} value='YAMAHA-DT 50'>YAMAHA-DT 50 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-MT-01' ? 'selected' : '' }} value='YAMAHA-MT-01'>YAMAHA-MT-01 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FZ-09' ? 'selected' : '' }} value='YAMAHA-FZ-09'>YAMAHA-FZ-09 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-MT-07' ? 'selected' : '' }} value='YAMAHA-MT-07'>YAMAHA-MT-07 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FZR600' ? 'selected' : '' }} value='YAMAHA-FZR600'>YAMAHA-FZR600 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FZR400' ? 'selected' : '' }} value='YAMAHA-FZR400'>YAMAHA-FZR400 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FZR250' ? 'selected' : '' }} value='YAMAHA-FZR250'>YAMAHA-FZR250 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XS500' ? 'selected' : '' }} value='YAMAHA-XS500'>YAMAHA-XS500 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XS650' ? 'selected' : '' }} value='YAMAHA-XS650'>YAMAHA-XS650 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XS750' ? 'selected' : '' }} value='YAMAHA-XS750'>YAMAHA-XS750 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XS850' ? 'selected' : '' }} value='YAMAHA-XS850'>YAMAHA-XS850 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XS1100' ? 'selected' : '' }} value='YAMAHA-XS1100'>YAMAHA-XS1100 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-SR500' ? 'selected' : '' }} value='YAMAHA-SR500'>YAMAHA-SR500 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-SRX 400' ? 'selected' : '' }} value='YAMAHA-SRX 400'>YAMAHA-SRX 400 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-SRX 600' ? 'selected' : '' }} value='YAMAHA-SRX 600'>YAMAHA-SRX 600 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-V-MAX 1680' ? 'selected' : '' }} value='YAMAHA-V-MAX 1680'>YAMAHA-V-MAX 1680 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-FJR1300' ? 'selected' : '' }} value='YAMAHA-FJR1300'>YAMAHA-FJR1300 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XTZ 750 SUPER TENERE' ? 'selected' : '' }} value='YAMAHA-XTZ 750 SUPER TENERE'>YAMAHA-XTZ 750 SUPER TENERE
                                            </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XT 600' ? 'selected' : '' }} value='YAMAHA-XT 600'>YAMAHA-XT 600 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-VIRAGO 400' ? 'selected' : '' }} value='YAMAHA-VIRAGO 400'>YAMAHA-VIRAGO 400 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-VIRAGO 535' ? 'selected' : '' }} value='YAMAHA-VIRAGO 535'>YAMAHA-VIRAGO 535 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-VIRAGO 750' ? 'selected' : '' }} value='YAMAHA-VIRAGO 750'>YAMAHA-VIRAGO 750 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-VIRAGO 1400' ? 'selected' : '' }} value='YAMAHA-VIRAGO 1400'>YAMAHA-VIRAGO 1400 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XZ 550' ? 'selected' : '' }} value='YAMAHA-XZ 550'>YAMAHA-XZ 550 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZR 500' ? 'selected' : '' }} value='YAMAHA-YZR 500'>YAMAHA-YZR 500 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-WR 450F' ? 'selected' : '' }} value='YAMAHA-WR 450F'>YAMAHA-WR 450F </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TZ 250' ? 'selected' : '' }} value='YAMAHA-TZ 250'>YAMAHA-TZ 250 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZ 125' ? 'selected' : '' }} value='YAMAHA-YZ 125'>YAMAHA-YZ 125 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZ 250' ? 'selected' : '' }} value='YAMAHA-YZ 250'>YAMAHA-YZ 250 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-YZ 450' ? 'selected' : '' }} value='YAMAHA-YZ 450'>YAMAHA-YZ 450 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TX500' ? 'selected' : '' }} value='YAMAHA-TX500'>YAMAHA-TX500 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-XR 180' ? 'selected' : '' }} value='YAMAHA-XR 180'>YAMAHA-XR 180 </option>
                                            <option {{ old('marcaMoto') == 'YAMAHA-TT 125' ? 'selected' : '' }} value='YAMAHA-TT 125'>YAMAHA-TT 125 </option>
                                            <option {{ old('marcaMoto') == 'KAWASAKI-ER-5' ? 'selected' : '' }} value='KAWASAKI-ER-5'>KAWASAKI-ER-5 </option>
                                            <option {{ old('marcaMoto') == 'HARLEY-DAVIDSON-CVO' ? 'selected' : '' }} value='HARLEY-DAVIDSON-CVO'>HARLEY-DAVIDSON-CVO </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-ALPINA' ? 'selected' : '' }} value='BRAVA-ALPINA'>BRAVA-ALPINA </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-APOLO' ? 'selected' : '' }} value='BRAVA-APOLO'>BRAVA-APOLO </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-NEVADA' ? 'selected' : '' }} value='BRAVA-NEVADA'>BRAVA-NEVADA </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-WINSTAR' ? 'selected' : '' }} value='BRAVA-WINSTAR'>BRAVA-WINSTAR </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-ELEKTRA' ? 'selected' : '' }} value='BRAVA-ELEKTRA'>BRAVA-ELEKTRA </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-TEXANA' ? 'selected' : '' }} value='BRAVA-TEXANA'>BRAVA-TEXANA </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-ALTINO' ? 'selected' : '' }} value='BRAVA-ALTINO'>BRAVA-ALTINO </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-AQUILA' ? 'selected' : '' }} value='BRAVA-AQUILA'>BRAVA-AQUILA </option>
                                            <option {{ old('marcaMoto') == 'BRAVA-DAYSTAR ROUTIER' ? 'selected' : '' }} value='BRAVA-DAYSTAR ROUTIER'>BRAVA-DAYSTAR ROUTIER </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="m-1">
                                    <label for="message-text" class="col-form-label"><label style="color: red">*</label>Cor:</label>
                                    <input type="text" class="form-control" id="cor" name="cor" value="{{ old('cor') }}" style="text-transform: uppercase;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button>
                </div>
            </form>

        </div>

    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.6.0.js') }}"></script>

    <?php
    if ($errors->any()) {
        echo '<script> $(document).ready(function() { $("#exampleModal").modal("show"); });</script>';
    }
    ?>

    <script>
        $('#tipo').change(function() {
            var valor = $('#tipo').val();
            if (valor == "moto") {
                $('#moto').show();
                $('#carro').hide();
            } else {
                $('#moto').hide();
                $('#carro').show();
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#tipo").select2({
                dropdownParent: $("#exampleModal")
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#marca").select2({
                dropdownParent: $("#exampleModal")
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#marcaMoto").select2({
                dropdownParent: $("#exampleModal")
            });
        });
    </script>	
