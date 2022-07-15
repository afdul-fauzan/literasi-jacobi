<?php
$a = $_POST["a"];
$b = $_POST["b"];
$c = $_POST["c"];
$n = $_POST["o"];

$x = array();
$y = array();
$z = array();

$x[] = 0;
$y[] = 0;
$z[] = 0;

$list_iterasi = "<table class='table table-striped table-bordered' style='text-align:center;font-size:1.08rem'>";
$list_iterasi .= "<thead>";
$list_iterasi .= "<tr>";
$list_iterasi .= "<th>Iterasi ke-</th>";
$list_iterasi .= "<th>x</th>";
$list_iterasi .= "<th>y</th>";
$list_iterasi .= "<th>z</th>";
$list_iterasi .= "</tr>";
$list_iterasi .= "</thead>";
$list_iterasi .= "<tbody>";

for($i=1; $i <= $_POST["ulangan"]; $i++){
    $x[$i] = number_format((float)($n[0] - ($b[0] * $y[$i - 1]) - ($c[0] * $z[$i - 1])) / $a[0], 3, '.', '');
    $y[$i] = number_format((float)($n[1] - ($a[1] * $x[$i - 1]) - ($c[1] * $z[$i - 1])) / $b[1], 3, '.', '');
    $z[$i] = number_format((float)($n[2] - ($a[2] * $x[$i - 1]) - ($b[2] * $y[$i - 1])) / $c[2], 3, '.', '');
    $list_iterasi .= "<tr>";
	$list_iterasi .= "<td>".$i."</td>";
	$list_iterasi .= "<td>".$x[$i]."</td>";
	$list_iterasi .= "<td>".$y[$i]."</td>";
	$list_iterasi .= "<td>".$z[$i]."</td>";
	$list_iterasi .= "</tr>";
}

$list_iterasi .= "</tbody>";
$list_iterasi .= "</table>";

$html = "";
for ($j=0;$j<count($a);$j++) {
	$html .= "<h5>";
	$html .= $a[$j]."x";
	if ($b[$j] >= 0) {	
		$html .= "+".$b[$j]."y";
	}else{
		$html .= $b[$j]."y";
	}	

	if ($c[$j] >= 0) {	
		$html .= "+".$c[$j]."z";
	}else{
		$html .= $c[$j]."z";
	}

	$html .= " = ".$n[$j];	
	$html .= "</h5>";	
}
$returnarray = array();
$returnarray["x"] = $x[$_POST["ulangan"]];
$returnarray["y"] = $y[$_POST["ulangan"]];
$returnarray["z"] = $z[$_POST["ulangan"]];
$returnarray["list_iterasi"] = $list_iterasi;
$returnarray["data"] = $html;

echo json_encode($returnarray);

?>