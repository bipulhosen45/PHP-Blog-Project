<?php


class Post
{
    use Notify,SlugHelper;

    private $db;

    public function __construct()
    {
        $this->db  = new Database();
    }

    public function index()
    {
        $sql = "SELECT posts.id,posts.title,posts.status,posts.created_at,category.name as CategoryName,admin.name as adminName
FROM posts INNER JOIN category ON posts.category_id = category.id INNER JOIN admin ON posts.admin_id = admin.id ORDER BY posts.id";
        $this->db->query($sql);
        $this->db->execute();
        return  $this->db->resultSet();
    }

    public function store($data,$image)
    {
        try {

            $postImageName    = $_FILES['post_image']['name'];
            $postImageTmpName = $_FILES['post_image']['tmp_name'];
            $ext       = strtolower(pathinfo($postImageName,PATHINFO_EXTENSION));
            $imageName = time().uniqid().'.'.$ext;
            $uploadDir ='uploads/post/';
            $uploadAbleImage = $uploadDir.$imageName;
            move_uploaded_file($postImageTmpName,$uploadAbleImage);

            $currentDateTime = date('Y-m-d h:i:s');
            $userId          = $_SESSION['user_id'];

            $slug = $this->str_slug($data['post_title']);

            $sql ="INSERT INTO posts(admin_id, category_id, title,slug, description, image, status, created_at, updated_at) VALUES (:adminId,:categoryId,:title,:slug,:description,:postImage,:status,:createTime,:updateTime)";
            $this->db->query($sql);
            $this->db->bind(":adminId",$userId);
            $this->db->bind(":categoryId",$data['category']);
            $this->db->bind(":title",$data['post_title']);
            $this->db->bind(":slug",$slug);
            $this->db->bind(":description",$data['description']);
            $this->db->bind(":postImage",$uploadAbleImage);
            $this->db->bind(":status",$data['status']);
            $this->db->bind(":createTime",$currentDateTime);
            $this->db->bind(":updateTime",$currentDateTime);
            $this->db->execute();
            $lastInsertId = $this->db->lastInsertId();

            if (isset($lastInsertId)){
                foreach ( $data['tags'] as $tag) {
                    $sql = 'INSERT INTO post_tag(post_id,tag_id)VALUES (:postId,:tagId)';
                    $this->db->query($sql);
                    $this->db->bind(":postId",$lastInsertId);
                    $this->db->bind(":tagId",$tag);
                    $this->db->execute();
                }
            }
            if (isset($lastInsertId)){
                return $this->successNotify('Post insert successfully');
            }else{
                return $this->errorNotify('Post insert failed');
            }

        }catch (PDOException $exception){
            echo $this->errorNotify($exception->getMessage());
        }
    }

    public function show($id)
    {
        $sql = "SELECT posts.*,category.name as CategoryName,admin.name as adminName FROM posts INNER JOIN category ON posts.category_id = category.id INNER JOIN admin ON posts.admin_id = admin.id WHERE posts.id=:postId";
        $this->db->query($sql);
        $this->db->bind(":postId",$id);
        $this->db->execute();
        return  $this->db->single();
    }

    public function edit($id)
    {
        $sql ="SELECT * FROM posts WHERE id=:postId";
        $this->db->query($sql);
        $this->db->bind(":postId",$id);
        $this->db->execute();
        return $this->db->single();

    }
    public function update($data,$image)
    {
        try {

            $postImageName    = $_FILES['post_image']['name'];
            $postImageTmpName = $_FILES['post_image']['tmp_name'];
            if ($postImageName){
                $ext       = strtolower(pathinfo($postImageName,PATHINFO_EXTENSION));
                $imageName = time().uniqid().'.'.$ext;
                $uploadDir ='uploads/post/';
                $uploadAbleImage = $uploadDir.$imageName;
                unlink($data['postOldImage']);
                move_uploaded_file($postImageTmpName,$uploadAbleImage);
            }else{
                $uploadAbleImage = $data['postOldImage'];
            }


            $currentDateTime = date('Y-m-d h:i:s');
            $userId          = $_SESSION['user_id'];

            $slug = $this->str_slug($data['post_title']);

            $sql ="UPDATE posts SET admin_id=:adminId, category_id=:categoryId, title=:title,slug=:slug, description=:description, image=:postImage, status=:status,updated_at=:updateTime WHERE id=:postId";
            $this->db->query($sql);
            $this->db->bind(":adminId",$userId);
            $this->db->bind(":categoryId",$data['category']);
            $this->db->bind(":title",$data['post_title']);
            $this->db->bind(":slug",$slug);
            $this->db->bind(":description",$data['description']);
            $this->db->bind(":postImage",$uploadAbleImage);
            $this->db->bind(":status",$data['status']);
            $this->db->bind(":updateTime",$currentDateTime);
            $this->db->bind(":postId",$data['postId']);
            if ( $this->db->execute()){
                return $this->successNotify('Post update successfully');
            }else{
                return $this->errorNotify('Post update failed');
            }

        }catch (PDOException $exception){
            echo $this->errorNotify($exception->getMessage());
        }
    }

    public function delete($id)
    {
        /*select post for delete post image*/
        $sql = "SELECT * FROM posts WHERE id=:postId";
        $this->db->query($sql);
        $this->db->bind(":postId",$id);
        $this->db->execute();
        $post =$this->db->single();
        if (isset($post)){
            unlink($post->image);
        }

        /*delete record*/
        $sql = "DELETE FROM posts WHERE id=:postId";
        $this->db->query($sql);
        $this->db->bind(":postId",$id);
        if ( $this->db->execute()){
            return $this->successNotify('Post delete successfully');
        }else{
            return $this->errorNotify('Post delete failed');
        }

    }
    public function postTag($id)
    {
        $sql ="SELECT tag.* FROM tag JOIN post_tag ON tag.id = post_tag.tag_id WHERE post_tag.post_id=:postId";
        $this->db->query($sql);
        $this->db->bind(":postId",$id);
        $this->db->execute();
        return $this->db->resultSet();
    }
}