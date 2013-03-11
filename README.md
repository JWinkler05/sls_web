Installing this repo

git clone
git checkout development
git submodule update --init --recursive
install apache2
install php5
install php5-curl
install php-pear
sudo pecl install mongo
copy etc/php5/mongo.ini to /etc/php5/conf.d/
copy etc/sls_web_ to http vhost directory 
  update working location
  update log file locations
enable mod_rewrite_ 
enable mod_headers_
restart apache2
run {base_dir}/fix_permissions.sh
add /etc/hosts entry for devwww.smartlocalsocial.com


# Kohana PHP Framework

[Kohana](http://kohanaframework.org/) is an elegant, open source, and object oriented HMVC framework built using PHP5, by a team of volunteers. It aims to be swift, secure, and small.

Released under a [BSD license](http://kohanaframework.org/license), Kohana can be used legally for any open source, commercial, or personal project.

## Documentation
Kohana's documentation can be found at <http://kohanaframework.org/documentation> which also contains an API browser.

The `userguide` module included in all Kohana releases also allows you to view the documentation locally. Once the `userguide` module is enabled in the bootstrap, it is accessible from your site via `/index.php/guide` (or just `/guide` if you are rewriting your URLs).

## Reporting bugs
If you've stumbled across a bug, please help us out by [reporting the bug](http://dev.kohanaframework.org/projects/kohana3/) you have found. Simply log in or register and submit a new issue, leaving as much information about the bug as possible, e.g.

* Steps to reproduce
* Expected result
* Actual result

This will help us to fix the bug as quickly as possible, and if you'd like to fix it yourself feel free to [fork us on GitHub](https://github.com/kohana) and submit a pull request!
