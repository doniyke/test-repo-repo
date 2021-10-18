<?php
require_once('dbconnection.php');

class deleteData extends DbConnection{ 
 public function DeleteById($id,$tblName){
    $sql = "DELETE FROM {$tblName} WHERE id = :id";

    $query = $this->connection->prepare($sql);
    $exec = $query->execute(array(':id'=>$id));
    
    if ($query->errorCode() == 0) {
        return array('status'=>1);
        
    } else {
        return array('status'=>0, 'message'=>$query->errorInfo());
    }
}



public function DeleteBySlug($training_slug,$tblName){
    $sql = "DELETE FROM {$tblName} WHERE training_slug = :training_slug";

    $query = $this->connection->prepare($sql);
    $exec = $query->execute(array(':training_slug'=>$training_slug));
    
    if ($query->errorCode() == 0) {
        return array('status'=>1);
        
    } else {
        return array('status'=>0, 'message'=>$query->errorInfo());
    }
}


public function deletetoken($tstamp){
    $sql = "DELETE FROM  passwordtokens  WHERE timestampExpires < :tstamp";

    $query = $this->connection->prepare($sql);
    $exec = $query->execute(array(':tstamp'=>$tstamp));
    
    if ($query->errorCode() == 0) {
        return array('status'=>1);
        
    } else {
        return array('status'=>0, 'message'=>$query->errorInfo());
    }
}

}
?>