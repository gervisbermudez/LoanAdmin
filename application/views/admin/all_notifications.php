<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Notificaciones</h3>
      </div><!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <?php if ($notificacions): ?>
          <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Estatus</th>
          </tr>
          <?php 
            $status = array('Primary' => '', 
                            'Info' => 'label-primary',
                            'Success' => 'label-success',
                            'Warning' => 'label-warning',
                            'Danger' => 'label-danger'
                            );
           ?>
          <?php foreach ($notificacions as $key => $notificacion): ?>
            <tr>
              <td><?php echo $notificacion['id'] ?></td>
              <td><?php echo $notificacion['description'] ?></td>
              <td><?php echo $notificacion['fecha'] ?></td>
              <td><span class="label <?php echo $status[$notificacion['type']]; ?>"><?php echo $notificacion['type'] ?></span></td>
              <td><?php if ($notificacion['isread']): ?>
               <i class="fa fa-fw fa-check-circle-o"></i> Vista
              <?php else: ?>
              <i class="fa fa-fw fa-circle"></i> No vista
              <?php endif ?>
             </td>
            </tr>
          <?php endforeach ?>
        </table>
        <?php else: ?>
        Aun no se han registrado notificaciones
        <?php endif ?>
      </div>
    </div>
  </div>
</div>