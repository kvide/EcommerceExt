<?php
$lang['ask_really_uninstall'] = 'Weet u zeker dat u deze module wilt de&iuml;nstalleren?';
$lang['attrib_item_description'] = 'Product Attributen Display Sjabloon';
$lang['cart_module'] = 'Cart Module ';
$lang['currency_code'] = 'Valuta Code';
$lang['currency_symbol'] = 'Valuta Symbool';
$lang['error_invalidaddress'] = 'Het benoemde adres is niet correct (mogelijk missen er een of meer verplichte velden?)?';
$lang['event_desc_CartAdjusted'] = 'Een tag die wordt aangeroepen wanneer bulk wijzigingen in de winkelwagen zijn uitgevoerd, of aan &eacute;&eacute;n van de mandjes';
$lang['event_desc_CartItemAddPre'] = 'Een tag die wordt aangeroepen voordat een item wordt toegevoegd aan de winkelwagen';
$lang['event_desc_CartItemAdded'] = 'Een tag die wordt aangeroepen wanneer een product of dienst is toegevoegd aan de winkelwagen';
$lang['event_desc_OrderCreated'] = 'Een tag die wordt aangeroepen nadat een order voor het eerst wordt opgenomen in de database';
$lang['event_desc_OrderDeleted'] = 'Een tag die wordt aangeroepen nadat een order wordt verwijderd';
$lang['event_desc_OrderUpdated'] = 'Een tag die wordt aangeroepen nadat een bestaande order wordt opgeslagen';
$lang['event_help_CartItemAddPre'] = '<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of \EcommerceExt\cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a \EcommerceExt\cartitem object representing the item that is proposed to add to the cart.</li>
</ul>';
$lang['event_help_CartAdjusted'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_items&quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&quot;status&quot; - A status flag, indicating wether this is before, or after the items have changed.</li>
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
$lang['gateway_policy'] = 'Gateway Beleid';
$lang['info_attrib_item_description'] = 'Sjabloon dat wordt gebruikt voor het weergeven van attribuut dropdowns. Mogelijke waarden zijn: {$currency_symbol},{$weight_units},{$attrib_adjust},{$attrib_text},{$attrib_sku} ';
$lang['info_cart_module'] = 'Er zijn verschillende modules die kunnen worden gebruikt als &quot;Winkelwagentje&quot;. Elk van deze werkt op een eigen manier. Selecteer van de geselecteerde winkelwagentjes uit deze lijst';
$lang['info_cart_policy'] = 'Het winkelwagen beleid wordt be&iuml;nvloed door de mogelijkheden van de betaling gateway, en bepaalt hoeveel en wat voor soort items kunnen worden toegevoegd aan de winkelwagen(s). U kunt het winkelwagenbeleid verder beperken, maar kan niet voorbij aan de beperkingen van de gateway.';
$lang['info_lineitem_desc_template'] = 'Deze template wordt gebruikt voor een &eacute;&eacute;n regel beschrijving voor een cart item. Dezelfde beschrijving wordt gebruikt voor de beschrijving in het orderproces.';
$lang['info_overweight_limit'] = 'Het gewicht waarbij een item moet worden verzonden is zijn eigen verpakking';
$lang['info_packaging_module'] = 'Selecteer een module die verantwoordelijk is voor het beheren van verschillende geselecteerde items van een order voor verpakking. Als er geen wordt geselecteerd dan zullen de verzendkosten worden berekent onafhankelijk van de items in de order.';
$lang['info_payment_module'] = 'Er kunnen verschillende modules worden gedownload die online betalingen kunnen verwerken. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde betaalmodules van deze lijst';
$lang['info_promotions_module'] = 'Er kunnen verschillende modules worden gedownload die coupons of ander vormen van korting kunnen verwerken. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde modules van deze lijst';
$lang['info_ship_dimensions'] = 'Veld van de productmodule dat de afmetingen van de verzending bevat voor dit product';
$lang['info_ship_seperately'] = 'Veld van de productmodule dat aangeeft dat deze waarde moet worden verzonden als eigen pakket';
$lang['info_shipping_module'] = 'Er kunnen verschillende modules worden gedownload die de kosten voor verzending kunnen verrekenen. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde verzendkostenmodules in deze lijst';
$lang['info_supplier_modules'] = 'Aanvullende modules die in staat zijn om samen te werken met het winkelwagentje en aanvragen kan beantwoorden van de ordermodules. U kunt meerdere aanvullende modules selecteren.';
$lang['info_tax_module'] = 'Er kunnen verschillende modules worden gedownload die belasting kunnen verrekenen. Deze werken allemaal op hun eigen manier. Selecteer een van de ge&iuml;nstalleerde belastingmodules van deze lijst';
$lang['info_tax_shipping'] = 'In sommige locaties zijn verzendkosten niet belastbaar. Gebruik deze optie om te bewerkstelligen dat verzendkosten niet belast worden';
$lang['length_units'] = 'Lengte eenheid';
$lang['lineitem_desc_template'] = 'Een-regel beschrijving sjabloon';
$lang['max_products'] = 'Maximaal aantal producten in een Cart';
$lang['max_services'] = 'Maximum aantal services in een Cart';
$lang['max_subscriptions'] = 'Maximum aantal inschrijvingen in een Cart';
$lang['mixed_subscriptions'] = 'Sta een mix van producten, services in inschrijvingen toe in een Cart?';
$lang['module_description'] = 'Een basis class voor alle e-commerce modules voor gezamenlijke instellingen die verbinding legt tussen de verschillende onderdelen van de ecommerce suite';
$lang['no'] = 'Nee';
$lang['none'] = 'Geen';
$lang['not_applicable'] = 'Niet toepasbaar';
$lang['packaging_module'] = 'Verpakkingsmodule';
$lang['payment_module'] = 'Online Betaling Gateway Module';
$lang['postinstall'] = 'De EcommerceExt module is nu ge&iuml;nstalleerd, u kunt nu verder gaan door meerdere componenten te installeren om de door u vereiste functionaliteit te bieden. Als deze eenmaal ge&iuml;nstalleerd zijn kunt u naar het administratiepaneel terugkeren om de configuratie te voltooien.';
$lang['postuninstall'] = 'Deze module en alle gerelateerde data is verwijderd uit de CMSMS database. U kunt nu veilig de bestanden verwijderen';
$lang['promotions_module'] = 'Promotions Module ';
$lang['prompt_company'] = 'Bedrijf';
$lang['prompt_firstname'] = 'Voornaam';
$lang['prompt_lastname'] = 'Achternaam';
$lang['prompt_maxweight'] = 'Maximaal gewicht';
$lang['prompt_address1'] = 'Adresregel 1';
$lang['prompt_address2'] = 'Adresregel 2';
$lang['prompt_city'] = 'Plaats';
$lang['prompt_state'] = 'Staat / Provincie';
$lang['prompt_postal'] = 'Postcode';
$lang['prompt_country'] = 'Land';
$lang['prompt_fax'] = 'Fax ';
$lang['prompt_email'] = 'E-mail Adres';
$lang['prompt_phone'] = 'Telefoon';
$lang['prompt_overweight_limit'] = 'Overgewicht limiet';
$lang['prompt_shipping_boxes'] = 'Verzenddozen';
$lang['prompt_width'] = 'Breedte';
$lang['prompt_height'] = 'Hoogte';
$lang['prompt_length'] = 'Lengte';
$lang['prompt_weight'] = 'Gewicht';
$lang['prompt_sorting'] = 'Prioriteit';
$lang['prompt_name'] = 'Naam';
$lang['reset'] = 'Herstel';
$lang['ship_dimensions_field'] = 'Productafmetingen veld bij verzending';
$lang['ship_seperately_field'] = 'Product wordt los geleverd veld';
$lang['shipping_module'] = 'Verzendmodule';
$lang['supplier_modules'] = 'Leveranciersmodule';
$lang['submit'] = 'Versturen';
$lang['system_policy'] = 'Systeem beleid';
$lang['tab_cart_settings'] = 'Cart Instellingen';
$lang['tab_general_settings'] = 'Algemene Instellingen';
$lang['tab_myinfo_settings'] = 'Winkel Adres';
$lang['tab_packaging_settings'] = 'Verpakkingsinstellingen';
$lang['tab_payment_settings'] = 'Betalingsinstellingen';
$lang['tab_policy'] = 'Leveringsvoorwaarden';
$lang['tab_promotion_settings'] = 'Promotieinstellingen';
$lang['tab_shipping_settings'] = 'Verzendingsinstellingen';
$lang['tab_supplier_settings'] = 'Verzenderinstellingen';
$lang['tab_tax_settings'] = 'BTW Instellingen';
$lang['tax_module'] = 'BTW Module';
$lang['tax_shipping'] = 'BTW Verzendkosten';
$lang['units_centimeters'] = 'Centimeters ';
$lang['units_inches'] = 'Inches ';
$lang['unlimited'] = 'Ongelimiteerd';
$lang['weight_units'] = 'Gewichteenheid';
$lang['yes'] = 'Ja';
$lang['utmz'] = '156861353.1342374360.1.1.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/project/admin/726|utmcmd=referral';
$lang['utma'] = '156861353.1110397634.1342374360.1342374360.1342374360.1';
$lang['qca'] = 'P0-802263609-1268423862699';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>
