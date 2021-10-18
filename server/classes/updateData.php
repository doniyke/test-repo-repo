<?php
require_once('dbconnection.php');

class updateData extends DbConnection{
    

    


    public function updateProfile($name,$email,$phone){
        $sql = "UPDATE users SET name = :name, phone = :phone WHERE email = :email";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':name'=>$name, ':phone'=>$phone, ':email'=>$email));

        if ($query->errorCode()==0) {
            return array('status'=>1);
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }



    public function updateTrainingStatus($training_status,$email,$id){
        $sql = "UPDATE purchases SET training_status = :training_status WHERE id = :id AND user_email = :email";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':training_status'=>$training_status, ':email'=>$email, ':id'=>$id));

        if ($query->errorCode()==0) {
            return array('status'=>1);
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }


     public function updateTraining($title,$short_description,$full_description,$category,$author,$price,$training_slug,$image){
        $sql = "UPDATE trainings SET title = :title,short_description =:short_description,full_description =:full_description,category =:category,author =:author,price =:price,image =:image WHERE training_slug = :training_slug ";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':title'=>$title, ':short_description'=>$short_description, ':full_description'=>$full_description, ':category'=>$category,':author'=>$author, ':price'=>$price,':image'=>$image,':training_slug'=>$training_slug));

        if ($query->errorCode()==0) {
            return array('status'=>1);
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }

    public function updateStudents($training_slug,$students){
        $sql = "UPDATE trainings SET students = :students WHERE training_slug = :training_slug ";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':students'=>$students,':training_slug'=>$training_slug));

        if ($query->errorCode()==0) {
            return array('status'=>1);
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }


    

    

    

    
    

    public function updateAdminPassword($email,$newPass){
        $sql = "UPDATE admin SET password = :newPass WHERE email = :email";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':newPass'=>$newPass, ':email'=>$email));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
            
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }



    public function updateUserPassword($email,$newPass){
        $sql = "UPDATE users SET password = :newPass WHERE email = :email";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':newPass'=>$newPass, ':email'=>$email));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
            
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }
    
    
}
?>