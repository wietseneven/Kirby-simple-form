# Kirby Simple Form Plugin
A Kirby CMS plugin for easily creating forms in Kirbytext and saving them to a CSV file

---

### Installation
Place all the files in a directory named 'simpleForm' for example and place it into /site/plugins

---

### How to use
In your Kirby page editor use the Kirbytext tag (simpleForm)

#### Parameters
```
simpleForm: 			// Your form name, your csv file will be named like this
fields: 			// Define your fields here
	input:name,		// Creates an input with the name 'name'
	email:emailaddress,	// Creates an input with type email and name 'emailaddress'
	textarea:message	// Creates an textarea with the name 'message'
confirmation: 			// Confirmation message that shows up when the form is submitted succesfully
```

The final version of the 'Kirbytag' will look like this (for this example form):
```
(simpleForm: myFormName fields: input:name,email:emailaddress:required,textarea:message confirmation: Succesvol opgeslagen)
```
