[imgexample1]: http://i.imgur.com/G0y1nIE.png "Imagem de exemplo"

# MagentoPdfCart
### Module for save current cart quote in pdf.

# How to use:
1. You need to add a link wherever you want, using the following helper function to add a link to open pdf in a tab
Ex: 
```.php
<?php echo Mage::helper('pdfcart')->getQuoteLink($label, $class); ?>
```
2. You also can add a link to send a email to customer with the generated pdf, using the following helper function
Ex: 
```.php
<?php echo Mage::helper('pdfcart')->getEmailLink($label, $class); ?>
```
# Example:
![alt text][imgexample1]

# Customize:
1. You can customize pdf appearance only editing the phtml located in base template folder or create different templates for each of your stores. 
2. You can create css files for each of your store on css pdfcart skin folder.
3. You can set some configurations in admin page.

# Changelog
## 0.0.2
1. Fixed encoding caracter intermitent bug;
2. Added send pdf to email function;
3. Added helper functions to get action links

# Backlog
1. Module translation to english

# If You need Help
#### You can ask me in github page and I'll be happy to help you.

