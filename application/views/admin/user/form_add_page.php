<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Formulario</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
      <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
      <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body validate-form">
    <?php echo form_open_multipart($action);?>
    <input type="hidden" name="id" value="<?php echo element('id', $user, ''); ?>">
    <div class="box-body">
      <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
        <input id="email" type="email" data-segment-url="/admin/fn_ajax_check_value/" data-value="<?php echo element('email', $user, ''); ?>" data-action-param='{"table":"user", "field":"email"}' class="fn_checkvalue validate form-control"  name="email" value="<?php echo element('email', $user, ''); ?>" required="required" maxlength="255">
        </div>
      </div>
      <div class="form-group">
        <label for="username" data-error="En uso">Usuario</label>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
          <input data-segment-url="/admin/fn_ajax_check_value/" data-value="<?php echo element('username', $user, ''); ?>" data-action-param='{"table":"user", "field":"username"}' class="fn_checkvalue validate form-control" maxlength="25" type="text" id="username" name="username" value="<?php echo element('username', $user, ''); ?>" required="required"></div>  
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input maxlength="25"   class="form-control" id="password"  name="password" value="" required="required" type="password">
     </div>      
      <div class="form-group">
        <label for="usergroup">Tipo de usuario:</label>
        <select name="usergroup" id="usergroup" class="form-control">
          <?php foreach ($usergroups as $key => $value): ?>
          <option value="<?php echo $value['id'] ?>" <?php if ($value['id'] === element('id_user_group', $user, '')): ?>
            selected
          <?php endif ?>><?php echo $value['name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input maxlength="20" class="form-control" id="nombre"  type="text" name="nombre" value="<?php echo element('nombre', $user, ''); ?>"  required="required">
      </div>
      <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input maxlength="20"  class="form-control" type="text"  id="apellido"  name="apellido" value="<?php echo element('apellido', $user, ''); ?>" required="required">
      </div>
      <div class="form-group">
        <label for="direccion">Direccion:</label>
        <input maxlength="200" class="form-control" type="text"   id="direccion"  name="direccion" value="<?php echo element('direccion', $user, ''); ?>" required="required">
      </div>
      <div class="form-group">
        <label for="dni">DNI:</label>
        <input maxlength="200" data-segment-url="/admin/fn_ajax_check_value/" data-value="<?php echo element('identificacion', $user, ''); ?>" data-action-param='{"table":"user_data", "field":"_value"}' class="fn_checkvalue validate form-control" type="text"   id="identificacion"  name="identificacion" value="<?php echo element('identificacion', $user, ''); ?>" required="required">
      </div>
      <div class="form-group">
        <label for="telefono">Telefono:</label>
        <input maxlength="50"  class="form-control" type="text"  id="telefono" name="telefono" value="<?php echo element('telefono', $user, ''); ?>" required="required">
      </div>
    </div>
    <div class="box-footer">
      <a href="<?php echo base_url('admin/user/'); ?>" type="submit" class="btn btn-default">Cancel</a>
      <button type="submit" class="btn btn-info pull-right">Enviar</button>
    </div>
  </form>
</div>
</div>