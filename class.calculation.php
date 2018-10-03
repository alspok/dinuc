<?php
class Calculation
{
	public function dinucleotideCalculation($seq){

		$seq = preg_replace("/\r|\n/", "", $seq);
		$seq = strtolower($seq);
		if (preg_match("/[^acgt]/i", $seq)) {
			echo "<br /><br />Use a, c, g, t letters only.";
			exit;
		}
		else {
			echo "Sequence length " . strlen($seq) . "<br>";
			$seqArray = str_split($seq);
			for($i = 0; $i < count($seqArray); $i++){
				if($i % 80 == 0 && $i > 0)  echo '<br>';
				echo $seqArray[$i];
			}
		}

		$seq = strtolower($seq);

		$frameSeq = new FrameSequences();
		$seqArray = $frameSeq -> diSequences($seq);

		$frqArray = new FrqCalculation();
		$frqTable = $frqArray -> frqCalc($seqArray);

		$printTable = new DinucTablePrint();
		$printTable -> diPrint($frqTable);

		$dinucleotideDiff = new DinucDiff();
		$diDiff = $dinucleotideDiff -> dinucDiffCalc($frqTable);
		echo "<br>Dinucleotides frq difference in two frames sum: " . sprintf ("%1\$.4f", $diDiff);
	}
}
?>