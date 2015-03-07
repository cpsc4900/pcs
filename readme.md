# CPSC4900 Project

## General Notes

This is the main repository for our school project.
Note: This description will be deleted in a few weeks.

## Markdown
This is a markdown file.  They are very simple to make.  We should include one in each folder to give a description of what the folder contains.

For each folder create a file named readme.md


```
readme.md

This is a literal section.  Use these sections to give code examples,
terminal command examples, etc
```


## Folder structure

We have a very basic folder structure here with pcs being the root (main) folder.  Place the _pcs_ folder in your webserver's host root folder.  For Linux, this would be
_/var/www/pcs.

You will need to configure apache to recognize this folder as being root.  If in Linux, go to _/etc/apache2_.  There are two folders named _sites-available_ and _sites-enabled_. create a _.conf_ file in _sites-available_ called _pcs.conf_. Insert the following:

```
# PCS (cpsc4900 project) configuration
Alias /pcs /var/www/pcs/
<Directory "/var/www/pcs/">
 AllowOverride None
</Directory>
```

Copy this same file into _sites-enabled_

Then, you'll need to restart your server.  You can now access the local website with:

```
localhost/pcs
```

The first index.php page contains a generic greeting to make sure your php and apache server are working properly.

Note: Configuration is different for MAC and Windows, but there should be a httd.config file where the above can be accomplished.

## PHP Requirements

1. For unit testing, see _tests_ folder.  You will need to install PHPUnit test Framework.

2. Sessions must be enabled in the php.ini file. In Linux, this file is located at:

    ```
    /etc/php5/apache2/php.ini
    ```
    
    You'll need to open the file with root (admin) priveleges...google !
    
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



