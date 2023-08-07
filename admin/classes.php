<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php

if (isset($_POST['submit'])) {


  $title = $_POST['title'];
  $sections = implode(',', $_POST['section']);
  $added_date = date("Y-m-d");
  mysqli_query($db_conn, "INSERT INTO classes (title,section,added_date) VALUE ('$title','$sections','$added_date')") or die('DB Error');
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Classes</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin </a></li>
            <li class="breadcrumb-item active">classes </li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>

  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php

      if (isset($_REQUEST['action'])) {
      ?>

        <!-- Info boxes -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Add New Class </h3>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <label for="title">Title</label>
              <div class="form-group">
                <input type="text" name="title" placeholder="title" required class="form-control">
              </div>
              <div class="form-group">
                <label for="section">Section</label>
                <?php
                $query = mysqli_query($db_conn, 'SELECT * FROM sections');
                $count = 1;

                while ($sections = mysqli_fetch_object($query)) {
                ?>
                  <div>
                    <label for="<?= $count ?>">
                      <input type="checkbox" id="<?= $count ?>" value="<?= $sections->id ?>" name="section[]" placeholder="section">
                      <?= $sections->title ?>
                    </label>
                  </div>
                <?php
                  $count++;
                }
                ?>
              </div>
              <button name="submit" class="btn btn-success"> Submit </button>
            </form>
          </div>
        </div>
        <!-- /.row -->

      <?php } else { ?>

        <!-- Info boxes -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Classes </h3>
            <div class="card-tools"> <a href="?action=add-new" class="btn btn-success btn-sm"><i class="fa fa-plus mr-2"></i>Add New</a> </div>
          </div>
          <div class="card-body">
            <div class="table-responsive bg-white">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                  $args = array(
                    'type' => 'class',
                    'status' => 'publish',
                  );
                  $classes = get_posts($args);
                  foreach ($classes as $class) { ?>
                    <tr>
                      <td><?= $count++ ?></td>
                      <td><?= $class->title ?></td>
                      <td>



                        <?php
                        $class_meta = get_metadata($class->id, 'section');
                        //   $sections = explode(',', $clas->section);
                        foreach ($class_meta as $meta) {
                          $section = get_post(array('id' => $meta->meta_value));
                          echo $section->title;
                        } ?>


                      </td>
                      <td> <?= $class->publish_date ?></td>
                      <td> </td>
                    </tr>
                  <?php  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->
      <?php } ?>
    </div>
    <!-- /.row -->
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->

  <?php include('footer.php') ?>