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
		<?= form_open_multipart($action);?>
		<div class="box-body">
			<?php if ($id_cliente): ?>
			<input type="hidden" name="id_cliente" value="<?= element('id', $cliente, ''); ?>">
			<?php else: ?>
			<div class="form-group">
				<label for="id_cliente">Cliente:</label>
				<select name="id_cliente" id="id_cliente" class="form-control">
					<?php foreach ($clientes as $key => $cliente): ?>
					<option value="<?= $cliente['id'] ?>">
						<?= ucwords($cliente['nombre'].' '.$cliente['apellido']) ?>
					</option>
					<?php endforeach ?>
					<option value="Nuevo">Nuevo</option>
				</select>
			</div>
			<?php endif ?>
			<div class="form-group">
				<label for="monto">Monto:</label>
				<input maxlength="20" class="form-control" id="monto" type="number" name="monto" value="<?php echo element('monto', $prestamo, ''); ?>"
				 min="0" required="required">
			</div>
			<div class="form-group">
				<label for="porcentaje">Porcentaje:</label>
				<input maxlength="20" class="form-control" id="porcentaje" type="text" name="porcentaje" value="<?php echo element('porcentaje', $prestamo, ''); ?>"
				 min="0" max="100" required="required">
			</div>
			<div class="form-group">
				<label for="ciclo_pago">Ciclo de pago:</label>
				<select name="ciclo_pago" id="ciclo_pago" class="form-control">
					<option value="Diario">Diario</option>
					<option value="Semanal">Semanal</option>
					<option value="Quincenal">Quincenal</option>
					<option value="Mensual">Mensual</option>
					<option value="Bimensual">Bimensual</option>
					<option value="Trimestral">Trimestral</option>
					<option value="Semestral">Semestral</option>
					<option value="Anual">Anual</option>
					<option value="Bianual">Bianual</option>
				</select>
			</div>
			<div class="form-group">
				<label for="cant_cuotas">Cantidad de cuotas:</label>
				<input maxlength="200" class="form-control" type="number" id="cant_cuotas" name="cant_cuotas" value="<?php echo element('cant_cuotas', $prestamo, ''); ?>"
				 required="required">
			</div>
      </div>
       <div class="form-group">
          <label for="datepicker">Fecha de primera cuota:</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" name="fecha_inicio" id="datepicker">
          </div>
          <!-- /.input group -->
		</div>
		<div class="box-footer">
			<a href="<?= base_url('admin/prestamos/'); ?>" type="submit" class="btn btn-danger"><i class="fa fa-fw fa-close"></i> Cancel</a>
			<button type="submit" class="btn btn-success pull-right"><i class="fa fa-fw fa-save"></i> Guardar</button>
		</div>
		</form>
	</div>
</div>