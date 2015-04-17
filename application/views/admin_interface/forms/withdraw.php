<form action="?action=pay" method="POST" class="form-horizontal form-edit-settings">
	<fieldset>
		<label>Choose payment system:</label>
		<select name="payment">
			<option value="visa">Visa</option>
			<!--<option value="2">Mastercard</option>
			<option value="3">Qiwi</option>
			<option value="4">Яндекс.Деньги</option>
			<option value="5">Webmoney</option>-->
		</select>
		<label>Specify the account number to withdraw money:</label>
		<input type="text" name="account"><br>
		<label>Expire date:</label>
		<input type="text" name="expiry"><br>
		<label>Specify the amount of money, USD:</label>
		<input type="text" name="amount"><br>
	</fieldset>
		
	<div class="form-actions">
		<button class="btn btn-success" type="submit" value="Send money">Send money</button>
	</div>
</form>