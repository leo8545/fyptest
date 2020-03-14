<?php 
include_once "header.php";
require "functions.php";

// Access this page only if this cookie is set, else redirect to home
if( $_COOKIE["eligible"] !== "passed" ) {
	header("Location: index.php");
}

$error = false;
$error_message = [];

if( isset($_POST["calculate"]) ) {

	$fields = array(
		"carName", "carCost", "carDownPayment", "years", "markup"
	);
	
	// Check if any field is empty
	foreach( $fields as $field ) {
		if ( is_empty($field) ) {
			$error = true;
			$error_message[] = "Please complete all the fields.";
		break;
		}
	}

	if( !$error ) {
		$carName = $_POST["carName"];
		$carDownPayment = $_POST["carDownPayment"];
		$carCost = (int) $_POST["carCost"];
		$markup = $_POST["markup"];
		$years = (int) $_POST["years"];

		// Check car name
		$allowed_models = array(
			"honda", "suzuki", "toyota"
		);
		if( !in_array($carName, $allowed_models) ) {
			$error = true;
			$error_message[] = "Please choose a valid car model.";
		}

		// Check down payments
		if( $carDownPayment < 20 || $carDownPayment > 50 ) {
			$error = true;
			$error_message[] = "Please choose a valid down payment.";
		}

		// Check mark up
		if( $markup < 10 || $markup > 15 ) {
			$error = true;
			$error_message[] = "Please choose a valid markup.";
		}

		// Check number of years
		$allowed_years = [3,4,5];
		if( !in_array($years, $allowed_years)) {
			$error = true;
			$error_message[] = "Please choose available number of years";
		}

		if( !$error ) {
			// echo "<h1>HURRAH</h1>";
			$carDown = $carDownPayment * ($carCost / 100);
			// echo $carDown;
			$remaining = $carCost - $carDown;
			// echo $remaining;
			$yearly_inst = round( $remaining / $years, 2 );
			// echo $yearly_inst;
			$monthly_inst = round( $yearly_inst / 12, 2 );
			// echo $monthly_inst;
			$markup_per_annum = ($remaining * ($markup / 100)) / 12;
			// echo $markup_per_annum;
			$total_payment = round( $monthly_inst + $markup_per_annum, 2 );
			// echo $total_payment;
		}
	}
}

?>

<main>
	<div class="heading">Calculate car loan</div>
	<?php if( $error ) { ?>
	<div class="info-box">
		<ul>
			<?php foreach( $error_message as $msg ): ?>
			<li><?php echo $msg; ?></li>	
			<?php endforeach; ?>
		</ul>
	</div>
	<?php 
	} ?>
	<form action="" method="post" class="calculate-form">
		<div class="form-field">
			<label for="carName">Car Name/Model:</label>
			<select name="carName" id="carName">
				<option value="">Choose model...</option>
				<option value="honda" <?php checked("carName", "honda"); ?>>Honda</option>
				<option value="suzuki" <?php checked("carName", "suzuki"); ?>>Suzuki</option>
				<option value="toyota" <?php checked("carName", "toyota"); ?>>Toyota</option>
			</select>
		</div>
		<div class="form-field">
			<label for="carCost">Car Cost (PKR):</label>
			<input type="text" name="carCost" id="carCost" value="<?php print_field_value("carCost"); ?>" />
		</div>
		<div class="form-field">
			<label for="carDownPayment">Down Payment:</label>
			<input type="number" min="20" max="50" name="carDownPayment" id="carDownPayment" value="<?php print_field_value("carDownPayment", 20); ?>" />%
		</div>
		<div class="form-field">
			<label for="years">Number of Years</label>
			<select name="years" id="years">
				<option value="">Choose...</option>
				<option value="3" <?php checked("years", "3"); ?>>3 years</option>
				<option value="4" <?php checked("years", "4"); ?>>4 years</option>
				<option value="5" <?php checked("years", "5"); ?>>5 years</option>
			</select>
		</div>
		<div class="form-field">
			<label for="markup">Markup Rate:</label>
			<input type="number" min="10" max="15" name="markup" id="markup" value="<?php print_field_value( "markup", 10 ); ?>" />%
		</div>
		<input type="submit" name="calculate" id="calculate" value="Calculate" /> 
	</form>
	<?php if( !$error && isset($total_payment) ): ?>
	<div class="table">
		<table>
			<tr>
				<td></td>
				<td>(in Pakistani rupees)</td>
			</tr>
			<tr>
				<td>Total Cost</td>
				<td><?php echo $carCost; ?></td>
			</tr>
			<tr>
				<td>Down Payment</td>
				<td><?php echo $carDown; ?></td>
			</tr>
			<tr>
				<td>Remaining</td>
				<td><?php echo $remaining; ?></td>
			</tr>
			<tr>
				<td>Yearly Installment</td>
				<td><?php echo $yearly_inst; ?></td>
			</tr>
			<tr>
				<td>Monthly Installment</td>
				<td><?php echo $monthly_inst; ?></td>
			</tr>
			<tr>
				<td>Total Payment per month at <?php echo $markup; ?>% markup</td>
				<td><?php echo $total_payment; ?></td>
			</tr>
		</table>
	</div>
	<?php endif; ?>
</main>

<?php include_once "footer.php";
