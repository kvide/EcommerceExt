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

/**
 *
 * @package EcommerceExt
 * @author calguy1000 <calguy1000@cmsmadesimple.org>
 * @copyright Copyright 2014 - Robert Campbell
 */

/**
 * A class describing an asynchonous transaction
 *
 * @final
 * @package EcommerceExt
 * @category Ecommerce
 */
class async_transaction
{
    const TYPE_PAYMENT = 'payment';
    const TYPE_ADJUSTMENT = 'adjustment';
    const TYPE_HOLDBACK = 'holdback';

    /**
     *
     * @ignore
     */
    private $_type = self::TYPE_PAYMENT;

    /**
     *
     * @ignore
     */
    private $_status;

    /**
     *
     * @ignore
     */
    private $_id;

    /**
     *
     * @ignore
     */
    private $_amt;

    /**
     *
     * @ignore
     */
    private $_msg;

    /**
     *
     * @ignore
     */
    private $_payment_id;

    /**
     *
     * @ignore
     */
    private $_order_id;

    /**
     *
     * @ignore
     */
    private $_invoice;

    /**
     *
     * @ignore
     */
    private $_user_id;

    /**
     *
     * @ignore
     */
    private $_other_data;

    /**
     *
     * @ignore
     */
    private $_gateway;

    /**
     *
     * @ignore
     */
    private $_billing_address;

    /**
     *
     * @ignore
     */
    private $_shipping_address;

    /**
     * Constructor
     *
     * @param int $order_id
     *            The order id
     * @param float $amt
     *            The transaction amount
     * @param string $gateway
     *            The name of the gateway module.
     */
    public function __construct($order_id, $amt, $gateway = '')
    {
        $this->_order_id = $order_id;
        $this->_amt = $amt;
        $this->_gateway = $gateway;
        $this->_type = self::TYPE_PAYMENT;
    }

    /**
     * Set the type of this transaction.
     *
     * @param string $type
     *            One of the accepted transaction types.
     */
    public function set_type($type)
    {
        switch ($type)
        {
            case self::TYPE_PAYMENT:
            case self::TYPE_ADJUSTMENT:
            case self::TYPE_HOLDBACK:
                $this->_type = $type;
                break;
            default:
                throw new \LogicException('Invalid transaction type ' . $type);
        }
    }

    /**
     * Get the type of this transaction.
     *
     * @return string
     */
    public function get_type()
    {
        return $this->_type;
    }

    /**
     * Set the status of this transaction.
     *
     * @param string $status
     *            One of the specified transaction statuses
     * @see \EcommerceExt\Payment\payment_gateway
     */
    public function set_status($status)
    {
        switch ($status)
        {
            case payment_gateway::PAYMENT_STATUS_APPROVED:
            case payment_gateway::PAYMENT_STATUS_DECLINED:
            case payment_gateway::PAYMENT_STATUS_ERROR:
            case payment_gateway::PAYMENT_STATUS_CANCELLED:
            case payment_gateway::PAYMENT_STATUS_OTHER:
            case payment_gateway::PAYMENT_STATUS_NONE:
            case payment_gateway::PAYMENT_STATUS_PENDING:
                $this->_status = $status;
                break;
            default:
                throw new \LogicException('Invalid transaction status ' . $status);
        }
    }

    /**
     * Get the status of this transaction.
     *
     * @return string
     */
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Set the id of this transaction.
     * Usually this is a unique string provided by the gateway.
     *
     * @param string $id
     */
    public function set_id($id)
    {
        $this->_id = $id;
    }

    /**
     * Get the id of this transaction.
     * Usually this is a unique string provided by the gateway.
     *
     * @return string
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the amount of this transaction.
     *
     * @param float $amt
     */
    public function set_amount($amt)
    {
        $this->_amt = $amt;
    }

    /**
     * Get the amount of this transaction.
     *
     * @return float;
     */
    public function get_amount()
    {
        return $this->_amt;
    }

    /**
     * Associate an error or status message with this transaction.
     *
     * @param string $msg
     */
    public function set_message($msg)
    {
        $this->_msg = trim($msg);
    }

    /**
     * Retrieve any message associated with this transaction.
     *
     * @return string
     */
    public function get_message()
    {
        return $this->_msg;
    }

    /**
     * Associate a payment id (which is used internally) with this transaction.
     *
     * @see orders_payment (FIXME)
     * @param int $n
     */
    public function set_payment_id($n)
    {
        $this->_payment_id = (int) $n;
    }

    /**
     * Get the payment id (if any) associated with this transaction.
     *
     * @return int
     */
    public function get_payment_id()
    {
        return $this->_payment_id;
    }

    /**
     * Associate this transaction with an order.
     * Note, transactions are usually associated with an order after information is sent from the remote payment gateway.
     *
     * @param int $n
     *            The order id.
     */
    public function set_order_id($n)
    {
        $this->_order_id = (int) $n;
    }

    /**
     * Get the id of the order that this transaction is associated with.
     * Note, transactions are usually associated with an order after information is sent from the remote payment gateway.
     *
     * @return int
     */
    public function get_order_id()
    {
        return $this->_order_id;
    }

    /**
     * Associate this transaction with a specific invoice.
     * The invoice string may be used to correlate the transaction with an order, or it may just be for convenience.
     *
     * @param string $invoice
     *            The unique invoice id.
     */
    public function set_invoice($invoice)
    {
        $this->_invoice = trim((string) $invoice);
    }

    /**
     * Get any associated invoice
     *
     * @return string
     */
    public function get_invoice()
    {
        return $this->_invoice;
    }

    /**
     * Associate a user id with this transaction.
     * This may be useful for subscription based registrations.
     *
     * @param int $n
     *            The user id
     */
    public function set_user_id($n)
    {
        $this->_user_id = (int) $n;
    }

    /**
     * Get any user id associated with this transaction.
     *
     * @return int
     */
    public function get_user_id()
    {
        return $this->_user_id;
    }

    /**
     * Asscocate extra key/value data with this transaction.
     *
     * @param string $k
     *            The key
     * @param mixed $v
     *            The value
     */
    public function set_other_val($k, $v)
    {
        $k = trim($k);
        if (! is_array($this->_other_data))
        {
            $this->_other_data = array();
        }
        $this->_other_data[$k] = $v;
    }

    /**
     * Retrieve data associated with this transaction via a key.
     *
     * @param string $k
     * @param mixed $dflt
     *            The default data to return if the key cannot be found.
     * @return mixed
     */
    public function get_other_val($k, $dflt = null)
    {
        if (! is_array($this->_other_data))
        {
            return $dflt;
        }
        if (! isset($this->_other_data[$k]))
        {
            return $dflt;
        }

        return $this->_other_data[$k];
    }

    /**
     * Return an array of keys of extra data associated with this transaction, if any.
     *
     * @return string[]
     */
    public function get_other_keys()
    {
        if (! is_array($this->_other_data))
        {
            return null;
        }

        return array_keys($this->_other_data);
    }

    /**
     * Associate a billing address with this transaction
     *
     * @deprecated
     * @param \xt_address $billing
     */
    public function set_billing_address(\xt_address &$billing)
    {
        $this->_billing_address = $billing;
    }

    /**
     * Get any billing address asssociated with this transaction.
     *
     * @deprecated
     * @return \xt_address
     */
    public function get_billing_address()
    {
        return $this->_billing_address;
    }

    /**
     * Associate a shipping address with this transaction
     *
     * @deprecated
     * @param \xt_address $shipping
     */
    public function set_shipping_address(\xt_address &$shipping)
    {
        $this->_shipping_address = $shipping;
    }

    /**
     * Get any shipping address asssociated with this transaction.
     *
     * @deprecated
     * @return \xt_address
     */
    public function get_shipping_address()
    {
        return $this->_shipping_address;
    }

    /**
     * Set the gateway associated with this transaction.
     *
     * @param string $n
     *            The gateway name.
     */
    public function set_gateway($n)
    {
        $this->_gateway = trim($n);
    }

    /**
     * Get the name of the gateway that created this transaction.
     *
     * @return string
     */
    public function get_gateway()
    {
        return $this->_gateway;
    }

    /**
     * Test if this transaction is valid.
     *
     * @return bool
     */
    public function is_valid()
    {
        if ($this->_gateway && $this->_type && $this->_status && $this->_id && $this->_amt && $this->_order_id)
        {
            return TRUE;
        }

        return FALSE;
    }

} // end of class

#
# EOF
#
?>
