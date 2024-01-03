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

namespace EcommerceExt\Promotion;

use EcommerceExt\ProductMgr;

/**
 * This class describes the 'match' (if any) found after testing a series of items against
 * some promotions.
 */
class promotion_match
{
    const OFFER_DISCOUNT = '__discount__';
    const OFFER_PERCENT = '__percent__';
    const OFFER_PRODUCTID = '__productid__';
    const OFFER_PRODUCTSKU = '__sku__';

    private $_source;
    private $_itemid;
    private $_sku;
    private $_name;
    private $_type;
    private $_val;
    private $_promo;
    private $_cart_idx = - 1;
    private $_discount_amt;
    private $_cumulative = 0;

    /**
     * Constructor
     */
    public function __construct($type = self::OFFER_DISCOUNT, $val = 0.00)
    {
        $this->set_type($type);
        $this->set_val($val);
    }

    /**
     * Set the type of match
     */
    public function set_type($type)
    {
        switch ($type)
        {
            case self::OFFER_DISCOUNT:
            case self::OFFER_PERCENT:
            case self::OFFER_PRODUCTID:
            case self::OFFER_PRODUCTSKU:
                $this->_type = $type;
                break;

            default:
                throw new \CmsInvalidDataException('Invalid type: ' . $type . ' for ' . __CLASS__);
        }
    }

    /**
     * Get the type of match
     */
    public function get_type()
    {
        return $this->_type;
    }

    /**
     * Get the name of the offer
     */
    public function set_name($name)
    {
        $this->_name = $name;
    }

    /**
     * Retrieve the name of the match
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Get the value of the match
     * In the case of a matched product this may be a product id or sku.
     * In the case of a percentage match this will be the percentage (as a decimal)
     * In the case of a fixed discount this will be the value of the discount
     */
    public function set_val($val)
    {
        $this->_val = $val;
    }

    /**
     * Retrieve the value of the match
     */
    public function get_val()
    {
        return $this->_val;
    }

    /**
     * Set the value of discount (in currency units)
     */
    public function set_discount_amt($discount_amt)
    {
        $this->_discount_amt = $discount_amt;
    }

    /**
     * Get the value of the discount
     */
    public function get_discount_amt()
    {
        return $this->_discount_amt;
    }

    /**
     * Set the promotion identifer that indicates what promotion we are referring to
     */
    public function set_promo($promo)
    {
        $this->_promo = $promo;
    }

    /**
     * Get the promotion identifier
     */
    public function get_promo()
    {
        return $this->_promo;
    }

    /**
     * Set the supplier module.
     */
    public function set_supplier($supplier)
    {
        $this->_supplier = trim($supplier);
    }

    /**
     * Get the supplier module.
     */
    public function get_supplier()
    {
        return $this->_supplier;
    }

    /**
     * Set the supplier module unique id
     */
    public function set_itemid($itemid)
    {
        $this->_itemid = trim($itemid);
    }

    /**
     * Get the itemid module unique id
     */
    public function get_itemid()
    {
        return $this->_itemid;
    }

    /**
     * Set the unique sku of the match.
     */
    public function set_sku($sku)
    {
        $this->_sku = trim($sku);
    }

    /**
     * Get the sku module unique id
     */
    public function get_sku()
    {
        return $this->_sku;
    }

    /**
     * The index (in the cart) of the matched item...
     * or -1
     */
    public function set_cart_idx($cart_idx)
    {
        $this->_cart_idx = (int) $cart_idx;
    }

    /**
     * Get the index (in the cart) of the matched item...
     */
    public function get_cart_idx()
    {
        return $this->_cart_idx;
    }

    /**
     * Wether this match can be applied to other matches.
     */
    public function set_cumulative($flag)
    {
        $this->_cumulative = (bool) $flag;
    }

    /**
     * Wether this match can be applied to other matches.
     */
    public function get_cumulative()
    {
        return $this->_cumulative;
    }

} // end of class

#
# EOF
#
?>
