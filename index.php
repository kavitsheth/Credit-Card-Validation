<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Credit Card Validation Demo</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/demo.css">
</head>

<body>
    <div class="container-fluid">
        <div class="creditCardForm">
            <div class="heading">
                <h1>Confirm Purchase</h1>
            </div>
            <div class="payment">
                <form method="POST">
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" name="cvv">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" name="cardNumber">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">TRANSACTION ID</label>
                        <input type="text" class="form-control" name="tid">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="Pyment Amount">Payment Amount</label>
                        <input type="text" class="form-control" name="PaymentAmount">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select name="cardMonth">
                            <option value="01">January</option>
                            <option value="02">February </option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="cardYear">
                            <option value="16"> 2016</option>
                            <option value="17"> 2017</option>
                            <option value="18"> 2018</option>
                            <option value="19"> 2019</option>
                            <option value="20"> 2020</option>
                            <option value="21"> 2021</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="assets/images/visa.jpg" id="visa">
                        <img src="assets/images/mastercard.jpg" id="mastercard">
                        <img src="assets/images/amex.jpg" id="amex">
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
                        <br><br><a href="admin.html"> LOGIN AS ADMIN</a><br>
                    </div>
                </form>
            </div>
        </div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
$sql = mysqli_connect("localhost", "root","","credit_card_database");
$name = $_POST['name'];
$cvv= $_POST['cvv']; 
$cardNumber= $_POST['cardNumber'];
$cardMonth= $_POST['cardMonth'];
$cardYear= $_POST['cardYear']; 
$payment=$_POST['PaymentAmount'];
$tid= $_POST['tid']; 
$que = "Select * from card where CardNumber=$cardNumber and CVV=$cvv";
$result = mysqli_query($sql,$que);
$row = mysqli_fetch_array($result);
$z=0;
	if(is_array($row)) 
	{
    mysqli_query($sql,"INSERT into user VALUES ($cardNumber,$tid);");
   
    mysqli_query($sql,"INSERT into transaction VALUES ($tid,$payment);");
    $z=1;
}
 
	else {
     echo "<script type='text/javascript'>alert('INVALID DETAILS');</script>";
	
	}
    if($z==1)
    header("Location://localhost\LoginPage.html?cardNumber='$cardNumber'&tid='$tid' ");

}

?>

</body>

</html>
