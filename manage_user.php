<?php
    include 'db.php';
    include 'scriptandlinks.php';

    session_start();
    $email = $_SESSION['email'];
    $sql = mysqli_query($con,"SELECT * from users where email='$email'");
    $row = mysqli_fetch_array($sql);
    $role = $row['role'];
    if($_SESSION['loggedin']!="true" || ($_SESSION['loggedin']!=true) || $role!='admin'){
        header("loaction: login.php");
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
            #mua{
                display:none;
            }
            #msm{
                display:none;
            }
            #hmt{
                display:none;
            }
            #hma{
                display:none;
            }
            #hms{
                display:none;
            }
            #prft{
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
                    display:none;
                }
                table thead {
                    display: none;
                }
                table tr {
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 15px;
                    padding: 10px;
                    border-radius: 4px;
                    background-color: #fff;
                    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.2);
                }
                table tbody tr:nth-child(odd) {
                    background-color: #fff;
                }
                table td {
                  padding: 0.25rem;
                }
                table td:nth-child(1) {
                    font-weight: bold;
                    font-size: 1.2em;
                }
                table td:nth-child(2)::before {
                    content: "Email: ";
                }
                table td:nth-child(3)::before {
                    content: "Role: ";
                }
                table td:nth-child(4)::before {
                    content: "View: ";
                }
                table td:nth-child(5)::before {
                    content: "Edit: ";
                }
                table td:nth-child(6)::before {
                    content: "Delete: ";
                }
                table td:nth-child(7)::before {
                    content: "Change Role: ";
                }
                table td::before {
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
            <h1 class="mt-3 text-center">Users of Student CRUD System.</h1>
        </div>
        <br><br>
        <div class="container">
            <?php
                $sql = "SELECT * from users WHERE role!='admin' ORDER by id ASC;";
                $res = mysqli_query($con,$sql);
                if($res){
                    if(mysqli_num_rows($res)>0){
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Email</th>";
                                echo "<th>Role</th>";
                                echo "<th>View</th>";
                                echo "<th>Edit</th>";
                                echo "<th>Delete</th>";
                                echo "<th>Change Role</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($res)){
                            echo "<tr>";
						        echo "<td>" . $row['id'] . "</td>";
						        echo "<td>" . $row['email'] . "</td>";
						        echo "<td>" . $row['role'] . "</td>";
                                echo "<td>";
        						echo '<a href="read.php?id='. $row['id'] .'" class="mr-3 btn btn-secondary" title="View Details" data-toggle="tooltip"><span class="fa fa-eye"></span></a></td>';
                                echo "<td>";
        						echo '<a href="update.php?id='. $row['id'] .'" class="mr-3 btn btn-secondary" title="Update Details" data-toggle="tooltip"><span class="fa fa-pencil"></span></a></td>';
                                echo "<td>";
                                echo '<a href="javascript:void(0)" title="Change Status" class="delete_btn_ajax btn btn-danger ms-1" data-toggle="tooltip"><span class="fas fa-trash"></span></a>';
					        	echo '<input type="hidden" class="delete_id_value" value='.$row["id"].'>';
                                echo '</td>';
                                echo '<td>';
                                echo 'Change role to:';
                                echo '<a href="javascript:void(0)" title="Change Status" class="student_btn_ajax btn btn-success ms-3 mt-2" data-toggle="tooltip">Student</a>';
					        	echo '<input type="hidden" class="student_id_value" value='.$row["id"].'>';
                                echo '<a href="javascript:void(0)" title="Change Status" class="admission_btn_ajax btn btn-success ms-3 mt-2" data-toggle="tooltip">Admission</a>';
					        	echo '<input type="hidden" class="admission_id_value" value='.$row["id"].'>';
                                echo '<a href="javascript:void(0)" title="Change Status" class="teacher_btn_ajax btn btn-success ms-3 mt-2" data-toggle="tooltip">Teacher</a>';
					        	echo '<input type="hidden" class="teacher_id_value" value='.$row["id"].'>';
                                echo '</td>';
                                                        
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
    <script>
        $(document).ready(function(){
                $('.student_btn_ajax').click(function(e){
                    e.preventDefault();
                    var statusid = $(this).closest("tr").find('.student_id_value').val();
                    swal.fire({
                        title: 'Are you Sure?',
                        text: 'You want to change role.',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#9A2124',
                        confirmButtonColor: '#34A853',
                        confirmButtonText: 'Yes, Change it!'
                    }).then((result)=>{
                        if(result.isConfirmed){
                            $.ajax({
                                type: "POST",
                                url: 'change.php',
                                data:{
                                    "student_btn_set": 1,
                                    "student_id": statusid,
                                },
                                success: function(response) {
                                    console.log("here");
                                    swal.fire(
                                        'Changed!',
                                        'Your status has been changed.',
                                        'success'
                                    ).then((result)=>{
                                        window.location.reload();
                                    });

                                } 
                            });
                        }
                    })
                    });
                });
                $(document).ready(function(){
                $('.admission_btn_ajax').click(function(e){
                    e.preventDefault();
                    var admissionid = $(this).closest("tr").find('.admission_id_value').val();
                    swal.fire({
                        title: 'Are you Sure?',
                        text: 'You want to change role.',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#9A2124',
                        confirmButtonColor: '#34A853',
                        confirmButtonText: 'Yes, Change it!'
                    }).then((result)=>{
                        if(result.isConfirmed){
                            $.ajax({
                                type: "POST",
                                url: 'change.php',
                                data:{
                                    "admission_btn_set": 1,
                                    "admission_id": admissionid,
                                },
                                success: function(response) {
                                    console.log("here");
                                    swal.fire(
                                        'Changed!',
                                        'Your status has been changed.',
                                        'success'
                                    ).then((result)=>{
                                        window.location.reload();
                                    });

                                } 
                            });
                        }
                    })
                    });
                });  
                $(document).ready(function(){
                $('.delete_btn_ajax').click(function(e){
                    e.preventDefault();
                    var deleteid = $(this).closest("tr").find('.delete_id_value').val();
                    swal.fire({
                        title: 'Are you Sure?',
                        text: 'You want be able to revert back.',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#9A2124',
                        confirmButtonColor: '#34A853',
                        confirmButtonText: 'Yes, Delete it!'
                    }).then((result)=>{
                        if(result.isConfirmed){
                            $.ajax({
                                type: "POST",
                                url: 'delete.php',
                                data:{
                                    "delete_btn_set": 1,
                                    "delete_id": deleteid,
                                },
                                success: function(response) {
                                    console.log("here");
                                    swal.fire(
                                        'Deleted!',
                                        'Your reocrd has been deleted.',
                                        'success'
                                    ).then((result)=>{
                                        window.location.reload();
                                    });

                                } 
                            });
                        }
                    })
                    });
                });  
                $(document).ready(function(){
                $('.teacher_btn_ajax').click(function(e){
                    e.preventDefault();
                    var teacherid = $(this).closest("tr").find('.teacher_id_value').val();
                    swal.fire({
                        title: 'Are you Sure?',
                        text: 'You want to change role.',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#9A2124',
                        confirmButtonColor: '#34A853',
                        confirmButtonText: 'Yes, Change it!'
                    }).then((result)=>{
                        if(result.isConfirmed){
                            $.ajax({
                                type: "POST",
                                url: 'change.php',
                                data:{
                                    "teacher_btn_set": 1,
                                    "teacher_id": teacherid,
                                },
                                success: function(response) {
                                    console.log("here");
                                    swal.fire(
                                        'Changed!',
                                        'Your status has been changed.',
                                        'success'
                                    ).then((result)=>{
                                        window.location.reload();
                                    });

                                } 
                            });
                        }
                    })
                    });
                });    

    </script>
    </body>
</html>