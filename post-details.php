<?php
include "./layout/head.php";
?>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <?php
    include "./layout/header.php";
    ?>

    <?php
    if (isset($_GET['slug'])) {
        $slug = $_GET['slug'];
        $singlePost = $post->postDetail($slug);
    }
    ?>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4><?php echo $singlePost->CategoryName ?? ''; ?></h4>
                            <h2><?php echo $singlePost->title ?? ''; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Banner Ends Here -->


    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="admin/<?php echo $singlePost->image ?? ''; ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span><?php echo $singlePost->CategoryName ?? ''; ?></span>
                                        <a href="javascript:void(0)">
                                            <h4><?php echo $singlePost->title ?? ''; ?></h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="#"><?php echo $singlePost->adminName ?? ''; ?></a></li>
                                            <li><a href="#">
                                                    <?php
                                                    $date = date_create($singlePost->created_at);
                                                    echo date_format($date, "F d, Y");
                                                    ?>
                                                </a>
                                            </li>
                                        </ul>
                                        <p>
                                            <?php echo html_entity_decode($singlePost->description); ?>
                                        </p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i></li>
                                                        <li><a href="#">
                                                                <?php
                                                                $postId = $singlePost->id;
                                                                $postTags = $home->postTag($postId);
                                                                if ($postTags != null) {
                                                                    foreach ($postTags as $postTag) { ?>
                                                        <li><a href="blog.php?tag=<?php echo $postTag->slug; ?>"><?php echo $postTag->name ?></a>,</li>
                                                            <?php       }
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
                            <div class="col-lg-12">
                                <div class="sidebar-item comments">
                                    <div class="sidebar-heading">
                                        <h2>4 comments</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <li>
                                                <div class="">
                                                    <h4>Charles Kate</h4>
                                                    <p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla condimentum eu quis leo. Vestibulum id turpis porttitor sapien facilisis scelerisque. Curabitur a nisl eu lacus convallis eleifend posuere id tellus.</p>
                                                </div>
                                            </li>
                                            <li class="replied">
                                                <div class="">
                                                    <h5>Mr. Admin</h5>
                                                    <p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar vel mattis eget.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="col-lg-12">
                                <div class="sidebar-item submit-comment">
                                    <div class="sidebar-heading">
                                        <h2>Your comment</h2>
                                    </div>
                                    <div class="content">
                                        <form id="comment" action="#" method="post">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <input name="name" type="text" id="name" placeholder="Your name" required="">
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <input name="email" type="text" id="email" placeholder="Your email" required="">
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <button type="submit" id="form-submit" class="main-button">Submit</button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php
                    include "post_sidebar.php";
                    ?>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="all-blog-posts">
                        <div class="sidebar-heading">
                            <h2>Related Posts</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="assets/images/blog-thumb-06.jpg" alt="">
                                    </div>
                                    <div class="down-content p-3">
                                        <a href="post-details.html">
                                            <h4>Mauris ac dolor ornare</h4>
                                        </a>
                                        <p class="p-0 border-bottom-0">Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="assets/images/blog-thumb-06.jpg" alt="">
                                    </div>
                                    <div class="down-content p-3">
                                        <a href="post-details.html">
                                            <h4>Mauris ac dolor ornare</h4>
                                        </a>
                                        <p class="p-0 border-bottom-0">Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="assets/images/blog-thumb-06.jpg" alt="">
                                    </div>
                                    <div class="down-content p-3">
                                        <a href="post-details.html">
                                            <h4>Mauris ac dolor ornare</h4>
                                        </a>
                                        <p class="p-0 border-bottom-0">Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="assets/images/blog-thumb-06.jpg" alt="">
                                    </div>
                                    <div class="down-content p-3">
                                        <a href="post-details.html">
                                            <h4>Mauris ac dolor ornare</h4>
                                        </a>
                                        <p class="p-0 border-bottom-0">Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
    include "./layout/footer.php";
    include "./layout/_script.php";

    ?>

</body>

</html>