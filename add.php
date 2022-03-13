<?php
session_start();
include('System/Database.php');

$lastkmh=0;
$Apostash=0;
$currentkmh=0;
$count=0;
$sumliter=0;
$sumkmh=0;
$summoney=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>KymcoPetrol</title>
</head>
<body>
	<div class="container">
	<?php
		if(isset($_SESSION['SessionPassToYourWeb'])){
			if($_SESSION['SessionPassToYourWeb']=='SessionPassToYourWeb'){		
				echo '<div class="menu"><a class="hrefA" href="#">link1</a>&nbsp;&nbsp; <a class="hrefA" href="#">link2</a></div>';
			}
		}
		else{
			echo "<script>window.location.href='#';</script>";
			exit;
		}
												
?>
<?php
if(isset($_POST['AddKmh'])){
$inputDate=date("Y-m-d");
$inputKmh=$_POST['NewKmh'];
$inputLiters=$_POST['NewLit'];
$inputLitrePrice=$_POST['price'];	

$erotima='INSERT INTO YourTable(saveDate, saveKmh, saveLitres, saveLitre_price) VALUES ("'.$inputDate.'","'.$inputKmh.'","'.$inputLiters.'","'.$inputLitrePrice.'")';
$result=import($erotima);
if($result){
echo $result;
}	
}

?>
		<h1>KYMCO JetiX 125</h1>
		<div class="lastKmh">
		<?php
		
			$erotima="SELECT saveKmh FROM YourTable ORDER BY id DESC LIMIT 1;";
			$lastCount=select($erotima);
			foreach($lastCount as $value){
				$lastCountkmh=$value['saveKmh'];
			}
				?>
			<p >Προηγούμενα χιλιόμετρα </p>
			<p><?php echo($lastCountkmh);?></p>
		</div>
		<div class="NewKmh">
			<form action="add.php" method="POST">
			  <label class="NKmh" for="NewKmh">New Kmh:</label><br>
			  <input class="inputKmh" type="number" id="NewKmh" name="NewKmh" value="0.0" step="0.1">
			  <label class="NKmh" for="NewLit">Liters:</label><br>
			  <input class="inputKmh" type="number" id="NewLit" name="NewLit" value="0.000" step="0.001">
			  <label class="NKmh" for="pr">Liter Price:</label><br>
			  <input class="inputKmh" type="number" id="pr" name="price" value="0.000" step="0.001">
			  <input class="subKmh" type="submit" value="Add" name="AddKmh">
			</form> 
		</div>
		<h2>Data:</h2>
		<div class="export">
		<?php
		$erotima="SELECT * FROM YourTable";
			$myarray=select($erotima);
			foreach($myarray as $value){
				$count++;
				$proc_lastkmh=$currentkmh;
				$proc_currentkmh=$value['saveKmh'];
				$ex_date=$value['saveDate'];
				$proc_litres=$value['saveLitres'];
				$proc_posoLitrou=$value['saveLitre_price'];
				$proc_Apostash=$proc_currentkmh-$proc_lastkmh;
				$proc_katanalosi=$proc_litres/$proc_Apostash;
				$proc_posoPliromis=$proc_litres*$proc_posoLitrou;
				$proc_euroPerKmh=$proc_katanalosi*$proc_posoLitrou;
				
				
				
			
				if($count>1){
					$proc_sumliter=$proc_sumliter+$proc_litres;
					$proc_sumkmh=$proc_sumkmh+$proc_Apostash;
					$proc_summoney=$proc_summoney+$proc_posoPliromis;
					
					$ex_format_katanalosi = number_format($proc_katanalosi, 3);
					$ex_format_litres = number_format($proc_litres, 1);
					$ex_format_Apostash = number_format($proc_Apostash, 1);
					$ex_format_posoPliromis = number_format($proc_posoPliromis, 2);
					$ex_format_euroPerKmh = number_format($proc_euroPerKmh, 3);
					
					
					?>
				
				<span class="exData"><?php echo($ex_date. ' '. $ex_format_katanalosi.'lit/Kmh '.$ex_format_litres.'lit '.$ex_format_Apostash .'kmh '.$ex_format_posoPliromis.'€ ' .$ex_format_euroPerKmh .' €/kmh');?></span>
				
				
				<?php
				}
				}
		?>
		
		</div>
		<?php
		$ex_format_sumliter = number_format($proc_sumliter, 1);
		$ex_format_sumkmh = number_format($proc_sumkmh, 1);
		$ex_format_summoney = number_format($proc_summoney, 2);
		
		
		?>
		<div class="sum">
		<span class="exData2"><?php echo($ex_format_sumliter . 'Lit - '.$ex_format_sumkmh .'kmh - '.$ex_format_summoney . '€ '  );?></span>
		</div>
		<span class="copy">&copy Alexandros Kountouris March 2022</span>
	</div>
</body>
</html>