<!-- Default box -->
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
  <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>
              <h3 class="box-title">Detalles del prestamo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <b>Cliente:</b> <a href="<?php echo base_url('admin/prestamo/cliente/'.$prestamo['id_cliente']); ?>"><?php echo $prestamo['nombre'].' '.$prestamo['apellido'] ?></a><br/>
                <b>Monto prestado:</b> <?php echo $prestamo['monto'] ?>$<br/>
                <b>Porcentaje:</b> <?php echo $prestamo['porcentaje'] ?>%<br/>
                <b>Monto total:</b> <?php echo $prestamo['monto_total'] ?>$<br/>
                <b>Ciclo de pago:</b> <?php echo $prestamo['ciclo_pago'] ?><br/>
                <b>Cantidad de cuotas:</b> <?php echo $prestamo['cant_cuotas'] ?><br/>
                <b>Cuotas a pagar:</b> <?php echo ((int)$prestamo['monto_total'])/((int)$prestamo['cant_cuotas']); ?>$
            </div>
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>
              <h3 class="box-title">Detalles de la cuota a pagar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <b>Fecha de pago:</b> <?php echo $cuota['fecha_pago'] ?>$<br/>
                <b>Monto total:</b> <?php echo $cuota['monto_total'] ?>$<br/>
                <b>Monto pagado:</b> <?php echo $cuota['monto_pagado'] ?><br/>
                <b>Estado:</b> <?php echo $cuota['estado'] ?><br/>
              </div>
      </div>
  <div class="box-body validate-form">
    <?php echo form_open_multipart($action);?>
    <input type="hidden" name="id_cuota" value="<?php echo element('id', $cuota, ''); ?>">
    <input type="hidden" name="id_prestamo" value="<?php echo element('id_prestamo', $cuota, ''); ?>">
    <input type="hidden" name="numero_cuota" value="<?php echo element('numero_cuota', $cuota, ''); ?>">
    <div class="box-body">
      <div class="form-group">
        <label for="monto">Monto a pagar:</label>
        <input maxlength="20" class="form-control" id="monto"  type="number" name="monto" value="<?php echo element('monto_pagado', $cuota, ''); ?>" min="1"  required="required">
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <a href="<?php echo base_url('admin/prestamos/'); ?>" type="submit" class="btn btn-default">Cancel</a>
      <button type="submit" class="btn btn-info pull-right">Enviar</button>
    </div>
  </form>
</div>
<!-- /.box-footer-->
</div>
<!-- /.box -->