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
                        <h1 class="m-0">Post</h1>
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
                                <h5>Post Create</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="post.php" class="btn btn-danger"><i class="fa fa-reply"></i> Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php




                        if (isset($_POST['submit'])){
                            $data =[
                                'category'      => $_POST['category'],
                                'post_title'    => $helper->validate($_POST['post_title']),
                                'description'   => $helper->validate($_POST['description']),
                                'postImageName' => $_FILES['post_image']['name'],
                                'tags'          => @$_POST['tag'],
                                'status'        => $_POST['status'],
                            ];

                            if (empty($data['category'])){
                                $error['category'] ="Category is required";
                            }
                            if (empty($data['post_title'])){
                                $error['post_title'] ="Post title is required";
                            }
                            if (empty($data['description'])){
                                $error['description'] ="Description is required";
                            }
                            if (empty($data['postImageName'])){
                                $error['post_image'] ="Post Image is required";
                            }
                            if (empty($data['tags'])){
                                $error['tag'] ="Tags is required";
                            }

                            if (empty($error['category']) && empty( $error['post_title']) && empty($error['description']) && empty($error['post_image']) && empty( $error['tag'])) {
                                $insertPost = $post->store($data,$_FILES);
                                if ($insertPost){
                                    echo $insertPost;
                                }
                            }

                        }

                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="p-4" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="category">Select Category <span class="text-danger">*</span></label>
                                        <select name="category" id="category" class="form-control select2">
                                            <option value="">Select Category</option>
                                            <?php
                                            $categories = $category->index();
                                            foreach ($categories as $category){?>
                                                <option value="<?php echo $category->id?>"><?php echo $category->name; ?></option>
                                            <?php     }
                                            ?>
                                        </select>
                                        <span class="text-danger d-block">
                                            <?php echo $error['category']??''; ?>
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="post_title">Post Title <span class="text-danger">*</span></label>
                                        <input type="text" name="post_title" class="form-control" id="post_title">
                                        <span class="text-danger d-block">
                                            <?php echo $error['post_title']??''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Post Description <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control" id="description"></textarea>
                                        <span class="text-danger d-block">
                                            <?php echo $error['description']??''; ?>
                                        </span>
                                    </div>


                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="post_image">Post Feature Image <span class="text-danger">*</span></label>
                                        <input type="file" name="post_image"  data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg webp" class="form-control dropify" id="post_image">
                                        <span class="text-danger d-block">
                                           <?php echo $error['post_image']??''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag">Select Tags <span class="text-danger">*</span></label>
                                        <select name="tag[]" id="tag" class="form-control select2" multiple>
                                            <option value="" disabled>Select Tags</option>
                                            <?php
                                            $tags = $tag->index();
                                            foreach ($tags as $tag){?>
                                                <option value="<?php echo $tag->id?>"><?php echo $tag->name; ?></option>
                                            <?php     }
                                            ?>
                                        </select>
                                        <span class="text-danger d-block">
                                            <?php echo $error['tag']??''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <br>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="status"  value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline1">Published</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" checked name="status" value="0" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline2">Draft</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center mt-3">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </form>

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
