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
    <?php
        include("databaseCon.php");
        $con=makeConnection();
    ?>
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
							<li class="navbar-brand"><a class="nav-link" href="createAcc.php">Create Account</a></li>
                            <li class="navbar-brand"><a class="nav-link active" href="checkBal.php">Check Balance</a></li>
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
					<table>
                        <tr>
                            <td><label class="form-label h3">Account &nbsp;</label></td>
                            <td><select class="form-select" name="user" required>
                            <option value="">Select</option>
                            <?php
                                $us=mysqli_query($con,"select * from Users");
                                while($data=mysqli_fetch_array($us))
                                {
                                    if(isset($_POST["get"])&&$data[1]==$_POST["user"])
                                        echo "<option value='$data[1]' selected>".$data[1]."</option>";
                                    else
                                        echo "<option value='$data[1]'>".$data[1]."</option>";
                                }
                            ?>
                            </select></td>
                            <?php
                                if(isset($_POST['get']))
                                {
                                    $us_name=$_POST['user'];
                                    $us_q=mysqli_query($con,"select * from Users where name='$us_name'");
                                    $row=mysqli_fetch_array($us_q);
                                    $e=$row[2];
                                    $b=$row[3];
                                }
                            ?>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td colspan="2" style="text-align:center;"><button type="submit" class="btn btn-info" name="get" formnovalidate onclick="checkBal()">Check Balance</button></td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td><label class="form-label h3">Email</label></td>
                            <td><input type="email" class="form-control" name="email" readonly value=<?php if(isset($_POST['get'])){echo $e;} ?>></td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td><label class="form-label h3">Balance</label></td>
                            <td><input type="number" class="form-control" name="balance" readonly value=<?php if(isset($_POST['get'])){echo $b;} ?>></td>
                        </tr>
                    </table>
				</center>
			</form>
        </div>
    <footer class="text-center" style="position:fixed;bottom:0;width:100%;background-color:#212529;color:white;">
		<p style="padding-top:1%;">&copy; <script>document.write(new Date().getFullYear());</script> All Rights Reserved</p>
	</footer>
</body>
</html>