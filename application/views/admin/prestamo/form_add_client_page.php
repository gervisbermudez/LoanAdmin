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
    <input type="hidden" name="id" value="<?php echo element('id', $cliente, ''); ?>">
    <div class="box-body">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input maxlength="20" class="form-control" id="nombre"  type="text" name="nombre" value="<?php echo element('nombre', $cliente, ''); ?>"  required="required">
      </div>
      <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input maxlength="20" class="form-control" id="apellido"  type="text" name="apellido" value="<?php echo element('apellido', $cliente, ''); ?>"  required="required">
      </div>
      <div class="form-group">
        <label for="identificacion">DNI:</label>
        <input maxlength="20"  data-segment-url="/admin/fn_ajax_check_value/" data-value="<?php echo element('identificacion', $cliente, ''); ?>" data-action-param='{"table":"prestamos_clientes", "field":"identificacion"}' class="fn_checkvalue validate form-control" type="text"  id="identificacion"  name="identificacion" value="<?php echo element('identificacion', $cliente, ''); ?>" required="required">
      </div>
      <div class="form-group">
        <label for="direccion">Direccion:</label>
        <input maxlength="200" class="form-control" type="text"   id="direccion"  name="direccion" value="<?php echo element('direccion', $cliente, ''); ?>" required="required">
      </div>
      <div class="form-group">
        <label for="telefono">Telefono:</label>
        <input maxlength="50"  class="form-control" type="text"  id="telefono" name="telefono" value="<?php echo element('telefono', $cliente, ''); ?>" required="required">
      </div>
    </div>
    <div class="box-footer">
      <a href="<?php echo base_url('admin/prestamo/'); ?>" type="submit" class="btn btn-danger"><i class="fa fa-fw fa-close"></i> Cancel</a>
      <button type="submit" class="btn btn-success pull-right"><i class="fa fa-fw fa-save"></i> Guardar</button>
    </div>
  </form>
</div>
</div>