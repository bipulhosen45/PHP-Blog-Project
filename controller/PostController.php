<?php


class PostController
{

    private $db;

    public function __construct()
    {
        $this->db  = new Database();
    }

    public function allPost()
    {
        $sql = "SELECT posts.*,category.name as CatName,admin.name as adminName FROM posts INNER JOIN category ON posts.category_id=category.id INNER JOIN admin ON posts.admin_id=admin.id WHERE posts.status=true ORDER BY id DESC LIMIT 6";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function postDetail($slug)
    {
        $sql = "SELECT posts.*,category.name as CategoryName, admin.name as adminName FROM posts INNER JOIN category ON posts.category_id = category.id INNER JOIN admin ON posts.admin_id =admin.id WHERE posts.slug=:slug";
        $this->db->query($sql);
        $this->db->bind(":slug", $slug);
        $this->db->execute();
        return $this->db->single();
    }

    public function recentPost($id)
    {
        /*post details page show recent post without requested id*/
        $sql = "SELECT * FROM posts WHERE NOT id=:postId";
        $this->db->query($sql);
        $this->db->bind(":postId", $id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function categoryPost($categorySlug)
    {
        /*select category first*/
        $sql = "SELECT * FROM category WHERE slug=:slug";
        $this->db->query($sql);
        $this->db->bind(":slug", $categorySlug);
        $this->db->execute();
        $category = $this->db->single();
        /*get Category post by category id*/

        $sql = "SELECT posts.*,category.name as CatName,admin.name as adminName FROM posts INNER JOIN category ON posts.category_id=category.id INNER JOIN admin ON posts.admin_id=admin.id WHERE posts.status=true AND posts.category_id=:categoryId ORDER BY id DESC LIMIT 6";
        $this->db->query($sql);
        $this->db->bind(":categoryId", $category->id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function tagPost($tagSlug)
    {
        /*select tag  first*/
        $sql = "SELECT * FROM tag WHERE slug=:slug";
        $this->db->query($sql);
        $this->db->bind(":slug", $tagSlug);
        $this->db->execute();
        $tag = $this->db->single();
        /*get Tag post by tag id*/

        $sql = "SELECT posts.*,category.name as CatName,admin.name as adminName FROM posts INNER JOIN category ON posts.category_id = category.id INNER JOIN admin ON posts.admin_id = admin.id JOIN post_tag ON posts.id = post_tag.post_id WHERE post_tag.tag_id=:tagId ORDER BY posts.id DESC LIMIT 6";
        $this->db->query($sql);
        $this->db->bind(":tagId", $tag->id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    /* for search */
    public function searchPost($find)
    {
        $searchString = "%$find%";
        $sql = "SELECT posts.*,category.name as CatName,admin.name as adminName FROM posts INNER JOIN category ON posts.category_id=category.id INNER JOIN admin ON posts.admin_id=admin.id WHERE posts.status=true AND title LIKE :title OR description LIKE :description";
        $this->db->query($sql);
        $this->db->bind(":title", $searchString);
        $this->db->bind(":description", $searchString);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
