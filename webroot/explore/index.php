<?php
print_r($_SERVER["REQUEST_URI"]);
if(preg_match('@'.$_SERVER["REQUEST_URI"].'@',".*\/explore\/.*")){
echo 'do something';
}
else
echo
'go away';

?>