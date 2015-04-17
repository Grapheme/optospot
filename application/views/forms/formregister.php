<ul class="switcher">
	<li><?=anchor('','<span>Real Trade</span>',array('class'=>'switcher__active'));?></li>
	<li><?=anchor('','<span>Demo Trade</span>');?></li>
</ul>
<div class="signup-form">
	<form id="signup-form" action="http://vl608.sysfx.com:8022/registration.aws?SCHEMA$=tfx22" method="post" target="signup_iframe">
		<input type="hidden" name="answerType" value="xml" />
		<input type="hidden" name="act" value="send" />
		<input type="hidden" name="office" value="main" />
		<input type="text" name="fname" placeholder="First name" />
		<input type="text" name="lname" placeholder="Last name" />
		<input type="text" name="email" placeholder="Email" />
		<select name="COUNTRY" class="" id="">
			<option disabled="disabled" selected="selected">Country</option>
			<option value="United States">United States</option>
			<option value="United Kingdom">United Kingdom</option>
			<option value="Russian Federation">Russian Federation</option>
		</select>
		<input type="text" name="PHONE" placeholder="Phone" />
		<input type="checkbox" checked="checked" name="coach"/> <label for="coach">I'd like to speak with a trading coach</label>
		<button id="signup-btn" type="submit" class="btn btn-action" name="Submit">Open Account</button>
	</form>
	<!-- <iframe id="signup_iframe" name="signup_iframe"> </iframe> -->
</div>