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
                        <h1 class="m-0">Tag</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">tag</li>
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
                                <h5>Tag Edit</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="tag.php" class="btn btn-danger"><i class="fa fa-reply"></i> Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">

                                <?php

                                if (isset($_POST['submit'])){

                                    $tag_name        = $helper->validate($_POST['tag_name']);
                                    $data['tagId']   = $_POST['tagId'];

                                    if (empty($tag_name)){
                                        $error['tag_name'] = "Tag name is required";
                                    }else{
                                        $data['tag_name'] = $tag_name;
                                    }

                                    if (empty($error['tag_name'])){
                                        $updateTag = $tag->udpate($data);
                                        if ($updateTag){
                                            echo $updateTag;
                                            echo '<meta http-equiv="refresh" content="1;url=tag.php" />';
                                        }
                                    }
                                }

                                ?>

                                <?php
                                /*get url requested category id*/
                                if (isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $tag = $tag->edit($id);

                                }
                                ?>
                                <form action="" method="post" class="p-4">
                                    <div class="form-group">
                                        <label for="tag_name">Tag Name</label>
                                        <input type="text" name="tag_name" value="<?php echo $tag->name??'';?>" class="form-control" id="tag_name">
                                        <span class="text-danger d-block">
                                            <?php echo $error['tag_name']??''; ?>
                                        </span>
                                    </div>
                                    <input type="hidden" name="tagId" value="<?php echo $tag->id??'';?>">
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
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



<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
