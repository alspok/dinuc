<?php
class DinucTable{
    public static $dinuc = array(
            "aa" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "ac" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "ag" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "at" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),

            "ca" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "cc" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "cg" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "ct" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),

            "ga" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "gc" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "gg" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "gt" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),

            "ta" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "tc" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "tg" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
            "tt" => array("1st" => 0, "2nd" => 0, "1stfrq" => 0, "2ndfrq" => 0, "frqDiff" => 0),
    );
}

class DinucTablePrint
{
    function diPrint($diTable){
        echo'<table width="1000" border="0" >';

        echo"<tr>";
        foreach ($diTable[0] as $key => $value){
            echo"<td>$key</td>";
        }
        echo"</tr>";
        //print("<br>");
        echo"<tr>";
        foreach($diTable[0] as $key => $value){
            foreach($value as $key1 => $value1) {
                if ($key1 == "1st") {
                    echo"<td>$value1</td>";
                }
            }
        }
        echo"</tr>";

        echo"<tr>";
        foreach($diTable[0] as $key => $value){
            foreach($value as $key2 => $value2) {
                if ($key2 == "2nd") {
                    echo"<td>$value2</td>";
                }
            }
        }
        echo "</tr>";

        echo"<tr>";
        foreach($diTable[0] as $key => $value){
            foreach($value as $key3 => $value3) {
                if ($key3 == "1stfrq") {
					echo "<td>";
                    echo sprintf("%1\$.4f", $value3);
					echo "</td>";
                }
            }
        }
        echo "</tr>";

        echo"<tr>";
        foreach($diTable[0] as $key => $value){
            foreach($value as $key4 => $value4) {
                if ($key4 == "2ndfrq") {
                    echo "<td>";
                    echo sprintf("%1\$.4f", $value4);
					echo "</td>";
                }
            }
        }
        echo "</tr>";

		echo"<tr>";
		foreach($diTable[0] as $key => $value){
            foreach($value as $key5 => $value5) {
                if ($key5 == "frqDiff") {
                    echo "<td>";
                    echo sprintf("%1\$.4f", $value5);
					echo "</td>";
                }
            }
        }
        echo "</tr>";

        echo'</table>';
    }
}

/* Return sequences for dinuc calculatinion in different dinuc frames.*/
class FrameSequences{
	function diSequences($seq){
		$firstFrameSeq = "";
		$secondFrameSeq = "";
		$mono = "";

		if(strlen($seq) % 2 == 0){
			$firstFrameSeq = $seq;
			$mono = substr($seq, 0, 1);
			$seq = substr($seq, -(strlen($seq) - 1));
			$secondFrameSeq = $seq .= $mono;
		}
		else{
			$firstFrameSeq = substr($seq, 0, (strlen($seq) - 1));
			$secondFrameSeq = substr($seq, 1, (strlen($seq) - 1));
		}
		return array($firstFrameSeq, $secondFrameSeq);
	}
}

/* Dinuc frequencies in two frames */
class FrqCalculation{
	function frqCalc($sqArray){
		$seqFirst = $sqArray[0];
		$seqSecond = $sqArray[1];
		$seqFirstDinucLength = strlen($seqFirst) / 2;
		$seqSecondDinucLength = strlen($seqSecond) / 2;

		$dinucTable = DinucTable::$dinuc;

/* Counts dinuc in seq first frame */
		while(strlen($seqFirst) > 0){
			$dinuc = substr($seqFirst, 0, 2);
			foreach($dinucTable as $di => $values){
				if($di == $dinuc){
					$dinucTable[$di]['1st'] += 1;
					break;
				}
			}
			$seqFirst = substr($seqFirst, 2);
		}

/* Counts dinuc in seq second frame */
		while(strlen($seqSecond) > 0){
			$dinuc = substr($seqSecond, 0, 2);
			foreach($dinucTable as $di => $values){
				if($di == $dinuc){
					$dinucTable[$di]['2nd'] += 1;
					break;
				}
			}
			$seqSecond = substr($seqSecond, 2);
		}

/* Calculates dinuc frequencies in bouth frames */
		foreach($dinucTable as $di => $values){
			$dinucTable[$di]['1stfrq'] = $dinucTable[$di]['1st'] / $seqFirstDinucLength;
			$dinucTable[$di]['2ndfrq'] = $dinucTable[$di]['2nd'] / $seqSecondDinucLength;

			$dinucTable[$di]['frqDiff'] = abs($dinucTable[$di]['1stfrq'] - $dinucTable[$di]['2ndfrq'] );
		}

		return array($dinucTable);
	}
}

/* Dinuc difference in two frames calculation */
class DinucDiff{
	function dinucDiffCalc($diTable){
		$diff = 0;
		foreach($diTable[0] as $key => $value){
			foreach($value as $key1 => $value1){
				if($key1 == "frqDiff"){
					$diff += $value1;
				}
			}
		}
		return $diff;
	}
}
?>