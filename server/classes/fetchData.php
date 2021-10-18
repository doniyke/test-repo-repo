<?php

require_once('dbconnection.php');
class fetchData extends DbConnection {  
    public function fetchAll($tblName) {
        $sql = "SELECT * FROM {$tblName} ORDER BY RAND() ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute();
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    public function fetchAllDescLimit($tblName,$limit) {
        $sql = "SELECT * FROM {$tblName} ORDER BY id DESC LIMIT $limit";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute();
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    public function fetchById($tblName,$id) {
        $sql = "SELECT * FROM {$tblName} Where id = :id ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':id' => $id));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }


    public function fetchByCategory($category) {
        $sql = "SELECT * FROM trainings Where category = :category ORDER BY RAND()";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':category' => $category));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    public function fetchByPrice($price) {
        $sql = "SELECT * FROM trainings Where price = :price ORDER BY RAND()";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':price' => $price));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }



    public function fetchBySlug($training_slug) {
        $sql = "SELECT * FROM trainings Where training_slug = :training_slug ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':training_slug' => $training_slug));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }


    public function fetchPurchaseDetails($training_slug) {
        $sql = "SELECT * FROM purchases Where training_slug = :training_slug ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':training_slug' => $training_slug));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }


    public function fetchTrainingResources($training_slug) {
        $sql = "SELECT * FROM traing_resources Where training_slug = :training_slug ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':training_slug' => $training_slug));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    public function fetchFreeResourcesBySlug($training_slug) {
        $sql = "SELECT * FROM free_resources Where training_slug = :training_slug ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':training_slug' => $training_slug));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    

    

    

    
    public function fetchTaskByTypeAndClass($tblName, $type, $class) {
        $sql = "SELECT * FROM {$tblName} Where type = :type AND class_id = :class ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':type' => $type, ':class'=>$class));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }




    public function registerCheck($email) {
        $sql = "SELECT email FROM users WHERE email = :email ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                return array('status'=>1,'data'=>$data);
            }else{
                return array('status'=>0);
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    public function subscribeCheck($email) {
        $sql = "SELECT email FROM subscribers WHERE email = :email ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                return array('status'=>1,'data'=>$data);
            }else{
                return array('status'=>0);
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    

    public function registerCheckAdmin($email) {
        $sql = "SELECT email FROM admin WHERE email = :email ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                return array('status'=>1,'data'=>$data);
            }else{
                return array('status'=>0);
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    

    public function emailValidationCheck($email,$code) {

        $sql = "SELECT  expires FROM email_verify WHERE email = :email AND code = :code";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email, ':code'=>$code));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $expires = $row['expires'];
                    return array('status'=>1, 'expires'=>$expires);
                }
            }else{
                return array('status'=>0);
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }


    
    public function userLogin($email) {

        $sql = "SELECT  password FROM users WHERE email = :email ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $pass = $row['password'];
                    return array('status'=>1, 'password'=>$pass);
                }
            }else{
                return array('status'=>0);
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    public function adminLogin($email) {

        $sql = "SELECT  password FROM admin WHERE email = :email ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $pass = $row['password'];
                    return array('status'=>1, 'password'=>$pass);
                }
            }else{
                return array('status'=>0);
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }


    public function getStudent($training_slug) {

        $sql = "SELECT  students FROM trainings WHERE training_slug = :training_slug ";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':training_slug'=>$training_slug));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) {
                    $students = $row['students'];
                    return array('status'=>1, 'students'=>$students);
                }
            }else{
                return array('status'=>0);
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    

    public function fetchUserData($email,$tblname) {
        $sql = "SELECT * FROM {$tblname} WHERE email = :email";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    public function fetchPurchases($user_email,$tblname) {
        $sql = "SELECT * FROM {$tblname} WHERE user_email = :user_email";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':user_email'=>$user_email));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    

    public function fetchAny($tblname, $id) {
        $sql = "SELECT * FROM {$tblname} WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':id'=>$id));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

    

    public function fetchPasswordToken($email, $token) {
        $sql = "SELECT * FROM passwordtokens WHERE email = :email AND token =:token";
        $query = $this->connection->prepare($sql);
        $exec = $query->execute(array(':email'=>$email, ':token'=>$token));
        if($query->errorCode() == 0){
            if ($query->rowCount() > 0) {
                return $query->fetchAll(PDO::FETCH_ASSOC);    
            }else{
                return 0;
            } 
        }else{
            return array('status'=>0, 'message'=>$query->errorInfo()); 
        }
        
    }

}
?>