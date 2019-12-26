<p>Folders above are the Wordpress themes that run the website https://saltauto.com/.</p>

<p>arash-theme (underscores) is the parent theme, and serves as a foundation point to build the website on top of</p>

<p>salt-auto is the child theme and it contains the meat of the website</p>

<p>The website works by parsing data from a file called cars.csv that is provided by Frazer DMS (Dealer Management System) as a custom upload to the server. This file can be kept anywhere as long as the server is able to access it.</p>

<p>salt-auto\page-home-temp.php - Was supposed to be the temporary home page, but ended up being the one that was used</p>

<p>under salt-auto\template-parts\ you can find the functions that are called withing page-home-temp.php to do all the work, including sorting, filtering, and print out the cars</p>
