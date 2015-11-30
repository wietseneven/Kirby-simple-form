<?php
	class processForm {
		function __construct($formName, $formData, $pageRoot) {
			$this->formName = $formName;
			$this->formData = $formData;
			$this->pageRoot = $pageRoot.'/'.$formName.'.csv';
			// We can remove the last from the array
			//array_pop($this->formData);
		}

		function createBaseCSV() {
			$file = fopen($this->pageRoot, "w");
			$heading = '';
			$i = 0;
			foreach ($this->formData as $key => $value){
				if ($i == count($this->formData) - 1){
					$heading .= '"'.$key.'"';
					$heading .= "\n";
				} else {
					$heading .= '"' . $key . '",';
				}

				$i++;
			}
			fwrite($file, $heading);
			fclose($file);
		}
		public function saveForm() {
			if (!file_exists($this->pageRoot))	{
				$this->createBaseCSV();
			}

			$formFile = fopen($this->pageRoot, "a") or die("Unable to open file!");
			// Put the array as CSV in the file after the last line
			fputcsv($formFile, $this->formData);
			fclose($formFile);
			return 'success';
		}

	}