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
					<option value="ayer">Prestamos de ayer</option>
				</select>
			</label>
			</div>
			<div class="form-group pull-left">
			<label for="user_selected">Cobrador
				<select class="form-control" name="user_selected" id="user_selected">
					<option value="Todos">Todos</option>
					<?php
						if($cobradores):
						foreach($cobradores as $key => $cobrador ):
					?>
						<option value="<?php echo $cobrador['id'] ?>"><?php echo $cobrador['username'] ?></option>
					<?php
						endforeach;
						endif;
					?>
				</select>
			</label>
			</div>
			<div class="form-group pull-left">
			<label for="client_selected">Cliente
				<select class="form-control" name="client_selected" id="client_selected">
					<option value="Todos">Todos</option>
					<?php
						if($clientes):
						foreach($clientes as $key => $cliente ):
					?>
						<option value="<?php echo $cliente['id'] ?>"><?php echo ucwords($cliente['nombre'].' '.$cliente['apellido']) ?></option>
					<?php
						endforeach;
						endif;
					?>
				</select>
			</label>
			</div>
			<div class="clearfix-left"></div>
			<div class="form-group">
                <label>Date range:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" value="<?php echo $date_range; ?>" name="date_range" id="date_range">
                </div>
                <!-- /.input group -->
              </div>
			<hr class="clearfix-left">
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
						<th><?php echo ucfirst($key) ?></th>
						<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<?php 
							$suma_monto = 0;
							$suma_monto_pagado = 0;
							$suma_monto_subtotal = 0;
							$suma_monto_total = 0;
						foreach ($prestamos as $key => $prestamo): ?>
						<tr>
							<?php foreach ($prestamo as $clave => $valor): ?>
							<td><?php echo $prestamo[$clave] ?></td>
							<?php endforeach ?>
						</tr>
						<?php 
							$suma_monto += $prestamo['monto'];
							$suma_monto_pagado += $prestamo['monto_pagado'];
							$suma_monto_subtotal += $prestamo['subtotal'];
							$suma_monto_total += $prestamo['monto_total'];
						endforeach ?>
					</tbody>
					<tfoot>
						<th>TOTAL</th>
						<th></th>
						<th><?php echo number_format ($suma_monto, 2, ',', '.'); ?> $</th>
						<th><?php echo number_format ($suma_monto_pagado, 2, ',', '.'); ?> $</th>
						<th></th>
						<th></th>
						<th><?php echo number_format ($suma_monto_subtotal, 2, ',', '.'); ?> $</th>
						<th><?php echo number_format ($suma_monto_total, 2, ',', '.'); ?> $</th>
					</tfoot>
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
