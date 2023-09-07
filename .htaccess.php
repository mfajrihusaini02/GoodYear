<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.php

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.html
</IfModule>

# Disable Directory Listings in this Directory and Subdirectories
# This will hide the files from the public unless they know direct URLs
Options -Indexes

# php -- BEGIN cPanel-generated handler, do not edit
# Set the “ea-php74” package as the default “PHP” programming language.
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php74 .php .php7 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit
