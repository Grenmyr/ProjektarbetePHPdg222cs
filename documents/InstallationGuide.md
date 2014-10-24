#Installation Guide UML->Code#

### Step by step
##### all settings for configuration is located in settings.php located in root folder.
##### All variable mentioned below is located in that file.


###Manual installation: 
#### Step: 1
Import the database manually by importing the dg222csproject.sql located in documents folder then the database will be named logindb.

#### Step: 2
Configure the root path in settings.php variable named "$ROOT_PATH"

#### Step: 3
Configure the database password and username by fill in $DB_PASSWORD and $DB_USERNAME in settings.php

#### Done!

###Trying to upload by install.php

#### Step: 1

Upload project

#### Step: 2
Configure the root path in settings.php variable named "$ROOT_PATH"

#### Step: 3
Configure the database password and username by fill in $DB_PASSWORD and $DB_USERNAME in settings.php

#### Step: 4
You can run my awesome installation script. just type install.php in browser at root directory and it runs.
It will create a database named after what your $DB_NAME is set to, it will create a database named logindb by default.
If you wish to change name, change variable $DB_Name to prefered name.

Don't forgett to remove install.php after you run it.


#### Done!
