<!-- REFERENCE CODE: https://github.com/gingerbeardman/loveletter -->

<!-- Title: LoveLost Letters -->

<!-- Description: 'LoveLost Letters' is a program implemented after Christopher
		Strachey's 'Love Letters' combinatory piece. This program has all the
		same functionalities as Strachey's piece, with added interactive features.
		'LoveLost Letters' is a letter generated to a loved one in which the 
		relationship has ended for whatever circumstance.
		This program utilizes arrays as the source of word banks to cycle through
		for randomization of adjectives, nouns, adverbs, and salutations/closing.
		Senetences are generated in a fixed format with select words randomly
		changing to always generate a new letter.
		Colored text, hypertext links, a floral background, soft lo-fi music was
		added for extra connection to the reader.
		'LoveLost Letter' is a Combinatory + Interactive Fiction Poem mash-up -->

<!-- Date Finalized: 27 June 2022 -->

<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="styles.css" type="text/css" media="screen" charset="utf-8">

	</head>
	<body>
		<pre>
			<strong>Alen Holsey "LoveLost Letters" (2022)</strong>

			<?php

			// Variable for string concatenation
			$concat = "";

			// Returns random value from array
			function rndm($arr) 
			{
				return $arr[array_rand($arr)];
			}

			
			// Array variables for LoveLost letter
			$sals = array("Cherished", "Darling", "Dearest", "Most Beloved", "Precious", "Treasured");

			$sals0 = array("Heart", "Love", "Sweetheart");

			$close = array("Forever and Always", "Love", "Sincerely", "With Deepest Love", "Yours Truly");

			$adj = array("adoring", "affectionate", "buring", "fond", "loveable", "loving", "precious", 
				"tender", "tenacious", "zealous");

			$adv1 = array("Beautifully", "Deeply", "Lovingly", "Passionately", "Tenderly", "Wistfully");

			$adv2 = array("abruptly", "bruningly", "fiercely", "immensely", "instantaneously", "instantly", 
				"intensely", "spontaneously","strongly", "suddenly", "vehemently", "wihtout delay");

			$vb = array("ceased", "died out", "disappeared", "dissolved", "ended", "evaporated", "faded", 
				"perished", "vanished");

			$noun = array("adoration", "affection", "devotion", "endearment", "fondness", "intimacy", "lust", 
				"passion", "tenderness", "warmth", "yearning");



			// Construction and concatenation of LoveLost letter
			$ll = sprintf("My %s %s,\n\n", rndm($sals), rndm($sals0));

			$ll .= sprintf("\t%s In my heart lies this %s %s for you.\n", $concat, rndm($adj), rndm($noun));

			$ll .= sprintf("%s Our relationship was the %s %s\n", $concat, rndm($adj), rndm($noun));

			$ll .= sprintf("%s that %s sparked my life.\n", $concat, rndm($adv2));

			$ll .= sprintf("%s Though our spark has %s %s.\n", $concat, rndm($vb), rndm($adv2));

			$ll .= sprintf("%s %s, I set you free, my %s %s.\n", $concat, rndm($adv1), rndm($adj), rndm($noun));

			$ll .= sprintf("%s Some %s, %s love will find you.\n\n", $concat, rndm($adj), rndm($adj));

			$ll .= sprintf("\t\t\t\t%s %s\n\n\n\n\n", $concat, rndm($close));

			//$ll .= sprintf("%s NJIT    ", $concat);


			// Displaying LoveLost letter
			echo "<em>";
			echo str_replace('  ', ' ', $ll);
			echo "</em>";

			// School footnote
			echo "<strong>";
			echo "NJIT";
			echo "</strong>";

			?>

			<!-- Link to refresh the page to generate a new LoveLost letter -->
			<a class="one" href="#" onclick="window.location.reload(true);">A New LoveLost</a>


			<!-- Link to source code for this project/website -->
			<br clear="both">
			<a class="two" href="https://github.com/gingerbeardman/loveletter">Source Code</a>


		</pre>


		<!-- Audio control for website--two other song options-->
		<audio loop autoplay>
			<!--<source src="./missYou.mp3" type="audio/mpeg">-->
			<!--<source src="./foreverLove.mp3" type="audio/mpeg">-->
			<source src="./noLove.mp3" type="audio/mpeg">
			Your browser, unfortunately, does not support this audio element.
		</audio>	


	</body>


</html>