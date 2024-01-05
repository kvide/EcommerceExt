<h3>What does this do?</h3>
  <p>This module provides a common base of communications for all ecommerce modules.  It allows specifying which available suppliers you wou would like to use, as well as cart, tax, shipping, and payment gateways.  It also provides a complex  API library for communication of, and manipulation of data between the various modules.</p>

<h3>Features:</h3>
  <p>This module provides no frontend interface of its own. It's purpose is to facilitate communication and provide common data elements between the various different modules required for an e-commerce solution.  This allows flexibility in selecting different types of solutions for different applications.  i.e.: different cart, shipping, tax, handling, packaging, payment, or even order management modules may be possible.</p>

<h3>How Do I Use It:</h3>
<ul>
    <li>Research and install all of the desinred ecommerce modules that you will require, along with their dependencies.</li>
    <li>Visit each module's admin panel and enter the appropriate configuration information.
        <p>You may visit these admin panels multiple times during the configuration process.
    </li>
    <li>Visit the EcommerceExt admin panel and begin connecting all of the modules and defining the functionality of your application.
        <ul>
	  <li><strong>Required:</strong> Enter your company address in the &quot;Store Address&quot; tab.
	     <p>This information can be provided to payment gateways and shipping modules, and may be displayed on invoices, etc.</p>
	  </li>
	  <li><strong>Required:</strong> Enter general settings such as weight and length units, and the currency that you will be selling in.
	     <p>The currency symbol is used for display purposes.</p>
	     <p>The three character currency code is provided to shipping, payment and other modules for price calculations.</p>
	     <p>The weight units describe the units that you will enter weights of products.  Please choose eithr g, kg, or lb.</p>
	     <p>The length units describe the units that you will enter dimensions of products and shipping oxes.  Please choose ither cm, or inches.</p>
	     <p class="warning">It is important that you do not change these settings once the application enteres into the production stage and you are working with real information.</p>
	  </li>
	  <li>Define a policy for the cart module to follow.
	     <p>This policy allows the cart module and potentially other modules to know how to behave.</p>
	  </li>
	  <li><strong>Required:</strong> Select one, or more source modules.
	     <p>Source modules are modules that can provide items (products, or services) to the cart.</p>
	  </li>
	  <li><strong>Required:</strong> Select a cart module.
	     <p>Cart provider modules allow customers to add items to the cart, and may provide different features and appearances.</p>
	  </li>
	  <li>Select a tax module.
	     <p>Tax provider modules allow for different ways to calculate taxes on customer orderrs.</p>
	  </li>
	  <li>Select a packaging provider.
	     <p>These modules are used to organize a cart contents into various packages, that can then be shipped.   Some shipping modules may require packaging modules to perform cost estimation.</p>
	  </li>
	  <li>Optionally select a handling provider.
	     <p>These provider modules allow calculating and adding handling charges in various ways.</p>
	  </li>
	  <li>Optionally select a shipping provider.
	     <p>These provider modules allow calculating shipping costs for physical products.</p>
	  </li>
	  <li>Optionally select a promotion module.
	     <p>These provider modules allow managing and calculating discounts for orders.</p>
	  </li>
	  <li>Optionally select one or more payment modules.
	     <p>These provider modules allow providing different methods for customers to pay for their order.</p>
	  </li>
	</ul>
    </li>
</ul>

<h3>Smarty Tags</h3>
<ul>
  <li><code style="color: blue;">{ecomm_form_addtocart source=EcProductMgr product=$num}</code>
   <p>This tag uses the currently selected cart module and displays a form to allow the user to add an item to the cart.<br/>Parameters:</p>
   <ul>
    <li>source - specify the name of the source module.  This module must be selected as a supplier in the EcommerceExt admin panel.</li>
    <li>product - specify the unique <em>(integer)</em> identifier of the product within the source module.</li>
   </ul>
   <p>Any other arguments passed to this tag are passed to the appropriate module, for example for specifying a different template you may want to add an &quot;addtocarttemplate=foo&quot; argument.</p>
  </li>
  <li><code style="color: blue;">{ecomm_erasecart}</code>
    <p>This tag empties all information from the currently selected cart, and sets the visitors basket back to a completely empty state.</p>
  </li>
  <li><code style="color: blue;">{ecomm_company_address [assign='string']}</code>
   <p>This tag retrieves the company address from the database, and assigns it to the named smarty variable.</p>
  </li>
  <li><code style="color: blue;">{ecomm_currency_code [assign=string]}</code> - Returns the currently set currency code.</li>
  <li><code style="color: blue;">{ecomm_currency_symbol [assign=string]}</code> - Returns the currently set currency symbol.</li>
  <li><code style="color: blue;">{ecomm_weight_units [assign=string]}</code> - Returns the currently set weight units.</li>
  <li><code style="color: blue;">{ecomm_weight_units [assign=string]}</code> - Returns the currently set weight units.</li>
  <li><code style="color: blue;">{ecomm_length_units [assign=string]}</code> - Returns the currently set length units.</li>
  <li><code style="color: blue;">{ecomm_cartitem_exists [source=string] [product=integer|sku=string] [extra=mixed] [assign=string]}</code>
    <p>Returns either 0 or 1 depending on if the item (identified by either the prouct id, or sku exists in the cart.</p>
  </li>
</ul>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2024, CMS Made Simple Foundation <a href="mailto:info@cmsmadesimple.org">&lt;info@cmsmadesimple.org&gt;</a>. All Rights Are Reserved.</p>
<p>Copyright &copy; 2008-2019, Robert Campbell &lt;calguy1000&gt;. All Rights Are Reserved.</p>
<hr>
<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>
<p>However, as a special exception to the GPL, this software is distributed
as an addon module to CMS Made Simple.  You may not use this software
in any Non GPL version of CMS Made simple, or in any version of CMS
Made simple that does not indicate clearly and obviously in its admin
section that the site was built with CMS Made simple.</p>
<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>

<hr>
<h4>Current Maintainers</h4>
<ul>
  <li class="p_bottom_15"><strong>Christian Kvikant</strong></li>
</ul>

<h4>Past Maintainers</h4>
<ul>
  <li><strong>Robert Campbell (calguy1000)</strong> <br /></li>
</ul>
