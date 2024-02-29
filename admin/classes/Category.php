<?php


class Category
{
    use Notify,SlugHelper;

    private $db;

    public function __construct()
    {
        $this->db  = new Database();
    }

    public function index()
    {
        $sql = "SELECT * FROM category";
        $this->db->query($sql);
        $this->db->execute();
      return  $this->db->resultSet();
    }

    public function store($data)
    {
       $slug = $this->str_slug($data['category']);

        try {
            $sql = "SELECT * FROM category WHERE name=:categoryName";
            $this->db->query($sql);
            $this->db->bind(':categoryName',$data['category']);
            $this->db->execute();
            if ($this->db->rowCount() >0 ){
                 return $this->errorNotify('This category name already exists');
            }else {
                $sql = "INSERT INTO category(name,slug)VALUES (:categoryName,:slug)";
                $this->db->query($sql);
                $this->db->bind(":categoryName", $data['category']);
                $this->db->bind(":slug", $slug);
                if ($this->db->execute()) {
                    return $this->successNotify('Category insert successfully');
                } else {
                    return $this->errorNotify('Category insert failed');
                }
            }

        }catch (PDOException $exception){
            return $this->errorNotify($exception->getMessage());
        }
    }


    public function edit($id)
    {
           $sql = "SELECT * FROM category WHERE id=:categoryId";
            $this->db->query($sql);
            $this->db->bind(':categoryId',$id);
            $this->db->execute();
            return $this->db->single();
    }

     public function udpate($data)
    {
       $slug = $this->str_slug($data['category']);

        try {
            $sql = "SELECT * FROM category WHERE name=:categoryName";
            $this->db->query($sql);
            $this->db->bind(':categoryName',$data['category']);
            $this->db->execute();
            if ($this->db->rowCount() >0 ){
                 return $this->errorNotify('This category name already exists');
            }else {
                $sql = "UPDATE category SET name=:categoryName,slug=:slug WHERE id=:categoryId";
                $this->db->query($sql);
                $this->db->bind(":categoryId", $data['categoryId']);
                $this->db->bind(":categoryName", $data['category']);
                $this->db->bind(":slug", $slug);
                if ($this->db->execute()) {
                    return $this->successNotify('Category udpate successfully');
                } else {
                    return $this->errorNotify('Category udpate failed');
                }
            }

        }catch (PDOException $exception){
            return $this->errorNotify($exception->getMessage());
        }
    }

    public function destory($id)
    {
        $sql ="DELETE FROM category WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind(":id",$id);
        if ($this->db->execute()) {
                    return $this->successNotify('Category delete successfully');
                } else {
                    return $this->errorNotify('Category delete failed');
                }
    }
}