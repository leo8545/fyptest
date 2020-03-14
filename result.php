<?php 
include_once "header.php";
require "functions.php";

$error = false;
$error_message = [];

if( isset( $_POST["check"] ) ) {
	$fields = array(
		"nationality", "age", "income", "profession"
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
		$nationality = $_POST["nationality"];
		$age = (int) $_POST["age"];
		$income = (int) $_POST["income"];
		$profession = $_POST["profession"];
	
		// Check age
		if( $profession === "job" && $age < 25 || $age > 50 ) {
			$error = true;
		} else if ( $profession === "business" && $age < 25 || $age > 70 ) {
			$error = true;
		}
		
		// Check nationality
		if( substr( $nationality, 0, 8 ) !== "Pakistan" ) {
			$error = true;
		}

		// Check income
		if( $profession === "job" && $income <= 70000 ) {
			$error = true;
		} else if ( $profession === "business" && $income <= 85000 ) {
			$error = true;
		}
	
		if ($error) {
			$error_message[] = "You are not eligible for this loan";
		}
	}
	
}
?>

<main>
	<?php if( $error ) { ?>
	<div class="info-box">
		<ul>
			<?php foreach( $error_message as $msg ): ?>
			<li><?php echo $msg; ?></li>	
			<?php endforeach; ?>
		</ul>
		<a href="./index.php" class="btn">Go back</a>
	</div>
	<?php 
	} else {
		setcookie("eligible", "passed");
		header("location: calculator.php");	
	}
	?>
</main>

<?php include_once "footer.php"; ?>