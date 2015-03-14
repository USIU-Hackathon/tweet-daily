<div class="row">
	<div class="col-md-6" style="padding-top:60px;">
		<?php
		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		?>
	</div>
	<div class="col-md-6">
		<h3>Sign Up <span>for TweetDaily</span></h3>
		<?php

		echo form_open("home/register/submit","class='form'");
		echo form_input("first_name",set_value("first_name"),"class='half'");
		echo form_input("last_name",set_value("last_name"),"class='half'");
		echo form_label("First Name <span class='right'>Last Name</span>","first_name");

		echo form_input("email",set_value("email"));
		echo form_label("Email (Will be used for logging in)","email");
		echo form_password("password",set_value("password"),"class='half'");
		echo form_password("password_confirm",set_value("password_confirm"),"class='half'");
		echo form_label("Set new Password for this system <span class='right'>Confirm Password</span>","password");

		echo form_submit("register","Register","class='btn btn-lg btn-success'");

		?>
	</div>
</div>
