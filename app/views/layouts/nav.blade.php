<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
        @if(Session::get('nivel')==null)
            <li>
                <a href="#"><i class="fa fa-bullhorn fa-fw"></i>Historial de Noticias</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-camera-retro fa-fw"></i>Galerias de Imagenes</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user-md fa-fw"></i>Quienes somos</a>
            </li>
        @endif
        @if(Session::get('nivel')==1)
            <li>
                <a href="{{URL::to('encargado/index')}}"><i class="fa fa-home fa-fw"></i> Inicio</a>
            </li>
            <li>
                <a href="{{URL::to('encargado/inventario')}}"><i class="fa fa-truck fa-fw"></i> Manejo de productos</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-money fa-fw"></i> Actualizar UFV</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Cuentas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Cuenta1</a>
                    </li>
                    <li>
                        <a href="#">Cuenta2</a>
                    </li>
                    <li>
                        <a href="#" >Cuenta3</a>
                    </li>
                    <li>
                        <a href="#" >Crear Cuenta</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="chat-panel panel panel-default">
                    <div class="panel-body">
                        <ul class="chat">
                            <li>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Viky fulanito</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 12:15 
                                        </small>
                                    </div>
                                    <p>
                                        hola compañeros como estan :D.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Carlos Mengano</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 12:16
                                        </small>
                                    </div>
                                    <p>
                                        hola hola que hay de nueno viejos.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Mylo llanque</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 12:18
                                        </small>
                                    </div>
                                    <p>
                                        hola como es un dotita?????
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>       
            </li>
        @endif
        @if(Session::get('nivel')==2)
        @endif
        </ul>
    </div>
</div>