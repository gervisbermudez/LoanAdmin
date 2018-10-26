<?php
  $modalid_eliminar_gastos = random_string('alnum', 16);
  $modalid_eliminar_ingresos = random_string('alnum', 16);
  $modalid_gastos = random_string('alnum', 16);
  $modalid_ingresos = random_string('alnum', 16);
  $modalid_avatar = random_string('alnum', 16);
?>
<div class="row">
<div class="col-sm-12">
		<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Herramientas</h3>
					<hr />
					<a href="<?= base_url('admin/user/edit/' . $user->id); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i>	Editar</a>
					<a href="<?php echo base_url('admin/prestamo/clientes/nuevo'); ?>" class="btn btn-success" data-toggle="tooltip"
					 data-original-title="Nuevo prestamo"><i class="fa fa-user-plus"></i> Nuevo Cliente</a>
					<a href="/admin/prestamo/nuevo" class="btn btn-success"><i class="fa fa-plus-circle"></i> Registrar Prestamo</a>
					<a href="#<?= $modalid_gastos; ?>" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle"></i>
						Agregar gasto</a>
						<a href="#<?= $modalid_ingresos; ?>" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-square-o"></i>
						Agregar ingreso</a>
					<!-- Date and time range -->
					<form action="" method="GET" class="pull-right dateranger"><div class="form-group">
					<div class="input-group">
					<button type="button" class="btn btn-default pull-right" id="daterange-btn">
					<span>
					<i class="fa fa-calendar"></i> Fecha seleccionada
					</span>
					<i class="fa fa-caret-down"></i>
					</button>
					</div>
					</div>
						<input type="hidden" name="date_start" id="date_start">
						<input type="hidden" name="date" id="date">
						<input type="hidden" name="date_end" id="date_end">
					</form>
              <!-- /.form group -->
				</div>
			</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<?php if (is_file(IMGPROFILEPATH . $user->avatar)) : ?>
				<a data-toggle="modal" href="<?= '#' . $modalid_avatar ?>"><img class="profile-user-img img-responsive img-circle"
					 src="<?= base_url(IMGPROFILEPATH . $user->avatar); ?>" alt="User profile picture">
				</a>
				<?php endif ?>
				<h3 class="profile-username text-center">
					<?=  ucwords($user->nombre.' '.$user->apellido) ?>
				</h3>
				<p class="text-muted text-center">
					<?= $user->username ?>
				</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Registro:</b> <a class="pull-right">
							<?= $user->date_created->format('d M Y H:i'); ?></a>
					</li>
					<li class="list-group-item">
						<b>Ultima vez:</b> <a class="pull-right">
							<?= $user->lastseen->format('d M Y H:i'); ?></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Sobre mi</h3>
			</div>
			<div class="box-body">
				<strong><i class="fa fa-user margin-r-5"></i> DNI</strong>
				<p class="text-muted">
					<?= $user->identificacion ?>
				</p>
				<hr>
				<strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
				<p class="text-muted">
					<a href="mailto:<?= $user->email ?>">
						<?= $user->email ?></a>
				</p>
				<hr>
				<strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
				<p class="text-muted"><a href="tel:<?= $user->telefono ?>">
						<?= $user->telefono ?></a></p>
				<hr>
				<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
				<p class="text-muted"><a href="https://www.google.com.ar/maps/search/<?= urlencode($user->direccion) ?>?hl=en&source=opensearch"
					 target="_blank">
						<?= $user->direccion ?></a></p>
				<hr>
				<strong><i class="fa fa-file-text-o margin-r-5"></i> Create by</strong>
				<p>
					<?= $user->{'create by'} ?>
				</p>
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
									<th class="hidden-xs">Prestamo</th>
									<th class="hidden-xs">Cuotas</th>
									<th>Total</th>
									<th>Fecha</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($prestamos as $key => $prestamo) : ?>
								<tr>
									<td><a href="<?= base_url('admin/prestamo/cliente/' . $prestamo['id_cliente']) ?>">
											<?=  ucwords($prestamo['nombre'] . ' ' . $prestamo['apellido']) ?></a></td>
									<td>
										<?= format($prestamo['monto']) ?>&nbsp;<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/' . $prestamo['id']); ?>"><i
											 class="fa fa-fw fa-search-plus"></i></a></td>
									<td class="hidden-xs">
										<?= $prestamo['porcentaje'] ?>
									</td>
									<td class="hidden-xs">
										<?= format($prestamo['monto_total']) ?>
									</td>
									<td class="hidden-xs">
										<?= $prestamo['registerdate'] ?>
									</td>
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
								<td>
									<?= format($ingreso['monto']) ?></td>
								<td>
									<?= $ingreso['descripcion'] ?>
								</td>
								<td>
									<?= $ingreso['fecha'] ?>
								</td>
								<td><a data-toggle="modal" href="<?= '#' . $modalid_eliminar_ingresos ?>" class="delete-data" data-table-reference="income"
									 data-value-id="<?= $ingreso['id']; ?>" data-delete-redirect="true" data-delete-redirectto="admin/user/view/<?= $user->id ?>"><i
										 class="fa fa-trash"></i></a></td>
							</tr>
							<?php
              $total_ingresos += $ingreso['monto'];
              endforeach ?>
						</tbody>
					</table>
					<?php endif ?>
					<br>
					<span><b>Total:
							<?php echo format($total_ingresos); ?></b></span>
					<hr>
					
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
								<td>
									<?= format($gasto['monto']) ?>
								</td>
								<td>
									<?= $gasto['descripcion'] ?>
								</td>
								<td>
									<?= $gasto['fecha'] ?>
								</td>
								<td><a data-toggle="modal" href="<?= '#' . $modalid_eliminar_gastos ?>" class="delete-data" data-table-reference="expenses"
									 data-value-id="<?= $gasto['id']; ?>" data-delete-redirect="true" data-delete-redirectto="admin/user/view/<?= $user->id ?>"><i
										 class="fa fa-trash"></i></a></td>
							</tr>
							<?php $total_gastos += $gasto['monto'];
              				endforeach ?>
						</tbody>
					</table>
					<?php endif ?>
					<br>
					<span><b>Total:
							<?php echo format($total_gastos); ?></b></span>
				</div>
				<div class="tab-pane" id="timeline">
					<?= $timeline ?>
				</div>
				<div class="tab-pane active" id="review">
					<div class="box-body">
						<div class="row">
							<div class="col-md-3">
								<div class="box box-solid">
									<div class="box-header with-border">
										<h3 class="box-title">Cartera de <?= $date_label ?></h3>
										<div class="box-tools">
										</div>
									</div>
									<div class="box-body no-padding">
										<ul class="nav nav-pills nav-stacked">
											<li><a href="mailbox.html"><i class="fa  fa-plus"></i> Ingresos
													<span class="label label-primary pull-right">
														<?= $balance['income']; ?></span></a></li>
											<li><a href="#"><i class="fa fa-minus"></i> Gastos
													<span class="label label-primary pull-right">
													<?= $balance['expenses']; ?></span>
												</a></li>
											<li><a href="#"><i class="fa fa-plus-circle"></i> Cobros
													<span class="label label-primary pull-right">
													<?= $balance['collections']; ?>
													</span>
												</a></li>
											<li><a href="#"><i class="fa fa-minus-circle"></i> Prestamos
													<span class="label label-warning pull-right">
													<?= $balance['loans']; ?>
													</span></a>
											</li>
											<li><a href="#"><i class="fa fa-bar-chart"></i> Total
													<span class="label label-primary pull-right">
													<?= $balance['total']; ?></span>
												</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-9">
							<h4 class="box-title"><?= $date_label_recaudo ?></h4>
					<?php $total_dues = 0; if ($dues) : ?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Monto cobrado</th>
								<th>Fecha</th>
							</tr>
						</thead>
						<tbody>
							<?php 
              				foreach ($dues as $key => $due) : ?>
								<tr id="#row<?= $due['id']; ?>">
								<td>
									<a href="<?= base_url('admin/prestamo/cliente/' . $due['id_cliente']) ?>"><?=  ucwords($due['nombre'].' '.$due['apellido']) ?></a>
								</td>
								<td>
									<?= format($due['recaudo']) ?>
									<a title='Ver Cuotas' href="<?= base_url('admin/prestamo/cuotas/' . $due['id_prestamo']); ?>"><i
											 class="fa fa-fw fa-search-plus"></i></a>
								</td>
								<td>
									<?= $due['fecha_pagado'] ?>
								</td>
							</tr>
							<?php $total_dues += $due['recaudo'];
              				endforeach ?>
						</tbody>
					</table>
					<?php endif ?>
					<hr>
					<span><b>Total:
							<?php echo format($total_dues); ?></b></span>
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
					<input type="number" class="form-control" name="monto" id="inputMonto" placeholder="Monto" min="0" required="required"
					 title="Monto">
				</div>
				<div class="form-group">
					<label for="descripcion">Descripcion</label>
					<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required="required"
					 title="Descripcion">
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
					<input type="number" class="form-control" name="monto" id="inputMonto" placeholder="Monto" min="0" required="required"
					 title="Monto">
				</div>
				<div class="form-group">
					<label for="descripcion">Descripcion</label>
					<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required="required"
					 title="Descripcion">
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
<div class="modal fade" id="<?php echo $modalid_eliminar_gastos; ?>">
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
<div class="modal fade" id="<?php echo $modalid_eliminar_ingresos; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Eliminar Ingresos</h4>
			</div>
			<div class="modal-body">
				<p>Esta accion eliminará el Ingresos y todos los datos relacionados con éste</p>
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