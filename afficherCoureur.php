
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="afficheCoureur"/>
		
	
		<?php include(traiterAfficherCoureur.php); ?>
	</body>
</html>