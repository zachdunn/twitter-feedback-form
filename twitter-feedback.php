<?php
	//Calls Bit.ly shortener on current URL, returns $short variable with results
	REQUIRE_ONCE 'shorten.php';
	
	//Assign title of page. Substitute with the_title() if using Wordpress.
	$current_title = "Share Feedback with Twitter and the Bit.ly API";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>Share Feedback with Twitter and the Bit.ly API </title>
   
	<link rel="stylesheet" type="text/css" href="twitter-feedback.css">

	<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
	
	<script type="text/javascript">

		$(document).ready(function(){

			//Assign initial values
			var short_url = "<?php echo $short;?>";
			var post_title = "<?php echo $current_title;?>";	
			var user_feedback;
			var tweet;

			function getFeedback(){
				//Assign selected item to feedback
				user_feedback = $("#feedback").val();
				
				//Update the live preview
				$("#tweet-preview").text(user_feedback);
			}
			
			function composeTweet(){
				//Compose the tweet
				tweet = user_feedback + ': ' + post_title + ' ' + short_url;
				
				//Update destination before sending tweet
				$('#tweetit a').attr("href", "http://twitter.com/home?status=" + tweet);
			}
			
			$("#tweetit a").click(function(){
				
				composeTweet();	
			
			});

			//Update feedback when option is changed	
			$("#feedback").change(getFeedback);

			//Get the initial feedback value from dropdown menu
			getFeedback();
			
			//Compose a default tweet
			composeTweet();
			
		});

	</script>
	
</head>
<body>
	
	<div id="wrapper">
		
		<h1>Share on Twitter</h1>
		<p>Ordinarily the share link would tweet a link to the current page. In the interest of demonstration, it links to the short URL of this tutorial instead. Go ahead and give it a try below!</p>
	
		<p class="mood">I <select id="feedback">
			<option value="Liked">liked</option>
			<option value="Interesting">was interested by</option>
			<option value="Inspired by">was inspired by</option>
			<option value="Absolutely loved">absolutely loved</option>
			<option value="Didn't like">didn't like</option>
			<option value="Completely disagree">completely disagreed with</option>
		</select> this post.</p>
		
		<h2>Tweet Preview</h2>
		<p class="tweet"><span id="tweet-preview">Liked</span>: <?php echo $current_title;?> <a href="<?php echo $short;?>"><?php echo $short;?></a></p>
		
		<p id="tweetit"><a href="http://twitter.com/home?status=Liked" target="_blank" title="Share link and feedback on Twitter">Tweet It</a><p>
		
	</div>
	
	<p class="footer">Want to see how this is done? <a href="http://buildinternet.com/2010/02/share-feedback-with-twitter-and-the-bit-ly-api/">Head back to the tutorial</a> on Build Internet.</p>
	
</body>
</html>
