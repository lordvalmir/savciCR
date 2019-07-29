<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
        <title><?php echo $title?> </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <?php 
        	if (isset($index)){
        		echo'<link rel="stylesheet" type="text/css" href="app/css/main.css">';		
        	}else{
        		echo '<link rel="stylesheet" type="text/css" href="css/main.css">';
        	}
        ?>
  	</head>
    