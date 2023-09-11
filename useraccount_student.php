<?php
    include 'scriptandlinks.php';

session_start();
if(($_SESSION['loggedin']!='true') || ($_SESSION['loggedin']!=true)){
    header("location: login.php");
    exit;
}
$id = $email = $password = $userimage = '';
$email = $_SESSION['email'];
include 'db.php';
$sql = "select * from users where email = '$email';";
$res = mysqli_query($con, $sql);
$data = mysqli_fetch_array($res);
$userid = $data['id'];
$password = $data['password'];
$userimage = $data['userimage'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>	   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
        
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
                display: none;
            }
            #mua{
                display:none;
            }
            #msa{
                display:none;
            }
            #mu{
                display:none;
            }
            #adm{
                display:none;
            }
            #tec{
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
            #hm{
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
                    display: none;
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
                    content: "Password: ";
                }
                table td:nth-child(4)::before {
                    content: "User Image: ";
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
        ?>
        <div>
            <h1 class='text-center'>User Details</h1>
            <div class="container">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Email</td>
                            <td>password</td>
                            <td>User Image</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $userid;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $password;?></td>
                            <td><img src="<?php echo $userimage;?>" width="100" height="100"></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </body>
</html>