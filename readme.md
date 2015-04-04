# CPSC4900 Project

## Description

The CPSC4900 project is a school project for a web application that offers daily services to a "mocked" company.

To set up the project locally, you will need:
Apache
php5
MySQL
And a digital certs (self-signed 'cause we are cheap!)

-----
## Folder structure

We have a very basic folder structure here with pcs being the root (main) folder.  Place the _pcs_ folder in your webserver's host root folder.  For Linux, this would be
_/var/www/pcs.

------
## Configure Apache
To setup Apache (technically apache2) you will need to:
1. Generate Public/Private Keys for SSL
2. Change a configuration file so Apache "knows" where to look for the key(s)
3  Change a configuration file so Apache listens on port 443

### Setup SSL

Run the following to make sure the correct modules are running:

```
sudo a2enmod rewrite

sudo a2enmod ssl
```

##### Generating RSA keys and Certificate

First, create folders (directories) to hold the key(s) and the cert

```
cd /etc/apache2/
sudo mkdir ssl

cd ssl

sudo mkdir crt
sudo mkdir key
```

Second, generate key(s) for the server:

```
sudo openssl genrsa -des -out key/server.key 1024
```
You'll be prompt to enter a password.  DO NOT FORGET THIS PASSWORD !!!!

Next, you are going to create a CSR (Certificate Signature Request):

```
sudo openssl req -new -key key/server.key -out crt/server.csr
``` 

Finally, you are going to "Self Sign" the CSR to create the actuall cert:

```
sudo openssl x509 -req -days 365 -in crt/server.csr -signkey key/server.key -out crt/server.crt
```

### Setup Apache with the DS and keys you just created

Create a _pcs.conf_ file in _etc/apache2/sites-available_

```
sudo touch etc/apache2/sites-available/pcs.conf 
```
Copy the following into pcs.conf:

```
# PCS (cpsc4900 project) configuration
<VirtualHost *:80>
ServerAdmin cmbonham@hotmail.com
DocumentRoot /var/www/pcs
ServerName pcs
DirectoryIndex index.php
ErrorLog /var/log/apache2/pcs-error.log
<Location />
RewriteEngine on
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [R]
</Location>
</VirtualHost>
<VirtualHost *:443>
ServerAdmin cmbonham@hotmail.com
DocumentRoot /var/www/pcs
ServerName pcs
DirectoryIndex index.php
ErrorLog /var/log/apache2/pcs-error.log
CustomLog /var/log/apache2/pcs-access.log combined
SSLEngine On
SSLCertificateFile /etc/apache2/ssl/crt/server.crt
SSLCertificateKeyFile /etc/apache2/ssl/key/server.key
<Location />
SSLRequireSSL On
SSLVerifyClient optional
SSLVerifyDepth 1
SSLOptions +StdEnvVars +StrictRequire
</Location>
</VirtualHost>
```
Of course, you will want to change the _ServerAdmin_ email


Copy this same file into _sites-enabled_ OR you can use the _a2ensite_ command (HIGHLY recommend doing it this way)

```
>> sudo a2ensite pcs
```

Note: Configuration is different for MAC and Windows, but there should be a httd.config file where the above can be accomplished.

### Configure local host file

Open your local host file, located at /etc/hosts.  Add the following line:

```
127.0.0.1       pcs

```
This will allow you type _pcs_ into the browser and you will be directed to your
local server.


Then, you'll need to restart your server.

```
sudo service apache2 restart
```
You will prompt for the password to the keys you generated under the section above, _Generating RSA keys and Certificate_

If all goes well, you should be able to access the website by simply typing _pcs_ into your browser.  You should see

https://pcs   NOT http://pcs


#### Restarting Apache2
Each time you restart (or start) apache2 you will need to supply the password for the private key. So, once again,
do not forget this password.  There is a way to bypass this, but I do not have the time to do a write up.

------
## PHP Requirements

php5 required.

1. For unit testing, see _tests_ folder.  You will need to install PHPUnit test Framework.

2. Sessions must be enabled in the php.ini file. In Linux, this file is located at:

    ```
    /etc/php5/apache2/php.ini
    ```
    
    You'll need to open the file with root (sudo) priveleges
    
    The following need to be set in this folder:
    
    ```
    session.save_handler  = files
    session.save_path     = "/tmp"
    session.use_cookies   = 1
    ```
    Note: the save_path. You will need to create this folder OR use a pre-  existing one. I just use the /tmp because cookies are only temporary. 
    
    For Unix: /tmp is popular
    For Windows: C:WINDOWSTEMP is popular

    These are the basic settings, I'll make note if/when php.ini changes will be required for security.



