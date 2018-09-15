<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Todos los clientes registrados</h3>
      </div>
      <div class="box-body">
        <?php if ($clientes): ?>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <?php if ($this->session->userdata('user')['level'] < 3): ?>
              <th class="hidden-xs">Registrado por</th>
            <?php endif ?>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th class="hidden-xs">Identificación</th>
            <th class="hidden-xs">Registro</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($clientes as $key => $cliente): ?>
            <tr>
              <?php if ($this->session->userdata('user')['level'] < 3): ?>
              <td class="hidden-xs"><a href="<?php echo base_url('admin/user/view/'.$cliente['id_user_register']); ?>"><?php echo $cliente['username'] ?></a></td>
            <?php endif ?>
              <td><a href="<?php echo base_url('admin/prestamo/cliente/'.$cliente['id']); ?>"><?php echo $cliente['nombre'].' '.$cliente['apellido'] ?></a></td>
              <td><?php echo $cliente['direccion'] ?></td>
              <td><?php echo $cliente['telefono'] ?></td>
              <td class="hidden-xs"><?php echo $cliente['identificacion'] ?></td>
              <td class="hidden-xs"><?php echo $cliente['registerdate'] ?></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php else: ?>
          No hay clientes registrados, <a href="<?php echo base_url('admin/prestamo/clientes/nuevo') ?>">Registrar nuevo</a>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>