### A CodeIgniter skeleton application based on twitter bootstrap and html5boilerplate.
---------------------------------------------------

* Codeigniter 2.1.4
* bootstrap 3.0RC1
* html5boilerplate 4.0.0
* unique style css contains all bootstrap css (responsive and basic), and global css for custom styles.
* unique plugin js contains all bootstrap plugins.
* view rendering handled by a smart MY_Controller.
* jQuery 1.10.2
* underscore.js 1.5.0
* nav_helper
* .htaccess tip for remove index.php
* basejs view always include in page. (usefull to access via js some server side information e.g. base_url())

USAGE
-------------------
1. edit .htaccess file in order to match your server config (see line 5 in the file);
	if you have http://localhost/site you need to set RewriteBase /site/
2. set up your defaults values in application/config/development/custom.php
3. take a look to home controller and template view files to understand how does rendering works.
4. create your template: I've set up an header, footer, nav, and main for example purpose. Skeleton.php contains the scaffolding page.
5. pass your data to the view using in controller $this->data["my_var"] = "value";

Database installation
------------------- 
Find **sonepar.sql.gz** in application/sql/ and import it to your database.

Email configuration
------------------- 
Go to application/controllers/email.php line 275 and enter your email details.

Demo
------------------- 
URL: https://www.andydesign.co.nz/projects/sonepar

User: **demo@demo.com**

Pass: **demodemo**

## Author

####Andy Wu

+	https://www.andydesign.co.nz

+	<mailto:admin@andy-web-dev.com>
