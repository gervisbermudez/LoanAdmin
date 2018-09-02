<?php if ($relations): ?>
	<ul class="timeline timeline-inverse">
	<?php foreach ($relations as $key => $value): ?>
	<?php
		$curdate = new DateTime();
		$curdate = DateTime::createFromFormat('Y-m-d H:i:s', $value['date_rel']);
		$antDate = new DateTime();
		$interval = $curdate->diff($antDate);
		
	?>
		<?php if($value['tiperel'] === 'user'): ?>
			<?php if ($interval->d > 1): ?>
			<li class="time-label">
				<span class="bg-blue">
					<?php echo $curdate->format('d M Y') ?>
				</span>
			</li>
			<?php 
			$antDate = $curdate;
			?>
			<?php endif ?>
			<li>
			<i class="fa fa-users bg-aqua"></i>
			<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> <?php echo $curdate->format('H:i:s') ?></span>
			<h3 class="timeline-header no-border">
				<a href="<?php echo base_url('admin/user/view/'.$value['id']); ?>"><?php echo $value['username'] ?></a> ha sido creado</h3>
			</div>
			</li>
		<?php endif ?>
		<?php if($value['tiperel'] === 'prestamos_clientes'): ?>
			<?php if ($interval->d > 1): ?>
			<li class="time-label">
				<span class="bg-blue">
					<?php echo $curdate->format('d M Y') ?>
				</span>
			</li>
			<?php 
			$antDate = $curdate;
			?>
			<?php endif ?>
			<li>
			<i class="fa fa-user-plus bg-yellow"></i>
			<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> <?php echo $curdate->format('H:i:s') ?></span>
			<h3 class="timeline-header no-border">
				<?php echo $value['user_rel'] ?> ha agregado a <a href="<?php echo base_url('admin/prestamo/cliente/'.$value['id']); ?>"> <?php echo $value['nombre'].' '.$value['apellido'] ?></a> como cliente
				 </h3> 
			</div>
			</li>
		<?php endif ?>
	<?php endforeach ?>
		<li><i class="fa fa-clock-o bg-gray"></i></li>
	</ul>
<?php endif ?>