# [DVS] Denovo Voucher Script
Denovo Voucher Script (DVS) is an affiliate marketing tool you can install on your domain to market affiliated products/promotions/offers etc. as well as distribute vouchers to your visitors through the tool.

DVS is extremely simple to use. Once operational you can log in to the administrative panel and configure all aspects of the site from there. Not only are you able to add retailers, vouchers, offers and promotions but you can also add products to the site manually or by importing the affiliate feeds. DVS supports affiliate network feeds (via icodes) allowing you to add as many as 50,000+ products to your site in a matter of hours!

Apart from other competitive websites, DVS has widgets that automatically analyze trends and display the most interesting retailers and products in order of popularity throughout the site.


----------
**Following screenshot illustrates the landing page on a (almost) fresh install of the script**
![Landing Page](https://rawgit.com/faisalthaheem/denovo-voucher-script/master/docs/home-page.png)


----------
**Sample screenshot from admin site**
![Admin interface](https://rawgit.com/faisalthaheem/denovo-voucher-script/master/docs/bo.codes.png)

# Hosting Requirements

Hosting setup must comply with the following requirements in order to use this script.

Feature|Requirement
-------|-----------
Web Server|Apache 2.2+
mod_rewrite|enabled
php version | 5.x
mysql | &gt;= 5.0
gd with php|yes
sendmail|yes
php safe mode|off
php_memory_limit| &gt;128M

# Trying it out quickly
Quickest way to try out the script is using docker, build the image from the Dockerfile in the "docker-dev" folder and run it

    git clone https://github.com/faisalthaheem/denovo-voucher-script.git
    cd denovo-voucher-script
    cd docker-dev
    build.bat
    run.bat "c:/somelocation/denovo-voucher-script/site"

Follow the instructions in the "Setup" section of wiki to get started.
