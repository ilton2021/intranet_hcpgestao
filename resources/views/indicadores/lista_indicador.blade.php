@extends('layouts.adm2') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 100px; margin-top: 100px;">
		<div class="col-md-12 text-center">
			<h5 style="font-size: 18px;"><b>LISTA DE INDICADORES: </b></h5>
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
	@endif <br><br><br>
	<div class="row" style="margin-top: -80px;">
		<div class="col-md-12">
			   <iframe width="1300px" height="1000px;" title="W3Schools Free Online Web Tutorials">
			        <!doctype html>
					  <html data-ng-app="weKnow" ng-strict-di>
						  <head>
							  <title ng-bind="getTitle()"></title>
							  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
							  <meta name="mobile-web-app-capable" content="yes">
							  <meta name="apple-mobile-web-app-capable" content="yes">
							  <meta name="apple-mobile-web-app-status-bar-style" content="black">
							    <link rel="apple-touch-icon" id="apple-touch-icon" sizes="180x180">
								<link rel="icon" id="favicon32" type="image/png" sizes="32x32">
								<link rel="icon" id="favicon16" type="image/png" sizes="16x16">
								<link rel="manifest" id="manifest">
								<link rel="mask-icon" id="safari-pinned-tab" color="#5bbad5">
								 <meta name="msapplication-TileColor" content="#ffffff">
								 <meta name="apple-mobile-web-app-title" content="weKnow">
								 <meta name="application-name" content="weKnow">
								 <meta charset="utf-8">
								 <meta http-equiv="X-UA-Compatible" content="IE=edge">
								 <meta name="description" content="">
								  <style>[ng-cloak].splash{display:block!important}.splash{padding-top:100px;display:none!important}.splash-text{margin:auto;text-align:center;font-family:Roboto,Helvetica Neue,sans-serif}.lds-dual-ring{display:block!important;width:50px;height:60px;margin:auto}.lds-dual-ring:after{content:" ";display:block!important;width:30px;height:30px;border-radius:50%;border:6px solid #fff;border-color:#f79633 transparent #fcbf80 transparent;animation:lds-dual-ring 1.1s linear infinite}@keyframes lds-dual-ring{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}</style>
						  </head>
						  <body layout="column" style="min-height:100%">
						   <div class="splash" ng-cloak="">
							 <div class="lds-dual-ring"><div>
						   </div>
						   <div class="splash-text"><img src="/c7bb0e5b696fcec9897a.svg" width="135px"></div>
						    <wk-shell flex="100" layout="column" ng-cloak=""></wk-shell>
							  <script defer="defer" src="/vendors.17ac76b23c83ec92ae73.js"></script>
							  <script defer="defer" src="/app.a61d4d25bcc403a4a6a6.js"></script>
						  </body>
						</html>
			   </iframe>
		</div>
	</div> 
</div>
</div>
</div>
</body>