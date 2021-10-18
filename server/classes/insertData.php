<?php


require_once('dbconnection.php');


class insertData extends DbConnection {
	
    public function addVerificationEmail($email,$code,$expires){
        $sql = "INSERT INTO email_verify(email,code, expires) VALUES(:email, :code, :expires)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email, ':code'=>$code, ':expires'=>$expires));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }


    public function register($name,$email,$phone,$password){
        $sql = "INSERT INTO users (name, email,phone, password) VALUES(:name,  :email, :phone, :password)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':name'=>$name,  ':email'=>$email, ':phone'=>$phone, ':password'=>$password));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }

    public function subscribe($name,$email,$category){
        $sql = "INSERT INTO subscribers (name, email,category) VALUES(:name,  :email, :category)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':name'=>$name,  ':email'=>$email, ':category'=>$category));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }

    public function freeResource($name,$email,$phone,$training_slug){
        $sql = "INSERT INTO free_leads (name, email,phone,training_slug) VALUES(:name,  :email, :phone, :training_slug)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':name'=>$name,  ':email'=>$email, ':phone'=>$phone, ':training_slug'=>$training_slug));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }

    

    public function addPurchase($training_slug,$user_email,$training_status){
        $sql = "INSERT INTO purchases (training_slug,user_email,training_status) VALUES(:training_slug,:user_email,:training_status)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':training_slug'=>$training_slug,  ':user_email'=>$user_email, ':training_status'=>$training_status));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }




    


    public function addTraining($title,$short_description,$full_description,$category,$author,$price,$students,$training_slug,$image){
        $sql = "INSERT INTO trainings (title,short_description,full_description,category,author,price,students,training_slug,image) VALUES(:title,:short_description,:full_description,:category,:author,:price,:students,:training_slug,:image)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':title'=>$title,':short_description'=>$short_description,':full_description'=>$full_description,':category'=>$category,':author'=>$author,':price'=>$price,':students'=>$students,':training_slug'=>$training_slug,':image'=>$image));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }


    public function addResource($type,$link,$training_slug){
        $sql = "INSERT INTO traing_resources (type,link,training_slug) VALUES(:type,:link,:training_slug)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':type'=>$type,':link'=>$link,':training_slug'=>$training_slug));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }

    public function addFreeResource($type,$link,$training_slug){
        $sql = "INSERT INTO free_resources (type,link,training_slug) VALUES(:type,:link,:training_slug)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':type'=>$type,':link'=>$link,':training_slug'=>$training_slug));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }



    

    


    
    

    public function addAdmin($name,$email,$password){
        $sql = "INSERT INTO admin(name, email, password) VALUES(:name,  :email, :password)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':name'=>$name,  ':email'=>$email, ':password'=>$password));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
    }


 

    public function passwordTokens($email,$token,$mytimestamp,$timestampExpires){
        $sql = "INSERT INTO passwordTokens(email, token, tstamp, timestampExpires) VALUES(:email, :token,:mytimestamp, :timestampExpires)";

        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email, ':token'=>$token, ':mytimestamp'=>$mytimestamp, ':timestampExpires'=>$timestampExpires));
        
        if ($query->errorCode() == 0) {
            return array('status'=>1);
        } else {
            return array('status'=>0, 'message'=>$query->errorInfo());
        }
        
    }
}
?>