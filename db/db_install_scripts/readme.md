# Install scripts

## Installing the pcs_db

Login to your local mysql from the command line as root user, supply password,
then run the "install_pcs_schema" script.  The example below is my linux file path.
Your file path will be different.

```
>mysql -u root -p

> supply password

mysql> \. /var/www/pcs/db/db_install_scripts/install_pcs_schema_v1.0.0

```
Note: The first install should not produce any errors.  As Mike edits the database, the install script needs to be updated.  So, two options:

In the script itself insert a command to delete the old **pcs_db** and install a fresh new copy.

Or, we'll manually have to delete our local copy and re-install.

@Mike, just let us know which method to use.
@Mike, make sure you change the version number of the script....easier to keep track of updates.


#### Version Control

**install_pcs_schema_v1.0.0**:

	* All foreign keys are integer values now.
	* Only two user types created:
		- Master  password: masterpass (can access all tables)
		- Login   password: loginpass  (can only read all tables) 

## Installing "Dummy Data"

Run the _dump\_data.sql_ script to load up records to the database:

```
mysql> \. /var/www/pcs/db/db_install_scripts/dump_data.sql

```
Once again, your file path will be different then mine depending on your OS and filesystem.