# Test Phase App : Car Loan Calculator
## Virtual University of Pakistan

### `index.php`

A simple form with four fields to check person's eligibility
In this form, I am using two jQuery plugins. One for Country picker in nationality and one for date of birth picker. I have included the jquery, css files in `header.php` and jQuery plugins' files in `footer.php` I have used the plugin in `js/main.js`

After form submission, it goes to result.php

### `result.php`

Here it validates the form e.g. Whether all the fields are complete or not, the age, the nationality, the profession.
If there are errors it shows error and a button to go back to eligibility test.
If there are no errors, it redirects the user to calculator.php

### `calculator.php`

Here is the form for the fields to calculate the car loan. After submission, it validates errors. If there are no errors then it shows the
table of calculated form fields.

