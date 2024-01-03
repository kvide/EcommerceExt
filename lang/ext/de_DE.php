<?php
$lang['ask_really_uninstall'] = 'Wollen Sie wirklich dieses Modul deinstallieren?';
$lang['attrib_item_description'] = 'Template f&uuml;r Produkt-Attribut-Anzeige';
$lang['cart_module'] = 'Warenkorb-Modul';
$lang['currency_code'] = 'W&auml;hrungsschl&uuml;ssel';
$lang['currency_symbol'] = 'W&auml;hrungssymbol';
$lang['error_invalidaddress'] = 'Die angegebene Adresse ist ung&uuml;ltig. Eines oder mehrere ben&ouml;tigte Felder fehlen.';
$lang['event_desc_CartAdjusted'] = 'Wird aufgerufen, wenn Massen&auml;nderungen am Warenkorb vorgenommen werden';
$lang['event_desc_CartItemAddPre'] = 'Wird aufgerufen wenn ein Artikel in den Warenkorb gelegt wird';
$lang['event_desc_CartItemAdded'] = 'Wird aufgerufen, wenn dem Warenkorb ein Produkt oder eine Dienstleistung hinzugef&uuml;gt wird';
$lang['event_desc_OrderCreated'] = 'Wird aufgerufen, wenn eine Bestellung erstmalig in die Datenbank eingef&uuml;gt wird';
$lang['event_desc_OrderDeleted'] = 'Wird aufgerufen, nachdem eine Bestellung komplett entfernt wurde';
$lang['event_desc_OrderUpdated'] = 'Wird aufgerufen, nachdem eine Bestellung gespeichert wurde';
$lang['event_help_CartItemAddPre'] = '<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameter:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of \EcommerceExt\cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a \EcommerceExt\cartitem object representing the item that is proposed to add to the cart.</li>
</ul>';
$lang['event_help_CartAdjusted'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_items&quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&quot;status&quot; - A status flag, indicating wether this is before, or after the items have changed.</li>
<li>&quot;extra&quot; - An additional string that may provide some state information as to when this action was called&#039;;
</ul>';
$lang['event_help_CartItemAdded'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_item&quot; - The single cart item object that was added.</li>
</ul>';
$lang['event_help_OrderCreated'] = '<p>Sent after an order is initially inserted into the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The newly created order id.</li>
</ul>';
$lang['event_help_OrderDeleted'] = '<p>Sent after an order is removed from the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The deleted order id.</li>
</ul>';
$lang['event_help_OrderUpdated'] = '<p>Sent after an order is updated</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The order id.</li>
</ul>';
$lang['friendlyname'] = 'E-commerce Configuration';
$lang['gateway_policy'] = 'Gateway-Regeln';
$lang['info_attrib_item_description'] = 'Das Temlate zur Anzeige von Attribut-Listenmen&uuml;s. M&ouml;gliche Variablen sind {$currency_symbol},{$weight_units},{$attrib_adjust},{$attrib_text},{$attrib_sku}';
$lang['info_cart_module'] = 'Zahlreiche Module, die als &quot;Warenk&ouml;rbe&quot; funktionieren, k&ouml;nnen heruntergeladen werden. Jedes von denen mit unterschiedlichen Verhaltensweisen. Bitte w&auml;hlen Sie eines der installierten Warenkorb-Module aus dieser Liste';
$lang['info_cart_policy'] = 'The cart policy is influenced by the capabilities of the payment gateway, and determines how many, and what type of items may be added tot he cart(s).  You ma8y further restrict the cart policy, but cannot bypass the restrictions placed by the gateway.';
$lang['info_lineitem_desc_template'] = 'This template is used to format the single line description for a cart item.  This same description is used for the line item in order processing.';
$lang['info_overweight_limit'] = 'Das Gewicht, ab dem ein Produkt in einem eigenen Paket geliefert werden soll';
$lang['info_packaging_module'] = 'Select a module responsible for arranging the various items selected in an order for packaging.  If none is selected, then the shipping maycalculate costs independantly on each order item.';
$lang['info_payment_module'] = 'Numerous modules that perform the functionality of allowing online payments may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_promotions_module'] = 'Numerous modules that perform the functionality of providing coupons or various forms of discounts may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_ship_dimensions'] = 'Field from the Products module that indicates the shippable dimensions for this product';
$lang['info_ship_seperately'] = 'Field from the Products module which indicates that this value should be shipped as its own package';
$lang['info_shipping_module'] = 'Numerous modules that perform shipping cost calculations may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_supplier_modules'] = 'Supplier modules are capable of interacting with the cart and answering requests from order processing modules.  You may select multiple supplier modules.';
$lang['info_tax_module'] = 'Numerous modules that perform tax calculation may be downloaded.  Each of these with different behaviours.  Please select one of the installed tax modules from this list';
$lang['info_tax_shipping'] = 'In some locations shipping may not be taxable.  Use this option to ensure that no shipping costs are taxed';
$lang['length_units'] = 'L&auml;ngeneinheiten';
$lang['lineitem_desc_template'] = 'Template f&uuml;r die Einzelposten-Beschreibung';
$lang['max_products'] = 'maximale Anzahl an Produkten im Warenkorb';
$lang['max_services'] = 'maximale Anzahl an Dienstleistungen im Warenkorb';
$lang['max_subscriptions'] = 'maximale Anzahl an Abonnements im Warenkorb';
$lang['mixed_subscriptions'] = 'Soll eine Mischung aus Produkten, Dienstleistungen und Abonnements in einem Warenkorb erlaubt sein?';
$lang['module_description'] = 'A base class for all e-commerce modules this utiility also provides common preferences and connectors for the various portions of the ecommerce suite';
$lang['no'] = 'Nein';
$lang['none'] = 'Nichts ausgew&auml;hlt';
$lang['not_applicable'] = 'Nicht anwendbar';
$lang['packaging_module'] = 'Versandverpackungs-Modul';
$lang['payment_module'] = 'Schnittstellenmodul f&uuml;r Online-Bezahlungen';
$lang['postinstall'] = 'Das EcommerceExt Modul wurde installiert. Installieren Sie jetzt weitere E-Commerce Module, um die von Ihnen ben&ouml;tigten Funktionen zu erhalten. Nachdem Sie die Module installiert haben, rufen Sie diese Einstellungsseite wieder auf, um die Konfiguration zu vervollst&auml;ndigen.';
$lang['postuninstall'] = 'Dieses Modul und alle zugeh&ouml;rigen Daten wurden aus der Datenbank entfernt. Sie k&ouml;nnen jetzt die verbliebenen Dateien l&ouml;schen.';
$lang['promotions_module'] = 'Werbemodul';
$lang['prompt_company'] = 'Firma';
$lang['prompt_firstname'] = 'Vorname';
$lang['prompt_lastname'] = 'Nachname';
$lang['prompt_maxweight'] = 'Maximalgewicht';
$lang['prompt_address1'] = 'Adresszeile 1';
$lang['prompt_address2'] = 'Adresszeile 2';
$lang['prompt_city'] = 'Stadt';
$lang['prompt_state'] = 'Bundesstaat/Provinz/Kanton';
$lang['prompt_postal'] = 'Postleitzahl';
$lang['prompt_country'] = 'Land';
$lang['prompt_fax'] = 'Fax ';
$lang['prompt_email'] = 'Email-Adresse';
$lang['prompt_phone'] = 'Telefon';
$lang['prompt_overweight_limit'] = '&Uuml;bergewichtsbeschr&auml;nkung';
$lang['prompt_shipping_boxes'] = 'Liefer-Boxen';
$lang['prompt_width'] = 'Breite';
$lang['prompt_height'] = 'H&ouml;he';
$lang['prompt_length'] = 'L&auml;nge';
$lang['prompt_weight'] = 'Gewicht';
$lang['prompt_sorting'] = 'Priorit&auml;t';
$lang['prompt_name'] = 'Name ';
$lang['reset'] = 'Zur&uuml;cksetzen';
$lang['ship_dimensions_field'] = 'Produkte Versand-Ma&szlig;e-Feld';
$lang['ship_seperately_field'] = 'Produkte separates Versand-Feld';
$lang['shipping_module'] = 'Versandmodul';
$lang['supplier_modules'] = 'Versorgungsmodule';
$lang['submit'] = 'Absenden';
$lang['system_policy'] = 'Systemrichtlinie';
$lang['tab_cart_settings'] = 'Warenkorbeinstellungen';
$lang['tab_general_settings'] = 'Allgemeine Einstellungen';
$lang['tab_myinfo_settings'] = 'Gesch&auml;ftsadresse';
$lang['tab_packaging_settings'] = 'Verpackungs-Einstellungen';
$lang['tab_payment_settings'] = 'Zahlungseinstellungen';
$lang['tab_policy'] = 'Richtlinie';
$lang['tab_promotion_settings'] = 'Werbungseinstellungen';
$lang['tab_shipping_settings'] = 'Versandeinstellungen';
$lang['tab_supplier_settings'] = 'Versorgungsmoduleinstellungen';
$lang['tab_tax_settings'] = 'Steuereinstellungen';
$lang['tax_module'] = 'Steuerberechnungsmodul';
$lang['tax_shipping'] = 'Tax shipping calculations';
$lang['units_centimeters'] = 'Zentimeter';
$lang['units_inches'] = 'Zoll';
$lang['unlimited'] = 'Unbegrenzt';
$lang['weight_units'] = 'Gewichtseinheiten';
$lang['yes'] = 'Ja';
$lang['utmb'] = '156861353.3.10.1377040104';
$lang['utma'] = '156861353.2042345210.1376300813.1377038689.1377039441.8';
$lang['utmc'] = '156861353';
$lang['utmz'] = '156861353.1376695246.4.2.utmcsr=mielenz.jonathanschmid.de|utmccn=(referral)|utmcmd=referral|utmcct=/admin/editcss.php';
?>