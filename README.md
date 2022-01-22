# Installation 
sudo chgrp -R www-data /home/~~~ app path
sudo chmod -R 775 /home/~~~ /storage
sudo chown -R $USER:www-data "app Folder"

sudo a2enmod rewrite

sudo a2dissite old.conf

sudo a2ensite new.conf

sudo nano /etc/apache2/apache2.conf

find something like this 
/*
<Directory /var/www/html/>    Options Indexes FollowSymLinks  AllowOverride None  Require all granted
</Directory>
*/

change /var/www/html if you set it outside of that area

sudo service restart apache2
