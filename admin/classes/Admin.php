<?php
class Admin{

    use Notify;

    private $db;

    public function __construct()
    {
        $this->db  = new Database();
    }

    public function login($data)
    {

        try
        {
            $sql ="SELECT * FROM admin WHERE email=:email";
            $this->db->query($sql);
            $this->db->bind(':email',$data['email']);
            $this->db->execute();
            if ($this->db->rowCount() >0){
               $row =$this->db->single();

                if ( password_verify( $data['password'],$row->password) ) {

                    $_SESSION['isAdmin'] = true;
                    $_SESSION['name']    = $row->name;
                    $_SESSION['user_id'] = $row->id;
                    header( 'Location:dashboard.php' );
                }
                else {
                    return $this->errorNotify('Password does not match');
                }

            }else{
               return $this->errorNotify(' Email not found!');
            }

        }catch (PDOException $exception){
            return $exception->getMessage();
        }

    }

}




