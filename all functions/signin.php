<?php 
include("inc/header.php");
Session::checkLogin();
?>

<!-- Start  Signin-->
<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="row myborder">
            <h4 style="color: 333333; margin: initial; margin-bottom: 10px;">Log In</h4><hr>
<?php   
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_email = $fm->validation($_POST['user_email']);
        $user_pass = $fm->validation(md5($_POST['user_pass']));
        
        $user_email = mysqli_real_escape_string($db->link, $user_email);
        $user_pass = mysqli_real_escape_string($db->link, $user_pass);
        
        $query = "SELECT * FROM user WHERE user_email='$user_email' AND user_pass='$user_pass'";
        $result = $db->select($query);
        if($result != false){
            $value = $result->fetch_assoc();
            //$value = mysqli_fetch_array($result);
            //$row = mysqli_num_rows($result);
            //if($row > 0){
            Session::set("login", true);
            Session::set("user_name", $value['user_name']);
            Session::set("id_reg", $value['id_reg']);
            Session::set("contact_num", $value['contact_num']);
                
            //Session::set("userRole", $value['role']);
            header("Location:index.php");
            //}else{
            //echo "<span style='color:red; font-size:18px;'>No Result //Found !!</span>";
            //}
        }else{
            echo "<span style='color:red; font-size:18px;'>Username or Password not matched !!</span>";
        }
    }  	
?>

            <form action="" method="post">
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user mycolor"></i>
                </span>
                <input size="60" maxlength="200" class="form-control" placeholder="e-mail" name="user_email" id="email" type="text">
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                <input size="50" maxlength="255" class="form-control" placeholder="Password" name="user_pass" id="password" type="password">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn-u pull-center" name="submit" type="submit">Sign In</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<!-- Start footer -->
<?php include("inc/footer.php"); ?>