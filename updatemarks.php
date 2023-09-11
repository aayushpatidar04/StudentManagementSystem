<?php
    include 'db.php';
    include 'scriptandlinks.php';

    session_start();
    $email = $_SESSION['email'];
    $sql = mysqli_query($con,"SELECT * from users where email='$email'");
    $row = mysqli_fetch_array($sql);
    $role = $row['role'];
    if($_SESSION['loggedin']!="true" || ($_SESSION['loggedin']!=true) || $role!='teacher'){
        header("location: login.php");
        exit;
    }
?>
<?php
$sucessalert = false;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
include 'db.php';


if ($_SERVER['REQUEST_METHOD']=="POST"){
    $id = $_POST['id'];
    $res2 = mysqli_query($con,"SELECT * from users WHERE id='$id'");
    $row2 = mysqli_fetch_array($res2);
    $name = $row['name'];
    $n = $row2['name'];
    $class = $row2['class'];
    $res3 = mysqli_query($con,"SELECT * from classes where class='$class'");
    $row3 = mysqli_fetch_array($res3);
    if($row3['physics']==$name){
        $physics = $_POST['physics'];
        $sql1 = "UPDATE `student_marks` SET `physics`='$physics' WHERE name='$n';";
        $result = mysqli_query($con,$sql1);
    }
    if($row3['chemistry']==$name){
        $chemistry = $_POST['chemistry'];
        $sql1 = "UPDATE `student_marks` SET `chemistry`='$chemistry'WHERE name='$n';";
        $result = mysqli_query($con,$sql1);
    }
    if($row3['math']==$name){
        $math = $_POST['math'];
        $sql1 = "UPDATE `student_marks` SET `math`='$math' WHERE name='$n';";
        $result = mysqli_query($con,$sql1);
    }
    if($row3['english']==$name){
        $english = $_POST['english'];
        $sql1 = "UPDATE `student_marks` SET `english`='$english' WHERE name='$n';";
        $result = mysqli_query($con,$sql1);
    }
    if($row3['hindi']==$name){
        $hindi = $_POST['hindi'];
        $sql1 = "UPDATE `student_marks` SET `hindi`='$hindi' WHERE name='$n';";
        $result = mysqli_query($con,$sql1);
    }
    if($row3['science']==$name){
        $science = $_POST['science'];
        $sql1 = "UPDATE `student_marks` SET `science`='$science' WHERE name='$n';";
        $result = mysqli_query($con,$sql1);
    }

    $sucessalert = true;
            
    mysqli_close($con);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Record</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jqajax.js"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

        <style>
            #lgin{
                display:none;
            }
            #reg{
                display:none;
            }
            #brand{
                pointer-events: none;
                cursor: default;
            }
            #mua{
                display:none;
            }
            #mu{
                display:none;
            }
            #tec{
                display:none;
            }
            #adm{
                display:none;
            }
            #msa{
                display:none;
            }
            #std{
                display:none;
            }
            #hm{
                display:none;
            }
            #hma{
                display:none;
            }
            #hms{
                display:none;
            }
            #prf{
                display:none;
            }
            #prfa{
                display:none;
            }
            #prfs{
                display:none;
            }
            @media screen and (max-width: 767px){
                #nav1{
                    display: none;
                }
            }
            @media screen and (min-width:768px) {
                #nav2{
                    display: none;
                }  
            }
        </style>
    </head>
    <body>
        <?php
            include 'db.php';
            include 'navbar.php';
            if($sucessalert){
                echo '<div class="alert alert-success alert-dismissible fade show">
                <strong>Success!</strong>Record updated.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="close"></button>
            </div>';
            }
            $res2 = mysqli_query($con,"SELECT * from users WHERE id='$id'");
            $row2 = mysqli_fetch_array($res2);
            $name = $row['name'];
            $class = $row2['class'];
            $res3 = mysqli_query($con,"SELECT * from classes where class='$class'");
            $row3 = mysqli_fetch_array($res3);
        ?>
        <div class="container">
            <h1 class="mt-5">Update Marks</h1>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" id="createform">
                    <div class="form-group">
                        <p>Please fill this form and submit to update student marks to the database.</p>
                        <input type="hidden" name="id" id="id" class="form-control mt-2" value="<?php echo $id;?>">
                    </div>
                    <?php
                    if($row3['physics']==$name){
                    ?>
                    <div class="form-group">
                        <label for="physics" class="mt-2">Physics.</label>
                        <input type="number" name="physics" id="physics" class="form-control mt-2"  required>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if($row3['chemistry']==$name){
                    ?>
                    <div class="form-group">
                        <label for="chemistry" class="mt-2">Chemistry.</label>
                        <input type="number" name="chemistry" id="chemistry" class="form-control mt-2"  required>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if($row3['math']==$name){
                    ?>
                    <div class="form-group">
                        <label for="math" class="mt-2">Math.</label>
                        <input type="number" name="math" id="math" class="form-control mt-2"  required>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if($row3['science']==$name){
                    ?>
                    <div class="form-group">
                        <label for="science" class="mt-2">Science.</label>
                        <input type="number" name="science" id="science" class="form-control mt-2"  required>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if($row3['english']==$name){
                    ?>
                    <div class="form-group">
                        <label for="english" class="mt-2">English.</label>
                        <input type="number" name="english" id="english" class="form-control mt-2"  required>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if($row3['hindi']==$name){
                    ?>
                    <div class="form-group">
                        <label for="hindi" class="mt-2">Hindi.</label>
                        <input type="number" name="hindi" id="hindi" class="form-control mt-2"  required>
                    </div>
                    <?php
                    }
                    ?>
                    
                <div class="mt-3 mb-3">
                    <button type="submit" class="btn btn-primary" id="btnadd">Submit</button>
                    <a href="manage_student.php" class="btn btn-secondary ml-2">Cancel</a>
                </div>
            </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

        
    </body>
</html>