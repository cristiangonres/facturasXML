<?php
session_start();
$message = '';
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'GENERAR') {
	if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
		// get details of the uploaded file
		echo $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
		echo $fileName = $_FILES['uploadedFile']['name'];
		$fileSize = $_FILES['uploadedFile']['size'];
		$fileType = $_FILES['uploadedFile']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));


		// check if file has one of the following extensions
		$allowedfileExtensions = array('xml');

		if (in_array($fileExtension, $allowedfileExtensions)) {
			// directory in which the uploaded file will be moved
			$uploadFileDir = './tmp/';
			$dest_path = $uploadFileDir . $fileName;

			if (move_uploaded_file($fileTmpPath, $dest_path)) {
				$facturaXML = $dest_path;
				$numeroFactura = $_POST['numeroFactura'];
				$centrecode = $_POST['centrecode01'];


				$xml = new DomDocument("1.0", "UTF-8");
				$xml->load($facturaXML, LIBXML_NOWARNING);


				$AdministrativeCentreTag = $xml->getElementsByTagName("AdministrativeCentre")->item(0);
				$AdministrativeCentresTag = $xml->getElementsByTagName("AdministrativeCentres")->item(0);
				$xml->documentElement->appendChild($AdministrativeCentreTag->cloneNode(true));
				$xml->documentElement->appendChild($AdministrativeCentreTag->cloneNode(true));

				//sercción1
				$CentreCodeTag = $xml->createElement("CentreCode", $numeroFactura);
				$RoleTypeCode = $xml->createElement("RoleTypeCode", $centrecode);

				$AdministrativeCentreTag->appendChild($CentreCodeTag);
				$AdministrativeCentreTag->appendChild($RoleTypeCode);

				$nameTag = $xml->getElementsByTagName("Name")->item(0);
				$AdministrativeCentreTag->insertBefore($CentreCodeTag, $nameTag);
				$AdministrativeCentreTag->insertBefore($RoleTypeCode, $nameTag);

				//sercción2
				$numeroFactura = $_POST['numeroFactura2'];
				$centrecode = $_POST['centrecode02'];

				$AdministrativeCentreTag = $xml->getElementsByTagName("AdministrativeCentre")->item(1);
				$CentreCodeTag = $xml->createElement("CentreCode", $numeroFactura);
				$RoleTypeCode = $xml->createElement("RoleTypeCode", $centrecode);

				$AdministrativeCentreTag->appendChild($CentreCodeTag);
				$AdministrativeCentreTag->appendChild($RoleTypeCode);

				$nameTag = $xml->getElementsByTagName("Name")->item(1);
				$AdministrativeCentreTag->insertBefore($CentreCodeTag, $nameTag);
				$AdministrativeCentreTag->insertBefore($RoleTypeCode, $nameTag);

				$AdministrativeCentresTag->appendChild($AdministrativeCentreTag);


				//sercción3
				$numeroFactura = $_POST['numeroFactura3'];
				$centrecode = $_POST['centrecode03'];

				$AdministrativeCentreTag = $xml->getElementsByTagName("AdministrativeCentre")->item(2);
				$CentreCodeTag = $xml->createElement("CentreCode", $numeroFactura);
				$RoleTypeCode = $xml->createElement("RoleTypeCode", $centrecode);

				$AdministrativeCentreTag->appendChild($CentreCodeTag);
				$AdministrativeCentreTag->appendChild($RoleTypeCode);

				$nameTag = $xml->getElementsByTagName("Name")->item(2);
				$AdministrativeCentreTag->insertBefore($CentreCodeTag, $nameTag);
				$AdministrativeCentreTag->insertBefore($RoleTypeCode, $nameTag);

				$AdministrativeCentresTag->appendChild($AdministrativeCentreTag);

				$xml->save($facturaXML);
				echo "";
				echo "<p> </p>";
				echo "";

				$message = '<p>Factura generada correctamente</p>Puede descargar el archivo pulsando <a href="' . $facturaXML . '"> AQUÍ</a>';
			} else {
				$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
			}
		} else {
			$message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
		}
	} else {
		$message = 'There is some error in the file upload. Please check the following error.<br>';
		$message .= 'Error:' . $_FILES['uploadedFile']['error'];
	}
}
$_SESSION['message'] = $message;
header("Location: index.php");
?>