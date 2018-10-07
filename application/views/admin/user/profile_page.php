<?php
$modalid_eliminar = random_string('alnum', 16);
$modalid_gastos = random_string('alnum', 16);
$modalid_ingresos = random_string('alnum', 16);
$modalid_avatar = random_string('alnum', 16);
?>
<div class="row">
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <?php if (is_file(IMGPROFILEPATH . $user->avatar)) : ?>
        <a data-toggle="modal" href="<?= '#' . $modalid_avatar ?>"><img class="profile-user-img img-responsive img-circle" src="<?= base_url(IMGPROFILEPATH . $user->avatar); ?>" alt="User profile picture">
        </a> <?php endif ?>
        <h3 class="profile-username text-center"><?= $user->nombre ?> <?= $user->apellido ?></h3>
        <p class="text-muted text-center"><?= $user->nombre ?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Registro:</b> <a class="pull-right"><?= $user->date_created->format('d M Y'); ?></a>
          </li>
          <li class="list-group-item">
            <b>Ultima vez:</b> <a class="pull-right"><?= $user->lastseen->format('d M Y'); ?></a>
          </li>
        </ul>
        <a href="<?= base_url('admin/user/edit/' . $user->id); ?>" class="btn btn-primary btn-block"><b>Edit</b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- About Me Box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Sobre mi</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <strong><i class="fa fa-user margin-r-5"></i> DNI</strong>
        <p class="text-muted">
          <?= $user->identificacion ?>
        </p>
        <hr>
        <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
        <p class="text-muted">
          <a href="mailto:<?= $user->email ?>"><?= $user->email ?></a>
        </p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
        <p class="text-muted"><a href="tel:<?= $user->telefono ?>"><?= $user->telefono ?></a></p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
        <p class="text-muted"><a href="https://www.google.com.ar/maps/search/<?= urlencode($user->direccion) ?>?hl=en&source=opensearch" target="_blank"><?= $user->direccion ?></a></p>
        <hr>
        <strong><i class="fa fa-file-text-o margin-r-5"></i> Create by</strong>
        <p><?= $user->{'create by'} ?></p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#review" data-toggle="tab">Resumen</a></li>
        <li><a href="#home" data-toggle="tab">Prestamos</a></li>
        <li><a href="#ingresos" data-toggle="tab">Ingresos</a></li>
        <li><a href="#gastos" data-toggle="tab">Gastos</a></li>
        <li><a href="#timeline" data-toggle="tab">Historial</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane" id="home">
          <div class="box-body">
            <?php if ($prestamos) : ?>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th  class="hidden-xs">Prestamo</th>
                  <th  class="hidden-xs">Cuotas</th>
                  <th>Total</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($prestamos as $key => $prestamo) : ?>
                <tr>
                  <td><a href="<?= base_url('admin/prestamo/cliente/' . $prestamo['id_cliente']) ?>"><?= $prestamo['nombre'] . ' ' . $prestamo['apellido'] ?></a></td>
                  <td><?= $prestamo['monto'] ?>&nbsp;<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/' . $prestamo['id']); ?>"><i class="fa fa-fw fa-search-plus"></i></a></td>
                  <td class="hidden-xs"><?= $prestamo['porcentaje'] ?></td>
                  <td class="hidden-xs"><?= $prestamo['monto_total'] ?></td>
                  <td class="hidden-xs"><?= $prestamo['registerdate'] ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
              <tr>
                <th>Cliente</th>
                <th>Prestamo</th>
                <th class="hidden-xs">Cuotas</th>
                <th class="hidden-xs">Total</th>
                <th>Fecha</th>

              </tr>
              </tfoot>
            </table>
            <?php else : ?>
            No hay prestamos registrados
            <?php endif ?>
          </div>
        </div>
        <div class="tab-pane" id="ingresos">
          <?php $total_ingresos = 0; if ($ingresos) : ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Monto</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $total_ingresos = 0;
              foreach ($ingresos as $key => $ingreso) : ?>
              <tr id="#row<?= $ingreso['id']; ?>">
                <td><?= $ingreso['monto'] ?> $</td>
                <td><?= $ingreso['descripcion'] ?></td>
                <td><?= $ingreso['fecha'] ?></td>
                <td><a data-toggle="modal" href="<?= '#' . $modalid_eliminar ?>" class="delete-data" data-table-reference="expenses" data-value-id="<?= $ingreso['id']; ?>" data-delete-redirect="true" data-delete-redirectto="admin/user/view/<?= $user->id ?>"><i class="fa fa-remove"></i></a></td>
              </tr>
              <?php
              $total_ingresos += $ingreso['monto'];
              endforeach ?>
            </tbody>
          </table>
          <?php endif ?>
          <br>
          <span><b >Total: <?php echo $total_ingresos; ?> $</b></span>
          <hr>
          <a href="#<?= $modalid_ingresos; ?>" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle"></i> Agregar ingreso</a>
        </div>
        <div class="tab-pane" id="gastos">
          <?php  $total_gastos = 0; if ($gastos) : ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Monto</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $total_gastos = 0;
              foreach ($gastos as $key => $gasto) : ?>
              <tr id="#row<?= $gasto['id']; ?>">
                <td><?= $gasto['monto'] ?></td>
                <td><?= $gasto['descripcion'] ?></td>
                <td><?= $gasto['fecha'] ?></td>
                <td><a data-toggle="modal" href="<?= '#' . $modalid_eliminar ?>" class="delete-data" data-table-reference="expenses" data-value-id="<?= $gasto['id']; ?>" data-delete-redirect="true" data-delete-redirectto="admin/user/view/<?= $user->id ?>"><i class="fa fa-remove"></i></a></td>
              </tr>
              <?php $total_gastos += $gasto['monto'];
              endforeach ?>
            </tbody>
          </table>
          <?php endif ?>
          <br>
          <span><b >Total: <?php echo $total_gastos; ?> $</b></span>
          <hr>
          <a href="#<?= $modalid_gastos; ?>" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle"></i> Agregar gasto</a>
        </div>
        <div class="tab-pane" id="timeline">
          <?= $timeline ?>
        </div>
        <div class="tab-pane active" id="review">
          <div class="box-body">
           <div class="row">
           <div class="col-md-3">
           <a href="mailbox.html" class="btn btn-primary btn-block margin-bottom">Registrar pago</a>
           <div class="box box-solid">
           <div class="box-header with-border">
           <h3 class="box-title">Cartera Hoy</h3>
           <div class="box-tools">
           </div>
           </div>
           <div class="box-body no-padding">
           <ul class="nav nav-pills nav-stacked">
           <li><a href="mailbox.html"><i class="fa  fa-plus"></i> Ingresos
           <span class="label label-primary pull-right"><?= $total_ingresos; ?> $</span></a></li>
           <li><a href="#"><i class="fa fa-minus"></i> Gastos
           <span class="label label-primary pull-right"><?= $total_gastos; ?> $</span>
           </a></li>
           <li><a href="#"><i class="fa fa-plus-circle"></i> Cobros
           <span class="label label-primary pull-right"></span>
           </a></li>
           <li><a href="#"><i class="fa fa-minus-circle"></i> Prestamos 
           <span class="label label-warning pull-right">w</span></a>
           </li>
           <li><a href="#"><i class="fa fa-bar-chart"></i> Total
           <span class="label label-primary pull-right"><?= $total_ingresos - $total_gastos ?> $ </span>
           </a></li>
           </ul>
           </div>
           </div>
           </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="<?php echo $modalid_gastos; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <?= form_open('admin/prestamo/gastos/registrar/' . $user->id); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar gasto</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">Monto</label>
          <input type="number" class="form-control" name="monto" id="inputMonto" placeholder="Monto" min="0" required="required" title="Monto">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required="required" title="Descripcion">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
</div>
<div class="modal fade" id="<?php echo $modalid_ingresos; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <?= form_open('admin/prestamo/ingresos/registrar/' . $user->id); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar ingresos</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">Monto</label>
          <input type="number" class="form-control" name="monto" id="inputMonto" placeholder="Monto" min="0" required="required" title="Monto">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required="required" title="Descripcion">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
</div>
<div class="modal fade" id="<?php echo $modalid_eliminar; ?>" style="display: none;">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Eliminar Gasto</h4>
    </div>
    <div class="modal-body">
      <p>Esta accion eliminará el Gasto y todos los datos relacionados con éste</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
      <button type="button" class="btn btn-danger" data-delete-data="run" data-dismiss="modal">Continuar</button>
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="<?php echo $modalid_avatar; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open_multipart('upload/do_upload/avatar/'.$user->id);?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Seleccione foto de perfil</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="userfile" size="20" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
</div>