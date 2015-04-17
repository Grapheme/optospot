<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php if(is_array($content)):?>
    <pre><?php print_r($content);?></pre>
<?php else:?>
    <p><?=@$content;?></p>
<?php endif;?>
</body>
</html>