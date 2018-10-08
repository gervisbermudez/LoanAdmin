<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?= $h1 ?> <small><?= $pagedescription; ?></small></h1>
  </section>
  <!-- Main content -->
  <section class="content" data-run-dashboard="true">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <a class="info-box-icon bg-aqua" href="<?= base_url('admin/user/add'); ?>"><i class="fa fa-users"></i></a>
          <div class="info-box-content">
            <span class="info-box-text">Prestamistas <br>registrados</span>
            <span class="info-box-number"><span id="usercount"></span></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <a href="<?= base_url('admin/prestamo/clientes/nuevo'); ?>" class="info-box-icon bg-red"><i class="fa fa-user"></i></a>
          <div class="info-box-content">
            <span class="info-box-text">Clientes <br>registrados</span>
            <span class="info-box-number"><span id="clientscount"></span></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <a href="<?= base_url('admin/prestamo/nuevo'); ?>" class="info-box-icon bg-green"><i class="fa fa-money"></i></a>
          <div class="info-box-content">
            <span class="info-box-text">Prestamos <br>activos</span>
            <span class="info-box-number"><span id="loanscount"></span></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <a href="<?= base_url(); ?>" class="info-box-icon bg-yellow"><i class="fa fa-list-alt"></i></a>
          <div class="info-box-content">
            <span class="info-box-text">Cuotas <br>pendientes</span>
            <span class="info-box-number"><span id="duescount"></span></span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Left col -->
      <div class="col-md-7">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Ultimos prestamos</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <?php if ($prestamos): ?>
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th class="hidden-xs">Prestamo</th>
                    <th class="hidden-xs">Cuotas</th>
                    <th>Total</th>
                    <th>Progreso</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($prestamos as $key => $prestamo): ?>
                  <?php
                  $badge = 'bg-red';
                  $progreso = $prestamo['progreso'];
                  if ($progreso > 50 && $progreso < 80) {
                  $progresstyle = 'progress-bar-yellow';
                  $badge = 'bg-yellow';
                  }
                  if ($progreso > 80) {
                  $badge = 'bg-light-blue';
                  }
                  if ($progreso == 100) {
                  $badge = 'bg-green';
                  }
                  ?>
                  <tr>
                    <td><?= number_format ($prestamo['monto'], 2, ',', '.'); ?> $</td>
                    <td class="hidden-xs"><?= $prestamo['cant_cuotas'] ?>&nbsp;<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/'.$prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a></td>
                    <td class="hidden-xs"><?= number_format ($prestamo['monto_total'], 2, ',', '.'); ?> $</td>
                    <td><span class="badge <?= $badge ?>"><?= $progreso ?>%</span></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
                <?php else: ?>
              <p>
                  <b>No hay prestamos registrados</b>
              </p>
              <?php endif ?>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <a href="<?= base_url('admin/prestamo/nuevo') ?>" class="btn btn-sm btn-info btn-flat pull-left">Nuevo prestamo</a>
            <a href="<?= base_url('admin/prestamo') ?>" class="btn btn-sm btn-default btn-flat pull-right">Ver todos</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-5">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Próximas cuotas a cobrar</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <?php if ($cuotas): ?>
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th class="hidden-xs">Cuota</th>
                    <th class="hidden-xs">Fecha</th>
                    <th>Cliente</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($cuotas as $key => $cuota): ?>
                  <?php
                  $badge = 'bg-red';
                  $progreso = $prestamo['progreso'];
                  if ($progreso > 50 && $progreso < 80) {
                  $progresstyle = 'progress-bar-yellow';
                  $badge = 'bg-yellow';
                  }
                  if ($progreso > 80) {
                  $badge = 'bg-light-blue';
                  }
                  if ($progreso == 100) {
                  $badge = 'bg-green';
                  }
                  ?>
                  <tr>
                    <td><?= number_format ($cuota['monto_total'], 2, ',', '.') ?> $</td>
                    <td class="hidden-xs"><?= $cuota['fecha_pago'] ?>&nbsp;<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/'.$cuota['prestamo_id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a></td>
                    <td class="hidden-xs"><?= $cuota['cliente'] ?></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <?php else: ?>
              <p>
                  <b>No hay proximas cuotas registradas</b>
              </p>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Reporte Mensual</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong id="loanrangegraph">Prestamos y Ganancias:</strong>
                </p>
                <div class="chart">
                  <canvas id="salesChart" style="height: 180px;"></canvas>
                </div>
              </div>
              <div class="col-md-4">
                <p class="text-center">
                  <strong>Durante este mes:</strong>
                </p>
                <div class="progress-group">
                  <span class="progress-text">Nuevos Clientes:</span>
                  <span class="progress-number" id="client_this_month"><b></b></span>
                  <div class="progress sm">
                    <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                  </div>
                </div>
                <div class="progress-group">
                  <span class="progress-text">Nuevos Prestamos:</span>
                  <span class="progress-number" id="prestamos_count_this_month"><b></b></span>
                  <div class="progress sm">
                    <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Nuevos prestamistas:</span>
                  <span class="progress-number" id="user_count_month"><b></b></span>
                  <div class="progress sm">
                    <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Cuotas caidas:</span>
                  <span class="progress-number" id="count_dues_down"><b></b></span>
                  <div class="progress sm">
                    <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>