jQuery(document).ready(function($) {
	/**
	 * jQuery plugin for date of birth: DobPicker
	 */

	$.dobPicker({
		// Selector IDs
		daySelector: "#dobday",
		monthSelector: "#dobmonth",
		yearSelector: "#dobyear"
	});

	let currentYear = new Date().getFullYear();
	let currentMonth = new Date().getMonth() + 1;

	/**
	 * Calculate and populates the hidden "age" field on homepage from select fields
	 */

	$("#dob").on("change", function() {
		let day = $("#dobday").val();
		let month = $("#dobmonth").val();
		let year = $("#dobyear").val();

		let age = currentYear - year;

		if (month > currentMonth) {
			age -= 1;
		}

		$("#age").val(age);
	});

	/**
	 * jQuery plugin for country select box: CountrySelect
	 */

	$("#country_selector").countrySelect({
		defaultCountry: "pk",
		preferredCountries: ["pk"]
	});
});
