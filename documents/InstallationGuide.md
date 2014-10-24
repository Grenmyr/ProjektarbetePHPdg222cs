#Installation Guide UML->Code#

### Step by step

#### Step: 1

Publish it on web hotel

##### all settings for configuration is located in settings.php located in root folder.
All variable mentioned below is located in that file.
#### Step: 2
configure the root path in settings.php variable named "$ROOT_PATH"
#### Step: 3
configure the database password and username by fill in $DB_PASSWORD and $DB_USERNAME in settings.php

#### step: 4a
either import the database manually by importing the dg222csproject located in documents folder then the database will be named logindb.
You must then change variable $DB_NAME in setting to logindb.

#### step: 4b
or you run my awesome installation script. just type install.php in browser and it runs.
It will create a database named after what your $DB_NAME is set to, it will create a database named project by default.
If you wish to change name, change variable $DB_Name.