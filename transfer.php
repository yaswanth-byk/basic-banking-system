<?php
    include("databaseCon.php");
    $con=makeConnection();
?>
<html>
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
							<li class="navbar-brand"><a class="nav-link" href="createAcc.php">Create Account</a></li>
                            <li class="navbar-brand"><a class="nav-link" href="checkBal.php">Check Balance</a></li>
                            <li class="navbar-brand"><a class="nav-link active" href="moneyTransfer.php">Money Transfer</a></li>
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
            <h1>Money Transfer</h1><br>
                <table>
                    <?php
                        $fid=$_GET['id'];
                        $fu=mysqli_query($con,"select * from Users where id=$fid");
                        while($rfu=mysqli_fetch_array($fu))
                        {
                            echo "<tr><td><label class='form-label h3'>From</label></td>";
                            echo "<td><input type='text' class='form-control' readonly value='$rfu[1]'></td></tr>";
                            echo "<tr><td><label class='form-label h3'>Balance</label></td>";
                            echo "<td><input type='text' class='form-control' readonly value='$rfu[3]'></td></tr>";
                        }
                        $tu=mysqli_query($con,"select * from Users where id not in($fid)");
                        echo "<tr><td><label class='form-label h3'>To</label></td>";
                        echo "<td><select name='to' class='form-select' required>";
                        echo "<option value='' disabled selected>Select</option>";
                        while($rtu=mysqli_fetch_array($tu))
                        {
                            echo "<option value='$rtu[0]'>".$rtu[1]."</option>";
                        }
                        echo "</select></td></tr>";
                    ?>
                    <tr>
                        <td><label class="form-label h3">Amount &nbsp;</label></td>
                        <td><input type="number" class="form-control" name="amount"></td>
                    </tr>
                </table><br>
                <Button type="submit" class="btn btn-success btn-lg" name="sbm">Transfer</Button>
                <?php
                if(isset($_POST['sbm']))
                {
                    $from=$_GET['id'];
                    $to=$_POST['to'];
                    $amt=$_POST['amount'];
                    $s1=mysqli_query($con,"select * from Users where id=$from");
                    $rs1=mysqli_fetch_array($s1);
                    $s2= mysqli_query($con,"select * from Users where id=$to");
                    $rs2= mysqli_fetch_array($s2);
                    if($amt<=0)
                    {
                        echo "<script>alert('Enter valid Amount')</script>";
                    }
                    else if($amt>$rs1[3])
                    {
                        echo "<script>alert('Insufficient Balance')</script>";
                    }
                    else
                    {
                        $nb=$rs1[3]-$amt;
                        mysqli_query($con,"update Users set balance=$nb where id=$from");
                        $nb=$rs2[3]+$amt;
                        mysqli_query($con,"update Users set balance=$nb where id=$to");
                        mysqli_close($con);
                        echo "<script>alert('Transaction Successful')</script>";
                        echo "<script>window.location='moneyTransfer.php'</script>";
                    }
                }
                ?>
            </center>
        </form>
    </div>
    <footer class="text-center" style="position:fixed;bottom:0;width:100%;background-color:#212529;color:white;">
		<p style="padding-top:1%;">&copy; <script>document.write(new Date().getFullYear());</script> All Rights Reserved</p>
	</footer>
</body>
</html>