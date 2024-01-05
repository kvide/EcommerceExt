<?php
#A
$lang['allow_pickup'] = 'Allow Local Pickup';
$lang['any'] = 'Any';
$lang['ask_really_uninstall'] = 'Are you really sure that you want to uninstall this module';
$lang['attrib_item_description'] = 'Product Attribute Display Template';

#B


#C
$lang['cart_module'] = 'Cart Module';
$lang['currency_code'] = 'Currency Code';
$lang['currency_symbol'] = 'Currency Symbol';

#D

#E
$lang['err_config_address'] = 'The specified store address is incomplete or invalid';
$lang['err_config_currency'] = 'The currency information specified is incomplete or invalid';
$lang['err_config_weight'] = 'The weight units specified are incomplete or invalid';
$lang['err_config_length'] = 'The weight units specified are incomplete or invalid';
$lang['err_config_suppliers'] = 'No valid supplier modules configured';
$lang['err_config_cart'] = 'A cart module is not selected, or not configured';
$lang['err_config_shipping_policy'] = 'You have not yet specified a valid shipping policy';
$lang['err_gateways_notfound'] = 'We could not find any valid payment gateways installed in this system.  Please ensure that you have installed, and configured at least one compatible gateway module.';
$lang['error_invalidaddress'] = 'Address specified is invalid (missing one or more required fields?';
$lang['event_desc_CartAdjusted'] = 'Called when bulk adjustments are done to the cart, or one of its baskets';
$lang['event_desc_CartItemAddPre'] = 'Called prior to an item being added to the cart';
$lang['event_desc_CartItemAdded'] = 'Called when a single product or service is added to the cart';
$lang['event_desc_OrderCreated'] = 'Called after an order is initially inserted into the database';
$lang['event_desc_OrderDeleted'] = 'Called after an order has been completely removed';
$lang['event_desc_OrderUpdated'] = 'Called after an existing order has been saved';
$lang['event_help_CartItemAddPre'] = <<<EOT
<p>Sent prior to an item being added to the cart, this event is called after the cart policy is checked, and can be used to alter the item.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;existing_items&quot; - <em>(read only)</em>  An array of \EcommerceExt\cartitem items representing the existing items in the cart.</li>
<li>&quot;cart_item&quot; - <em>(modifiable)</em> A reference (modifiable) to a \EcommerceExt\cartitem object representing the item that is proposed to add to the cart.</li>
</ul>
EOT;
$lang['event_help_CartAdjusted'] = <<<EOT
<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_items&quot; - An hash of baskets, each containing an array of cart item objects and some summary information.</li>
<li>&quot;status&quot; - A status string, indicating wether this is before, or after the items have changed.</li>
<li>&quot;extra&quot; - An additional string that may provide some state information as to when this action was called';
</ul>
EOT;
$lang['event_help_CartItemAdded'] = <<<EOT
<p>Sent when bulk adjustments are done to the cart, or one of its baskets.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;cart_item&quot; - The single cart item object that was added.</li>
</ul>
EOT;
$lang['event_help_OrderCreated'] = <<<EOT
<p>Sent after an order is initially inserted into the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The newly created order id.</li>
</ul>
EOT;
$lang['event_help_OrderDeleted'] = <<<EOT
<p>Sent after an order is removed from the database.</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The deleted order id.</li>
</ul>
EOT;
$lang['event_help_OrderUpdated'] = <<<EOT
<p>Sent after an order is updated</p>
<h4>Parameters:</h4>
<ul>
<li>&quot;order_id&quot; - The order id.</li>
</ul>
EOT;

#F
$lang['friendlyname'] = 'E-commerce Configuration';

#G
$lang['gateway_policy'] = 'Gateway Policy';

#H
$lang['handling_module'] = 'Handling Module';

#I
$lang['info_config_tab'] = 'This panel shows what sub modules are used to add functionality to the E-commerce configuration, and their current status.  Here you can remove a module from the configuration.  To add the module back to the E-commerce configuration you should visit the module\'s admin panel.';
$lang['info_shipping_pickup'] = 'If enabled, customers will have the option during checkout to allow picking up items at your store location';
$lang['info_shipping_policy'] = 'This tab allows you to specify the default shipping policy for this website.';
$lang['info_shipping_shipto'] = 'Specify the list of countries (or any) that this store ships to.  If a limited list is selected, then an error will be generated if the customer attempts to place an order with shippment to a disallowed location';
$lang['info_attrib_item_description'] = 'The template used for displaying attribute dropdowns.  Possible variables are {$currency_symbol},{$weight_units},{$attrib_adjust},{$attrib_text},{$attrib_sku}';
$lang['info_cart_module'] = 'Numerous modules that act as &quot;Shopping Carts&quot; may be downloaded.  Each of them with different behaviours.  Please select one of the installed cart modules from this list';
$lang['info_cart_policy'] = 'The cart policy is influenced by the capabilities of the payment gateway, and determines how many, and what type of items may be added to the cart(s).  You may further restrict the cart policy, but cannot bypass the restrictions placed by the gateway.';
$lang['info_lineitem_desc_template'] = 'This template is used to format the single line description for a cart item.  This same description is used for the line item in order processing.';
$lang['info_handling_module']  = 'Numerous modules that perform the functionality of calculating a handling charge may be downloaded.  Each of them with different behaviors.  Please select one of the installed handling modules from this list';
$lang['info_overweight_limit'] = 'The weight at which an item should be shipped in its own package';
$lang['info_packaging_module'] = 'Select a module responsible for arranging the various items selected in an order for packaging.  If none is selected, then the shipping maycalculate costs independantly on each order item.';
$lang['info_payment_modules2'] = 'The e-commerce system allows checkout via numerous payment gateways.  Each with their own features and capabilities.  The input below shows the gateway modules that are installed and configured.  Please select the gateways that customers should be able to use at checkout.';
$lang['info_promotions_module'] = 'Numerous modules that perform the functionality of providing coupons or various forms of discounts may be downloaded.  Each of them with different behaviours.  Please select one of the installed promotions modules from this list';
$lang['info_ship_dimensions'] = 'Field (of type dimensions) from the Products module that indicates the shippable dimensions for this product';
$lang['info_ship_seperately'] = 'Field (of type checkbox) from the Products module which indicates that this value should be shipped as its own package';
$lang['info_shipping_module'] = 'Numerous modules that perform shipping cost calculations may be downloaded.  Each of them with different behaviours.  Please select one of the installed  modules from this list';
$lang['info_supplier_modules'] = 'Supplier modules are capable of interacting with the cart and answering requests from order processing modules.  You may select multiple supplier modules.';
$lang['info_tax_module'] = 'Numerous modules that perform tax calculation may be downloaded.  Each of these with different behaviours.  Please select one of the installed tax modules from this list';
$lang['info_tax_shipping'] = 'In some locations shipping may not be taxable.  Use this option to ensure that no shipping costs are taxed';

#J


#K


#L
$lang['length_units'] = 'Length Units';
$lang['lineitem_desc_template'] = 'Line Item Description Template';


#M
$lang['max_products'] = 'Maximum Number of Products in one Cart';
$lang['max_services'] = 'Maximum Number of Services in one Cart';
$lang['max_subscriptions'] = 'Maximum Number of Subscriptions in one Cart';
$lang['max_subscription_periods'] = 'Maximum Number of payment periods for a subscription';
$lang['mixed_subscriptions'] = 'Allow a mixture of products, services and subscriptions in one cart?';
$lang['module_description'] = 'A base class for all e-commerce modules this utility also provides common preferences and connectors for the various portions of the ecommerce suite';
$lang['msg_prefs_saved'] = 'Preferences updated';

#N
$lang['no'] = 'No';
$lang['none'] = 'None';
$lang['not_applicable'] = 'Not applicable';
$lang['not_configured'] = 'Not configured';

#O
$lang['ok'] = 'Ok';


#P
$lang['packaging_module'] = 'Packaging Module';
$lang['payment_modules'] = 'Online Payment Gateway Modules';
$lang['postinstall'] = 'The EcommerceExt module is now installed, you may now proceed to install more components to the ecommerce suite to fill out your required functionality.  Once they are installed return to this modules administration panel to continue the configuration';
$lang['postuninstall'] = 'This module and all associated data have been removed from the CMSMS database.  You are now safe to remove its files';
$lang['promotions_module'] = 'Promotions Module';
$lang['prompt_company'] = 'Company';
$lang['prompt_firstname'] = 'First Name';
$lang['prompt_lastname'] = 'Last Name';
$lang['prompt_maxweight'] = 'Max Weight';
$lang['prompt_address1'] = 'Address Line 1';
$lang['prompt_address2'] = 'Address Line 2';
$lang['prompt_city'] = 'City';
$lang['prompt_state'] = 'State / Province';
$lang['prompt_postal'] = 'Postal / Zip Code';
$lang['prompt_country'] = 'Country';
$lang['prompt_fax'] = 'Fax';
$lang['prompt_email'] = 'Email Address';
$lang['prompt_phone'] = 'Phone';
$lang['prompt_overweight_limit'] = 'Overweight Limit';
$lang['prompt_shipping_boxes'] = 'Shipping Boxes';
$lang['prompt_width'] = 'Width';
$lang['prompt_height'] = 'Height';
$lang['prompt_length'] = 'Length';
$lang['prompt_weight'] = 'Weight';
$lang['prompt_sorting'] = 'Priority';
$lang['prompt_name'] = 'Name';


#Q


#R
$lang['reset'] = 'Reset';


#S
$lang['ship_dimensions_field'] = 'Products Ship Dimensions Field';
$lang['ship_seperately_field'] = 'Products Ship Seperately Field';
$lang['shipping_module'] = 'Shipping Module';
$lang['ships_to'] = 'Allow Shipping to';
$lang['supplier_modules'] = 'Supplier Modules';
$lang['submit'] = 'Submit';
$lang['system_policy'] = 'System Policy';

#T
$lang['tab_cart_settings'] = 'Cart Settings';
$lang['tab_configuration'] = 'Configuration';
$lang['tab_general_settings'] = 'General Settings';
$lang['tab_handling_settings'] = 'Handling Settings';
$lang['tab_myinfo_settings'] = 'Store Address';
$lang['tab_packaging_settings'] = 'Packaging Settings';
$lang['tab_payment_settings'] = 'Payment Settings';
							$lang['tab_policy'] = 'Policy';
$lang['tab_promotion_settings'] = 'Promotion Settings';
$lang['tab_shipping_policy'] = 'Shipping Policy';
$lang['tab_supplier_settings'] = 'Supplier Settings';
$lang['tab_tax_settings'] = 'Tax Settings';
$lang['tax_module'] = 'Tax Calculation Module';
$lang['tax_shipping'] = 'Tax shipping calculations';

#U
$lang['units_centimeters'] = 'Centimeters';
$lang['units_inches'] = 'Inches';
$lang['unlimited'] = 'Unlimited';
$lang['unset'] = 'Unset';

#V


#W
$lang['warn_general_settings'] = '<strong>Warning:</strong> it is not a good idea to change these settings in a production system.  The currency code, length and weight units may be used to calculate taxes, and shipping costs.  Changing them may corrupt the data of an existing installation.';
$lang['warn_nomodule'] = 'There is currently no module configured for this functionality.';
$lang['warn_no_suppliers'] = 'No supplier modules detected';
$lang['weight_units'] = 'Weight Units';
$lang['wunit_lbs'] = 'Pounds (lbs)';
$lang['wunit_kg'] = 'Kilograms (kg)';
$lang['wunit_hg'] = 'Hectogram (hg)';
$lang['wunit_g'] = 'Grams (g)';

#X


#Y
$lang['yes'] = 'Yes';

#Z


?>
