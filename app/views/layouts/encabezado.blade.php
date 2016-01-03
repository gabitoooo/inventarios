<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('layouts/date')
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a class="dropdown-toggle" href="">
                    <i class="fa fa-money fa-fw"></i>Cotizacion de UFV 2.1451  
                </a>
            </li>
            @if(Session::get('nivel')==null)
            <li>
                <a class="dropdown-toggle" href="{{URL::to('/')}}">
                    <i class="fa fa-home fa-fw"></i>Pag. Inicio
                </a>
            </li>
            @endif
            @if(Session::get('nivel')==1)
            <li>
                <a class="dropdown-toggle" href="{{URL::to('admi')}}">
                    <i class="fa fa-list-alt fa-fw"></i>Aministracion
                </a>
            </li>
            @endif
            @if(Session::get('nivel')==3)
            <li>
                <a class="dropdown-toggle" href="{{URL::to('cardex')}}">
                    <i class="fa fa-folder-open fa-fw"></i>Cardex
                </a>
            </li>
            @endif
            @if(Session::get('nivel')==2)
            <li>
                <a class="dropdown-toggle" href="{{URL::to('encargado')}}">
                    <i class="fa fa-list-alt fa-fw"></i>Inventarios
                </a>
            </li>
            @endif
            @if(Session::get('nivel')==4)
            <li>
                <a class="dropdown-toggle" href="{{URL::to('encargado')}}">
                    <i class="fa fa-book fa-fw"></i>Proyectos
                </a>
            </li>
            @endif
            @if(Session::get('nivel')!=null)
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> {{Session::get('username')}} <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="perfil"><i class="fa fa-user fa-fw"></i>Ver mi Perfil </a>
                    </li>
                    <li><a href="cambiar"><i class="fa fa-gear fa-fw"></i>Cambiar contraseña</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{URL::to('cerrar')}}"><i class="fa fa-sign-out fa-fw"></i>Cerrar Sesion</a>
                    </li>
                </ul>
            </li>
            @endif
        </ul> 
    </nav>
</div>
