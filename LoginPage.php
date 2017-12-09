<!DOCTYPE html>
<html>
<head>
<title>Add Card</title>
<style type="text/css">
body
{
   margin-left: 100px;
   margin-right: 100px;
   color:black;
}	
form
{
font-size:20px;
font-style:bold;
}
.error {color: #FF0000;}
table,th,tr,td
{
	border: 2px solid black;padding: 30px;font-size: 20px;border-collapse: collapse;
}
th
{
	padding: 10px;
}
</style>
</head>

<body>


<h1 style="color:darkblue;"> <i><center>YOUR CARD DETAILS</center></i></h1>
<hr/> <br/><br/>
<br/><br/>

<?php
$cno=$_GET['cardNumber'];
$tid=$_GET['tid'];
$link = mysqli_connect("localhost", "root", "","credit_card_database");
$sql="Select card.CardNumber,card.name,CVV,CardMonth,CardYear,user.Tid,Amount,Balance from card,user,transaction,bank_details where card.CardNumber=$cno and user.tid=$tid and card.CardNumber=bank_details.cardnumber and card.CardNumber=user.cardnumber and user.tid=transaction.tid";

if($result = mysqli_query($link, $sql)){
if(mysqli_num_rows($result) > 0){
echo "<table>";
echo "<tr>";
echo "<th>CARD NUMBER</th>";
echo "<th>NAME</th>";
echo "<th>CVV</th>";
echo "<th>CARD MONTH</th>";
echo "<th>CARD YEAR</th>";
echo "<th>Transaction ID</th>";
echo "<th>PAYMENT AMOUNT</th>";
echo "<th>BALANCE</th>";


echo "</tr>";
$row = mysqli_fetch_array($result);
echo "<tr>";
echo "<td>" . $row['CardNumber'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['CVV'] ."</td>";
echo "<td>" . $row['CardMonth'] . "</td>";
echo "<td>" . $row['CardYear'] . "</td>";
echo "<td>" . $row['Tid'] . "</td>";
echo "<td>" . $row['Amount'] . "</td>";
echo "<td>" . $row['Balance'] . "</td>";
echo "</tr>"; 
echo "</table>";

if( $row['Amount']< $row['Balance'])
{
	$x= -($row['Amount']-$row['Balance']);
	$y=$row['CardNumber'];
	echo "<br><br><hr><br> <h2>PAYMENT SUCCESSFUL NEW BALANCE = $x  </h2><br><br>  ";
	mysqli_query($link,"Update bank_details set balance=$x where cardnumber=$y;");
	mysqli_query($link,"delete from user where cardnumber=$y");
}
else
{
	echo "<br><br><hr><br> <h2>PAYMENT UNSUCCESSFUL NOT ENOUGH BALANCE!!  </h2><br><br>";

}
mysqli_free_result($result);
}
}  
?>
</body>
</html>