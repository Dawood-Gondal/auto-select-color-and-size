# AutoSelectColorAndSize-Magento2

The module helps in auto selecting product swatches for color and size attributes.

### How it works
On the product level, there will be two attributes Auto Select Size and Auto Select Color if we enable these attributes. Whenever the last variant is left in the stock, on storefront color and size attributes will be auto selected and hidden on PDP and listing pages.

## Installation

### Magento® Marketplace

This extension will also be available on the Magento® Marketplace when approved.

### Manually

1. Go to Magento® 2 root folder

2. Require/Download this extension:

   Enter following commands to install extension.

   ```
   composer require m2commerce/auto-select-color-and-size
   ```

   Wait while composer is updated.
   
   #### OR
   
   You can also download code from this repo under Magento® 2 following directory:
    
    ```
    app/code/M2Commerce/AutoSelectColorAndSize
    ```    

3. Enter following commands to enable the module:

   ```
   php bin/magento module:enable M2Commerce_AutoSelectColorAndSize
   php bin/magento setup:upgrade
   php bin/magento setup:di:compile
   php bin/magento cache:clean
   php bin/magento cache:flush
   ```

4. If Magento® is running in production mode, deploy static content: 

   ```
   php bin/magento setup:static-content:deploy
   ```
