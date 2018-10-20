<?php
$this->load->helper('string');
$modalid = random_string('alnum', 16);
?>
<?php 
  $badge = 'bg-red';
  $progreso = $prestamo['progreso'];
  if ($progreso > 50 && $progreso < 80) {
    $badge = 'bg-yellow';
  }
  if ($progreso > 80) {
    $badge = 'bg-light-blue';
  }
  if ($progreso == 100) {
    $badge = 'bg-green';
  }
?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Herramientas</h3>
    <hr>
    <a role="menuitem" class="btn btn-success" tabindex="-1" href="<?php echo base_url('admin/prestamo/prestamo/editar/' . $prestamo['id']); ?>">Editar</a>
  </div>
<!-- /.box-footer-->
</div>
<div class="box box-widget widget-user-2">
  <div class="widget-user-header <?php echo $badge; ?>">
    <!-- /.widget-user-image -->
    <h3 class="widget-user-username">Detalles del prestamo</h3>
    <h5 class="widget-user-desc"><?php echo $prestamo['progreso']; ?>% Pagado</h5>
  </div>
  <div class="box-footer no-padding">
      <ul class="nav nav-stacked">
      <li><a href="<?php echo base_url('admin/prestamo/cliente/' . $prestamo['id_cliente']); ?>"><b>Cliente:</b> <?php echo ucwords($prestamo['nombre'] . ' ' . $prestamo['apellido']) ?><br/></a></li>
      <li><a href="#!"><b>Monto prestado:</b> <?php echo number_format($prestamo['monto'], 2, ',', '.'); ?> $<br/></a></li>
      <li><a href="#!"><b>Porcentaje:</b> <?php echo $prestamo['porcentaje'] ?>%<br/></a></li>
      <li><a href="#!"><b>Monto total:</b> <?php echo number_format($prestamo['monto_total'], 2, ',', '.'); ?> $<br/></a></li>
      <li><a href="#!"><b>Ciclo de pago:</b> <?php echo $prestamo['ciclo_pago'] ?><br/></a></li>
      <li><a href="#!"><b>Cantidad de cuotas:</b> <?php echo $prestamo['cant_cuotas']; ?><br/></a></li>
      <li><a href="#!"><b>Cuota a pagar:</b> <?php echo number_format(((int)$prestamo['monto_total']) / ((int)$prestamo['cant_cuotas']), 2, ',', '.'); ?> $</a></li>
    </ul>
  </div>
</div>
<?php if ($prestamo['progreso'] < 100) : ?>
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Registrar un pago</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body validate-form">
		<?php echo form_open_multipart($action); ?>
		<input type="hidden" name="id_prestamo" value="<?php echo $prestamo['id']; ?>">
		<div class="box-body">
			<div class="form-group">
				<label for="monto">Monto a pagar:</label>
				<input maxlength="20" class="form-control" id="monto" type="number" name="monto" value="" min="1" required="required">
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-info pull-right">Registrar</button>
		</div>
		</form>
	</div>
</div>
<?php endif ?>
<div class="row">
        <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-fw fa-bars"></i> Detallado</a></li>
              <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-fw fa-calendar"></i> Calendario</a></li>
              <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-fw fa-bar-chart"></i> Gráfico</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Opciones <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <?php if ($this->session->userdata('user')['level'] < 2) : ?>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('admin/prestamo/prestamo/editar/' . $prestamo['id']); ?>">Editar</a></li>
                  <li role="presentation"><a role="menuitem" data-toggle="modal" data-target="<?php echo '#' . $modalid ?>" tabindex="-1" href="#!" data-table-reference="loans" data-value-id="<?php echo $prestamo['id']; ?>" data-target="" data-delete-redirect="true" data-delete-redirectto="admin/prestamo/cliente/<?= $prestamo['id_cliente'] ?>" class="delete-data">Eliminar</a></li>
                  <?php endif ?>
                </ul>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <h3 class="box-title">Todas las cuotas del prestamo realizado</h3>
              <?php if ($cuotas) : ?>
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha de pago</th>
                  <th>Monto a pagar</th>
                  <th>Monto pagado</th>
                  <th class="hidden-xs">Fecha pagado</th>
                  <th class="hidden-xs">Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $monto_total_pagado = 0;
                ?>
                 <?php foreach ($cuotas as $key => $cuota) : ?>
                 <?php 
                $badge = 'label-danger';
                if ($cuota['estado'] === 'Proximo') {
                  $badge = 'label-warning';
                }
                if ($cuota['estado'] === 'Pendiente') {
                  $badge = 'label-primary';
                }
                if ($cuota['estado'] === 'Pagado') {
                  $badge = 'label-success';
                }
                ?>
                <tr>
                     <td><?php echo $cuota['fecha_pago'] ?></td>
                     <td><?php echo number_format($cuota['monto_total'], 2, ',', '.'); ?> $</td>
                     <td><?php echo number_format($cuota['monto_pagado'], 2, ',', '.'); ?> $</td>
                     <td class="hidden-xs"><?php echo $cuota['fecha_pagado'] ?></td>
                     <td class="hidden-xs"><span class="label <?php echo $badge ?>"><?php echo $cuota['estado'] ?></span></td>
                   </tr>
                <?php
                $monto_total_pagado = $cuota['monto_pagado'] + $monto_total_pagado;
                ?>
                 <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Fecha de pago</th>
                  <th>Monto a pagar</th>
                  <th>Monto pagado</th>
                  <th class="hidden-xs">Fecha pagado</th>
                  <th class="hidden-xs">Estado</th>
                </tr>
                </tfoot>
              </table>

              <?php else : ?>
              No hay cuotas para este prestamo
              <?php endif ?>
              <b>Monto total pagado hasta el momento: </b> <?php echo number_format($monto_total_pagado, 2, ',', '.'); ?> $
              <br>
              <b>Deuda total hasta el momento: </b>
					    <?php echo number_format($prestamo['monto_total'] - $monto_total_pagado, 2, ',', '.'); ?> $
            </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div id="calendar"></div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
    </div>
</div>

<div class="row" id="dues_chart"> 
<div class="col-sm-12">
  <div class="chart" id="revenue-chart" style="position: relative; height: 300px;"></div>
</div>
</div>
                
<div class="modal fade" id="<?php echo $modalid; ?>" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Eliminar Prestamo</h4>
      </div>
      <div class="modal-body">
        <p>Esta accion eliminará el Prestamo y todos los datos relacionados con éste</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-delete-data="run" data-dismiss="modal">Continuar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  var calendarEvents = [
    <?php foreach ($cuotas as $key => $cuota) : ?>
      <?php 
      $fecha_pago = DateTime::createFromFormat('Y-m-d', $cuota['fecha_pago']);
      $Eventcolor = '#0073b7'; // Pendiente Azul
      if ($cuota['estado'] == 'Proximo') {
        $Eventcolor = '#f39c12'; // Amarillo
      }
      if ($cuota['estado'] == 'Caida') {
        $Eventcolor = '#f56954'; // Rojo
      }
      if ($cuota['estado'] == 'Pagado') {
        $Eventcolor = '#00a65a'; // Verde
      }
      ?>
      {
        title          : 'Cuota de <?php echo $cuota["monto_total"] ?>',
        start          : new Date(<?php echo $fecha_pago->format('Y') . ', ' . ((int)($fecha_pago->format('m')) - 1) . ', ' . $fecha_pago->format('d') . ',08,00,00' ?>),
        backgroundColor: '<?php echo $Eventcolor ?>', //red
        borderColor    : '<?php echo $Eventcolor ?>', //red
        url            : '<?= base_url() . 'admin/prestamo/cuotas/' . $cuota["id_prestamo"] ?>',
      },
    <?php endforeach ?>
    {}
  ];
  /** 
  var MorrisArea = [
    <?php foreach ($cuotas as $key => $cuota) : ?>
		  { y: '<?= $cuota['fecha_pago'] ?>', item1: <?= $cuota['monto_total'] ?>},
    <?php endforeach ?>
    {}
    ];*/
    var MorrisArea = [
      <?php foreach ($cuotas as $key => $cuota) : ?>
        { y: '<?= $cuota['fecha_pago'] ?>', item1: <?= $cuota['monto_pagado'] ?> },
      <?php endforeach ?>
		]
</script>