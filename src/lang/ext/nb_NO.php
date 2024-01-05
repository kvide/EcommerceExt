<?php
$lang['ask_really_uninstall'] = 'Er du virkelig sikker p&aring; at du vil avinstallere denne modulen';
$lang['attrib_item_description'] = 'Produktattributt visningsmal';
$lang['cart_module'] = 'Handlekurvmodul';
$lang['currency_code'] = 'Valutakode';
$lang['currency_symbol'] = 'Valutasymbol';
$lang['error_invalidaddress'] = 'Opgitt adresse er ugyldig (mangler en eller flere p&aring;krevde felter)?';
$lang['event_desc_CartAdjusted'] = 'Kalles n&aring;r bulk justeringer er gjort i handlevognen, eller en av dets handlekurver';
$lang['event_desc_CartItemAddPre'] = 'Kalles f&oslash;r et element legges til handlevognen';
$lang['event_desc_CartItemAdded'] = 'Kalles n&aring;r et produkt eller en tjeneste er lagt til handlevognen';
$lang['event_desc_OrderCreated'] = 'Kalles etter en ordre f&oslash;rst settes inn i databasen';
$lang['event_desc_OrderDeleted'] = 'Kalles etter at en bestilling er blitt fullstendig fjernet';
$lang['event_desc_OrderUpdated'] = 'Kalles etter en eksisterende ordre er lagret';
$lang['event_help_CartItemAddPre'] = '<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of \EcommerceExt\cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a \EcommerceExt\cartitem object representing the item that is proposed to add to the cart.</li>
</ul>';
$lang['event_help_CartAdjusted'] = '<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&amp;quot;cart_items&amp;quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&amp;quot;status&amp;quot; - A status string, indicating wether this is before, or after the items have changed.</li>
<li>&amp;quot;extra&amp;quot; - An additional string that may provide some state information as to when this action was called&#039;;
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
$lang['gateway_policy'] = 'Gateway-politikk';
$lang['info_attrib_item_description'] = 'Malen brukes for &aring; vise attributtet rullegardinlister. Mulige variabler er ($currency_symbol), ($weight_units), ($attrib_adjust), ($attrib_text), ($attrib_sku)';
$lang['info_cart_module'] = 'Flere moduler som fungerer som &#039;Handlekurver&#039; kan lastes ned. Hver av dem med ulik atferd. Vennligst velg en av de installerte handlekurvmoduler fra denne listen';
$lang['info_cart_policy'] = 'Handlevognpolitikken er p&aring;virket av egenskapene til betalingsgateway, og bestemmer hvor mange og hva slags gjenstander kan legges til handlevognen(e). Du kan ytterligere begrense handlekurvpolitikken, men kan ikke omg&aring; begrensningene plassert av portalen.';
$lang['info_lineitem_desc_template'] = 'Denne malen brukes til &aring; formatere &eacute;n linje beskrivelse for et handlevognelement. Den samme beskrivelsen brukes til den aktuelle linjen for ordrebehandling.';
$lang['info_overweight_limit'] = 'Vekten som tilsier at et element skal sendes som en egen pakke';
$lang['info_packaging_module'] = 'Velg en modul ansvarlig for &aring; ordne de forskjellige enhetene i en ordre for pakking. Om ingen er valgt, da vil forsendelse(shipping) trolig kalkulere kostnadene uavhengig for hver enhet i ordren.';
$lang['info_payment_module'] = 'Flere moduler som tilf&oslash;rer funksjonalitet for &aring; tillate elektroniske betalinger kan lastes ned. Hver av dem med ulik atferd. Velg en av de installerte betalingsmodulene fra denne listen';
$lang['info_promotions_module'] = 'Flere moduler som tilf&oslash;rer funksjonaliteten ved &aring; tilby kuponger eller ulike former for rabatter kan lastes ned. Hver av dem med ulik atferd. Velg en av de installerte rabattmoduler fra denne listen';
$lang['info_ship_dimensions'] = 'Felt fra Products-modulen som indikerer forsendelsesdimensjonene for dette produktet';
$lang['info_ship_seperately'] = 'Felt fra Products-modulen som indikerere at denne verdien skal sendes som en egen pakke';
$lang['info_shipping_module'] = 'Flere moduler som utf&oslash;rer frakt kostnadsberegningene kan lastes ned. Hver av dem med ulik atferd. Velg en av de installerte fraktmodulene fra denne listen';
$lang['info_supplier_modules'] = 'Leverand&oslash;r moduler er i stand til &aring; kommunisere med handlekurven og svare p&aring; foresp&oslash;rsler fra ordrebehandlingsmoduler. Du kan velge flere leverand&oslash;rmoduler.';
$lang['info_tax_module'] = 'Flere moduler som utf&oslash;rer avgiftsberegning kan lastes ned. Hver av disse med forskjellige virkem&aring;ter. Velg en av de installerte avgiftsmodulene fra denne listen';
$lang['info_tax_shipping'] = 'P&aring; noen steder er kanskje ikke frakt skattepliktig. Bruk dette alternativet for &aring; sikre at ingen fraktkostnadene blir tillagt skatt';
$lang['length_units'] = 'Lengde enheter';
$lang['lineitem_desc_template'] = 'Linje varebeskrivelsesmal';
$lang['max_products'] = 'Maksimalt antall produkter i en handlekurv';
$lang['max_services'] = 'Maksimalt antall tjenester i en handlekurv';
$lang['max_subscriptions'] = 'Maksimalt antall abonnement i en handlekurv';
$lang['mixed_subscriptions'] = 'Tillat en blanding av produkter, tjenester og abonnement i en handlekurv?';
$lang['module_description'] = 'En base klasse for alle e-handelsmodulene. Denne verkt&oslash;yet gir ogs&aring; felles preferanser og kontakter for de ulike deler av ehandelsuiten';
$lang['no'] = 'Nei';
$lang['none'] = 'Ingen';
$lang['not_applicable'] = 'Ikke aktuelt';
$lang['packaging_module'] = 'Pakke modul';
$lang['payment_module'] = 'Online betalingsgateway modul';
$lang['postinstall'] = 'EcommerceExt modulen er n&aring; installert, kan du n&aring; g&aring; videre til &aring; installere flere komponenter til e-handelsuiten for &aring; fylle de n&oslash;dvendige funksjonalitetene du trenger. S&aring; snart de er installert g&aring;r du til disse modulenes administrasjonspanel og fortsetter konfigurasjonen';
$lang['postuninstall'] = 'Denne modulen og alle tilh&oslash;rende data har blitt fjernet fra CMSMS databasen. Du kan n&aring; trygt &aring; fjerne dens filer';
$lang['promotions_module'] = 'Promotions modul';
$lang['prompt_company'] = 'Firma';
$lang['prompt_firstname'] = 'Fronavn';
$lang['prompt_lastname'] = 'Etternavn';
$lang['prompt_maxweight'] = 'Maks vekt';
$lang['prompt_address1'] = 'Adresselinje 1';
$lang['prompt_address2'] = 'Adresselinje 2';
$lang['prompt_city'] = 'By';
$lang['prompt_state'] = 'Stat / Provins';
$lang['prompt_postal'] = 'Postnummer/ zip-kode';
$lang['prompt_country'] = 'Land';
$lang['prompt_fax'] = 'TElefaks';
$lang['prompt_email'] = 'E-postadresse';
$lang['prompt_phone'] = 'Telefon';
$lang['prompt_overweight_limit'] = 'Overvektsgrense';
$lang['prompt_shipping_boxes'] = 'Forsendelsesbokser';
$lang['prompt_width'] = 'Bredde';
$lang['prompt_height'] = 'H&oslash;yde';
$lang['prompt_length'] = 'Lengde';
$lang['prompt_weight'] = 'Vekt';
$lang['prompt_sorting'] = 'Prioritet';
$lang['prompt_name'] = 'NAvn';
$lang['reset'] = 'Nullstill';
$lang['ship_dimensions_field'] = 'Produktforsendelse dimensjonsfelt';
$lang['ship_seperately_field'] = 'Produkt send-separat felt';
$lang['shipping_module'] = 'Forsendelse moduler';
$lang['supplier_modules'] = 'Leverand&oslash;r moduler';
$lang['submit'] = 'Utf&oslash;r';
$lang['system_policy'] = 'Systempolitikk';
$lang['tab_cart_settings'] = 'Handlekurvinnstillinger';
$lang['tab_general_settings'] = 'Generelle innstillinger';
$lang['tab_myinfo_settings'] = 'Lageradresse';
$lang['tab_packaging_settings'] = 'Pakke innstillinger';
$lang['tab_payment_settings'] = 'Betalingsinnstillinger';
$lang['tab_policy'] = 'Policy ';
$lang['tab_promotion_settings'] = 'Promotion innstillinger';
$lang['tab_shipping_settings'] = 'Forsendelsesinnstillinger';
$lang['tab_supplier_settings'] = 'Leverand&oslash;rinnstillinger';
$lang['tab_tax_settings'] = 'Avgiftsinnstillinger';
$lang['tax_module'] = 'Avgiftskalkuleringsmodul';
$lang['tax_shipping'] = 'Frakt avgift/skatt kalkuleringer';
$lang['units_centimeters'] = 'Centimeter';
$lang['units_inches'] = 'Tommer';
$lang['unlimited'] = 'Ubegrenset';
$lang['weight_units'] = 'Vektenheter';
$lang['yes'] = 'Ja';
$lang['qca'] = 'P0-536849115-1307983495210';
$lang['utma'] = '156861353.1400698784.1339530996.1339878866.1339882165.16';
$lang['utmz'] = '156861353.1339530996.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>
