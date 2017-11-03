<?php
	include 'elements.php';

    // sticky form, init
	$num1 = isset($_POST['num1']) ? $_POST['num1'] : "";
	$num2 = isset($_POST['num2']) ? $_POST['num2'] : "";
	$num3 = isset($_POST['num3']) ? $_POST['num3'] : "";
	$ele1 = isset($_POST['ele1']) ? $_POST['ele1'] : "";
	$ele2 = isset($_POST['ele2']) ? $_POST['ele2'] : "";
	$ele3 = isset($_POST['ele3']) ? $_POST['ele3'] : "";

	function compute($ele1, $ele2, $ele3, $num1, $num2, $num3, $array) {
		if (isset($ele1) || isset($ele2) || isset($ele3)) {
			// pass over if 0, null, or negative
			$mole1 = "";
			$mole2 = "";
			$mole3 = "";
			$result = "";

			if ($num1 > 0)
	 			$mole1 = printElement($ele1, $num1);
	 		if ($num2 > 0)
	 			$mole2 = printElement($ele2, $num2); 
	 		if ($num3 > 0)
	 			$mole3 = printElement($ele3, $num3); 
	 		$weigh = ($array[$ele1]*$num1) + ($array[$ele2]*$num2) + ($array[$ele3]*$num3);

	 		// if some content
	 		if ($num1 != "" || $num2 != "" || $num3 == "")
	 			$result = "The weight of " . $mole1 . $mole2 . $mole3 . " is " . $weigh;
	 		return $result;
	 	}
	}

	// prints one element with its subscript
    function printElement($elem_name, $count) {
    	if ($count != 1) {
    		$sub = "<sub>$count</sub>";
    		$molecule = $elem_name . $sub;
    		return $molecule;
    	}
    	return $elem_name;
    }
?>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/molecule.css">
	</head>

	<body>

		<form action="molecule.php" method="post">
			<fieldset>
				<legend>Select the elements and enter quantities to calculate molecular weight</legend>
					<select name="ele1">
						<?php
						foreach($atomicWeight as $key1 => $value) { 
							if ($key1 == $ele1) { ?>
								<option selected="selected" value="<?php echo $key1 ?>"><?php echo $key1 ?></option>
							<?php } 
							else { ?>
								<option value="<?php echo $key1 ?>"><?php echo $key1 ?></option>
  							<?php }
  						} ?>
  					</select>
					<input type="text" name="num1" value="<?php echo $num1; ?>"/><br>

					<select name="ele2">
						<?php
						foreach($atomicWeight as $key2 => $value) { 
							if ($key2 == $ele2) { ?>
								<option selected="selected" value="<?php echo $key2 ?>"><?php echo $key2 ?></option>
							<?php } 
							else { ?>
								<option value="<?php echo $key2 ?>"><?php echo $key2 ?></option>
  							<?php } 
  						} ?>
  					</select>
					<input type="text" name="num2" value="<?php echo $num2; ?>"/><br>

					<select name="ele3">
						<?php 
						foreach($atomicWeight as $key3 => $value) {
							if ($key3 == $ele3) { ?>
								<option selected="selected" value="<?php echo $key3 ?>"><?php echo $key3 ?></option>
							<?php } 
							else { ?>
								<option value="<?php echo $key3 ?>"><?php echo $key3 ?></option>
  							<?php } 
  						} ?>
  					</select>
					<input type="text" name="num3" value="<?php echo $num3; ?>"/><br><br>

					<button id="submit" type="submit">Calculate!</button><br>
			</fieldset>
		</form>

		<?php if (isset($_POST['ele1']) || isset($_POST['ele2']) || isset($_POST['ele3'])) { ?>
			<div id="answer"><?php echo compute($ele1, $ele2, $ele3, $num1, $num2, $num3, $atomicWeight) ?></div>
		<?php } ?>
	</body>
</html>