@extends('layouts.app')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<body>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Portal de Assinaturas de Nota Fiscal</h2>
        <div class="d-inline-flex">
        <div class="">
            <img class="card-img-top" src="{{asset('img')}}/{{('portal_ass.jpeg')}}" style="width: 120px;" alt="Card image cap">
        </div>
		  </div>
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Portal de Assinaturas - Detalhes</li>
          </ol>
        </div>
        
      </div>
    </section>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-6">
         <div>

         <div class="d-inline-flex justify-content-between flex-wrap">
          <div class="card border-0 m-2" style="width: 14rem;outline:none;">
          <a href="http://10.0.0.107:8080/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-hmr.png')}}" style="width:150px" alt="Card image cap">
          </a>
           <center>
             <div class="card-body">
               <h5 class="card-title">HMR</h5>
             </div>
           </center>
          </div>
			
          <div class="card border-0 m-2" style="width: 14rem;outline:none;">
          <a href="http://10.3.0.22:8088/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-hss.png')}}" style="width:150px" alt="Card image cap">
          </a>
           <center>
             <div class="card-body">
               <h5 class="card-title" style="margin-left: 15px">HSS</h5>
             </div>
           </center>
          </div>
			
          <div class="card border-0 m-2" style="width: 14rem;outline:none;">
           <a href="http://10.1.0.76:8088/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-ARRUDA.png')}}" style="width:150px" alt="Card image cap">
           </a>
           <center>   
             <div class="card-body">
               <h5 class="card-title" style="margin-left: 10px">UPAE ARRUDA</h5>
             </div>
           </center>
          </div>

          <div class="card border-0 m-2" style="width: 14rem;outline:none;">
          <a href="http://192.168.0.2:8080/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-BJ.png')}}" style="width:150px" alt="Card image cap">
          </a>
           <center> 
             <div class="card-body">
               <h5 class="card-title" style="margin-left: -10px">UPAE BELO JARDIM</h5>
             </div>
           </center>
          </div>

          <div class="card border-0 m-3" style="width: 14rem;outline:none;">
          <a href="http://192.168.1.96:8080/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-ARCO.png')}}" style="width:150px" alt="Card image cap">
          </a>
           <center>   
             <div class="card-body">
               <h5 class="card-title" style="margin-left: 5px">UPAE ARCOVERDE</h5>
             </div>
           </center>
          </div>

          <div class="card border-0 m-3" style="width: 14rem;outline:none;">
          <a href="http://192.168.12.22:8080/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-caruaru-upae.png')}}" style="width:150px" alt="Card image cap">
          </a>
           <center> 
            <div class="card-body">
               <h5 class="card-title" style="margin-left: 10px">UPAE CARUARU</h5>
             </div>
           </center>
          </div>

          <div class="card border-0 m-3" style="width: 14rem;outline:none;">
          <a href="http://11.2.0.22:8088/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo_igarassu.png')}}" style="width:150px" alt="Card image cap">
          </a>
           <center>
             <div class="card-body">
               <h5 class="card-title" style="margin-left: 20px">UPA IGARASSU</h5>
             </div>
           </center>
          </div>
          
          <div class="card border-0 m-3" style="width: 14rem;outline:none;">
           <a href="http://10.10.0.15:8088/assinaturas/public/" target="_blank">
            <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-PALMARES.png')}}" style="width:150px" alt="Card image cap">
           </a>
             <div class="card-body">
               <h5 class="card-title">UPAE PALMARES
             </div>
          </div>

			</div>
     </div>
    </div>
   </div>
  </section>
 </main>
</body>
</html>
