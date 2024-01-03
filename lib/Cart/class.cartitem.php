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

namespace EcommerceExt\Cart;

use EcommerceExt\ProductMgr;

class cartitem
{
    const TYPE_PRODUCT = 1;
    const TYPE_SHIPPING = 2;
    const TYPE_SERVICE = 3;
    const TYPE_DISCOUNT = 4;
    const TYPE_OTHER = 5;
    const TYPE_TAXES = 6;

    // was erroneously 3 in 1.8
    private $_source = null;
    private $_product_id = null;
    private $_sku = null;
    private $_quantity = null;
    private $_base_price = null;
    // the base price of the object, not including options
    private $_attributes = array();
    private $_type = self::TYPE_PRODUCT;
    private $_digital = false;
    private $_estimated = false;
    private $_pending = false;
    private $_unit_weight = null;
    private $_unit_dimensions = null;
    private $_unit_price = null;
    private $_summary = null;
    private $_item_total = null;
    // only set if the unit total has been overriden.... accounts for quantity as well.
    private $_subscription = null;
    private $_allow_duplicate = TRUE;
    private $_allow_quantity_adjust = true;
    private $_allow_remove = true;
    private $_unit_discount = 0;
    private $_parent = - 1;
    private $_promo = null;

    public function __construct($sku, $product_id, $quantity, $source = 'EcProductMgr')
    {
        $this->_source = $source;
        $this->_sku = $sku;
        $this->_product_id = $product_id;
        $this->_quantity = $quantity;
    }

    public function set_estimated($flag)
    {
        $this->_estimated = (bool) $flag;
    }

    public function is_estimated()
    {
        return $this->_estimated;
    }

    public function set_digital($flag)
    {
        $this->_digital = (bool) $flag;
    }

    public function is_digital()
    {
        return $this->_digital;
    }

    public function set_source($num)
    {
        $this->_source = $num;
    }

    public function get_source()
    {
        return $this->_source;
    }

    public function set_allow_quantity_adjust($flag = true)
    {
        $this->_allow_quantity_adjust = $flag;
    }

    public function allow_quantity_adjust()
    {
        return $this->_allow_quantity_adjust;
    }

    public function set_allow_duplicate($flag = true)
    {
        $this->_allow_duplicate = $flag;
    }

    public function allow_duplicate()
    {
        return $this->_allow_duplicate;
    }

    public function set_allow_remove($flag = true)
    {
        $this->_allow_remove = $flag;
    }

    public function allow_remove()
    {
        return $this->_allow_remove;
    }

    public function set_product_id($num)
    {
        $this->_product_id = $num;
    }

    public function get_product_id()
    {
        return $this->_product_id;
    }

    public function set_sku($num)
    {
        $this->_sku = $num;
    }

    public function get_sku()
    {
        return $this->_sku;
    }

    public function set_pending($num = true)
    {
        $this->_pending = $num;
    }

    public function get_pending()
    {
        return $this->_pending;
    }

    public function set_quantity($num)
    {
        $this->_quantity = $num;
    }

    public function get_quantity()
    {
        return $this->_quantity;
    }

    public function set_base_price($num)
    {
        $this->_base_price = $num;
    }

    public function get_base_price()
    {
        return $this->_base_price;
    }

    public function set_unit_discount($num)
    {
        $this->_unit_discount = $num;
    }

    public function get_unit_discount()
    {
        if ($this->_unit_discount)
        {
            return $this->_unit_discount;
        }

        return 0;
    }

    public function set_unit_price($num)
    {
        $this->_unit_price = $num;
    }

    public function get_unit_price()
    {
        if (is_null($this->_unit_price))
        {
            $price = $this->get_base_price();
            foreach ($this->get_options() as $obj)
            {
                $price += $obj->adjustment;
            }
            return $price;
        }

        return $this->_unit_price;
    }

    public function get_net_unit_price()
    {
        return $this->get_unit_price() + $this->get_unit_discount();
    }

    public function set_options($attribs)
    {
        if (is_array($attribs))
        {
            $this->_attributes = $attribs;
        }
    }

    public function get_options()
    {
        return $this->_attributes;
    }

    public function set_type($num)
    {
        $this->_type = $num;
    }

    public function get_type()
    {
        return $this->_type;
    }

    public function set_unit_weight($num)
    {
        $this->_unit_weight = (float) $num;
    }

    public function get_unit_weight()
    {
        return $this->_unit_weight;
    }

    public function set_dimensions($len, $width, $height)
    {
        // todo: should be dimensions object.
        $this->_unit_dimensions = [(float) $len, (float) $width, (float) $height];
    }

    public function get_dimensions()
    {
        return $this->_unit_dimensions;
    }

    public function set_summary($num)
    {
        $this->_summary = $num;
    }

    public function get_summary()
    {
        return $this->_summary;
    }

    public function set_parent($num)
    {
        $this->_parent = $num;
    }

    public function get_parent()
    {
        return $this->_parent;
    }

    public function set_promo($num)
    {
        $this->_promo = $num;
    }

    public function get_promo()
    {
        return $this->_promo;
    }

    public function set_item_total($num)
    {
        $this->_item_total = $num;
    }

    public function get_item_total()
    {
        if (! is_null($this->_item_total))
        {
            // item total has been overridden.
            return $this->_item_total;
        }

        return $this->get_net_unit_price() * $this->get_quantity();
    }

    public function set_subscription(ProductMgr\productinfo_subscription $subscr)
    {
        $this->_subscription = $subscr;
    }

    public function get_subscription()
    {
        return $this->_subscription;
    }

    public function to_array()
    {
        $tmp = array();
        $tmp['product_id'] = $this->get_product_id();
        $tmp['sku'] = $this->get_sku();
        $tmp['quantity'] = $this->get_quantity();
        $tmp['base_price'] = $this->get_base_price();
        $tmp['type'] = $this->get_type();
        $tmp['pending'] = $this->get_pending();
        $tmp['unit_weight'] = $this->get_unit_weight();
        $tmp['unit_dimension'] = $this->get_dimensions();
        $tmp['unit_price'] = $this->get_unit_price();
        $tmp['summary'] = $this->get_summary();
        $tmp['parent'] = $this->get_parent();
        $tmp['promo'] = $this->get_promo();
        $tmp['unit_discount'] = $this->get_unit_discount();
        $tmp['item_total'] = $this->get_item_total();

        if ($this->_subscription)
        {
            $tmp['subscription'] = $this->_subscription->to_array();
        }

        return $tmp;
    }

    public function __tostring()
    {
        return implode('//', array(
            $this->get_source(),
            $this->get_sku(),
            $this->get_summary(),
            $this->get_unit_price()
        ));
    }

    public function compare(cartitem $other_item)
    {
        $tmp1 = $this->to_array();
        unset($tmp1['unit_discount'], $tmp1['quantity'], $tmp1['item_total']);
        $tmp2 = $other_item->to_array();
        unset($tmp2['unit_discount'], $tmp2['quantity'], $tmp2['item_total']);
        if (! is_array($tmp1) && ! is_array($tmp2))
        {
            return FALSE;
        }
        $tmp = @array_diff($tmp1, $tmp2);
        if (! is_array($tmp) || count($tmp) == 0)
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
