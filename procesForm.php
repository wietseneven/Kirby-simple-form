<?php
	$formData = $_POST;
	$formName = $tag->attr('saveForm');
	$fileURI = $tag->page()->root().'/'.$formName.'.csv';

	// We can remove the filedir from the array
	array_pop($formData);

	$formLength = count($formData);
	if (!file_exists($fileURI)) {
		$file = fopen($fileURI,"w");

		$heading = '';
		$i = 0;
		foreach ($formData as $key => $value) {

			if ($i == $formLength - 1) {
				$heading .= '"'.$key.'"';
				$heading .= "\n";
			} else {
				$heading .= '"'.$key.'",';
			}

			$i++;
		}
		echo 'Heading= :'.$heading;
		fwrite($file,$heading);
		fclose($file);

	}


	$formFile = fopen($fileURI, "a") or die("Unable to open file!");
	fputcsv($formFile, $formData);

	fclose($formFile);