<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo $h1 ?>
    <small><?php echo $pagedescription; ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol> -->
    <?php echo $breadcrumb; ?>
  </section>
  <!-- Main content -->
  <section class="content">
  <?php if (isset($page)): ?>
    <?php echo $page ?>
  <?php endif ?>
  </section>
  <!-- /.content -->
</div>