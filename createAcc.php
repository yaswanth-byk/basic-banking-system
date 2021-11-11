<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PEOPLES'Bank</title>
    <link rel="icon" href="icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <script>
        if( window.history.replaceState )
            window.history.replaceState( null, null, window.location.href );
    </script>
    <header>
		<div>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container-fluid">
                    <a class="navbar-brand mb-0 h1" style="color:#ffff66;" href="home.php">
                        <img src="icon.png" alt="" width="30" height="30" class="d-inline-block align-text-top"><b style="color:#ccff66;">PEOPLES'</b>Bank
                    </a>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
							<li class="navbar-brand"><a class="nav-link" href="home.php">Home</a></li>
							<li class="navbar-brand"><a class="nav-link active" href="createAcc.php">Create Account</a></li>
                            <li class="navbar-brand"><a class="nav-link" href="checkBal.php">Check Balance</a></li>
                            <li class="navbar-brand"><a class="nav-link" href="moneyTransfer.php">Money Transfer</a></li>
						</ul>
					</div>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
			</nav>
		</div>
	</header><br>
    <div>
		<form method="post">
            <center>
                <h1>Create Account</h1><br>
                <table>
                    <tr>
                        <td><label class="form-label h3">Name</label></td>
                        <td><input type="text" class="form-control" name="name" required></td>
                    </tr>
                    <tr>
                        <td><label class="form-label h3">Email</label></td>
                        <td><input type="email" class="form-control" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label class="form-label h3">Balance &nbsp;</label></td>
                        <td><input type="number" class="form-control" name="balance" required></td>
                    </tr>
                </table><br>
                <input type="submit" class="btn btn-primary btn-lg" name="create" value="Create">
            </center>
        </form>
	</div>
    <?php
        if(isset($_POST["create"]))
        {
            include("databaseCon.php");
            $name=$_POST['name'];
            $email=$_POST['email'];
            $balance=$_POST['balance'];
            $con=makeConnection();
            $check_user=mysqli_query($con,"select * from Users where email='$email'");
            if(mysqli_num_rows($check_user)==1)
            {
                echo "<script>alert('User already has an Account');</script>";
                exit();
            }
            else
            {
                $add_user="insert into Users(name,email,balance) values('$name','$email',$balance)";
                mysqli_query($con,$add_user);
                mysqli_close($con);
                echo "<script>alert('User Account has been created');</script>";
            }
        }
    ?>
    <footer class="text-center" style="position:fixed;bottom:0;width:100%;background-color:#212529;color:white;">
		<p style="padding-top:1%;">&copy; <script>document.write(new Date().getFullYear());</script> All Rights Reserved</p>
	</footer>
</body>
</html>