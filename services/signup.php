<?php
include('connection.php');

class LoginUser extends connection
{
    function __construct()
    {
        $this->connectionDB();
    }

  function signup(){
  
      $uname = $_REQUEST['name'];
      $email = $_REQUEST['email'];
      $password = $_REQUEST['password'];
      $cpassword = $_REQUEST['cpassword'];

      if ($password != $cpassword) {

      // echo "The two passwords do not match";
      header("Location:../login/signup.php");
    }
    else{

      // $password = md5($password);//encrypt the password before saving in the database
     
     $sql_ins="INSERT INTO ".'"'."tbl_users".'"'."(user_name, email, password) VALUES ('$uname', '$email', '$password') ";

        $sql_reg_num = pg_query($sql_ins);

        if($sql_reg_num){
           header("Location:../login/loginform.php");
        }else{
           return "failure";
        }

    }

    // register user if there are no errors in the form
     
  }

}
   $loginuser=new LoginUser();

       echo $loginuser->signup();

?>