# EcommerceExt

This is a fork of the CGEcommerceBase module for CMS Made Simple.

The module can co-exist and will not interfere with systems that use CGEcommerceBase as basis for their
E-commerce functionality.

## Installing

The module requires that the latest version (v1.4.5) of CMSMSExt module (a fork of CGExtensions) is installed
on the server.

Download and unzip the latest EcommerceExt-x.x.x.xml.zip from [releases](../../releases). Use CMSMS's Module Manager
to upload the unzipped XML file to your server.

The module will only install on servers running CMSMS v2.2.19 on PHP 8.0 or newer. The software may run on older
versions of CMSMS or PHP, but the checks in MinimumCMSVersion() and method.install.php would need to be tweaked.

## Using the module

Installing the module will add an `E-commerce configuration` option to the Admin E-Commerce section. The
module uses its own namespace which means that existing E-commerce modules that are based on CGEcommerceBase will not
work or be visible in EcommerceExt's configurations options.

The module uses MAMS module as front end user module.
