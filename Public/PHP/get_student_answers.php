<?php
define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
require_once('../../Private/PHP/initialize.php');
$q = get_active();
$id = $q[0]["QuestionId"];
echo json_encode(get_student_answers($id));
?>
