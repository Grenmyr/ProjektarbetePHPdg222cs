#Installation Guide UML->Code#

### Step by step
##### all settings for configuration is located in settings.php located in root folder.
##### All variable mentioned below is located in that file.
#### Step: 1

Publish it on web hotel


#### Step: 2
Configure the root path in settings.php variable named "$ROOT_PATH"
#### Step: 3
Configure the database password and username by fill in $DB_PASSWORD and $DB_USERNAME in settings.php


#### Step: 4a
You can run my awesome installation script. just type install.php in browser and it runs.
It will create a database named after what your $DB_NAME is set to, it will create a database named logindb by default.
If you wish to change name, change variable $DB_Name to prefered name.
#### Step: 4b
Or import the database manually by importing the dg222csproject.sql located in documents folder then the database will be named logindb.
You must then change variable $DB_NAME in setting to logindb.

#### Done!
