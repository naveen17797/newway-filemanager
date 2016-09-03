<?php 


echo "
<i class='fa fa-file'></i>&nbsp;

<div class='display'>
<form action='index.php' method='POST'>
<input type='hidden' value='$arg1$file' name='delete'>
</div>";

echo $file;
echo "
<button type='submit'><i class='fa fa-close'></i></button>
&nbsp;&nbsp;<a href='$arg1$file' target='_blank'><i class='fa fa-eye'></i></a>
<br/><br/>";




?>