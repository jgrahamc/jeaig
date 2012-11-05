<html>
<head>
<title>jgc's email address image generator</title>
 <!--tipjoy:jgrahamc-->
</head>

<body style="font-family: Helvetica,Arial,sans-serif;">
<h1><a href="/">jeaig</a>: jgc's email address image generator</h1>

<?php

if ( isset( $_POST['generate'] ) && ( $_POST['email'] != '' ) ) {
  $email = $_POST['email'];
  if ( preg_match( '/^\w[\w\._\+\-]+@[\w_\+\-]+\.[\w_\.\+\-]+$/', $email ) &&
       (strlen( $email ) < 64 ) ) {
    $secret = trim(`perl jeaig/generate $email`);
?>

<h2>Your obscured email address (<?php echo htmlentities($email) ?>)</h2>

Place the following HTML on your web site:
<p />
<tt>
&lt;img src="http://jeaig.org/image/<?=$secret?>.png"&gt;
<br />
&lt;br /&gt;
<br />
&lt;font size="-2"&gt;Made using &lt;a href="http://jeaig.org/"&gt;jeaig&lt;/a&gt;&lt;/font&gt;
</tt>
<p />
It will look like this:
<p />
<img src="http://jeaig.org/image/<?php echo $secret ?>.png">
<br />
<font size="-2">Made using <a href="http://jeaig.org/">jeaig</a></font>

<h2>Copying the image</h2>

If you prefer to use a static image (instead of linking to this site) simply copy the image above to your site.  This has the advantage that displaying your email address is not dependent on this site being up; the big disadvantage is that if/when I change the image generation algorithm to better avoid web crawlers your image will not change and your email address may be vulnerable.

<?php

  } else {

?>

<b><font color="red">Invalid email address.  Please go back and enter a valid address</font></b>

<?php
  }
?>

<?php

} else {

?>

<h2>What it does</h2>

This site converts a text-based email address (such as me@example.com) and creates an image that can be inserted on a web site.  The image contains the email address and is easily read by a human, but is intended to fool web crawlers that search for email addresses.
<p />
I can't guarantee that this is foolproof, but Project Honeypot <a href="http://www.projecthoneypot.org/how_to_avoid_spambots_3.php">reports</a> that image obfuscation of an email address is very effective (they say 100%) against web crawlers.

<h2>How it works</h2>

The user enters an email address here and will be returned a snippet of HTML that displays their email address as an image.  The HTML is in the form:
<p />
<tt>
    &lt;img src="http://jeaig.org/image/UmFuZG9tSVbAX97gmPVJ2SkKfTNcX1R211W-Jjyfw8YjakAMVGodLNV3ET9SUyCy2Zt1R4kFRWptkqxQ7kNEMA.png&gt;
</tt>
<p />
This looks like:
<p />
<img src="http://jeaig.org/image/UmFuZG9tSVbAX97gmPVJ2SkKfTNcX1R211W-Jjyfw8YjakAMVGodLNV3ET9SUyCy2Zt1R4kFRWptkqxQ7kNEMA.png" border="0">
<p />
The long string is the email address (padded with a large amount of random data to avoid a dictionary attack) encrypted using a key known only to this server.   When the image is loaded the server decrypts the email address and creates the image: the email address is <b>never</b> stored by this server.
<p />
Instead of giving the user a static image, this service uses a dynamic image so that it can be changed if web crawlers start to perform OCR on the email addresses.

<h2>Obscure my address</h2>

<form action="/" method="post">

Enter your email address: <input type="text" name="email">
<br />
<input type="submit" name="generate" value="Generate">

</form>

<?php
}
?>

</body>
</html>
