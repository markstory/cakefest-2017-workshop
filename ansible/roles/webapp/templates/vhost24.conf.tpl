# Redirect to HTTPS.
<VirtualHost *:80>
    ServerName {{ apache.servername }}

    # Add content types and gzip
    AddType image/gif .gif
    AddType image/png .png
    AddType font/ttf .ttf
    AddType font/eot .eot
    AddType application/font-woff .woff
    AddType application/font-woff .woff2
    SetOutputFilter DEFLATE

    ServerAdmin webmaster@localhost
    DocumentRoot {{ apache.docroot }}
    ServerName {{ apache.servername }}

    <Directory {{ apache.docroot }}>
        AllowOverride All
        Options -Indexes +FollowSymLinks
        Require all granted
    </Directory>
</VirtualHost>
