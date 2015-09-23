<!DOCTYPE html>
<html>
<head>
<title>XKCD Password Generator</title>
<meta charset='utf-8'>
	
	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<link href='//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css' rel="stylesheet">
</head>

<body>
	<div class="container">
		<h1>Password Generator</h1>
		<p>An XKCD password strings together four random words to create a password that is challenging to guess but easy to remember. The benefit of this multi-word method is that the longer one`s password, the harder it is to crack. This is true for passwords made of both common dictionary words and randomly generated strings of text. This application will produce a random set of words that one could use as a password.</p>
			<form method='POST' action='index.php'>
				Number of Words: <input type="text" name="numOfWords"><br /><br />
				<input class="btn btn-default" type="submit" value="Submit"><br /><br />
			</form>
		<?php 
			
			// get random words from file and create array //
			$numbers = file('wordBank.txt');

			
			// check if we are in form submission state
			if (isset($_POST['numOfWords'])) {
				// removes special characters/white space and checks for letters
				$numWords = htmlspecialchars(trim($_POST['numOfWords']));
				
				if ( (preg_match('/[a-zA-Z]/', $numWords)) || ($numWords == "") ){
		    		echo 'Pleas enter a valid number';
				}
				else {

					// turns user submission into array if value is 1
					$word_indexes = ($numWords <= 1) ? array(array_rand($numbers, $numWords)):array_rand($numbers, $numWords);

					echo 'Your random words have been generated' . '<br /><br />';
					
					foreach($word_indexes as $index) {
						echo $numbers[$index] . ' - ';
					}
				}
			
			} 

		?>
	</div>
</body>
	

</html>