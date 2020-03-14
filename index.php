<?php include_once  "header.php"; ?>

<main>
	<div class="heading">
		Check eligibility
	</div>
	<form action="result.php" method="post">
		<div class="form-field">
			<label for="nationality">Nationality</label>
			<input id="country_selector" type="text" name="nationality" required />
		</div>
		<div class="form-field" id="dob">
			<label for="dob">Date of Birth</label>
			<select id="dobday" required></select>
			<select id="dobmonth" required></select>
			<select id="dobyear" required></select>
			<input type="hidden" name="age" value="" id="age" />
		</div>
		<div class="form-field">
			<label for="income">Monthly Income (PKR):</label>
			<input type="text" name="income" id="income" required />
		</div>
		<div class="form-field">
			<label for="">Profession</label>
			<label for="job">
				<input type="radio" name="profession" id="job" value="job" />Salaried
			</label>
			<label for="business">
				<input type="radio" name="profession" id="business" value="business"/>Business
			</label>
		</div>
		<input type="submit" value="Check" name="check" />
	</form>
</main>

<?php include_once "footer.php";