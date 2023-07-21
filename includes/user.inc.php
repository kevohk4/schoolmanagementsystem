<?php
class User extends Dbh{
protected function getAllarts(){
   $sql = "SELECT DISTINCT artype,category,artinformation,img_link FROM arts GROUP BY artype DESC LIMIT 9";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows > 0){
      while($row = $result->fetch_assoc()){
         $data[]=$row;
      }
      return $data;
   }
}


protected function getpassword($username,$password){
   $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows == 1) {
      session_start();
      $_SESSION['username'] = $username;
   // $_SESSION['email'] = $row['email'];
       header("location:index.php");
    }
    else {
      echo '<td style="color:red;padding: 4px;">Your username or Password is invalid please </br>try again or register </td></tr><tr>';
    }
}//Authentication 


protected function getPaint($artype){
   $sql = "SELECT * FROM arts where artype ='$artype'";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows > 0){
      while($row = $result->fetch_assoc()){
         $data[]=$row;
      }
      return $data;
   }
}

protected function getArt($artId){
   $sql = "SELECT * FROM arts where artype ='$artId'";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows > 0){
      while($row = $result->fetch_assoc()){
         $data[]=$row;
      }
      return $data;
   }
}
protected function count(){
   $sql = "SELECT DISTINCT  artype,count(artype) as 'Total'  FROM arts  ";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows > 0){
      while($row = $result->fetch_assoc()){
         $data[]=$row;
      }
      return $data;
   }
}

protected function artypes(){
   $sql = "SELECT DISTINCT artype FROM arts ";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows > 0){
      while($row = $result->fetch_assoc()){
         $data[]=$row;
      }
      return $data;
   }
}

}
?>