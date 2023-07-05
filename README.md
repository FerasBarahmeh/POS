# Point Of Sale System
This Point of Sale System is aimed for small convenience stores which are still unfamiliar to computerized system of running the business. This system is simple yet effective as the functions are easy to use for the users, that is, for the store owner or store manager and store cashiers.

In the admin panel, there are fields which are effective for the administration of the whole store. The administrator can manage list of product items, product categories, cashier information, customer information and supplier information.

This project is implemented with Model-view-controller (MVC) software design pattern.

# Libraries / Dependencies Used
- Chart.js
- fpdf
# Setup
1) Download Server controller like XAMPP or MAMP
2) PHP >= 8.*
3) Clone this repo use this command in terminal ```https://github.com/Feras-Barahmeh/POS.git``` in ```\XAMPP\htdocs``` folder
4) Create Database name pos then import file pos.sql the path this file is ```\XAMPP\htdocs\POS\pos.sql``` all this steps from **http://localhost/phpmyadmin/**
5) If Your OS is Windows
    - Go The host file in your device the path file is ```C:\Windows\System32\drivers\etc\hosts```
      and add ```127.0.0.1       pos.local``` without single Quotation
      then go the **httpd-vhosts.conf** file in Server controller (XAMPP) the path of this file is ```\XAMPP\apache\conf\extra```
      and set this lines

      ```
      <VirtualHost *:80>
          ServerAdmin http://pos.local/dashboard/
          DocumentRoot "E:/XAMPP/htdocs/POS/public"
      </VirtualHost>
      ```
      ###### NOTE
    - ```E:/XAMPP/htdocs/POS/public``` `E` drive because I installed **XAMPP** in `E` drive, but you set path depend  your device 
   


**The ``admin`` **username**  is **bnzz** and the **password** is **1234567****


## Copyright

&copy; Feras Barahmeh 2023

The contents of this repository, including all files and subdirectories, are licensed under the [appropriate license you choose, e.g., MIT License, Apache License 2.0, etc.]. Unless otherwise stated, all rights are reserved by the copyright holder.

You may not use, copy, modify, or distribute any part of this repository without explicit permission from the copyright holder. If you would like to request permission or have any questions regarding the use of the contents of this repository, please contact [your contact information, such as an email address or website].