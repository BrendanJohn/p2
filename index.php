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
         <div class="col-md-6">
            <form method='POST' action='index.php'>
               <div class="control-label form-group">Number of Words:
                  <input type="text" name="numOfWords">
               </div>
               <div class="control-label form-group">Include a symbol?
                  <label for="symbolyes" class="radio-inline">
                  <input type="radio" name="symbol" id="symbolyes" required value="yes"> Yes 
                  </label>
                  <label for="symbolno" class="radio-inline">
                  <input type="radio" name="symbol" id="symbolno" required value="no"> No
                  </label>
               </div>
               <p><input class="btn btn-lg btn-primary form-group" type="submit" value="Submit"></p>
            </form>
         </div>
         <div class="col-md-8">
            <?php 
               // get random words from file and create array //
               $numbers = file('wordBank.txt');
               //empty array to hold password string
               $password = '';
               // array to hold symbols
               $symbols = array('=', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '!');
               $symbols_count = count($symbols) - 1;
               // assigns checkbox value y/n
               $symbol = $_POST['symbol'];
               
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
               
               		echo '<div class="panel panel-primary">' . '<div class="panel-heading">' . '<h3 class="panel-title">' . 'Your random words have been generated:' . '</h3> </div>' . '<div class="panel-body">';
               		
               		foreach($word_indexes as $index) {
               			$password = $password . $numbers[$index] . ' - ';
               		}
               
               		// appends password string with a symbol
               		if ($symbol == 'yes') {
               			$password = $password . $symbols[rand(0, $symbols_count)];
               		}
               
               		echo $password . '</div></div>';
               	}
               
               } 
               
               ?>
         </div>
   </body>
</html>