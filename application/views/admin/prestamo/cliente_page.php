<?php
$this->load->helper('string');
$modalid = random_string('alnum', 16);
  $badge = 'bg-red';
  $boxColor = 'box-danger';
  $progreso_global = $balance['porcentaje_total_pagado'];
  if ($progreso_global > 50 && $progreso_global < 80) {
    $badge = 'bg-yellow';
    $boxColor = 'box-warning';
  }
  if ($progreso_global > 80) {
    $badge = 'bg-light-blue';
    $boxColor = 'box-primary';
  }
  if ($progreso_global == 100) {
    $badge = 'bg-green';
    $boxColor = 'box-success';
  }
?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Herramientas</h3>
    <hr />
					<a href="<?php echo base_url('admin/prestamo/nuevo'); ?>" class="btn btn-success" data-toggle="tooltip"
           data-original-title="Nuevo prestamo"><i class="fa fa-plus-circle"></i> Registrar prestamo</a>
           <?php if ($this->session->userdata('user')['level'] < 2) : ?>
                  <a role="menuitem" data-toggle="modal" data-target="<?= '#' . $modalid ?>" tabindex="-1" href="#!" data-table-reference="clients" data-value-id="<?= $cliente['id']; ?>" data-target="" data-delete-redirect="true" data-delete-redirectto="admin/prestamo/clientes" class="delete-data btn btn-danger"><i class="fa fa-close"></i> Eliminar</a>
            <?php endif ?>
  </div>
<!-- /.box-footer-->
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class=""><a href="#tab_calendar" data-toggle="tab"><i class="fa fa-fw fa-calendar"></i> Calendario</a></li>
              <li class=""><a href="#tab_1-1" data-toggle="tab"><i class="fa fa-fw fa-history"></i> Historial</a></li>
              <li class=""><a href="#tab_2-2" data-toggle="tab" ><i class="fa fa-fw fa-credit-card"></i> Prestamos</a></li>
              <li class="active"><a href="#tab_3-2" data-toggle="tab" ><i class="fa fa-fw fa-newspaper-o"></i> Resumen</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                  Opciones <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/prestamo/nuevo/user/' . $cliente['id']); ?>">Registrar Prestamo</a></li>
                  <?php if ($this->session->userdata('user')['level'] < 2) : ?>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/prestamo/cliente/editar/' . $cliente['id']); ?>">Editar cliente</a></li>
                  <li role="presentation"><a role="menuitem" data-toggle="modal" data-target="<?= '#' . $modalid ?>" tabindex="-1" href="#!" data-table-reference="clients" data-value-id="<?= $cliente['id']; ?>" data-target="" data-delete-redirect="true" data-delete-redirectto="admin/prestamo/clientes" class="delete-data">Eliminar cliente</a></li>
                  <?php endif ?>
                </ul>
              </li>
              <li class="pull-left header"><i class="fa fa-user"></i> <?= $cliente['nombre'] . ' ' . $cliente['apellido'] ?></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane" id="tab_calendar">
                <div class="box-body">
                <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
                </div>
                </div>
            </div>
              <div class="tab-pane" id="tab_1-1">
                
                <div class="box-body">
              <?php if ($historial_prestamo) : ?>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3) : ?>
                  <th>Prestamista</th>
                  <?php endif ?>
                  <th>Prestamo</th>
                  <th>Porcentaje</th>
                  <th>Total</th>
                  <th>Coutas</th>
                  <th>Ciclo de pago</th>
                  <th>Fecha de inicio</th>
                  <th>Progreso</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach ($historial_prestamo as $key => $prestamo) : ?>
                   <tr>
                    <?php if ($this->session->userdata('user')['level'] < 3) : ?>
                    <td><a href="<?= base_url('admin/user/view/' . $prestamo['id_prestamista']); ?>"><?= $prestamo['username'] ?></a></td>
                  <?php endif ?>
                     <td><?= $prestamo['monto'] ?> $&nbsp;<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/' . $prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a></td>
                     <td><?= $prestamo['porcentaje'] ?>%</td>
                     <td><?= $prestamo['monto_total'] ?> $</td>
                     <td><?= $prestamo['cant_cuotas'] ?></td>
                     <td><?= $prestamo['ciclo_pago'] ?></td>
                     <td><?= $prestamo['fecha_inicio'] ?></td>
                     <td><span class="badge bg-green"><?= $prestamo['progreso'] ?>%</span></td>
                   </tr>
                 <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3) : ?>
                  <th>Prestamista</th>
                  <?php endif ?>
                  <th>Prestamo</th>
                  <th>Porcentaje</th>
                  <th>Total</th>
                  <th>Coutas</th>
                  <th>Ciclo de pago</th>
                  <th>Fecha de inicio</th>
                  <th>Progreso</th>
                </tr>
                </tfoot>
              </table>
            <?php else : ?>
            No hay prestamos registrados
            <?php endif ?>
            </div>
              
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                <div class="box-body">
              <?php if ($prestamos) : ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3) : ?>
                  <th>Prestamista</th>
                  <?php endif ?>
                  <th>Prestamo</th>
                  <th>Porcentaje</th>
                  <th>Total</th>
                  <th>Coutas</th>
                  <th>Ciclo de pago</th>
                  <th>Fecha de inicio</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach ($prestamos as $key => $prestamo) : ?>
                   <tr>
                    <?php if ($this->session->userdata('user')['level'] < 3) : ?>
                    <td><a href="<?= base_url('admin/user/view/' . $prestamo['id_prestamista']); ?>"><?= $prestamo['username'] ?></a></td>
                    <?php endif ?>
                     <td><?= $prestamo['monto'] ?> $&nbsp;<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/' . $prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a></td>
                     <td><?= $prestamo['porcentaje'] ?>%</td>
                     <td><?= $prestamo['monto_total'] ?> $</td>
                     <td><?= $prestamo['cant_cuotas'] ?></td>
                     <td><?= $prestamo['ciclo_pago'] ?></td>
                     <td><?= $prestamo['fecha_inicio'] ?></td>
                   </tr>
                 <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3) : ?>
                  <th>Prestamista</th>
                  <?php endif ?>
                  <th>Prestamo</th>
                  <th>Porcentaje</th>
                  <th>Total</th>
                  <th>Coutas</th>
                  <th>Ciclo de pago</th>
                  <th>Fecha de inicio</th>
                </tr>
                </tfoot>
              </table>
            <?php else : ?>
            No hay prestamos registrados
            <?php endif ?>
            </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_3-2">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="box <?= $boxColor ?>">
                          <div class="box-header with-border">
                            <h3 class="box-title">Información</h3>
                          </div>
                          <div class="box-body">
                            <strong><i class="fa fa-phone margin-r-5"></i> Teléfono</strong>
                            <p class="text-muted"><a href="tel:<?= $cliente['telefono'] ?>"><?= $cliente['telefono'] ?></a></p>
                            <hr>
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                            <p class="text-muted"><a href="https://www.google.com.ar/maps/search/<?= urlencode($cliente['direccion']) ?>" target="_blank"><?= ucwords($cliente['direccion']) ?></a></p>
                            <hr>
                            <strong><i class="fa fa-calendar-plus-o margin-r-5"></i> Fecha de registro</strong>
                            <p class="text-muted"><?= $cliente['registerdate'] ?></p>
                          </div>
                        </div>
                        </div>
                        <div class="col-lg-8">
                          <div class="box <?= $boxColor ?>">
                            <div class="box-header with-border">
                              <h3 class="box-title">Prestamos Activos</h3>
                            </div>
                            <!-- /.box-header -->
                            <?php if ($prestamos) : ?>
                            <div class="box-body no-padding">
                              <table class="table table-condensed">
                                <tbody>
                                <tr>
                                  <th>Ciclo</th>
                                  <th>Monto</th>
                                  <th>Progreso</th>
                                  <th style="width: 40px">Porcentaje</th>
                                </tr>
                                  <?php foreach ($prestamos as $key => $prestamo) : ?>
                                  <?php 
                                  $progresstyle = 'progress-bar-danger';
                                  $badge = 'bg-red';
                                  $progreso = $prestamo['progreso'];
                                  if ($progreso > 50 && $progreso < 80) {
                                    $progresstyle = 'progress-bar-yellow';
                                    $badge = 'bg-yellow';
                                  }
                                  if ($progreso > 80) {
                                    $progresstyle = 'progress-bar-primary';
                                    $badge = 'bg-light-blue';
                                  }
                                  if ($progreso == 100) {
                                    $progresstyle = 'progress-bar-success';
                                    $badge = 'bg-green';
                                  }
                                  ?>
                                  <tr>
                                    <td>
                                      <?= $prestamo['ciclo_pago'] ?>
                                    </td>
                                    <td>
                                      <?= $prestamo['monto'] ?>$&nbsp;<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/' . $prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a>
                                    </td>
                                    <td>
                                    <div class="progress progress-xs progress-striped active">
                                      <div class="progress-bar <?= $progresstyle ?>" style="width: <?= $prestamo['progreso'] ?>%"></div>
                                    </div>
                                  </td>
                                  <td><span class="badge <?= $badge ?>"><?= $progreso ?>%</span></td>
                                  </tr>  
                                <?php endforeach ?>
                              </tbody>
                            </table>
                            </div>
                          <?php else : ?>
                              <div class="box-body">No hay prestamos activos, <a href="<?= base_url('admin/prestamo/nuevo/user/' . $cliente['id']); ?>">Registrar nuevo</a></div>
                          <?php endif ?>
                            <!-- /.box-body -->
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="box box-widget widget-user-2">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      
                      <div class="widget-user-header <?= $badge; ?>">
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Balance Global</h3>
                        <?php if((int)$balance['porcentaje_total_pagado']===100): ?>
                        <h5 class="widget-user-desc">Sin deuda</h5>
                        <?php else: ?>
                        <h5 class="widget-user-desc"><?= (int)$balance['porcentaje_total_pagado'] ?>% Pagado</h5>
                        <?php endif; ?>
                      </div>
                      <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                          <li><a href="#"><b>Monto Prestado</b> <span class="pull-right"><?= number_format($balance['monto_total_prestado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Monto Ganado</b> <span class="pull-right"><?= number_format($balance['monto_total_ganado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Monto total</b> <span class="pull-right"><?= number_format($balance['monto_gobal_prestado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Total Pagado</b> <span class="pull-right"><?= number_format($balance['monto_total_pagado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Deuda actual</b> <span class="pull-right"><?= number_format($balance['monto_deuda_total'], 2, ',', '.') ?>$</span></a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.widget-user -->
                  </div>
                </div>
               <div class="row">
                      <div class="box box-solid bg-teal-gradient">
                      <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <i class="fa fa-th"></i>

                        <h3 class="box-title">Sales Graph</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body border-radius-none">
                        <div class="chart" id="line-chart" style="height: 250px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        </div>
                        </div>
                        <!-- /.box-footer -->
                      </div>
                      </div>
                    </div>
                </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<div class="modal fade" id="<?= $modalid; ?>" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Eliminar Cliente</h4>
      </div>
      <div class="modal-body">
        <p>Esta accion eliminará el Cliente y todos los datos relacionados con éste</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-delete-data="run" data-dismiss="modal">Continuar</button>
      </div>
    </div>
  </div>
</div>
<?php $fechas = array();
foreach ($pagos_realizados as $key => $value) : ?>
  <?php
  if (!array_key_exists($value['Fecha'], $fechas)) {
    $fechas[$value['Fecha']] = $value['monto_pagado'];
  } else {
    $fechas[$value['Fecha']] = $fechas[$value['Fecha']] + $value['monto_pagado'];
  }
  ?>
<?php endforeach; ?>
<script>
  var pagos_data = [
    <?php foreach ($fechas as $key => $value) : ?>
    { y: '<?= $key ?>', item1: '<?= $value ?>' },
    <?php endforeach; ?>
		];
</script>
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
        $Eventcolor = '#dd4b39'; // Rojo
      }
      if ($cuota['estado'] == 'Pagado') {
        $Eventcolor = '#00a65a'; // Verde
      }
      ?>
      {
        title          : 'Cuota de <?= $cuota["monto_total"] ?>',
        start          : new Date(<?= $fecha_pago->format('Y') . ', ' . ((int)($fecha_pago->format('m')) - 1) . ', ' . $fecha_pago->format('d') . ',08,00,00' ?>),
        backgroundColor: '<?= $Eventcolor ?>', //red
        borderColor    : '<?= $Eventcolor ?>', //red
        url            : '<?= base_url() . 'admin/prestamo/cuotas/' . $cuota["id_prestamo"] ?>',
      },
    <?php endforeach ?>
    {}
  ]
</script>