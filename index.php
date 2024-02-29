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

<!-- Page Content -->
<!-- Banner Starts Here -->
<?php
include "banner_slider.php";
?>
<!-- Banner Ends Here -->



<section class="blog-posts">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                $latestPosts = $home->index();
                if ($latestPosts !=null){
                foreach ($latestPosts as $latestPost){?>
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="admin/<?php echo $latestPost->image; ?>" alt="">
                    </div>
                    <div class="down-content">
                        <span><?php echo $latestPost->CatName; ?></span>
                        <a href="post-details.php?slug=<?php echo $latestPost->slug;?>">
                            <h4><?php echo $latestPost->title; ?></h4>
                        </a
                    </div>
                    <div class="post-meta">
                        <a href="#"><?php echo $latestPost->adminName; ?></a>
                        |
                        <?php
                        $date=date_create($latestPost->created_at);
                        echo date_format($date,"F d, Y");
                        ?>
                    </div>

                    <p>
                        <?php echo html_entity_decode($latestPost->description); ?>
                    </p>
                    <div class="post-options">
                        <div class="row">
                            <div class="col-12">
                                <ul class="post-tags">
                                    <li><i class="fa fa-tags"></i></li>
                                    <?php
                                    $postId = $latestPost->id;
                                    $postTags = $home->postTag($postId);
                                    if ($postTags !=null){
                                        foreach ($postTags as $postTag) {?>
                                            <li><a href="blog.php?tag=<?php echo $postTag->slug; ?>"><?php echo $postTag->name?></a>,</li>
                                        <?php       }
                                    }
                                    ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            }
            ?>

            <div class="main-button">
                <a href="blog.php">View All Posts</a>
            </div>

        </div><!--//.col-lg-8 end -->

        <div class="col-lg-4">
            <div class="sidebar">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sidebar-item search">
                            <form id="search_form" name="gs" method="GET" action="#">
                                <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="sidebar-item categories">
                            <div class="sidebar-heading">
                                <h2>Categories</h2>
                            </div>
                            <div class="content">
                                <ul>
                                    <?php
                                    $categories = $home->category();
                                    if ($categories !=null){
                                        foreach ($categories as $category) {?>
                                            <li><a href="blog.php?category=<?php echo $category->slug; ?>">- <?php echo $category->name; ?></a></li>
                                        <?php      }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="sidebar-item tags">
                            <div class="sidebar-heading">
                                <h2>Tags</h2>
                            </div>
                            <div class="content">
                                <ul>
                                    <?php
                                    $tags = $home->tag();
                                    if ($tags !=null){
                                        foreach ($tags as $tag) {?>
                                            <li><a href="blog.php?tag=<?php echo $tag->slug; ?>">- <?php echo $tag->name; ?></a></li>
                                        <?php      }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>


<!--footer-->
<?php
include "./layout/footer.php";
include "./layout/_script.php";
?>


</body>
</html>