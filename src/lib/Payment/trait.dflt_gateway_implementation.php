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

use EcommerceExt\Cart;
use EcommerceExt\ecomm;

/**
 * A trait to provide most of the skeleton code for a payment gateway.
 */
trait dflt_gateway_implementation
{

    /**
     *
     * @ignore
     */
    protected $_data = array();

    /**
     *
     * @ignore
     */
    private function session_clear($key = '')
    {
        $pkey = 'c' . md5(__FILE__ . get_class($this));
        if (empty($key))
        {
            unset($_SESSION[$pkey]);
        }
        else
        {
            unset($_SESSION[$pkey][$key]);
        }
    }

    /**
     *
     * @ignore
     */
    private function session_get($key, $dfltvalue = '')
    {
        $pkey = 'c' . md5(__FILE__ . get_class($this));
        if (! isset($_SESSION[$pkey]))
        {
            return $dfltvalue;
        }
        if (! isset($_SESSION[$pkey][$key]))
        {
            return $dfltvalue;
        }

        return $_SESSION[$pkey][$key];
    }

    /**
     *
     * @ignore
     */
    private function session_put($key, $value)
    {
        $pkey = 'c' . md5(__FILE__ . get_class($this));
        if (! isset($_SESSION[$pkey]))
        {
            $_SESSION[$pkey] = array();
        }

        $_SESSION[$pkey][$key] = $value;
    }

    // /////////////////////////

    /**
     * Save the state of this gateway in a way that can be used accross requests.
     *
     * @param bool $encrypt
     *            Optionally encrypt the state (recommended) for security purposes. This is because some gateways may store personal information or credit card numbers temporarily.
     * @param string $key
     *            an optional encryption key. If encrypt is enabled, and a key is not specified, one will be calculated.
     * @return string|null The encryption key (if the state was encrypted.)
     */
    public function SaveState($encrypt = false, $key = '')
    {
        $encrypt = (bool) $encrypt;
        $key = trim((string) $key);

        if ($encrypt)
        {
            if (! $key)
            {
                $key = str_shuffle(md5(session_id() . time()));
            }
            $raw = serialize($this->_data);
            $enc = \xt_encrypt::encrypt($key, $raw);
            $this->session_put('state', base64_encode($enc));
            debug_to_log(__METHOD__ . ' returned ' . $key);

            return $key;
        }
        else
        {
            $raw = serialize($this->_data);
            $this->session_put('state', base64_encode($raw));
        }
    }

    /**
     * Restore a gateway from a stored state, and remove it from temporary storage.
     *
     * @param string $key
     *            The encryption key used to encrypt the gateway state.
     *            return bool
     */
    public function RestoreState($key = '')
    {
        debug_to_log(__METHOD__ . ' key is ' . $key);
        $key = trim((string) $key);

        // we may not have the classes we need...
        ecomm::get_order_manager();

        $data = $this->session_get('state');
        if (! $data)
        {
            return FALSE;
        }
        $raw = base64_decode($data);
        if (! $raw)
        {
            return FALSE;
        }
        $tmp = @unserialize($raw); // hackish
        if (! $tmp && $key)
        {
            // assume its encrypted.
            $raw = \xt_encrypt::decrypt($key, $raw);
            if ($raw === FALSE)
            {
                return FALSE;
            }
        }
        $this->_data = @unserialize($raw);
        if (! $this->_data)
        {
            return FALSE;
        }
        $this->session_clear();
        debug_to_log(__METHOD__ . ' success');

        return TRUE;
    }

    /**
     * Reset all data associated with this gateway.
     */
    public function Reset()
    {
        $this->_data = array();
        $this->session_clear();
    }

    // // lower level stuff ////

    /**
     * Set the transaction status.
     *
     * @param string $in
     *            One of the valid statuses for this object.
     */
    public function SetTransactionStatus($in)
    {
        switch ($in)
        {
            case self::PAYMENT_STATUS_APPROVED:
            case self::PAYMENT_STATUS_DECLINED:
            case self::PAYMENT_STATUS_ERROR:
            case self::PAYMENT_STATUS_CANCELLED:
            case self::PAYMENT_STATUS_OTHER:
            case self::PAYMENT_STATUS_PENDING:
            case self::PAYMENT_STATUS_AUTHORIZED:
            case self::PAYMENT_STATUS_NONE:
                $this->_data['status'] = $in;
                break;

            default:
                throw new \LogicException($in . ' is not a valid transaction status');
        }
    }

    /**
     * Return the current payment status
     *
     * @return string
     */
    public function GetTransactionStatus()
    {
        if (isset($this->_data['status']))
        {
            return $this->_data['status'];
        }

        return self::PAYMENT_STATUS_NONE;
    }

    // // higher level status stuff

    // @todo: document me.
    public function AllowsInstantCheckout()
    {
        return false;
    }

    /**
     * Get a message (error or success) if it is set.
     */
    public function GetMessage()
    {
        if (isset($this->_data['message']) && $this->_data['emssage'])
        {
            return $this->_data['message'];
        }
        if (isset($this->_data['error_message']) && $this->_data['error_message'])
        {
            return $this->_data['error_message'];
        }
    }

    /**
     * Set a success message for the current transaction.
     * Will unset the error message, but will not adjust the transaction status.
     *
     * @param string $message
     */
    public function SetSuccessMessage($message)
    {
        $message = trim((string) $message);
        unset($this->_data['error_message']);
        $this->_data['message'] = $message;
    }

    /**
     * Set an error message for the current transaction.
     * Will unset the success message, but will not adjust the transaction status.
     *
     * @param string $message
     */
    public function SetErrorMessage($message)
    {
        $message = trim((string) $message);
        unset($this->_data['message']);
        $this->_data['error_message'] = $message;
    }

    /**
     * Get the success message (if any) associated with this transaction.
     *
     * @return string
     */
    public function GetSuccessMessage()
    {
        if (isset($this->_data['message']))
        {
            return $this->_data['message'];
        }
    }

    /**
     * Get the error message (if any) associated with this transaction.
     *
     * @return string
     */
    public function GetErrorMessage()
    {
        if (isset($this->_data['error_message']))
        {
            return $this->_data['error_message'];
        }
    }

    /**
     * Set the transaction status to cancelled.
     *
     * @param string $message
     *            an optional error message.
     */
    public function SetCancelled($message = null)
    {
        $this->SetTransactionStatus(self::PAYMENT_STATUS_CANCELLED);
        $this->SetErrorMessage($message);
    }

    /**
     * Set the transaction status to declined.
     *
     * @apram string $message an optional error message.
     */
    public function SetDeclined($message = null)
    {
        $this->SetTransactionStatus(self::PAYMENT_STATUS_DECLINED);
        $this->SetErrormessage($message);
    }

    /**
     * Set the transaction status to error.
     *
     * @apram string $message an optional error message.
     */
    public function SetTransactionError($message)
    {
        $message = trim((string) $message);
        $this->SetTransactionStatus(self::PAYMENT_STATUS_ERROR);
        $this->_data['error_message'] = $message;
    }

    // // generic stuff ///

    /**
     * Associate key/value data with this transaction.
     * note: may be used later by the gateway, but not usually used by the order processing module.
     *
     * @param string $key
     * @param mixed $value
     */
    public function SetTransactionData($key, $value)
    {
        $key = trim((string) $key);
        if (! isset($this->_data['transdata']))
        {
            $this->_data['transdata'] = array();
        }
        $this->_data['transdata'][$key] = $value;
    }

    /**
     * Get the keys of all key/value data stored with the transaction.
     *
     * @return string[]
     */
    public function GetTransactionKeys()
    {
        if (! isset($this->_data['transdata']))
        {
            return;
        }

        return array_keys($this->_data['transdata']);
    }

    /**
     * Get key/value data associated with this transaction.
     *
     * @param string $key
     * @param mixed $dflt
     *            Default data to return if the key does not exist.
     */
    public function GetTransactionData($key, $dflt = null)
    {
        $key = trim((string) $key);
        if (! isset($this->_data['transdata']))
        {
            return $dflt;
        }
        if (! isset($this->_data['transdata'][$key]))
        {
            return $dflt;
        }

        return $this->_data['transdata'][$key];
    }

    // // higher level stuff ////

    /**
     * Set the type of transaction.
     *
     * @param string $type
     *            one fo the accepted transaction types.
     */
    public function SetTransactionType($type)
    {
        $type = trim((string) $type);
        switch ($type)
        {
            case self::TRANS_CAPTURE:
            case self::TRANS_VOID:
            case self::TRANS_CREDIT:
                $this->_data['transaction_type'] = $type;
                break;
            default:
                throw new \CmsInvalidDataException($type . ' is an invalid transaction type for ' . __METHOD__);
        }
    }

    /**
     * Get the type of transaction.
     *
     * @return string|null
     */
    public function GetTransactionType()
    {
        if (isset($this->_data['transaction_type']))
        {
            return $this->_data['transaction_type'];
        }
    }

    /**
     * Set the transaction id
     *
     * @param string $str
     *            The transaction id.
     */
    public function SetTransactionId($str)
    {
        $str = trim((string) $str);
        $this->_data['transaction_id'] = $str;
    }

    /**
     * Get the transaction id
     *
     * @return string
     */
    public function GetTransactionId()
    {
        if (isset($this->_data['transaction_id']))
        {
            return $this->_data['transaction_id'];
        }
    }

    /**
     * Add an item to the transaction.
     * This is typically used by the order processing module to add items to the transaction for use in submitting the order to the gateway.
     *
     * @param string $name
     *            The item n ame
     * @param int $number
     *            the item number
     * @param int $quantity
     *            The item quantity
     * @param float $weight
     *            The item weight
     * @param float $amount
     *            The item amount (currency)
     * @param float $tax
     *            The tax for this particular item, if any.
     */
    public function AddItem($name, $number, $quantity, $weight, $amount, $tax = '')
    {
        $name = strip_tags($name);
        $name = preg_replace('/\&.*\;\"\'\°/', '', $name);
        $name = trim($name);
        if (! isset($this->_data['items']))
        {
            $this->_data['items'] = array();
        }

        $num = 1;
        $tmp = $name;
        while (isset($this->_data['items'][$tmp]) && ($num < 100))
        {
            $num = (int) $num + 1;
            $tmp = $name . $num;
        }
        $this->_data['items'][$tmp] = array(
            'name' => $name,
            'number' => $number,
            'quantity' => $quantity,
            'weight' => $weight,
            'amount' => $amount
        );
        if (! empty($tax))
        {
            $this->_data['items'][$tmp]['tax'] = $tax;
        }
    }

    /**
     * Return an array of items associated with this transaction.
     *
     * @return array
     */
    public function GetItems()
    {
        if (isset($this->_data['items']))
        {
            return $this->_data['items'];
        }
    }

    /**
     * Set credit card info that must be used for this transaction.
     * note: some gateways do not require credit card info.
     *
     * @deprecated (collecting credit card info should be done internally by the module).
     * @param string $ccnumber
     *            The credit card number
     * @param int $ccexp
     *            The unix timestamp of the credit card expiry
     * @param string $ccvcode
     *            The credit card verification code.
     */
    public function SetCreditCardInfo($ccnumber, $ccexp, $ccvcode)
    {
        $this->_data['raw_ccinfo'] = array(
            $ccnumber,
            $ccexp,
            $ccvcode
        );

        $_ccinfo = array();
        $_ccinfo['x_card_num'] = preg_replace('([^0-9])', '', $ccnumber);
        $_ccinfo['x_exp_date'] = date('m', $ccexp) . '/' . date('Y', $ccexp);
        if (! empty($ccvcode))
        {
            $_ccinfo['x_card_code'] = preg_replace('([^0-9])', '', $ccvcode);
        }
        $this->_data['ccinfo'] = $_ccinfo;
    }

    /**
     * Get the raw credit card information entered by the user.
     *
     * @return array
     */
    public function GetRawCreditCardInfo()
    {
        if (isset($this->_data['raw_ccinfo']))
        {
            return $this->_data['raw_ccinfo'];
        }
    }

    /**
     * Get a version of the credit card information that is sutable for frontend display.
     *
     * @return array An associative array.
     */
    public function GetProcessedCreditCardInfo()
    {
        if (isset($this->_data['ccinfo']))
        {
            return $this->_data['ccinfo'];
        }
    }

    /**
     * Set the currency for this transaction.
     *
     * @deprecated - The gateway module should use the currency code specified in the ecommerce suite.
     * @param string $code
     */
    public function SetCurrencyCode($code = 'USD')
    {
        $code = trim((string) $code);
        $this->_data['currencycode'] = strtoupper($code);
    }

    /**
     * Get the currency code for this transaction.
     *
     * @deprecated - Everything should use the currency code set in EcommerceExt
     * @return string
     */
    public function GetCurrencyCode()
    {
        if (isset($this->_data['currencycode']))
        {
            return $this->_data['currencycode'];
        }

        return \EcommerceExt\ecomm::get_currency_code();
    }

    /**
     * Set the weight units for this transaction.
     *
     * @deprecated - Everything should use the currency code set in EcommerceExt
     * @param string $units;
     */
    public function SetWeightUnits($units = 'lbs')
    {
        $units = trim((string) $units);
        $this->_data['weightunits'] = $units;
    }

    /**
     * get the weight units for this transaction.
     *
     * @deprecated - Everything should use the currency code set in EcommerceExt
     * @return tring;
     */
    public function GetWeightUnits()
    {
        if (isset($this->_data['weightunits']))
        {
            return $this->_data['weightunits'];
        }

        return ecomm::get_weight_units();
    }

    /**
     * For synchronous gateways (typically those that redirect out of the site and then back in)
     * This sets the URL that the system should redirect to after returning from the gateway website.
     * This is typically set by the order processing module.
     *
     * @param string $url
     */
    public function SetDestination($url)
    {
        $url = trim((string) $url);
        $this->_data['destination'] = $url;
    }

    /**
     * Get the destination URL for after processing is complete.
     *
     * @return string
     */
    public function GetDestination()
    {
        if (isset($this->_data['destination']))
        {
            return $this->_data['destination'];
        }
    }

    /**
     * Set a description for the entire order.
     *
     * @deprecated (should prolly use the order object itself)
     * @param string $txt
     */
    public function SetOrderDescription($txt)
    {
        $txt = trim((string) $txt);
        $this->_data['description'] = substr($txt, 0, 255);
    }

    /**
     * Get a description for the entire order.
     *
     * @deprecated (should prolly use the order object itself)
     * @return string
     */
    public function GetOrderDescription()
    {
        if (isset($this->_data['description']))
        {
            return $this->_data['description'];
        }
    }

    /**
     * Set the order object into the gateway
     *
     * @todo use base object instead of an order object to remove cross dependency
     */
    public function SetOrderObject(\orders_order $order)
    {
        $this->_data['order_obj'] = $order;
    }

    /**
     * Get the order object.
     *
     * @todo use base object instead of an order object to remove cross dependency
     * @return \orders_order
     */
    public function get_order_object()
    {
        $out = null;
        if (isset($this->_data['order_obj']))
        {
            $out = $this->_data['order_obj'];
        }

        return $out;
    }

    /**
     * Set the order id for this transaction.
     * This method may be used by asynhronous events.
     *
     * @param int $orderid
     */
    public function SetOrderID($orderid)
    {
        $orderid = (int) $orderid;
        $this->_data['orderid'] = $orderid;
    }

    /**
     * Get the order id for this transaction.
     * This method may be used by asynhronous events.
     *
     * @return int
     */
    public function GetOrderId()
    {
        if (isset($this->_data['orderid']))
        {
            return $this->_data['orderid'];
        }
        $obj = $this->get_order_object();
        if (! $obj)
        {
            return;
        }

        return $obj->get_id();
    }

    /**
     * Set the invoice name for this transaction.
     * This method may be used by asynhronous events.
     *
     * @param string $invoice
     */
    public function SetInvoice($invoice)
    {
        $len = min(strlen($invoice), 20) * - 1;
        $this->_data['invoice'] = substr($invoice, $len);
    }

    /**
     * Get the invoice name for this transaction.
     * This method may be used by asynhronous events.
     *
     * @return string
     */
    public function GetInvoice()
    {
        if (isset($this->_data['invoice']))
        {
            return $this->_data['invoice'];
        }
        $obj = $this->get_order_object();
        if (! $obj)
        {
            return;
        }

        return $obj->get_invoice();
    }

    /**
     * Set the amount of the total transaction amount for this transaction.
     * This method may be used by asynhronous events.
     * For submitting an order, the gateway should calculate the transaction amount from the order.
     *
     * @param float $val
     */
    public function SetTransactionAmount($val)
    {
        $val = (float) $val;
        $this->_data['transaction_amt'] = $val;
    }

    /**
     * Get the amount of this transaction.
     * If a transaction amount has not been specified, and an order object is associated with this gateway
     * then use the order total.
     *
     * @return float
     */
    public function GetTransactionAmount()
    {
        if (isset($this->_data['transaction_amt']))
        {
            return $this->_data['transaction_amt'];
        }
        $obj = $this->get_order_object();
        if (is_object($obj))
        {
            return $obj->get_total();
        }
    }

    /**
     * Set the payment id for this transaction.
     * This is usually used when finishing a transaction with data provided by the gateway.
     *
     * @param string $str
     */
    public function SetPaymentId($str)
    {
        $str = trim((string) $str);
        $this->_data['__payment_id__'] = $str;
    }

    /**
     * Set the payment id for this transaction.
     * This is usually used when finishing a transaction with data provided by the gateway.
     *
     * @return string;
     */
    public function GetPaymentId()
    {
        if (isset($this->_data['__payment_id__']))
        {
            return $this->_data['__payment_id__'];
        }
    }

    /**
     * Set a billing address for this transaction.
     * This is typically used when creating a transaction to send to the gateway.
     *
     * @param \xt_address $billing_addy
     */
    public function SetBillingAddress(\xt_address $billing_addy)
    {
        if (! $billing_addy instanceof \xt_address)
        {
            return FALSE;
        }
        $this->_data['billing_address'] = $billing_addy;
    }

    /**
     * Get a billing address for this transaction.
     * This is typically used when creating a transaction to send to the gateway.
     * If none has been explicitly specified, and an order object exists, then the billing address from the order will be used.
     *
     * @return \xt_address
     */
    public function GetBillingAddress()
    {
        if (isset($this->_data['billing_address']))
        {
            return $this->_data['billing_address'];
        }
        $obj = $this->get_order_object();
        if ($obj)
        {
            return $obj->get_billing();
        }
    }

    /**
     * Set a shipping address for this transaction.
     * This is typically used when creating a transaction to send to the gateway.
     *
     * @param \xt_address $billing_addy
     */
    public function SetShippingAddress(\xt_address $shipping_addy)
    {
        if (! $shipping_addy instanceof \xt_address)
        {
            return FALSE;
        }
        $this->_data['shipping_address'] = $shipping_addy;
    }

    /**
     * Get a billing address for this transaction.
     * This is typically used when creating a transaction to send to the gateway.
     * If none has been explicitly specified, and an order object exists, then the first shiping address from the order will be used.
     *
     * @return \xt_address
     */
    public function GetShippingAddress()
    {
        if (isset($this->_data['shipping_address']))
        {
            return $this->_data['shipping_address'];
        }
        $obj = $this->get_order_object();
        if (! $obj)
        {
            return;
        }
        $shipment = $obj->get_shipping(0);

        return $shipment->get_shipping_address();
    }

    /**
     * Synchronously finish the transaction.
     * This method is usually called by payment gateways after returning from the gateway website, or posting stuff to the gateway for a user.
     * This method will save the state of the gateway, and redirect to the destination URL (if any).
     *
     * @see SetDestination()
     * @return string The transaction status is returned if there is no destination set.
     */
    public function FinishTransaction()
    {
        // if( !isset($this->_data['destination']) ) return FALSE;
        // FIXME:
        $mod = \cms_utils::get_module(MOD_AUTHNETAIM);
        $key = $this->SaveState();
        if (isset($this->_data['destination']))
        {
            $url = $this->_data['destination'];
            $url = html_entity_decode($url);
            $url .= "&cntnt01datakey=$key";
            $url .= '&cntnt01gateway=' . $mod->GetName();
            redirect($url);
        }
        else
        {
            return $this->GetTransactionStatus();
        }
    }

    /**
     * This method is used to notify the order processing module of an asyncrhonous ecommerce event from the gateway.
     * Typically this is used when the gateway sends events asynchronously
     *
     * @param int $order_id
     * @param string $transaction_id
     * @param string $payment_status
     * @apram float $amount
     * @param string $message
     *            The error message.
     * @todo: test me.... (this is dangerous in this method)
     */
    function ProcessAsyncTransaction($order_id, $transaction_id, $payment_status, $amount, $message = '')
    {
        $transaction = new async_transaction($order_id, $amount);
        $transaction->set_message($message);
        $transaction->set_id($transaction_id);
        $transaction->set_gateway($this->GetName());
        $transaction->set_status($payment_status);
        $this->send_transaction_notification($transaction);
    }

    /**
     * Return an object indicating the capabilities and policies
     * of this gateway module.
     *
     * @see Cart\cartitem_policy
     * @abstract
     * @return object Object of type Cart\cartitem_policy.
     */
    public function get_cartitem_policy()
    {
        // by default we don't allow subscriptions.
        $policy = new Cart\cartitem_policy();
        $policy->set_mixed_subscriptions(false);
        $policy->set_max_subscriptions(0);

        return $policy;
    }

} // end of trait

#
# EOF
#
?>
