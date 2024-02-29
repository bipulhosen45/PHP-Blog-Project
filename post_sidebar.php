<div class="sidebar">
    <div class="row">
       
        <div class="col-lg-12">
            <div class="recent-posts">
                <div class="sidebar-heading">
                    <h2>Recent Posts</h2>
                </div>
                <div class="content">
                    <ul>
                        <?php
                        $latestPosts = $post->recentPost($singlePost->id);
                        if ($latestPosts !=null){
                        foreach ($latestPosts as $latestPost){?>
                        <li><a href="post-details.php?slug=<?php echo $latestPost->slug;?>">
                                <h5><?php echo $latestPost->title??''?></h5>
                                <span>
                                                     <?php
                                                     $date=date_create($latestPost->created_at);
                                                     echo date_format($date,"F d, Y");
                                                     ?>
                                                </span>
                            </a></li>
                        <li>

                            <?php
                            }}
                            ?>


                    </ul>
                </div>
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
                    <h2>Tag Clouds</h2>
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