<?php

# BEGIN_LICENSE
# -------------------------------------------------------------------------
# Module: EcommerceExt (c) 2023 by CMS Made Simple Foundation
#
# Provides a base platform for all E-commerce modules.
#
# -------------------------------------------------------------------------
# A fork of:
#
# Module: CGEcommerceBase (c) 2010-2019 by Robert Campbell
# (calguy1000@cmsmadesimple.org)
#
# -------------------------------------------------------------------------
#
# CMSMS - CMS Made Simple is (c) 2006 - 2023 by CMS Made Simple Foundation
# CMSMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# Visit the CMSMS Homepage at: http://www.cmsmadesimple.org
#
# -------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple. You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
# -------------------------------------------------------------------------
# END_LICENSE
namespace EcommerceExt\Payment;

interface payment_gateway
{
    const PAYMENT_STATUS_APPROVED = 'payment_approved';
    const PAYMENT_STATUS_DECLINED = 'payment_declined';
    const PAYMENT_STATUS_ERROR = 'payment_error';
    const PAYMENT_STATUS_CANCELLED = 'payment_cancelled';
    const PAYMENT_STATUS_OTHER = 'payment_other';
    const PAYMENT_STATUS_PENDING = 'payment_pending';
    const PAYMENT_STATUS_AUTHORIZED = 'payment_authorized';
    const PAYMENT_STATUS_NONE = 'payment_none';
    const TRANS_CAPTURE = 'TRANS_CAPTURE';
    const TRANS_VOID = 'TRANS_VOID';
    const TRANS_CREDIT = 'TRANS_CREDIT';

    /**
     * Returns a boolean indicate wether the gateway module allows instant checkout.
     *
     * Instant checkout gateways ask the user for their billing and shipping information
     * and this information is returned from the gateway to fill the order.
     *
     * @abstract
     * @return boolean
     */
    public function AllowsInstantCheckout();

    /**
     * Returns a boolean indicating wether the gateway module
     * requires credit card information be submitted to the gateyay.
     *
     * If this is set to true, order processor modules may provide a
     * mechanism to allow a site visitor to input credit card information.
     *
     * @abstract
     * @return boolean
     */
    public function RequiresCreditCardInfo();

    /**
     * Returns a boolean indicates wether the payment gateay module
     * Supports the token mechanism for offline charges
     *
     * @abstract
     * @return boolean
     */
    public function SupportsOfflineCharges();

    /**
     * Get the gateway name (usually the module name)
     *
     * @abstract
     * @return string
     */
    public function GetName();

    /**
     * Test if the gateway is properly configured and ready to use
     * by an order processing module.
     *
     * @abstract
     * @return boolean
     */
    public function IsConfigured();

    /**
     * Does this module require SSL in order to be able to communicate
     * with the remote gateway
     *
     * @abstract
     * @return boolean
     */
    public function RequiresSSL();

    /**
     * Does this gateway require shipping address information
     *
     * @abstract
     * @return boolean
     */
    public function RequiresShippingInfo();

    /**
     * Does this gateway require billing address information
     *
     * @abstract
     * @return boolean
     */
    public function RequiresBillingInfo();

    /**
     * Does this gateway support issuing credit transactions.
     *
     * @abstract
     * @return boolean
     */
    public function SupportsRefunds();

    /**
     * Save the information currently associated with the gateway module into
     * a temporary (but secure) state for later retrieval by other actions
     * of this module.
     *
     * This method is typically used to store state information before the visitor
     * is redirected to a hosted gateway. It can then be restored after the visitor
     * has returned from the third party gateway.
     *
     * You may use any secure encryption or storage mechanism you wish.
     *
     * @abstract
     * @param
     *            boolean Should the data be encrypted
     * @param
     *            string An optional encryption key
     * @return string The encryption key if the data was encrypted, or null.
     */
    public function SaveState($encrypt = false, $key = '');

    /**
     * Restore saved module state information from an encrypted/secure storage location
     *
     * @abstract
     * @param
     *            string An optional encryption key
     * @return boolean indicates success or failure.
     */
    public function RestoreState($key = '');

    /**
     * Set credit card information into the module.
     * This method may be called by the order processing module to provide information
     * that must be sent to the payment gateway.
     *
     * The gateway module should store this data for later sending to the host.
     *
     * Note: This method is subject to change.
     *
     * @abstract
     * @param
     *            string Credit card number.
     * @param
     *            integer Credit card expiry date
     * @param
     *            string Credit card verification code.
     * @return void
     */
    public function SetCreditCardInfo($ccnumber, $ccexp, $ccvcode);

    /**
     * Get raw (user entered) credit card info.
     * Returns an array with three elements (ccnumber, ccexp, and ccvcode).
     *
     * @return array
     */
    public function GetRawCreditCardInfo();

    /**
     * Get the processed credit card info.
     * This is suitable for use by payment gateways.
     *
     * Returns an array with three elements (x_card_num,x_exp_date, and x_card_code)
     */
    public function GetProcessedCreditCardInfo();

    /**
     * Set a payment identifier
     *
     * The payment identifier provides order processing specific information to
     * tie the incoming transaction to an existing payment transaction. This
     * variable may be null or empty if it is a new transaction, and has no
     * relation to a transaction id provided by the gateway.
     *
     * This method may be called by the gateway module to provide information
     * to the order processing module after a transaction has been received.
     *
     * Note: This method is subject to change.
     *
     * @abstract
     * @deprecated
     * @param
     *            string Payment ID
     * @return void
     */
    public function SetPaymentId($payment_id);

    /**
     * Retrieved a payment identifier
     *
     * The payment identifier provides order processing specific information to
     * tie the incoming transaction to an existing payment transaction. This
     * variable may be null or empty if it is a new transaction, and has no
     * relation to a transaction id provided by the gateway.
     *
     * This method may be called by the order processing module to retrieve information
     * about a payment identifier (if one exists).
     *
     * Note: This method is subject to change.
     *
     * @abstract
     * @deprecated
     * @param
     *            integer Payment ID
     * @return void
     */
    public function GetPaymentId();

    /**
     * Set a currency code.
     *
     * Associate a currency code with the information that will be sent to the gateway.
     *
     * This method may be called by the order processing module to add currency information
     * to the list of information that will be sent to the host.
     *
     * The gateway module should store this data for later sending to the host.
     *
     * Note: This method is subject to change.
     *
     * @abstract
     * @deprecated
     * @param
     *            string The currency code (usually two or three digits)
     * @return void
     */
    public function SetCurrencyCode($code = 'USD');

    /**
     * Retrieve the currency code.
     *
     * @abstract
     * @return string
     */
    public function GetCurrencyCode();

    /**
     * Set weight units
     *
     * This method may be called by the order processing module to add weight units
     * to the list of information that will be sent to the host.
     *
     * The gateway module should store this data for later sending to the host.
     *
     * Note: This method is subject to change.
     *
     * @abstract
     * @param
     *            string the weight units. either 'lbs' or 'kg'
     * @return void
     */
    public function SetWeightUnits($units = 'lbs');

    /**
     * Retrieve the weight units;
     *
     * @abstract
     * @return string
     */
    public function GetWeightUnits();

    /**
     * Set Destination URL.
     *
     * This method may be called by the order processing module to specify where
     * the customer should be returned to (if possible) once the payment gateway transaction
     * is complete.
     *
     * The gateway module should store this data for use after gateway communications are
     * complete.
     *
     * Note: This method is subject to change.
     *
     * @abstract
     * @param
     *            string the weight units. either 'lbs' or 'kg'
     * @return void
     */
    public function SetDestination($url);

    /**
     * Get the destination URL,
     *
     * @abstract
     * @return string
     */
    public function GetDestination();

    /**
     * Add a cart item.
     *
     * This method may be called by the order processing module to add cart information
     * to the information that should be sent to the payment gateway.
     *
     * The gateway module should store this data for later sending to the host.
     *
     * Note: This method is subject to change.
     *
     * @abstract
     * @param
     *            string The item name.
     * @param
     *            string The item name (maybe a sku)
     * @param
     *            integer Quantity
     * @param
     *            float The weight of the items
     * @param
     *            float The unit price of the item.
     * @param
     *            float An optional tax amount (deprecated)
     * @return void
     */
    public function AddItem($name, $number, $quantity, $weight, $amount, $tax = '');

    /**
     * Retrieve the list of items (if any) associated with this order.
     *
     * @return array
     */
    public function GetItems();

    /**
     * Set the order object.
     * if this is set. other methods may extract data using the order object.
     *
     * @todo Use a base object instead of orders_order
     * @param
     *            \orders_order
     */
    public function SetOrderObject(\orders_order $order);

    /**
     * Return the order object (if set)
     *
     * @return \orders_order
     */
    public function get_order_object();

    /**
     * Set a description for the whole order.
     *
     * This method may be called by the order processing module to provide a global
     * description for the order.
     *
     * The gateway module should store this data for later sending to the host.
     *
     * @abstract
     * @param
     *            string The description.
     * @return void.
     */
    public function SetOrderDescription($str);

    /**
     * Get a description for the whole order.
     *
     * @abstract
     * @return string
     */
    public function GetOrderDescription();

    /**
     * Set the id for this order.
     *
     * @param int $orderid
     */
    public function SetOrderId($orderid);

    /**
     * Get the id for this order.
     *
     * @return int
     */
    public function GetOrderId();

    /**
     * Set the order invoice string.
     *
     * This method may be called by the order processing module to set an invoice identifer.
     *
     * The gateway module should store this data for later sending to the host.
     *
     * @abstract
     * @param
     *            string Invoice label.
     * @return void.
     */
    public function SetInvoice($invoice);

    /**
     * Get the order invoice string.
     *
     * @return string
     */
    public function GetInvoice();

    /**
     * Set an optional billing address for this order.
     * Most payment gateways require some sort of billing address
     *
     * @param \xt_address $billing_addy
     *            The billing address (must be valid).
     */
    public function SetBillingAddress(\xt_address $billing_addy);

    /**
     * Get a billing address for this transaction, if one is available.
     *
     * @return \xt_address|null
     */
    public function GetBillingAddress();

    /**
     * Set an optional shipping address for this order.
     * Most payment gateways require some sort of shipping address
     *
     * @param \xt_address $shipping_addy
     *            The shipping address (must be valid).
     */
    public function SetShippingAddress(\xt_address $shipping_addy);

    /**
     * Get a shipping address for this transaction, if one is available.
     *
     * @return \xt_address|null
     */
    public function GetShippingAddress();

    /**
     * Set the amount of this transaction.
     *
     * @abstract
     * @param float $val
     */
    public function SetTransactionAmount($val);

    /**
     * Retrieve the transaction amount.
     *
     * This method may be called by the order processing module when handling transaction
     * information.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @return float
     */
    public function GetTransactionAmount();

    /**
     * Set the transaction type
     *
     * This method may be called by order processing modules when preparing to process a transaction
     *
     * The default transaction type should be EcPaymentExt::TRANS_CAPTURE
     * other valid types are EcPaymentExt::TRANS_VOID and EcPaymentExt::TRANS_CREDIT.
     * Invalid transaction types are ignored.
     *
     * @author calguy1000
     * @since 1.0.11
     */
    public function SetTransactionType($type);

    /**
     * Get the transaction type.
     *
     * @return string
     */
    public function GetTransactionType();

    /**
     * Sets the Transactionid retrieved from the gateway host into the module.
     *
     * This method should be called by the gateway module after receiving transaction
     * information.
     *
     * @abastract.
     * @param
     *            string Transaction ID.
     * @return void
     */
    public function SetTransactionId($tid);

    /**
     * Sets the transaction as cancelled.
     *
     * This method should be called by the gateway module after receiving transaction
     * information if the transaction has been cancelled by the user.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @param
     *            string an optional message to associate with the status.
     * @return void
     */
    public function SetCancelled($message = null);

    /**
     * Sets the transaction status to error.
     *
     * This method should be called by the gateway module after receiving transaction
     * information if there is an error with the transaction.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @param
     *            string an optional message to associate with the status.
     * @return void
     */
    public function SetTransactionError($message);

    /**
     * Reset the information stored with the gateway module.
     *
     * @abastract.
     * @return void
     */
    public function Reset();

    /**
     * Sets the transaction as cancelled.
     *
     * This method should be called by the gateway module after receiving transaction
     * information if the transaction has been declined.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @param
     *            string an optional message to associate with the status.
     * @return void
     */
    public function SetDeclined($message = null);

    /**
     * Sets the the transaction status.
     *
     * This method may be called by the gateway module after receiving transaction
     * information from the gateway host.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @param
     *            string an optional message to associate with the status.
     * @return void
     */
    public function SetTransactionStatus($status);

    /**
     * Retrieve the transaction status
     *
     * This method may be called by the order processing module when handling transaction
     * information.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @return string
     */
    public function GetTransactionStatus();

    /**
     * Set misc data associated with the transaction.
     *
     * @param string $key;
     * @param mixed $value;
     */
    public function SetTransactionData($key, $value);

    /**
     * Get the keys of misc data, if any associated with this transaction.
     *
     * @return string[]
     */
    public function GetTransactionKeys();

    /**
     * Get specific extra information associated with this transaction.
     *
     * @param string $key
     * @param mixed $dflt
     * @return mixed
     */
    public function GetTransactionData($key, $dflt = null);

    /**
     * Retrieve the transaction id provided by the gateway host.
     *
     * This method may be called by the order processing module when handling transaction
     * information.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @return string
     */
    public function GetTransactionId();

    /**
     * Retrieve any previously set message.
     *
     * This method may be called by the order processing module when handling transaction
     * information.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @return string
     */
    public function GetMessage();

    /**
     * Finish the transaction.
     *
     * This is used for asyncrhonous transactions with the gateway server.
     *
     * Usually gateway modules will save the gateway state
     * and redirect to the destination url.
     *
     * Note: This method is subject to change.
     *
     * @abastract.
     * @return void.
     */
    public function FinishTransaction();

    /**
     * Ensure that there is enough information to send to the gateway host.
     *
     * This method is usually called before attempting to send information to the
     * gateway host, or when displaying the form.
     *
     * @abstract
     * @return boolean.
     */
    public function CheckInfo();

    /**
     * Display a form or other suitable output to allow a customer to checkout
     * using this gateway.
     *
     * Some gateways expect input to be provided in a form, others use an entirely
     * programmatic appriach (prepare data and post it to some URL).
     *
     * This method is usually called by the order processing module to display
     * a form or a button, or a link to allow the user to checkout.
     *
     * @abstract
     * @return string
     */
    public function GetForm($returnid);

    /**
     * This method is used to send information to the remote gateway without
     * user interaction (asyncrhoonously)
     *
     * Some gateways may not support this.
     *
     * @abstract
     * @return void
     */
    public function ProcessTransaction();

    /**
     * This method is used to send notification to the order processor that transaction
     * information has arrived asyncrhonously.
     *
     * This method prepares some information, and sends the EcPaymentExt::on_incoming_event event.
     *
     * @deprecated.
     * @final
     * @return void
     */
    public function ProcessAsyncTransaction($order_id, $transaction_id, $payment_status, $amount, $message = '');

    /**
     * This method is used to process a transaction with the payment gateway
     * in synchrnous mode, without user interaction.
     *
     * This method throws exceptions instead of calling FinishTransaction
     * Modules using this method are responsible for
     *
     * @abstract
     * @return \EcommerceExt\Payment\async_transaction
     */
    public function ProcessSyncTransaction();

    /**
     * Return the policy for cart items that can be added to this module.
     * This is used by the order processing module to determine what gateways can be used to process the order considering the items in the order.
     *
     * @return \EcommerceExt\Cart\cartitem_policy
     */
    public function get_cartitem_policy();

} // end of interface

#
# EOF
#
?>
