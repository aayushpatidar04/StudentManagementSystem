<?php
    include 'db.php';
    include 'scriptandlinks.php';

    session_start();
    $email = $_SESSION['email'];
    $sql = mysqli_query($con,"SELECT * from users where email='$email'");
    $row = mysqli_fetch_array($sql);
    $role = $row['role'];
    $name = $row['name'];
    if($_SESSION['loggedin']!="true" || ($_SESSION['loggedin']!=true) || $role!='student'){
        header("location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome - <?php echo $_SESSION['email']; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
            #std{
                display:none;
            }
            #mus{
                display:none;
            }
            #msa{
                display:none;
            }
            #tec{
                display:none;
            }
            #adm{
                display:none;
            }
            #mu{
                display:none;
            }
            #msm{
                display:none;
            }
            #mua{
                display:none;
            }
            #hm{
                display:none;
            }
            #hma{
                display:none;
            }
            #hmt{
                display:none;
            }
            #prft{
                display:none;
            }
            #prfa{
                display:none;
            }
            #prf{
                display:none;
            }
            
            @media screen and (max-width: 767px){
                #nav1{
                    display:none;
                }
                #t1 thead {
                    display: none;
                }
                #t1 tr {
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 15px;
                    padding: 10px;
                    border-radius: 4px;
                    background-color: #fff;
                    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.2);
                }
                #t1 tbody tr:nth-child(odd) {
                    background-color: #fff;
                }
                #t1 td {
                  padding: 0.25rem;
                }
                #t1 td:nth-child(1) {
                    font-weight: bold;
                    font-size: 1.2em;
                }
                #t1 td:nth-child(2)::before {
                    content: "Email: ";
                }
                #t1 td:nth-child(3)::before {
                    content: "Role: ";
                }
                #t1 td::before {
                    font-weight: bold;
                }

                #t2 thead {
                    display: none;
                }
                #t2 tr {
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 15px;
                    padding: 10px;
                    border-radius: 4px;
                    background-color: #fff;
                    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.2);
                }
                #t2 tbody tr:nth-child(odd) {
                    background-color: #fff;
                }
                #t2 td {
                  padding: 0.25rem;
                }
                #t2 td:nth-child(1) {
                    font-weight: bold;
                    font-size: 1.2em;
                }
                #t2 td:nth-child(2)::before {
                    content: "Physics: ";
                }
                #t2 td:nth-child(3)::before {
                    content: "Chemistry: ";
                }
                #t2 td:nth-child(4)::before {
                    content: "Math: ";
                }
                #t2 td:nth-child(5)::before {
                    content: "Science: ";
                }
                #t2 td:nth-child(6)::before {
                    content: "English: ";
                }
                #t2 td:nth-child(7)::before {
                    content: "Hindi: ";
                }
                #t2 td::before {
                    font-weight: bold;
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
        include 'navbar.php';
        require 'db.php';
        ?>
        <div class="container">
            <h1 class="mt-3 text-center">Students Detail.</h1>
        </div>
        <br><br>
        <div class="container">
            <?php
                $sql = "SELECT * from users WHERE email='$email' ORDER by id ASC;";
                $res = mysqli_query($con,$sql);
                if($res){
                    if(mysqli_num_rows($res)>0){
                        echo '<table class="table table-bordered table-striped" id="t1">';
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Email</th>";
                                echo "<th>Role</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($res)){
                            echo "<tr>";
						        echo "<td>" . $row['id'] . "</td>";
						        echo "<td>" . $row['email'] . "</td>";
						        echo "<td>" . $row['role'] . "</td>";
						    echo "<tr>";
                        }
                    echo "</tbody>";                            
                    echo "</table>";
                    mysqli_free_result($res);
                    }
                    else{
                        echo '<div class="alert alert-danger">
                                No Record were Found.
                            </div>';
                    }
                }
                else{
                    echo 'OOPs! something went wrong. please try again later.';
                 }
            mysqli_close($con);
            ?>
        </div>
        <div class="container">
            <h2>Marksheet</h2>
        </div>
        <div class="container">
            <?php
            include 'db.php';
                $sql = "SELECT * from student_marks WHERE name='$name';";
                $res = mysqli_query($con,$sql);
                if($res){
                    if(mysqli_num_rows($res)>0){
                        echo '<table class="table table-bordered table-striped" id="t2">';
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Name</th>";
                                echo "<th>Physics</th>";
                                echo "<th>Chemistry</th>";
                                echo "<th>Math</th>";
                                echo "<th>Science</th>";
                                echo "<th>English</th>";
                                echo "<th>Hindi</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($res)){
                            echo "<tr>";
						        echo "<td>" . $row['name'] . "</td>";
						        echo "<td>" . $row['physics'] . "</td>";
						        echo "<td>" . $row['chemistry'] . "</td>";
						        echo "<td>" . $row['math'] . "</td>";
						        echo "<td>" . $row['science'] . "</td>";
						        echo "<td>" . $row['english'] . "</td>";
						        echo "<td>" . $row['hindi'] . "</td>";
						    echo "<tr>";
                        }
                    echo "</tbody>";                            
                    echo "</table>";
                    mysqli_free_result($res);
                    }
                    else{
                        echo '<div class="alert alert-danger">
                                No Record were Found.
                            </div>';
                    }
                }
                else{
                    echo 'OOPs! something went wrong. please try again later.';
                 }
            mysqli_close($con);
            ?>
        </div>

    </body>
</html>