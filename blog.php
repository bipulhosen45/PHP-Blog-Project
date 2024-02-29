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
  <div class="heading-page header-text">
    <section class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-content">
              <h4>Recent Posts</h4>
              <h2>Our Recent Blog Entries</h2>
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
              <!-- Post search query -->
              <?php
                    if (isset($_GET['search'])){
                      $search = $helper->validate($_GET['search']);
                      if(empty($search)){
                        $error['searchError'] = "Please write somthing...";
                      }
                      if(empty($error['searchError'])){
                        $searchPosts = $post->searchPost($search);
                        // print_r($searchPosts);
                      }
                    }
                    ?>


              <?php
              if (isset($_GET['category'])) {
                $category = $_GET['category'];
                $posts = $post->categoryPost($category);
              } elseif (isset($_GET['tag'])) {
                $tag = $_GET['tag'];
                $posts = $post->tagPost($tag);
              }elseif(isset($searchPosts)){
                $posts = $searchPosts;
              }
              else {
                $posts = $post->allPost();
              }

              if (!empty($posts)) {
                foreach ($posts as $post) { ?>
                  <div class="col-lg-6">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="admin/<?php echo $post->image; ?>" alt="">
                      </div>
                      <div class="down-content">
                        <span><?php echo $post->CatName; ?>"</span>
                        <a href="post-details.php?slug=<?php echo $post->slug; ?>">
                          <h4><?php echo $post->title; ?>"</h4>
                        </a>
                        <ul class="post-info">
                          <li><a href="#"><?php echo $post->adminName; ?>"</a></li>
                          <li><a href="#"> <?php
                                            $date = date_create($post->created_at);
                                            echo date_format($date, "F d, Y");
                                            ?></a></li>
                        </ul>

                        <div class="post-options">
                          <div class="row">
                            <div class="col-lg-12">
                              <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                <?php
                                $postId = $post->id;
                                $postTags = $home->postTag($postId);
                                if ($postTags != null) {
                                  foreach ($postTags as $postTag) { ?>
                                    <li><a href="blog.php?tag=<?php echo $postTag->slug; ?>"><?php echo $postTag->name ?></a>,</li>
                                <?php       }
                                }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php
                }
              } else {
                echo "No blog posts found!";
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <div class="row">
              <div class="col-lg-12">
                <div class="sidebar-item">
               
                  <form id="search_form" name="gs" method="GET" action="#">
                    <!-- <input type="text" name="search" class="searchText" placeholder="type to search..." autocomplete="on">
                    <button type="button" class="btn btn-outline-success mt-3 btn-xs">Search</button> -->                   
                    <div class="input-group mb-3">
                      <input type="text" name="search" class="form-control" placeholder="type to search...">
                      <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fa fa-search"></i> Search</button>
                      </div>
                    </div>
                    <span class="text-danger" ><?php echo $error['searchError'] ??''; ?></span>
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
                      if ($categories != null) {
                        foreach ($categories as $category) { ?>
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
                      if ($tags != null) {
                        foreach ($tags as $tag) { ?>
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


  <?php
  include "./layout/footer.php";
  include "./layout/_script.php";

  ?>

</body>

</html>