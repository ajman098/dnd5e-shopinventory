dnd5e-shopinventory
===================

Shop Inventory/Pricing Generator for D&amp;D 5e


Preview
=======

You can preview this project at http://rpg.gorker.org/shop/index.php


Goals
=====

1. Set up each 'card' as a different category of item
2. List under each category the available items with a price or "Out of Stock"
3. Each price will have a "low", "average" or "high" marking based on its relation to average market price
4. An ability for GM to generate and freeze prices as well as name the shop
5. Update listings to include/reflect 5E items, as source is 3.5
6. Humor


Stretch Goals
=============

1. Add an icon for each item
2. Add an onclick description for each item
3. Generate a random "delivery time" for items that are out of stock?


Icons
=====

All icons are provided by http://game-icons.net/


FAQ
===

#### Q: I have found a layout issue or a major issue in one of the core items, what should I do? ####
A: Open an issue at https://github.com/ajman098/dnd5e-shopinventory/issues. Even better: fork the project, fix the problem, and post a pull request.

#### Q: How do I edit the base items and prices? ####
A: Currently the code points to a read-only database. You can instead edit the connect.php file and point it to your own database. All the current data is in the tables.sql file. Once that's imported to your sql database, you can edit the values using phpmyadmin.


CREDIT
======

Any and all credit for the design, layout and code (minus any of my php scraps) of this project goes to Robert Autenrieth. If you like this project, I highly recommend the original 5e quickref here: https://github.com/crobi/dnd5e-quickref/

The concept and a lot of the legwork comes from Jacob Valdez's Shop Inventory Spreadsheet. You can see the original here: https://roleplayingtips.com/tools/excel-file-generates-shop-inventory-for-you/
