# Code-nShill
Personnal web site (hosted on your personnal network)

features:
1 - You can use this web site while you're coding, you have all the YouTube videos that you want at the same place. You also can embed other videos / services as spotify playlists etc...
Interesting point: There is no adds on the videos that you add to your bdd. Can be useful on smartphone (y).

2 - You have a little forum. It allows you to plan / wrote things about the dev or your mind set. Use it as you want.


Installation guide:

1 - Firstly you need to setup a server, as Xampp for instance, in order to host your site.
(Everything is explained here http://doc.ubuntu-fr.org/xampp)

2 - Download the files of code-nShill project.
On linux, do{
  $ sudo rm -rfv /opt/lammp/htdocs/*
Then copy-paste the files of my project in the directory: /opt/lammp/htdocs/
  $ sudo lampp start //If you have done the configuration as doc.ubuntu-fr.org it should work.
Launch your browser and search "http://localhost" you will be able to see the index.php page of this project.
}
On Windows, do{
Go on the xampp installation folder and look for the folder named "htdocs" It's the emplacement of your website (by default)
Erase all the files and folders inside, then copy-paste the files of this project inside the htdocs folder.
Launch your browser and search "http://localhost" you will be able to see the index.php page of this project.
}


Configuration guide:

You need to go on http://localhost/phpmyadmin in order to create the whole system of BDD used in this project. When it's done, the website is fully operational

Example:

Create a BDD named "as-you-want"
Create a Table named "logs". Content (id, date, ip_addr, legal).
Create a Table named "music_playlist". Content (id, lien_video, nom_video).
Create a Table named "note". Content (id, date, commentaire).
Create a Table named "ytb_videos". Content (id, url, nom, tag).
