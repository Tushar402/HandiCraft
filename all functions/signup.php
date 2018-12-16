<!-- header -->
<?php include("inc/header.php"); ?>

<!-- Start  signup -->
<br />
<div class="container">
    <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="row myborder">
                <h4 style="color: #333333; margin: initial; margin-bottom: 10px;">Registration</h4><hr>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_name = $fm->validation($_POST['first_name']);
    $last_name = $fm->validation($_POST['last_name']);
    $address = $fm->validation($_POST['address']);    
    $contact_num = $fm->validation($_POST['contact_num']);
    $email = $fm->validation($_POST['email']);
    $password = $fm->validation(md5($_POST['password']));
    $confrm_pass = $fm->validation(md5($_POST['confrm_pass']));
    
    $first_name = mysqli_real_escape_string($db->link, $first_name);
    $last_name = mysqli_real_escape_string($db->link, $last_name);
    $address = mysqli_real_escape_string($db->link, $address);
    $contact_num = mysqli_real_escape_string($db->link, $contact_num);
    $email = mysqli_real_escape_string($db->link, $email);
    $password = mysqli_real_escape_string($db->link, $password);
    $confrm_pass = mysqli_real_escape_string($db->link, $confrm_pass);
    
    if($password != $confrm_pass){
        echo "<span style='color:red'>Password not match !! </span>";
    }else{
        $mailquery = "select * from registration where email = '$email' limit 1";
        $mailcheck = $db->select($mailquery);
        if($mailcheck != false){
            echo "<span style='color:red'>Eail Already Exist!!</span>";
        }else{
            $query = "INSERT INTO registration(first_name, last_name, address, contact_num, email, password, confrm_pass) VALUES('$first_name', '$last_name', '$address', '$contact_num', '$email', '$password', '$confrm_pass')";
            $catinsert = $db->insert($query);
            
            if($catinsert){
                $query = "select * from registration where email = '$email'";
                $category = $db->select($query);
                if($category){
                    $result = $category->fetch_assoc();
                    $first_name = $result['first_name'];
                    $last_name = $result['last_name'];
                    $user_name = $first_name ." ".$last_name;
                    $user_email = $result['email'];
                    $user_pass = $result['password'];
                    $id_reg = $result['id_reg'];
                    $contact_num = $result['contact_num'];
                    $query = "INSERT INTO user(user_name, user_email, user_pass, contact_num, id_reg) VALUES('$user_name', '$user_email', '$user_pass', '$contact_num', '$id_reg')";
                    $catinsert = $db->insert($query);
                }
                echo "<span style='color:green'>User Created Successfully !! </span>";
            }else{
                echo "<span style='color:green'>User Not Created !!</span>";
            }   
        }
    }
}
?>

                <form action="signup.php" method="post">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user mycolor"></i>
                        </span>
                        <input size="60" maxlength="255" required class="form-control" placeholder="First Name" name="first_name" id="fname" type="text">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                        <input size="60" maxlength="255" required class="form-control" placeholder="Last Name" name="last_name" id="lname" type="text">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                        <input size="60" maxlength="255" required class="form-control" placeholder="Address" name="address" id="address" type="text">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                        <input size="60" maxlength="255" required class="form-control" placeholder="Contact Number" name="contact_num" id="contactnumber" type="number">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                        <input size="60" maxlength="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required class="form-control" placeholder="E-mail" name="email" id="email" type="text">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                        <input size="60" maxlength="255" class="form-control" placeholder="Password" name="password" required id="UserRegistration_password" type="password">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                        <input size="60" maxlength="255" class="form-control" required placeholder="Confirm Password" name="confrm_pass" id="password" type="password">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn-u pull-left" name="submit" type="submit">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        <div class="col-md-2"></div>
    </div>
</div>
    
<!-- Start footer -->
<?php include("inc/footer.php"); ?>