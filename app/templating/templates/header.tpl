<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{if isset($title)}{$title}{else}SOLAS Match{/if}</title>
	<link rel="stylesheet" type="text/css" media="all" href="{urlFor name="home"}resources/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="{urlFor name="home"}resources/css/style.1.css">
</head>
<body {if isset($body_class)}class="{$body_class}"{/if} {if isset($body_id)}id="{$body_id}"{/if}>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
	    <div class="container">
    	    <a class="brand" href="{urlFor name='home'}">
				SOLAS Match
		    </a>
		    <ul class="nav">
		    	<li
		    		{if isset($current_page) && $current_page == 'home'}class="active"{/if}
		    	>
		    		<a href="{urlFor name="home"}">Home</a></li>
		    	{if isset($user_is_organisation_member)}
			    	<li
			    		{if isset($current_page) && $current_page == 'client-dashboard'}class="active"{/if}
			    	>
			    		<a href="{urlFor name="client-dashboard"}">Dashboard</a>
			    	</li>
		    	{/if}
			{if UserDao::isLoggedIn()}
				<li {if isset($current_page) && $current_page == 'user-profile'}class="active" {/if}>
					<a href="{urlFor name='user-profile'}">Profile</a>
				</li>
			{/if}
		    </ul>
		    <ul class="nav pull-right">
		    	{if isset($user)}
					<li><a href="{urlFor name="logout"}">Log out</a></li>
				{else}
					<li><a href="{urlFor name="register"}">Register</a></li>
					<li><a href="{urlFor name="login"}">Log in</a></li>
				{/if}
		    </ul>
	    </div>
    </div>
</div>

<div class="container">
