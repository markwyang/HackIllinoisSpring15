<?
session_start();
?>
<!doctype html>

<html>

	<head>
		
		<meta charset="utf-8">

		<title>
			
			Social Union

		</title>


		<link rel="stylesheet" href="css/styles.css" type = "text/css" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>




		<script src = "script.js"></script>

	</head>

	<body onload="boxHeight()">


	<div id = "navbar">

			<div id = "logo_background">
		    
		    	<a href = "home.html"><img id = "logo" src = "images/SocialUnionLogo.png"></a>
		    
		    </div>
		    
		    <div id = "profilepicture">
		    
		    	<img id = "profilepicture" src = "images/placement/placementanon.jpg">

		    </div>

			<div id = "navbar_wrapper">
			    
		        <ul>


		            <li><a href = ""><? session_start(); echo "<font color='white'>".$_SESSION["user"]."</font>";?></a></li><li class="search" style="-webkit-opacity:1;-moz-opacity:1;opacity:1;-webkit-transition:none;-moz-transition:none;-ms-transition:none;-o-transition:none;transition:none;background-color:#002E72;">
		            <!--<input type="search" placeholder = "Search someone.." name = "searching" id = "autocomplete">-->

		            
                        <input type = "text" id = "searchUser" class="autocomplete birds"></li>
                    <li>
                        <input type="submit" value="Search" id="searchButt">
                        <script>
                             $("#searchButt").click(function() {
                                 val = document.getElementById('searchUser').value
                                 console.log(val)
                                $("#infinite_scrolling_div").load("populateHome.php?searchUser="+document.getElementById('searchUser').value);
                             })
                        </script>
                    </li><li id = "invite">
                    <a href = "invite.html"><button class = "invitebutton">Invite a Friend!</button></a></li><li id = "settings">
		        	<a><button class = "settingsbutton" onclick="showSettings()">Settings</button></a></li><li id = "logout">
		            <a><button class = "logoutbutton">Logout</button></a>

		        	</li>

		        </ul>

<!-- Element to pop up -->
<div id="element_to_pop_up">
    <a class="b-close">x<a/>
    <form><center>
    	<h1>Login to SocialUnion</h1>
    	Username: <input type = "text" name ="username">
    	<br>
    	Password: <input type = "text" name ="password">
    	<br><br>
    	<button type = "button" id = "loginbutton">Login</button>

    	<br><br>

    	Don't have an account?  <a href = "signup.html" id="signupLink">Sign Up here!</a>
    </center></form>
	</div>

			</div>

	</div> <!-- end navbar div -->

	<div class = "contentfade">



		<div id = "whitespace">
		</div>
		



		<div id = "settingspanel" onmouseout="filterPosts()">
        	
        		<h1>Your Social Medias</h1>
            <ul>
        		<!--<li><input type = "checkbox" id="facebookCheck" onclick="filterPosts('facebook')"/>Facebook</li>-->
        		<li><input type = "checkbox" id="googleplusCheck" onclick="filterPosts('googleplus')"/>Google+</li>
        		<li><input type = "checkbox" id="twitterCheck" onclick="filterPosts('twitter')"/>Twitter</li>
                <li><input type = "checkbox" id="youtubeCheck" onclick="filterPosts('youtube')"/>Youtube</li>
            </ul>
        </div>





        <div id = "infinite_scrolling_div">

            



        </div> <!-- end div for the infinite scrolling --> 



</div>




	
<script type="text/javascript" src="autocomplete/jquery-1.4.2.js"></script>
<script type="text/javascript" src="autocomplete/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" src="autocomplete/autocomplete.js"></script>





	</body>

</html>
