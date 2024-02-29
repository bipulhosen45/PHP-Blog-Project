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
                        <h1 class="m-0">Post Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Post Details</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="post.php" class="btn btn-danger"><i class="fa fa-reply"></i> Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])){
                            $id = $_GET['id'];
                            $row = $post->show($id);
                        }
                        ?>
                        <div class="blog-post">
                            <div class="blog-thumb">
                                <img class="w-50" src="<?php echo  $row->image;?>" alt="">
                            </div>
                            <div class="down-content">
                                <span><?php echo  $row->CategoryName;?></span>
                                <a href=""><h4><?php echo  $row->title;?></h4></a>
                                <ul class="list-unstyled nav">
                                    <li><a href="#"><?php echo  $row->adminName;?></a></li>
                                    |
                                    <li><a href="#">
                                            <?php
                                            $date=date_create( $row->created_at);
                                            echo date_format($date,"F d, Y");
                                            ?>
                                        </a></li>
                                </ul>
                                <p><?php echo html_entity_decode( $row->description) ;?></p>
                                <div class="post-options">
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="nav">
                                            <li class="mr-1"><i class="fa fa-tags"></i></li>
                                                <?php
                                                $postId = $row->id;
                                                $postTags = $post->postTag($postId);
                                                if($postTags !=null){
                                                    foreach ($postTags as $postTag){?>
                                                        <li><a href="#"><?php echo $postTag->name; ?></a>,</li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col-6">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="assets/dropify/dist/js/dropify.min.js"></script>
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>

<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>

<script>
    $('.dropify').dropify()
    $('#description').summernote({
        height:300
    })

    $('.select2').select2();
</script>
</body>
</html>
