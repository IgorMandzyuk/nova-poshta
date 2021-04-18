# Mage2 Module Im NovaPoshta

    ``im/module-novaposhta``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Nova Poshta

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Im`
 - Enable the module by running `php bin/magento module:enable Im_NovaPoshta`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require im/module-novaposhta`
 - enable the module by running `php bin/magento module:enable Im_NovaPoshta`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - NovaPoshta - carriers/novaposhta/*

 - api_key (settings/im_novaposhta/api_key)


## Specifications

 - Console Command
	- Import

 - Shipping Method
	- novaposhta


## Attributes



