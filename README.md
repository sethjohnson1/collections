Center of the West Collections
===========

OVERVIEW
------
[Buffalo Bill Center of the West](http://centerofthewest.org) collections data gathered from Argus.NET and built into a CakePHP app. Any object with a 
photo was included, with the exception of loan and sacred objects.

The production version is located here. [Buffalo Bill Center of the West Online Collections](http://collections.centerofthewest.org/) Visitors are encouraged to
curate their own Virtual Gallery or just browse and enjoy over 20,000 treasures, many of which aren't even on display right now!

Latest tested CakePHP 2.5.3

INSTALLATION
--------
These instructions assume you're running this single app on one CakePHP library. 
See [CakePHP Advanced Installation](http://book.cakephp.org/2.0/en/installation/advanced-installation.html) if you desire otherwise.

1. Extract the contents of the Cake install to your server, for best results use the latest tested version

1. Delete the app folder

1. Clone this repository as the app folder, such as 

	git clone https://github.com/sethjohnson1/collections.git app
	
1. Make a tmp directory inside the cloned app folder and apply permissions. This works for me, tell me if you know better

	chgrp -R www-data app/tmp
	
	chmod -R g+rw app/tmp
	
1. Create a new database and run the oc_test.sql script. I hope to provide a larger test DB soon.	

1. Create a file app/Config/private.php based on the private_sample.php file with proper DB settings

1. Add a bit.ly API key if you with to use the shortener. Still working on gracefully degrading if you don't have one... But the social media links are
all hard-coded anyway.

1. Add your own app/webroot/ayah_config.php file based on the ayah_config_sample.php - you'll need your own API keys (as of this writing was free)

1. Alternatively, just disable the few references to AYAH in the Controller and View. [AYAH](http://areyouahuman.com/) is a gamified captcha alternative.
I am not in love with it, but for now it's what we use.

1. I still need to package some sample Zoomify folders, however for now the images pull from our web site (there are a couple missing still...)

HELP US OUT!
-------------
I welcome feedback or contributions of any sort. I am a mediocre programmer at best, and completely new to git and github. If you see any glaring
mistakes or security issues please let me know.

Copyright (C) 2012--2014 Buffalo Bill Center of the West. This repository contains some scripts and libraries that we did not write. Please be sure to review their licenses before reusing them in production.
