<?php
include "layout/head.php";
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <?php
    include "layout/top_navbar.php";
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include "layout/_left_sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Categories</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="addCategory.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                            if (isset($_GET['delete'])){
                                $id = $_GET['delete'];
                              $deleteCategory =  $category->destory($id);
                              if ($deleteCategory){
                                  echo $deleteCategory;
                                   echo '<meta http-equiv="refresh" content="1;url=category.php" />';
                              }
                            }
                        ?>
                        <table class="table table-bordered" id="category">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Category</th>
                                <th>slug</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $categories = $category->index();
                            if ($categories !=null){
                                $i=1;
                                foreach ($categories as $category){?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $category->name; ?></td>
                                        <td><?php echo $category->slug; ?></td>
                                        <td width="10%">
                                            <a href="editCategory.php?id=<?php echo $category->id; ?>" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a onclick="return confirm('Are you sure to delete?')" href="?delete=<?php echo $category->id; ?>" class="btn btn-danger">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php     }
                            }

                            ?>



                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <?php
    include "layout/footer.php";
    ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php
include "layout/_main_script.php";
?>

<!-- page require js load here... -->
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $('#category').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>
