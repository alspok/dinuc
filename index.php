<!DOCTYPE HTML>

<html>
	<head>
		<title>Alspok dinuc</title>
		<style><?php require_once('style.css'); ?></style>
		<?php
		require_once('class.calculation.php');
		require_once('class.dinuccalc.php');
		?>
	</head>
	<body>
		<h2>Dinuc calculation.</h2>
		<h3>Input seq. Use acgt or ACGT only.</h3><br>
		<form action='' method='post'>
			<textarea class='textarea' name='sequence'><?php
				seqInput();
				seqList();
				clear();
			?></textarea><br><br>

			<input type='submit' name='calculate' value='Calculate' >
			<input type='submit' name='clear' value='Clear seq'>

			<h3>Select sequence:</h3>
			<select name='seqselect'>
				<option>Select seq</option>
				<option value='coli'>Escherichia coli</option>
				<option value='cerevisiae'>Saccharomyces cerevisiae</option>
				<option value='sapience'>Homo sapiens</option>
			</select><br><br>
			
			<input type='submit' name='enterseq' value='Emter seq'>
		</form>
	</body>
</html>

<?php
//include_once 'class.calculation.php';

if(!empty($_POST['calculate']) && !empty($_POST['sequence'])){
	$sequence = $_POST['sequence'];
	// echo $_POST['sequence'];
	$dinuc = new Calculation();
	$dinuc -> dinucleotideCalculation($sequence);
}

if(!empty($_POST["enterseq"]) && !empty($_POST['calculate'])){
	$_POST['sequence'] = file_get_contents('_' . $_POST["seqselect"] . '.seq');
	$sequence = $_POST['sequence'];
	$dinuc = new Calculation();
	$dinuc -> dinucleotideCalculation($sequence);
}

function seqInput(){
	
	if(!empty($_POST['calculate'])){
		echo $_POST['sequence'];
	}
}

function seqList(){

	if(!empty($_POST["enterseq"])){
		$_POST['sequence'] = file_get_contents('_' . $_POST["seqselect"] . '.seq');
		$sequence = $_POST['sequence'];
		echo $sequence;
	}
}

function clear(){
	if(!empty($_POST['clear'])){
		$_POST['sequence'] = '';
		echo '';
	}
}