<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Herramientas</h3>
    <div class="box-tools pull-right">
    	<button class="btn btn-box-tool"><i class="fa fa-table"></i></button>
    </div>
  </div>
<!-- /.box-footer-->
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
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
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
                  <li role="presentation"><a href="<?php echo base_url('admin/prestamo/cuotas/pagar/'.$prestamo['id']) ?>" role="menuitem" tabindex="-1" title="Registrar pago"><i class="fa fa-fw fa-plus-circle"></i> Realizar un pago</a></li>
                </ul>
              </li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <h3 class="box-title">Todas las cuotas del prestamo realizado</h3>
              <?php if ($cuotas): ?>
              
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
                 <?php foreach ($cuotas as $key => $cuota): ?>
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
                     <td><?php echo $cuota['monto_total'] ?>$</td>
                     <td><?php echo $cuota['monto_pagado'] ?>$</td>
                     <td class="hidden-xs"><?php echo $cuota['fecha_pagado'] ?></td>
                     <td class="hidden-xs"><span class="label <?php echo $badge ?>"><?php echo $cuota['estado'] ?></span></td>
                   </tr>
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
              <?php else: ?>
              No hay cuotas para este prestamo
              <?php endif ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div id="calendar"></div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
    </div>
</div>

<script>
  var calendarEvents = [
    <?php foreach ($cuotas as $key => $cuota): ?>
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
        start          : new Date(<?php echo $fecha_pago->format('Y').', '.((int)($fecha_pago->format('m'))-1).', '.$fecha_pago->format('d').',08,00,00' ?>),
        backgroundColor: '<?php echo $Eventcolor ?>', //red
        borderColor    : '<?php echo $Eventcolor ?>' //red
      },
    <?php endforeach ?>
    {}
  ]
</script>