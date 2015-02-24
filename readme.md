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
this is a test
## Tables

Tables are simple to make in md (markdown) files:

col1 | col2
-----|------
item1 | item2


## Markdown spacing

Markdown rendering relies on formatting properly.  Use 4 spaces for tab indentations

## List

Here is a numbered list

1. Item 1
2. Item 2
	Note: To put more info inbetween to list items, you must indent !!!!
3. Item 3


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