<br>
<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
       {{Form::open(array('url'=>'agregar','method'=>'post','class'=>'form-horizontal'))}} 
            <div class="form-group">
                <label class="col-sm-2 control-label">Nick de Usuario:</label>
                <div class="col-sm-10">
                  <input  type="text" class="form-control" name="username" placeholder="Ejemplo: fulanito_2">
                  <span class="help-block">{{$errors->first('username')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nivel del Usuario:</label>
                <div class="col-sm-10">
                    <input list="oficio" class="form-control" placeholder="2 => Maestranza; 3 => Proyectos; 4 => Cardex" name="level">
                    <datalist id="oficio" class="panel-default">
                        <option value="2">Manejo de inventario Maestranza</option>
                        <option value="3">
                        <option value="4">
                    </datalist>
                    <span class="help-block">{{$errors->first('level')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombres del Usuario:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Cristian Gabriel" name="names">
                    <span class="help-block">{{$errors->first('names')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos del Usuario:</label>
                <div class="col-sm-10">
                  <input  type="text" class="form-control" placeholder="Martinez Torrez" name="last_name">
                  <span class="help-block">{{$errors->first('last_name')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Numero de CI:</label>
                <div class="col-sm-10">
                  <input  type="text" class="form-control" placeholder="8632085 pt." name="ci_num">
                  <span class="help-block">{{$errors->first('ci_num')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Correo Electronico:</label>
                <div class="col-sm-10">
                  <input  type="email" class="form-control" placeholder="Ejemplo@gmail.com" name="correo">
                  <span class="help-block">{{$errors->first('correo')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Telefono:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="62466635 o 72375140" name="telephone">
                    <span class="help-block">{{$errors->first('telephone')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Direccion:</label>
                <div class="col-sm-10">
                  <input  type="text" class="form-control" placeholder="Av. Ejemplo1 / Calle fortunato gumiel" name="adress">
                  <span class="help-block">{{$errors->first('adress')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Contraseña:</label>
                <div class="col-sm-10">
                  <input  type="text" class="form-control" placeholder="12345" name="password">
                  <span class="help-block">{{$errors->first('password')}}</span>
                </div>
            </div>
            <div class="well">
                <button type="submit" id="btnagregar" class="btn btn-default btn-lg btn-block" target="_blank">
                    Agregar
                </button> 
            </div>
        {{Form::close()}}
    </div>
</div>