<?php
    if (isset($_POST["upload"]) && !empty($_POST)){
        $userid = uniqid('prefix');
        $file = $_FILES['photo'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed) ) {
        	if ($fileError === 0) {
        		if ($fileSize < 1000000) {
        			$fileNameNew = "profile".$userid.".".$fileActualExt;
        			$fileDestination = 'uploads/'.$fileNameNew;
        			if(move_uploaded_file($fileTmpName, $fileDestination)) {
        				echo "Your file has been successfully uploaded.";
        			}
        		} else {
        			echo "Your file is too big!";
        		}
        	} else {
        		echo "There was an error in uploading your file!";
        	}
        } else {
        	echo "You Cannot upload files of this type!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Picture</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label>Profile Photo</label>
        <input type="file" name="photo">
        <button type="submit" name="upload">Upload</button>
    </form>
</body>
</html>