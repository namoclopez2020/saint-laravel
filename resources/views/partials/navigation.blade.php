@auth
<nav class="side-navbar navbar-light">
    <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <!-- User Info-->
        <div class="sidenav-header-inner text-center"><a href="pages-profile.html"><img src="/assets/img/logo_login.png" alt="person" class="img-fluid rounded-circle"></a>
        <h2 class="h5">{{ auth()->user()->name}}</h2><span>{{ auth()->user()->user_level->name}}</span>
        </div>
        <!-- Small Brand information, appears on minimized sidebar-->
        <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
      </div>
      <!-- Sidebar Navigation Menus-->
      <div class="main-menu">
        <h5 class="sidenav-heading">Principal</h5>
        <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="{{ route('home')}}"> <i class="icon-home"></i>Home                             </a></li>
          
          @if (level_rol(auth()->user()->role))
            <li>
              <a href="#formsDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-cog"></i>Ajustes</a>
              <ul id="formsDropdown" class="collapse list-unstyled ">     
                <li><a href="{{ route ('office.index') }}">Sucursales</a></li>
                <li><a href="{{ route('warehouse.index') }}">Almacenes</a></li>
                <li><a href="{{route('provider.index')}}">Proveedores</a></li>
                <li><a href="{{ route ('user.index') }}">Usuarios</a></li>
              </ul>
            </li>
            <li>
              <a href="#clientDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>Clientes</a>
              <ul id="clientDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route ('client.index') }}">Registro de clientes</a></li>
              </ul>
            </li>
            <li>
              <a href="#chartsDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Categorias</a>
              <ul id="chartsDropdown" class="collapse list-unstyled ">
              <li><a href="{{ route('categorie.index')}}">Categorias</a></li>
              </ul>
            </li>
            <li>
              <a href="#tablesDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Inventario </a>
              <ul id="tablesDropdown" class="collapse list-unstyled ">
                <li><a href="{{route('product.create')}}">Agregar producto</a></li>
                <li><a href="{{route('product.index')}}">Lista de productos</a></li>
              </ul>
            </li>
            <li>
              <a href="#componentsDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-page"></i>Compras </a>
              <ul id="componentsDropdown" class="collapse list-unstyled ">
                <li><a href=" {{route('buy.create')}} ">Nueva compra</a></li>
                <li><a href=" {{route('buy.index')}} ">Registro de Compras</a></li>
                <li><a href=" {{route('buy.cuentas')}} ">Cuentas por pagar</a></li>
              </ul>
            </li> 
          @endif
          
          <li><a href="#ventasDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cart-plus"></i>Ventas </a>
            <ul id="ventasDropdown" class="collapse list-unstyled ">
              <li><a href="nueva_venta.php">Nueva venta</a></li>
              <li><a href="ventas.php">Registro de Ventas</a></li>
              <li><a href="cuentas_por_cobrar.php">Cuentas por cobrar</a></li>
            </ul>
          </li>
         
        <!--  <li> <a href="#"> <i class="icon-mail"></i>Demo
              <div class="badge badge-warning">6 New</div></a></li>-->
        </ul>
      </div>
      <div class="admin-menu">
        <h5 class="sidenav-heading">Configuración</h5>
        <ul id="side-admin-menu" class="side-menu list-unstyled"> 
          <li> <a href="{{ route('select.index') }}"> <i class="icon-screen"> </i>Cambiar Sucursal</a></li>
          @if (level_rol(auth()->user()->role))
          <li> <a href="{{route('general.index')}}"> <i class="icon-screen"> </i>Datos Generales</a></li>  
          @endif
         
         
        <!--  <li> <a href="#"> <i class="icon-flask"> </i>Demo
              <div class="badge badge-info">Special</div></a></li>
          <li> <a href=""> <i class="icon-flask"> </i>Demo</a></li>
          <li> <a href=""> <i class="icon-picture"> </i>Demo</a></li>-->
        </ul>
      </div>
    </div>
  </nav>
  @endauth