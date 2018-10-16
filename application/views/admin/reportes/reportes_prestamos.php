<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Aplicar Filtros</h3>
		<hr>
		<form action="<?php echo base_url('admin/reportes'); ?>" method="GET">
		<div class="form-group pull-left">
			<label for="fecha_seleccionada">Rango de fecha
				<select class="form-control" name="fecha_seleccionada" id="fecha_seleccionada">
					<option value="Todas">Todos</option>
					<option value="hoy">Prestamos de hoy</option>
					<option value="hoy">Prestamos de ayer</option>
					<option value="semana">Prestamos de la semana</option>
					<option value="mes">Prestamos del mes</option>
				</select>
			</label>
			</div>
			<div class="form-group pull-left">
			<label for="fecha_seleccionada">Cobrador
				<select class="form-control" name="fecha_seleccionada" id="fecha_seleccionada">
					<option value="Todas">Todos</option>
					<?php
						if($cobradores):
						foreach($cobradores as $key => $cobrador ):
					?>
						<option value="hoy"><?php echo $cobrador['username'] ?></option>
					<?php
						endforeach;
						endif;
					?>
				</select>
			</label>
			</div>
			<hr class="clearfix">
			<button type="submit" class="btn btn-primary pull-right">Aplicar</button>
		</form>
	</div>
	<!-- /.box-footer-->
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Todos los prestamos registrados</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<?php if ($prestamos): ?>
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
						<?php foreach ($prestamos[0] as $key => $prestamo): ?>
						<th><?php echo ($key) ?></th>
						<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($prestamos as $key => $prestamo): ?>
						<tr>
							<?php foreach ($prestamo as $clave => $valor): ?>
							<th><?php echo $prestamo[$clave] ?></th>
							<?php endforeach ?>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<br><br>
				<hr>
				<button class="btn btn-primary" onclick="print();">Imprimir</button>
				<?php else: ?>
				No hay prestamos registrados
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
