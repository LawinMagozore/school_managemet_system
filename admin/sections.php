<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<?php

if (isset($_POST['submit'])) {


  $title = $_POST['title'];
  mysqli_query($db_conn, "INSERT INTO sections (title) VALUE ('$title')") or die('dffsfv');
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Sections</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin </a></li>
            <li class="breadcrumb-item active">Sections </li>
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
      <div class="row">
        <div class="col-lg-8">
          <!-- Info boxes -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Section </h3>
            </div>
            <div class="card-body">
              <div class="table-responsive bg-white">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $count = 1;
                    $args = array(
                      'type' => 'section',
                      'status' => 'publish',
                    );
                    $sections = get_posts($args);
                    foreach ($sections as $section) {
                    ?>
                      <tr>
                        <td><?= $count++ ?></td>
                        <td><?= $section->title ?></td>
                        <td></td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Info boxes -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Add New Section </h3>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <label for="title">Title</label>
                <div class="form-group">
                  <input type="text" name="title" placeholder="title" required class="form-control">
                </div>
                <button name="submit" class="btn btn-success float-right"> Submit </button>
              </form>
            </div>
          </div>
        </div>
        </di>
      </div>
      <!-- /.row -->
      <!--/. container-fluid -->
  </section>
  <!-- /.content -->

  <?php include('footer.php') ?>