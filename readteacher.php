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
<?php
$id = $name = $class= $section = $country = $state = $city  = $image = '';
$id = $_GET['id'];
include 'db.php';
$sql = "select * from users where id='$id';";
$res = mysqli_query($con, $sql);
$data = mysqli_fetch_array($res);

$name = $data['name'];
$role = $data['role'];
$class = $data['class'];
$section = $data['section'];
$country = $data['country'];
$state = $data['state'];
$city = $data['city'];
$image = $data['userimage'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Details</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--for font awesome icons-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
            #msm{
                display:none;
            }
            #msa{
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
                    content: "Name: ";
                }
                table td:nth-child(3)::before {
                    content: "Country: ";
                }
                table td:nth-child(4)::before {
                    content: "State: ";
                }
                table td:nth-child(5)::before {
                    content: "City: ";
                }
                table td:nth-child(6)::before {
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
            <div class="container"><div class="row"><div class="col-12">
            <h1>Details</h1>
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Country</td>
                            <td>State</td>
                            <td>City</td>
                            <td>Image</td>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $country;?></td>
                            <td><?php echo $state;?></td>
                            <td><?php echo $city;?></td>
                            <td><img src="<?php echo $image?>" width="100" height="100"></td>
                        </tr>
                    </tbody>
                </table>
            
                <a href="generate_pdf.php?id='<?php echo $id;?>'" class="btn btn-success" title="Generate PDF" data-toogle="tooltip">Download PDF</a>                
                    <br><br>
            </div></div></div>
        </div>
    </body>
</html>