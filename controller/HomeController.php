<?php


class HomeController
{
    private $db;

    public function __construct()
    {
        $this->db  = new Database();
    }

    public function index()
    {
        $sql ="SELECT posts.*,category.name as CatName,admin.name as adminName FROM posts INNER JOIN category ON posts.category_id=category.id INNER JOIN admin ON posts.admin_id=admin.id WHERE posts.status=true ORDER BY id DESC LIMIT 3";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getLatestSliderPost()
    {
        $sql ="SELECT posts.id,posts.title,posts.image,posts.slug,posts.created_at,category.name as CatName,admin.name as adminName FROM posts INNER JOIN category ON posts.category_id=category.id INNER JOIN admin ON posts.admin_id=admin.id WHERE posts.status=true ORDER BY id DESC LIMIT 6";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();
    }
    public function postTag($id)
    {
        $sql ="SELECT tag.* FROM tag JOIN post_tag ON tag.id = post_tag.tag_id WHERE post_tag.post_id=:postId";
        $this->db->query($sql);
        $this->db->bind(":postId",$id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function category()
    {
        $sql = "SELECT * FROM category";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();

    }
    public function tag()
    {
        $sql = "SELECT * FROM tag";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->resultSet();

    }
}