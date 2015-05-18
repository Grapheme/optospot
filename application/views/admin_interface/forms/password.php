<form action="<?=site_url(uri_string())?>" method="POST" class="form-horizontal form-save-password">
    <fieldset>
        <label>New password:</label>
        <input type="password" name="password"><br>
        <label>Confirm password:</label>
        <input type="password" name="confirm_password"><br>
    </fieldset>
    <hr>
    <div class="form-actions">
        <button class="btn btn-success"name="submit" type="submit" value="Send">Save</button>
    </div>
</form>