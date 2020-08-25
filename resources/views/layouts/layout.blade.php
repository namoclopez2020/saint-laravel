<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href=" {{asset('/assets/vendor/bootstrap/css/bootstrap.min.css')}} ">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/font-awesome/css/font-awesome.min.css') }} ">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href=" {{asset('/assets/css/fontastic.css')}} ">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- Bootstrap Select CSS-->
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap-select/css/bootstrap-select.min.css')}}">
    <!-- Bootstrap Touchspin CSS-->
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
    <!-- Bootstrap Datepicker CSS-->
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}">
    <!-- Bootstrap Tags input CSS-->
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <!-- No UI Slider-->
    <link rel="stylesheet" href="{{asset('/assets/vendor/nouislider/nouislider.css')}}">
 
    <!-- DataTables CSS
    <link rel="stylesheet" href="/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/assets/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">-->

    <!-- datatables responsive-->
    <link rel="stylesheet" href="https://cdn.datatables.net/r/dt/dt-1.10.9,r-1.0.7/datatables.min.css">
     <!--estilos de autocompletado -->
    
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="/assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/assets/css/style.default.premium.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/assets/css/custom.css">
    <!-- Favicon-->
    {{-- <link rel="shortcut icon" href="img/favicon.ico"> --}}
    
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
   
    @include('partials.navigation')

    @auth
      <div class="page">

      @include('partials.nav_page')
    @endauth
    

      @yield('content')

     @auth
        </div> 
     @endauth
    

    
  
  <!-- JavaScript files-->
  
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="/assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/assets/vendor/chart.js/Chart.min.js"></script>
    <script src="/assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    
       <!--librerias de autocomplete -->

    <script src="/assets/vendor/ui-autocomplete/js/jquery-ui.min.js"></script>
        
    <!-- Bootstrap Select-->
    <script src="/assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap Touchspin-->
    <script src="/assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Bootstrap No UI Slider-->
    <script src="/assets/vendor/nouislider/nouislider.min.js"></script>
    <!-- Bootstrap DatePicker-->
    <script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap Tags Input-->
    <script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <!-- Jasny Bootstrap - Input Masks-->
    <script src="/assets/vendor/jasny-bootstrap/js/jasny-bootstrap.min.js"> </script>
    <!-- MultiSelect-->
    <script src="/assets/vendor/multiselect/js/jquery.multi-select.js"> </script>
    <!-- Forms init-->
    <script src="/assets/js/forms-advanced.js"></script>
      <!-- Notifications -->
      <script src="/assets/vendor/messenger-hubspot/build/js/messenger.min.js">   </script>
    <script src="/assets/vendor/messenger-hubspot/build/js/messenger-theme-flat.js">       </script>
    <!--<script src="/assets/js/home-premium.js"> </script>-->
    
     <!-- Data Tables-->
   <!--  <script src="/assets/vendor/datatables.net/js/jquery.dataTables.js"></script>
    <script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    -->
  <!-- quicksearch-->
   <script src="/assets/vendor/quicksearch/jquery.quicksearch.js"></script>
    <!--datatables probar -->
    <script src="/assets/vendor/datatable-responsive-input/datatables.min.js"></script>
    <script src="/assets/js/tables-datatable.js"></script>
  
    <!--sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

   
    <!-- Main File-->
    <script src="{{ asset('/assets/js/front.js') }}"></script>

   
   	<script>
     function display_msg(mensaje,tipo){
      $(function () {

Messenger.options = {
    extraClasses: 'messenger-fixed messenger-on-top  messenger-on-right',
    theme: 'flat',
    messageDefaults: {
        showCloseButton: true
    }
}
Messenger().post({
            message: mensaje,
            type: tipo
        });

});
     }
     
     </script>

     <script>
     // de prueba para scripts
  
 
    
     </script>
    @include('partials.message')
    @yield('scripts')
  </body>
</html>