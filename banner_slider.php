<?php
$sliderPosts = $home->getLatestSliderPost();

?>

<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            <?php
            if ($sliderPosts  !=null){
                foreach ($sliderPosts as $sliderPost){?>
                    <div class="item">
                        <img src="admin/<?php echo $sliderPost->image; ?>" alt="">
                        <div class="item-content">
                            <div class="main-content">
                                <div class="meta-category">
                                    <span><?php echo $sliderPost->CatName; ?></span>
                                </div>
                                <a href="post-details.php?slug=<?php echo $sliderPost->slug; ?>"><h4><?php echo $sliderPost->title; ?></h4></a>
                                <ul class="post-info">
                                    <li><a href="#"><?php echo $sliderPost->adminName; ?></a></li>
                                    <li><a href="#">
                                            <?php
                                            $date=date_create($sliderPost->created_at);
                                            echo date_format($date,"F d, Y");
                                            ?>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>




        </div>
    </div>
</div>