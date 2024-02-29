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
                        <h1 class="m-0">Posts/News</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">post/news</li>
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
                                <h5>Posts</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="addPost.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Post</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])){
                            $id = $_GET['id'];
                            echo $id;
                            $deletePost =  $post->delete($id);
                            if ($deletePost){
                                echo $deletePost;
                                echo '<meta http-equiv="refresh" content="1;url=post.php" />';
                            }
                        }
                        ?>
                        <table class="table table-bordered" id="category">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $posts = $post->index();
                            if ($posts !=null){
                                $i =1;
                                foreach ($posts as $post)   {?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $post->title;?></td>
                                        <td><?php echo $post->CategoryName;?></td>
                                        <td><?php echo $post->adminName;?></td>
                                        <td><?php echo $post->created_at;?></td>
                                        <td><?php
                                            if ($post->status == true){
                                                echo '<span class="badge badge-success">Published</span>';
                                            }else{
                                                echo '<span class="badge badge-warning">Draft</span>';
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <a href="post_details.php?id=<?php echo $post->id;?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                            <a href="editPost.php?id=<?php echo $post->id;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure delete?')" href="post.php?id=<?php echo $post->id;?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
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
