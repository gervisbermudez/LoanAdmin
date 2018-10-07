<?php
  $this->load->helper('string');
  $modalid = random_string('alnum', 16);
?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Herramientas</h3>
    <div class="box-tools pull-right">
    	<button class="btn btn-box-tool"><i class="fa fa-table"></i></button>
    </div>
  </div>
<!-- /.box-footer-->
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class=""><a href="#tab_1-1" data-toggle="tab"><i class="fa fa-fw fa-history"></i> Historial</a></li>
              <li class=""><a href="#tab_2-2" data-toggle="tab" ><i class="fa fa-fw fa-credit-card"></i> Prestamos</a></li>
              <li class="active"><a href="#tab_3-2" data-toggle="tab" ><i class="fa fa-fw fa-newspaper-o"></i> Resumen</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                  Opciones <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('admin/prestamo/nuevo/user/'.$cliente['id']); ?>">Registrar Prestamo</a></li>
                  <?php if ($this->session->userdata('user')['level'] < 2): ?>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('admin/prestamo/cliente/editar/'.$cliente['id']); ?>">Editar</a></li>
                  <li role="presentation"><a role="menuitem" data-toggle="modal" data-target="<?php echo '#'.$modalid ?>" tabindex="-1" href="#!" data-table-reference="clients" data-value-id="<?php echo $cliente['id']; ?>" data-target="" data-delete-redirect="true" data-delete-redirectto="admin/prestamo/clientes" class="delete-data">Eliminar</a></li>
                  <?php endif ?>
                </ul>
              </li>
              <li class="pull-left header"><i class="fa fa-user"></i> <?php echo $cliente['nombre'].' '.$cliente['apellido'] ?></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1-1">
                
                <div class="box-body">
              <?php if ($historial_prestamo): ?>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3): ?>
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
                 <?php foreach ($historial_prestamo as $key => $prestamo): ?>
                   <tr>
                    <?php if ($this->session->userdata('user')['level'] < 3): ?>
                    <td><a href="<?php echo base_url('admin/user/view/'.$prestamo['id_prestamista']); ?>"><?php echo $prestamo['username'] ?></a></td>
                  <?php endif ?>
                     <td><?php echo $prestamo['monto'] ?> $&nbsp;<a title='Ver Cuotas' href="<?php echo base_url('admin/prestamo/cuotas/'.$prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a></td>
                     <td><?php echo $prestamo['porcentaje'] ?>%</td>
                     <td><?php echo $prestamo['monto_total'] ?> $</td>
                     <td><?php echo $prestamo['cant_cuotas'] ?></td>
                     <td><?php echo $prestamo['ciclo_pago'] ?></td>
                     <td><?php echo $prestamo['fecha_inicio'] ?></td>
                     <td><span class="badge bg-green"><?php echo $prestamo['progreso'] ?>%</span></td>
                   </tr>
                 <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3): ?>
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
            <?php else: ?>
            No hay prestamos registrados
            <?php endif ?>
            </div>
              
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                <div class="box-body">
              <?php if ($prestamos): ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3): ?>
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
                 <?php foreach ($prestamos as $key => $prestamo): ?>
                   <tr>
                    <?php if ($this->session->userdata('user')['level'] < 3): ?>
                    <td><a href="<?php echo base_url('admin/user/view/'.$prestamo['id_prestamista']); ?>"><?php echo $prestamo['username'] ?></a></td>
                    <?php endif ?>
                     <td><?php echo $prestamo['monto'] ?> $&nbsp;<a title='Ver Cuotas' href="<?php echo base_url('admin/prestamo/cuotas/'.$prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a></td>
                     <td><?php echo $prestamo['porcentaje'] ?>%</td>
                     <td><?php echo $prestamo['monto_total'] ?> $</td>
                     <td><?php echo $prestamo['cant_cuotas'] ?></td>
                     <td><?php echo $prestamo['ciclo_pago'] ?></td>
                     <td><?php echo $prestamo['fecha_inicio'] ?></td>
                   </tr>
                 <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                  <?php if ($this->session->userdata('user')['level'] < 3): ?>
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
            <?php else: ?>
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
                        <div class="box box-success">
                          <div class="box-header with-border">
                            <h3 class="box-title">Información</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <strong><i class="fa fa-phone margin-r-5"></i> Teléfono</strong>
                            <p class="text-muted"><a href="tel:<?php echo $cliente['telefono'] ?>"><?php echo $cliente['telefono'] ?></a></p>
                            <hr>
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                            <p class="text-muted"><a href="https://www.google.com.ar/maps/search/<?php echo urlencode($cliente['direccion']) ?>" target="_blank"><?php echo $cliente['direccion'] ?></a></p>
                            <hr>
                            <strong><i class="fa fa-calendar-plus-o margin-r-5"></i> Fecha de registro</strong>
                            <p class="text-muted"><?php echo $cliente['registerdate'] ?></p>
                          </div>
                          <!-- /.box-body -->
                        </div>
                        </div>
                        <div class="col-lg-8">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Prestamos Activos</h3>
                            </div>
                            <!-- /.box-header -->
                            <?php if ($prestamos): ?>
                            <div class="box-body no-padding">
                              <table class="table table-condensed">
                                <tbody>
                                <tr>
                                  <th>Ciclo</th>
                                  <th>Monto</th>
                                  <th>Progreso</th>
                                  <th style="width: 40px">Porcentaje</th>
                                </tr>
                                  <?php foreach ($prestamos as $key => $prestamo): ?>
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
                                      <?php echo $prestamo['ciclo_pago'] ?>
                                    </td>
                                    <td>
                                      <?php echo $prestamo['monto'] ?>$&nbsp;<a title='Ver Cuotas' href="<?php echo base_url('admin/prestamo/cuotas/'.$prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a>
                                    </td>
                                    <td>
                                    <div class="progress progress-xs progress-striped active">
                                      <div class="progress-bar <?php echo $progresstyle ?>" style="width: <?php echo $prestamo['progreso'] ?>%"></div>
                                    </div>
                                  </td>
                                  <td><span class="badge <?php echo $badge ?>"><?php echo $progreso ?>%</span></td>
                                  </tr>  
                                <?php endforeach ?>
                              </tbody>
                            </table>
                            </div>
                          <?php else: ?>
                              <div class="box-body">No hay prestamos activos, <a href="<?php echo base_url('admin/prestamo/nuevo/user/'.$cliente['id']); ?>">Registrar nuevo</a></div>
                          <?php endif ?>
                            <!-- /.box-body -->
                          </div>
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
                        <div class="chart" id="line-chart" style="height: 250px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="250" version="1.1" width="380" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; top: -0.59375px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="41" y="214" text-anchor="end" font-family="Open Sans" font-size="10px" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: &quot;Open Sans&quot;; font-size: 10px; font-weight: normal;" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#efefef" d="M53.5,214H355.406" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="41" y="166.75" text-anchor="end" font-family="Open Sans" font-size="10px" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: &quot;Open Sans&quot;; font-size: 10px; font-weight: normal;" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">5,000</tspan></text><path fill="none" stroke="#efefef" d="M53.5,166.75H355.406" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="41" y="119.5" text-anchor="end" font-family="Open Sans" font-size="10px" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: &quot;Open Sans&quot;; font-size: 10px; font-weight: normal;" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">10,000</tspan></text><path fill="none" stroke="#efefef" d="M53.5,119.5H355.406" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="41" y="72.25" text-anchor="end" font-family="Open Sans" font-size="10px" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: &quot;Open Sans&quot;; font-size: 10px; font-weight: normal;" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">15,000</tspan></text><path fill="none" stroke="#efefef" d="M53.5,72.25H355.406" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="41" y="25" text-anchor="end" font-family="Open Sans" font-size="10px" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: &quot;Open Sans&quot;; font-size: 10px; font-weight: normal;" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">20,000</tspan></text><path fill="none" stroke="#efefef" d="M53.5,25H355.406" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="300.0137691373026" y="226.5" text-anchor="middle" font-family="Open Sans" font-size="10px" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: &quot;Open Sans&quot;; font-size: 10px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,5.5)"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="165.75180558930742" y="226.5" text-anchor="middle" font-family="Open Sans" font-size="10px" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: &quot;Open Sans&quot;; font-size: 10px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,5.5)"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><path fill="none" stroke="#efefef" d="M53.5,188.8063C61.93722721749696,188.5417,78.81168165249088,190.4009875,87.24890886998784,187.74790000000002C95.68613608748481,185.09481250000002,112.56059052247873,168.75624016393445,120.9978177399757,167.5816C129.34333596597813,166.41972766393442,146.03437241798298,180.6438625,154.37989064398542,178.40185C162.72540886998786,176.1598375,179.41644532199268,151.8811350409836,187.76196354799512,149.6455C196.1991907654921,147.3852975409836,213.07364520048603,158.0678125,221.510872417983,160.4185C229.94809963547996,162.7691875,246.82255407047387,179.6189893442623,255.25978128797084,168.451C263.60529951397325,157.40440184426228,280.29633596597813,78.52883321823204,288.64185419198054,71.56015C296.89566342648845,64.66804571823204,313.4032818955042,105.24937403846154,321.65709113001213,113.00785C330.0943183475091,120.93873653846154,346.96877278250304,128.9901625,355.406,134.3176" stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="53.5" cy="188.8063" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="87.24890886998784" cy="187.74790000000002" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="120.9978177399757" cy="167.5816" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="154.37989064398542" cy="178.40185" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="187.76196354799512" cy="149.6455" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="221.510872417983" cy="160.4185" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="255.25978128797084" cy="168.451" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="288.64185419198054" cy="71.56015" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="321.65709113001213" cy="113.00785" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="355.406" cy="134.3176" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 178.487px; top: 93px; display: none;"><div class="morris-hover-row-label">2012 Q2</div><div class="morris-hover-point" style="color: #efefef">
                        Item 1:
                        5,670
                      </div></div></div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-border">
                          <div class="row">
                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                              <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; -webkit-appearance: none;"></div>

                              <div class="knob-label">Mail-Orders</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                              <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; -webkit-appearance: none;"></div>

                              <div class="knob-label">Online</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-xs-4 text-center">
                              <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; -webkit-appearance: none;"></div>

                              <div class="knob-label">In-Store</div>
                            </div>
                            <!-- ./col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                      </div>
                      </div>
                    </div>
                  <div class="col-lg-4">
                  <div class="box box-widget widget-user-2">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <?php 
                        $badge = 'bg-red'; 
                        $progreso = $balance['porcentaje_total_pagado'];
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
                      <div class="widget-user-header <?php echo $badge; ?>">
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Balance Global</h3>
                        <h5 class="widget-user-desc"><?php echo (int)$balance['porcentaje_total_pagado'] ?>% Pagado</h5>
                      </div>
                      <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                          <li><a href="#"><b>Monto Prestado</b> <span class="pull-right"><?php echo number_format ($balance['monto_total_prestado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Monto Ganado</b> <span class="pull-right"><?php echo number_format ($balance['monto_total_ganado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Monto total</b> <span class="pull-right"><?php echo number_format ($balance['monto_gobal_prestado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Total Pagado</b> <span class="pull-right"><?php echo number_format ($balance['monto_total_pagado'], 2, ',', '.') ?>$</span></a></li>
                          <li><a href="#"><b>Deuda actual</b> <span class="pull-right"><?php echo number_format ($balance['monto_deuda_total'], 2, ',', '.') ?>$</span></a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.widget-user -->
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
<div class="modal fade" id="<?php echo $modalid; ?>" style="display: none;">
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
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>