<?php
	$modalid = random_string('alnum', 16);
	$curuser = $this->session->userdata('user');
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
<?php if ($users): ?>
<?php foreach ($users as $user): ?>
<?php
	$itemid = random_string('alnum', 16);
?>
<div class="col-md-4" id="<?php echo $itemid; ?>">
	<!-- /.widget-user -->
	<div class="box box-widget widget-user-2">
		<!-- Add the bg color to the header using any of the bg-* classes -->
		<div class="dropdown pull-right">
			<a class="dropdown-toggle description-text" data-toggle="dropdown" href="#" aria-expanded="false"><i class="fa fa-gear"></i></a>
			<ul class="dropdown-menu">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('admin/user/view/'.$user->id); ?>">Ver perfil</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('admin/user/edit/'.$user->id); ?>">Editar</a></li>
				<?php if ($curuser['id'] !== $user->id): ?><li role="presentation"><a class="toggle-user-access-menu-item toggle-user-access" role="menuitem" tabindex="-1" href="#!" data-reference-table="user" data-reference-id="<?php echo $user->id; ?>" data-access="<?php echo $user->status; ?>">Bloquear</a></li>
				<li role="presentation"><a class="delete-data" role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-table-reference="user" data-value-id="<?php echo $user->id; ?>" data-target="<?php echo '#'.$modalid ?>">Eliminar</a></li>
				<?php endif ?>
			</ul>
		</div>
		<div class="widget-user-header bg-light-blue"><a class="txt-white" href="<?php echo base_url('admin/user/view/'.$user->id); ?>">
			<div class="widget-user-image">
				<?php if (is_file(IMGPROFILEPATH.$user->avatar)): ?>
				<img class="img-circle" src="<?php echo base_url(IMGPROFILEPATH.$user->avatar); ?>" alt="User Avatar">
				<?php endif ?>
			</div></a>
			<!-- /.widget-user-image -->
			<h3 class="widget-user-username"><a class="txt-white" href="<?php echo base_url('admin/user/view/'.$user->id); ?>"><?php echo $user->username ?></a></h3>
			<h5 class="widget-user-desc"><?php echo $user->nombre.' '.$user->apellido ?>
			<?php if ($curuser['id'] !== $user->id): ?>
			<a href="#!" class="toggle-user-access txt-white" data-reference-table="user" data-reference-id="<?php echo $user->id; ?>" data-access="<?php echo $user->status; ?>">
				<?php if ($user->status === '1'): ?>
				<i class="fa fa-unlock-alt user-status-icon" data-toggle="tooltip" data-original-title="Acceso Permitido"></i>
				<?php else: ?>
				<i class="fa fa-lock user-status-icon" data-toggle="tooltip" data-original-title="Acceso Bloqueado"></i>
				<?php endif ?>
			</a>
			<?php endif ?>
			</h5>
		</div>
		<div class="box-footer no-padding">
			<ul class="nav nav-stacked">
				<li><a href="<?php echo $user->user_group->name ?>">Nivel <span class="pull-right"><?php echo $user->user_group->name ?></span></a></li>
				<li><a href="mailto:<?php echo $user->email ?>">Email <span class="pull-right"><?php echo $user->email ?></span></a></li>
				<li><a href="tel:<?php echo $user->telefono; ?>">Teléfono <span class="pull-right"><?php echo $user->telefono; ?></span></a></li>
				<li><a href="#">Ultima vez <span class="pull-right"><?php echo $user->lastseen->format('d M Y H:i'); ?></span></a></li>
			</ul>
		</div>
	</div>
</div>
<?php endforeach ?>
<?php else: ?>
No hay más cobradores registrados
<?php endif ?>
<div class="modal fade" id="<?php echo $modalid; ?>" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Eliminar cobradores</h4>
			</div>
			<div class="modal-body">
				<p>Esta accion eliminará el cobradores y todos los datos relacionados con éste</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" data-delete-data="run" data-dismiss="modal">Continuar</button>
			</div>
		</div>
	</div>
</div>