<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<style type="text/css">
		/* Based on The MailChimp Reset INLINE: Yes. */
		/* Client-specific Styles */
		#outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
		body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
		/* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/
		.ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
		/* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
		/* End reset */

		/* Some sensible defaults for images
		Bring inline: Yes. */
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
		a img {border:none;}
		.image_fix {display:block;}

		/* Yahoo paragraph fix
		Bring inline: Yes. */
		p {margin: 1em 0;}

		/* Hotmail header color reset
		Bring inline: Yes. */
		h1, h2, h3, h4, h5, h6 {color: black !important;}

		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
		color: red !important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
		}

		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
		color: purple !important; /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
		}

		/* Outlook 07, 10 Padding issue fix
		Bring inline: No.*/
		table td {border-collapse: collapse;}

		/* Remove spacing around Outlook 07, 10 tables
		Bring inline: Yes */
		table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

		/* Styling your links has become much simpler with the new Yahoo.  In fact, it falls in line with the main credo of styling in email and make sure to bring your styles inline.  Your link colors will be uniform across clients when brought inline.
		Bring inline: Yes. */
		a {color: inherit;}


		/***************************************************
		****************************************************
		MOBILE TARGETING
		****************************************************
		***************************************************/
		@media only screen and (max-device-width: 480px) {
			/* Part one of controlling phone number linking for mobile. */
			a[href^="tel"], a[href^="sms"] {
						text-decoration: none;
						color: blue; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
						text-decoration: default;
						color: inherit !important;
						pointer-events: auto;
						cursor: default;
					}

		}

		/* More Specific Targeting */

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		/* You guessed it, ipad (tablets, smaller screens, etc) */
			/* repeating for the ipad */
			a[href^="tel"], a[href^="sms"] {
						text-decoration: none;
						color: blue; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
						text-decoration: default;
						color: inherit !important;
						pointer-events: auto;
						cursor: default;
					}
		}

		/*!
		 * Bootstrap v3.0.0
		 *
		 * Copyright 2013 Twitter, Inc
		 * Licensed under the Apache License v2.0
		 * http://www.apache.org/licenses/LICENSE-2.0
		 *
		 * Designed and built with all the love in the world @twitter by @mdo and @fat.
		 */


		article,aside,details,figcaption,figure,footer,header,hgroup,main,nav,section,summary{display:block;}
		audio,canvas,video{display:inline-block;}
		audio:not([controls]){display:none;height:0;}
		[hidden]{display:none;}
		html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}
		body{margin:0;}
		a:focus{outline:thin dotted;}
		a:active,a:hover{outline:0;}
		h1{font-size:2em;margin:0.67em 0;}
		abbr[title]{border-bottom:1px dotted;}
		b,strong{font-weight:bold;}
		dfn{font-style:italic;}
		hr{-moz-box-sizing:content-box;box-sizing:content-box;height:0;}
		mark{background:#ff0;color:#000;}
		code,kbd,pre,samp{font-family:monospace, serif;font-size:1em;}
		pre{white-space:pre-wrap;}
		q{quotes:"\201C" "\201D" "\2018" "\2019";}
		small{font-size:80%;}
		sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline;}
		sup{top:-0.5em;}
		sub{bottom:-0.25em;}
		img{border:0;}
		svg:not(:root){overflow:hidden;}
		figure{margin:0;}
		fieldset{border:1px solid #c0c0c0;margin:0 2px;padding:0.35em 0.625em 0.75em;}
		legend{border:0;padding:0;}
		button,input,select,textarea{font-family:inherit;font-size:100%;margin:0;}
		button,input{line-height:normal;}
		button,select{text-transform:none;}
		button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer;}
		button[disabled],html input[disabled]{cursor:default;}
		input[type="checkbox"],input[type="radio"]{box-sizing:border-box;padding:0;}
		input[type="search"]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box;}
		input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none;}
		button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0;}
		textarea{overflow:auto;vertical-align:top;}
		table{border-collapse:collapse;border-spacing:0;}
		*,*:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
		html{font-size:62.5%;-webkit-tap-highlight-color:rgba(0, 0, 0, 0);}
		body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.428571429;color:#333333;background-color:#ffffff;}
		input,button,select,textarea{font-family:inherit;font-size:inherit;line-height:inherit;}
		button,input,select[multiple],textarea{background-image:none;}
		a{color:#428bca;text-decoration:none;}a:hover,a:focus{color:#2a6496;text-decoration:underline;}
		a:focus{outline:thin dotted #333;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
		img{vertical-align:middle;}
		.img-responsive{display:block;max-width:100%;height:auto;}
		.img-rounded{border-radius:6px;}
		.img-thumbnail{padding:4px;line-height:1.428571429;background-color:#ffffff;border:1px solid #dddddd;border-radius:4px;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out;display:inline-block;max-width:100%;height:auto;}
		.img-circle{border-radius:50%;}
		hr{margin-top:20px;margin-bottom:20px;border:0;border-top:1px solid #eeeeee;}
		.sr-only{position:absolute;width:1px;height:1px;margin:-1px;padding:0;overflow:hidden;clip:rect(0 0 0 0);border:0;}
		p{margin:0 0 10px;}
		.lead{margin-bottom:20px;font-size:16.099999999999998px;font-weight:200;line-height:1.4;}@media (min-width:768px){.lead{font-size:21px;}}
		small{font-size:85%;}
		cite{font-style:normal;}
		.text-muted{color:#999999;}
		.text-primary{color:#428bca;}
		.text-warning{color:#c09853;}
		.text-danger{color:#b94a48;}
		.text-success{color:#468847;}
		.text-info{color:#3a87ad;}
		.text-left{text-align:left;}
		.text-right{text-align:right;}
		.text-center{text-align:center;}
		h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-weight:500;line-height:1.1;}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small,.h1 small,.h2 small,.h3 small,.h4 small,.h5 small,.h6 small{font-weight:normal;line-height:1;color:#999999;}
		h1,h2,h3{margin-top:20px;margin-bottom:10px;}
		h4,h5,h6{margin-top:10px;margin-bottom:10px;}
		h1,.h1{font-size:36px;}
		h2,.h2{font-size:30px;}
		h3,.h3{font-size:24px;}
		h4,.h4{font-size:18px;}
		h5,.h5{font-size:14px;}
		h6,.h6{font-size:12px;}
		h1 small,.h1 small{font-size:24px;}
		h2 small,.h2 small{font-size:18px;}
		h3 small,.h3 small,h4 small,.h4 small{font-size:14px;}
		.page-header{padding-bottom:9px;margin:40px 0 20px;border-bottom:1px solid #eeeeee;}
		ul,ol{margin-top:0;margin-bottom:10px;}ul ul,ol ul,ul ol,ol ol{margin-bottom:0;}
		.list-unstyled{padding-left:0;list-style:none;}
		.list-inline{padding-left:0;list-style:none;}.list-inline>li{display:inline-block;padding-left:5px;padding-right:5px;}
		dl{margin-bottom:20px;}
		dt,dd{line-height:1.428571429;}
		dt{font-weight:bold;}
		dd{margin-left:0;}
		@media (min-width:768px){.dl-horizontal dt{float:left;width:160px;clear:left;text-align:right;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;} .dl-horizontal dd{margin-left:180px;}.dl-horizontal dd:before,.dl-horizontal dd:after{content:" ";display:table;} .dl-horizontal dd:after{clear:both;}}abbr[title],abbr[data-original-title]{cursor:help;border-bottom:1px dotted #999999;}
		abbr.initialism{font-size:90%;text-transform:uppercase;}
		blockquote{padding:10px 20px;margin:0 0 20px;border-left:5px solid #eeeeee;}blockquote p{font-size:17.5px;font-weight:300;line-height:1.25;}
		blockquote p:last-child{margin-bottom:0;}
		blockquote small{display:block;line-height:1.428571429;color:#999999;}blockquote small:before{content:'\2014 \00A0';}
		blockquote.pull-right{padding-right:15px;padding-left:0;border-right:5px solid #eeeeee;border-left:0;}blockquote.pull-right p,blockquote.pull-right small{text-align:right;}
		blockquote.pull-right small:before{content:'';}
		blockquote.pull-right small:after{content:'\00A0 \2014';}
		q:before,q:after,blockquote:before,blockquote:after{content:"";}
		address{display:block;margin-bottom:20px;font-style:normal;line-height:1.428571429;}
		.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:normal;line-height:1.428571429;text-align:center;vertical-align:middle;cursor:pointer;border:1px solid transparent;border-radius:4px;white-space:nowrap;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none;}.btn:focus{outline:thin dotted #333;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
		.btn:hover,.btn:focus{color:#333333;text-decoration:none;}
		.btn:active,.btn.active{outline:0;background-image:none;-webkit-box-shadow:inset 0 3px 5px rgba(0, 0, 0, 0.125);box-shadow:inset 0 3px 5px rgba(0, 0, 0, 0.125);}
		.btn.disabled,.btn[disabled],fieldset[disabled] .btn{cursor:not-allowed;pointer-events:none;opacity:0.65;filter:alpha(opacity=65);-webkit-box-shadow:none;box-shadow:none;}
		.btn-default{color:#333333;background-color:#ffffff;border-color:#cccccc;}.btn-default:hover,.btn-default:focus,.btn-default:active,.btn-default.active,.open .dropdown-toggle.btn-default{color:#333333;background-color:#ebebeb;border-color:#adadad;}
		.btn-default:active,.btn-default.active,.open .dropdown-toggle.btn-default{background-image:none;}
		.btn-default.disabled,.btn-default[disabled],fieldset[disabled] .btn-default,.btn-default.disabled:hover,.btn-default[disabled]:hover,fieldset[disabled] .btn-default:hover,.btn-default.disabled:focus,.btn-default[disabled]:focus,fieldset[disabled] .btn-default:focus,.btn-default.disabled:active,.btn-default[disabled]:active,fieldset[disabled] .btn-default:active,.btn-default.disabled.active,.btn-default[disabled].active,fieldset[disabled] .btn-default.active{background-color:#ffffff;border-color:#cccccc;}
		.btn-primary{color:#ffffff;background-color:#428bca;border-color:#357ebd;}.btn-primary:hover,.btn-primary:focus,.btn-primary:active,.btn-primary.active,.open .dropdown-toggle.btn-primary{color:#ffffff;background-color:#3276b1;border-color:#285e8e;}
		.btn-primary:active,.btn-primary.active,.open .dropdown-toggle.btn-primary{background-image:none;}
		.btn-primary.disabled,.btn-primary[disabled],fieldset[disabled] .btn-primary,.btn-primary.disabled:hover,.btn-primary[disabled]:hover,fieldset[disabled] .btn-primary:hover,.btn-primary.disabled:focus,.btn-primary[disabled]:focus,fieldset[disabled] .btn-primary:focus,.btn-primary.disabled:active,.btn-primary[disabled]:active,fieldset[disabled] .btn-primary:active,.btn-primary.disabled.active,.btn-primary[disabled].active,fieldset[disabled] .btn-primary.active{background-color:#428bca;border-color:#357ebd;}
		.btn-warning{color:#ffffff;background-color:#f0ad4e;border-color:#eea236;}.btn-warning:hover,.btn-warning:focus,.btn-warning:active,.btn-warning.active,.open .dropdown-toggle.btn-warning{color:#ffffff;background-color:#ed9c28;border-color:#d58512;}
		.btn-warning:active,.btn-warning.active,.open .dropdown-toggle.btn-warning{background-image:none;}
		.btn-warning.disabled,.btn-warning[disabled],fieldset[disabled] .btn-warning,.btn-warning.disabled:hover,.btn-warning[disabled]:hover,fieldset[disabled] .btn-warning:hover,.btn-warning.disabled:focus,.btn-warning[disabled]:focus,fieldset[disabled] .btn-warning:focus,.btn-warning.disabled:active,.btn-warning[disabled]:active,fieldset[disabled] .btn-warning:active,.btn-warning.disabled.active,.btn-warning[disabled].active,fieldset[disabled] .btn-warning.active{background-color:#f0ad4e;border-color:#eea236;}
		.btn-danger{color:#ffffff;background-color:#d9534f;border-color:#d43f3a;}.btn-danger:hover,.btn-danger:focus,.btn-danger:active,.btn-danger.active,.open .dropdown-toggle.btn-danger{color:#ffffff;background-color:#d2322d;border-color:#ac2925;}
		.btn-danger:active,.btn-danger.active,.open .dropdown-toggle.btn-danger{background-image:none;}
		.btn-danger.disabled,.btn-danger[disabled],fieldset[disabled] .btn-danger,.btn-danger.disabled:hover,.btn-danger[disabled]:hover,fieldset[disabled] .btn-danger:hover,.btn-danger.disabled:focus,.btn-danger[disabled]:focus,fieldset[disabled] .btn-danger:focus,.btn-danger.disabled:active,.btn-danger[disabled]:active,fieldset[disabled] .btn-danger:active,.btn-danger.disabled.active,.btn-danger[disabled].active,fieldset[disabled] .btn-danger.active{background-color:#d9534f;border-color:#d43f3a;}
		.btn-success{color:#ffffff;background-color:#5cb85c;border-color:#4cae4c;}.btn-success:hover,.btn-success:focus,.btn-success:active,.btn-success.active,.open .dropdown-toggle.btn-success{color:#ffffff;background-color:#47a447;border-color:#398439;}
		.btn-success:active,.btn-success.active,.open .dropdown-toggle.btn-success{background-image:none;}
		.btn-success.disabled,.btn-success[disabled],fieldset[disabled] .btn-success,.btn-success.disabled:hover,.btn-success[disabled]:hover,fieldset[disabled] .btn-success:hover,.btn-success.disabled:focus,.btn-success[disabled]:focus,fieldset[disabled] .btn-success:focus,.btn-success.disabled:active,.btn-success[disabled]:active,fieldset[disabled] .btn-success:active,.btn-success.disabled.active,.btn-success[disabled].active,fieldset[disabled] .btn-success.active{background-color:#5cb85c;border-color:#4cae4c;}
		.btn-info{color:#ffffff;background-color:#5bc0de;border-color:#46b8da;}.btn-info:hover,.btn-info:focus,.btn-info:active,.btn-info.active,.open .dropdown-toggle.btn-info{color:#ffffff;background-color:#39b3d7;border-color:#269abc;}
		.btn-info:active,.btn-info.active,.open .dropdown-toggle.btn-info{background-image:none;}
		.btn-info.disabled,.btn-info[disabled],fieldset[disabled] .btn-info,.btn-info.disabled:hover,.btn-info[disabled]:hover,fieldset[disabled] .btn-info:hover,.btn-info.disabled:focus,.btn-info[disabled]:focus,fieldset[disabled] .btn-info:focus,.btn-info.disabled:active,.btn-info[disabled]:active,fieldset[disabled] .btn-info:active,.btn-info.disabled.active,.btn-info[disabled].active,fieldset[disabled] .btn-info.active{background-color:#5bc0de;border-color:#46b8da;}
		.btn-link{color:#428bca;font-weight:normal;cursor:pointer;border-radius:0;}.btn-link,.btn-link:active,.btn-link[disabled],fieldset[disabled] .btn-link{background-color:transparent;-webkit-box-shadow:none;box-shadow:none;}
		.btn-link,.btn-link:hover,.btn-link:focus,.btn-link:active{border-color:transparent;}
		.btn-link:hover,.btn-link:focus{color:#2a6496;text-decoration:underline;background-color:transparent;}
		.btn-link[disabled]:hover,fieldset[disabled] .btn-link:hover,.btn-link[disabled]:focus,fieldset[disabled] .btn-link:focus{color:#999999;text-decoration:none;}
		.btn-lg{padding:10px 16px;font-size:18px;line-height:1.33;border-radius:6px;}
		.btn-sm,.btn-xs{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px;}
		.btn-xs{padding:1px 5px;}
		.btn-block{display:block;width:100%;padding-left:0;padding-right:0;}
		.btn-block+.btn-block{margin-top:5px;}
		input[type="submit"].btn-block,input[type="reset"].btn-block,input[type="button"].btn-block{width:100%;}

	</style>


	<style type="text/css">
		body, #backgroundTable{
			background-color: #f8f8f8;
		}

		#contentTable{
			background-color: #ffffff;
			border: 1px solid #e7e7e7;
		}
	</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
	<tr height=50>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" id="contentTable">
				<tr>
					<td width=20 height=20>&nbsp;</td>
					<td></td>
					<td width=20></td>
				</tr>
				<tr>
					<td></td>
					<td valign="top">
						@yield('content')
					</td>
					<td></td>
				</tr>
				<tr>
					<td width=20 height=20>&nbsp;</td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr height=50>
		<td>&nbsp;</td>
	</tr>
</table>
</body>
</html>
