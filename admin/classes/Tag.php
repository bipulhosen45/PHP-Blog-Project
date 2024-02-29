<?php


class Tag
{
    use Notify,SlugHelper;

    private $db;

    public function __construct()
    {
        $this->db  = new Database();
    }

    public function index()
    {
        $sql = "SELECT * FROM tag";
        $this->db->query($sql);
        $this->db->execute();
        return  $this->db->resultSet();
    }

    public function store($data)
    {
        $slug = $this->str_slug($data['tag_name']);

        try {
            $sql = "SELECT * FROM tag WHERE name=:tagName";
            $this->db->query($sql);
            $this->db->bind(':tagName',$data['tag_name']);
            $this->db->execute();
            if ($this->db->rowCount() >0 ){
                return $this->errorNotify('This tag name already exists');
            }else {
                $sql = "INSERT INTO tag(name,slug)VALUES (:tagName,:slug)";
                $this->db->query($sql);
                $this->db->bind(":tagName", $data['tag_name']);
                $this->db->bind(":slug", $slug);
                if ($this->db->execute()) {
                    return $this->successNotify('Tag insert successfully');
                } else {
                    return $this->errorNotify('Tag insert failed');
                }
            }

        }catch (PDOException $exception){
            return $this->errorNotify($exception->getMessage());
        }
    }


    public function edit($id)
    {
        $sql = "SELECT * FROM tag WHERE id=:tagId";
        $this->db->query($sql);
        $this->db->bind(':tagId',$id);
        $this->db->execute();
        return $this->db->single();
    }

    public function udpate($data)
    {
        $slug = $this->str_slug($data['tag_name']);

        try {
            $sql = "SELECT * FROM tag WHERE name=:tag_name";
            $this->db->query($sql);
            $this->db->bind(':tag_name',$data['tag_name']);
            $this->db->execute();
            if ($this->db->rowCount() >0 ){
                return $this->errorNotify('This tag name already exists');
            }else {
                $sql = "UPDATE tag SET name=:tag_name,slug=:slug WHERE id=:tagId";
                $this->db->query($sql);
                $this->db->bind(":tagId", $data['tagId']);
                $this->db->bind(":tag_name", $data['tag_name']);
                $this->db->bind(":slug", $slug);
                if ($this->db->execute()) {
                    return $this->successNotify('Tag update successfully');
                } else {
                    return $this->errorNotify('Tag update failed');
                }
            }

        }catch (PDOException $exception){
            return $this->errorNotify($exception->getMessage());
        }
    }

    public function destory($id)
    {
        $sql ="DELETE FROM tag WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind(":id",$id);
        if ($this->db->execute()) {
            return $this->successNotify('Tag delete successfully');
        } else {
            return $this->errorNotify('Tag delete failed');
        }
    }

}