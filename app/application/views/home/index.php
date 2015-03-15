
<div class="landing">

<h1>Tweet<span>Daily</span></h1>


<!-- <p class="sub">
	Making Twitter cool again :-)
</p> -->

<p>Do you sometimes miss on very important postings by very important 
	people? Please put a smile on your face because your problems, will soon come 
to and beautiful end.</p>

<p>So far <strong><?php echo $user_number;?> people</strong> <em>seem</em> like this service...</p>
<p class="call">We will invite you for a beta <em>fail-fast</em> release, next week
<?php 

if($this->session->userdata('first_name') == ""){
	echo ", please sign up.</p>";

	echo anchor("home/register",
		"<i class='fa fa-thumbs-o-up'></i> Sign Up Now","class='btn btn-lg btn-primary'");
}else{
	echo "</p>";
	echo("<p class='em'><i class='fa fa-thumbs-o-up'></i> Thanks for <strong>Signing Up</strong>, we'll keep you posted.</p>");
}

?>

</div>