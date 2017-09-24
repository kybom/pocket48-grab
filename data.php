<?php
require_once ('functions.php');
if ($_POST["type"]=="group") {
	get_group_table();
} else if ($_POST["type"]=="member") {
	get_member_table();
} else {
header('HTTP/1.1 400 Bad Request');
echo "400 Bad Request";
}

?>