<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Calendario</h3>
      </div><!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
       <!-- Main content -->
        <section class="content">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </section>
      </div>
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