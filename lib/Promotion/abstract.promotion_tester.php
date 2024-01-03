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
 * An abstract class to pefrorm matches against promotions
 */
abstract class promotion_tester
{
    const TYPE_INSTANT = '_instant_';
    const TYPE_CHECKOUT = '_checkout_';

    private $_type = self::TYPE_CHECKOUT;
    private $_cart;
    private $_product;
    private $_feu_uid;
    private $_sku;
    private $_quantity;
    private $_price;
    private $_skip_cart;
    private $_ignore_discounted = 0;

    public function __construct()
    {
    }

    /**
     * Set the type of promotions to match against
     */
    final public function set_promo_type($type)
    {
        switch ($type)
        {
            case self::TYPE_INSTANT:
            case self::TYPE_CHECKOUT:
                $this->_type = $type;
                break;
            default:
                throw new \LogicException('Invalid type specified for ' . __CLASS__);
        }
    }

    /**
     * Get the promotion type
     */
    final public function get_promo_type()
    {
        return $this->_type;
    }

    /**
     * Set the product that we are testing against
     */
    public function set_product(ProductMgr\productinfo $product)
    {
        $this->_product = $product;
    }

    /**
     * Retrieve the product
     */
    final public function get_product()
    {
        return $this->_product;
    }

    /**
     * Set the cart items (for a cart match)
     *
     * @param
     *            array Array of \EcommerceExt\Cart\cartitem objects.
     */
    public function set_cart($items)
    {
        if (is_array($items) && count($items))
        {
            foreach ($items as $one)
            {
                if (! is_a($one, '\EcommerceExt\Cart\cartitem'))
                {
                    throw new \LogicException('attempt to set_cart in ' . __CLASS__ . ' with invalid data');
                }
            }
            $this->_cart = $items;
        }
    }

    /**
     * Get the cart
     */
    public function get_cart()
    {
        return $this->_cart;
    }

    /**
     * Set the FEU uid to test against
     */
    public function set_feu_uid($uid)
    {
        $this->_feu_uid = $uid;
    }

    /**
     * Get the current FEU uidt
     */
    public function get_feu_uid()
    {
        return $this->_feu_uid;
    }

    /**
     * Set the current sku.
     * This overrides the product sku (if any)
     */
    public function set_sku($sku)
    {
        $this->_sku = trim($sku);
    }

    /**
     * Retrieve the current sku
     */
    public function get_sku()
    {
        return $this->_sku;
    }

    /**
     * Set the flag that indicates to ignore already discounted items.
     */
    public function set_ignore_discounted($val = TRUE)
    {
        $this->_ignore_discounted = cms_to_bool($val);
    }

    /**
     * Retrieve the ignore discounted item flag.
     */
    public function get_ignore_discounted()
    {
        return $this->_ignore_discounted;
    }

    /**
     * Set the quantity of the current item.
     */
    public function set_quantity($quantity)
    {
        $this->_quantity = (int) $quantity;
    }

    /**
     * Retrieve the current sku
     */
    public function get_quantity()
    {
        return (int) $this->_quantity;
    }

    /**
     * Set the product price.
     * This overrides the product price (if any)
     */
    public function set_price($price)
    {
        $price = (float) $price;
        if ($price >= 0)
        {
            $this->_price = $price;
        }
    }

    /**
     * Get the price
     */
    public function get_price()
    {
        if (! is_null($this->_price))
        {
            return $this->_price;
        }
        if (! is_null($this->_product))
        {
            return $this->_product->get_price();
        }
    }

    /**
     * Set a flag indicating wether cart contents should be skipped in tests
     */
    public function set_skip_cart($skip_cart = TRUE)
    {
        $this->_skip_cart = (bool) $skip_cart;
    }

    /**
     * Get the skip_cart flag
     */
    public function get_skip_cart()
    {
        return $this->_skip_cart;
    }

    /**
     * tests if product matches any promotions that match set criteria.
     * (product must be set).
     *
     * @return promotion_match
     */
    abstract public function find_match();

    /**
     * test if the product (or sku) matches the offer part
     * of a promotion, and if the cart contents match the conditions
     * of the offer.
     *
     * @return promotion_match
     */
    abstract public function find_offer_match();

    /**
     * Find the first promotion that matches the items in the cart
     *
     * @return promotion_match
     */
    abstract public function find_cart_match();

    /**
     * Find all promotions that matches the items in the cart
     *
     * @return promotion_match
     */
    abstract public function find_all_cart_matches();

} // end of class

#
# EOF
#
?>
