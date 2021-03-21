# phpcatalog3x3

First install apache2, mysql and configure.

Simply clone the repository to /var/www/html
db user : root
db pass: password1234

in order to approve comments;
run the sql query from admin page, which you can use phpmyadmin etc;


UPDATE `comments`
SET `approved`=1 
WHERE `comment_id`= xxxxx
