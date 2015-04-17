<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin_interface/includes/head");?>
    <link rel="stylesheet" href="<?=base_url('codemirror/lib/codemirror.css');?>">
    <script src="<?=base_url('codemirror/lib/codemirror.js');?>"></script>
    <script src="<?=base_url('codemirror/addon/edit/matchbrackets.js');?>"></script>
    <script src="<?=base_url('codemirror/mode/htmlmixed/htmlmixed.js');?>"></script>
    <script src="<?=base_url('codemirror/mode/xml/xml.js');?>"></script>
    <script src="<?=base_url('codemirror/mode/clike/clike.js');?>"></script>
    <script src="<?=base_url('codemirror/mode/php/php.js');?>"></script>

</head>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span19">
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand none" href="">Settings</a>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div style="height:3px;"> </div>
				<?php $this->load->view("admin_interface/forms/settings");?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/user-delete");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
    <script>
        if($("#code").length > 0){
            var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                lineWrapping: true
            });
//            $(".btn-edit-mails").click(function(){
//                $("#code").html(editor.getValue());
//                $(".form-edit-mails").submit();
//            });
        }

    </script>
</body>
</html>