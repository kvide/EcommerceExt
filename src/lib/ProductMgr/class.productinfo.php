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

namespace EcommerceExt\ProductMgr;

use EcommerceExt\ecomm;

/**
 * A simple class to abstract information about a product or service.
 */
class productinfo
{
    const TYPE_PRODUCT = 1;
    const TYPE_SERVICE = 3;

    /**
     *
     * @ignore
     */
    private $_source = null;

    /**
     *
     * @ignore
     */
    private $_product_id = null;

    /**
     *
     * @ignore
     */
    private $_weight = null;

    /**
     *
     * @ignore
     */
    private $_sku = null;

    /**
     *
     * @ignore
     */
    private $_price = null;

    /**
     *
     * @ignore
     */
    private $_name = null;

    /**
     *
     * @ignore
     */
    private $_taxable = null;

    /**
     *
     * @ignore
     */
    private $_type = self::TYPE_PRODUCT;

    /**
     *
     * @ignore
     */
    private $_subscription = null;

    /**
     *
     * @ignore
     * @var bool
     */
    private $_digital;

    /**
     *
     * @ignore
     */
    private $_options = array();

    /**
     *
     * @ignore
     */
    private $_dimensions;

    /**
     *
     * @ignore
     */
    private $_qoh;

    /**
     * Get the type of the of this item (product or service)
     *
     * @return string self::TYPE_PRODUCT or self::TYPE_SERVICE
     */
    public function get_type()
    {
        return $this->_type;
    }

    /**
     * Set the type of this item
     *
     * @param string $type
     *            self::TYPE_PRODUCT or self::TYPE_SERVICE
     */
    public function set_type($type)
    {
        switch ($type)
        {
            case self::TYPE_PRODUCT:
            case self::TYPE_SERVICE:
                $this->_type = $type;
                break;
        }
    }

    /**
     * Get the product source module.
     *
     * @return int
     */
    public function get_source()
    {
        return $this->_source;
    }

    /**
     * Set the product source module
     *
     * @param int $val
     */
    public function set_source($val)
    {
        $this->_source = trim($val);
    }

    /**
     * Get the product id
     *
     * @return int
     */
    public function get_product_id()
    {
        return $this->_product_id;
    }

    /**
     * Set the product id
     *
     * @param int $val
     */
    public function set_product_id($val)
    {
        $this->_product_id = (int) $val;
    }

    /**
     * Get the weight (units are determined by system preferences)
     *
     * @return float
     */
    public function get_weight()
    {
        return $this->_weight;
    }

    /**
     * Set the weight (units are determined by system preferences)
     *
     * @param float $val
     */
    public function set_weight($val)
    {
        $this->_weight = (float) $val;
    }

    /**
     * Get the quantity on hand for this item
     *
     * @return int
     */
    public function get_qoh()
    {
        return $this->_qoh;
    }

    /**
     * Set the quantity on hand for this item.
     * Note: it is okay for negative values to be here, which may be used to indicate backorder status.
     *
     * @param int $val
     */
    public function set_qoh($val)
    {
        $this->_qoh = (int) $val;
    }

    /**
     * Get the dimensions for this item if any.
     * Units are determined by system preferences.
     *
     * @return float[] Array of length, width, and height ... or null
     */
    public function get_dimensions()
    {
        return $this->_dimensions;
    }

    /**
     * Set the dimensions for this item.
     *
     * @param float $l
     *            length
     * @param float $w
     *            width
     * @param float $h
     *            height
     */
    public function set_dimensions($l, $w, $h)
    {
        // todo: should be object.
        $this->_dimensions = [(float) $l, (float) $w, (float) $h];
    }

    /**
     * Get the SKU (stock keeping unit) for this item.
     * Note: this is the primary item SKU, not including any options.
     *
     * @return string
     */
    public function get_sku()
    {
        return $this->_sku;
    }

    /**
     * Set the SKU (stock keeping unit) for this item.
     * Note: This is the primary item SKU, not including any options.
     *
     * @param string $val
     */
    public function set_sku($val)
    {
        $this->_sku = trim($val);
    }

    /**
     * Check if this product is a digital product or not.
     * Note: Results are invalid if type != PRODUCT.
     *
     * @return bool
     */
    public function get_digital()
    {
        return $this->_digital;
    }

    /**
     * Set the digital flag for this product.
     * Note: This is invalid for types != PRODUCT;
     *
     * @param string $val
     */
    public function set_digital($val)
    {
        $this->_digital = (bool) $val;
    }

    /**
     * Get the base price for this item
     *
     * @return float
     */
    public function get_price()
    {
        return $this->_price;
    }

    /**
     * Set the base price for this item
     *
     * @param float $val
     */
    public function set_price($val)
    {
        $this->_price = (float) $val;
    }

    /**
     * Get the name for this item
     *
     * @return string
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Set the name for this item
     *
     * @param string $val
     */
    public function set_name($val)
    {
        $this->_name = trim($val);
    }

    /**
     * Return wether or not this item is taxable.
     * Note: No tax modules will calculate taxes for non taxable items.
     *
     * @return bool
     */
    public function get_taxable()
    {
        return $this->_taxable;
    }

    /**
     * Set wether or not this item is taxable.
     * Note: No tax modules will calculate taxes for non taxable items.
     *
     * @param bool $val
     */
    public function set_taxable($val)
    {
        $this->_taxable = (int) $val;
    }

    /**
     * Get subscription info (if any) for this item.
     *
     * @return productinfo_subscription
     */
    public function get_subscription()
    {
        return $this->_subscription;
    }

    /**
     * Set subscription info for this item, indicating that it is a subscribable item.
     *
     * @param productinfo_subscription $obj
     */
    public function set_subscription(productinfo_subscription $obj)
    {
        $this->_subscription = $obj;
    }

    /**
     * Count the number of options for this item.
     *
     * @return int
     */
    public function count_options()
    {
        return count($this->_options);
    }

    /**
     * Add an option for this item
     *
     * @param productinfo_option $attr
     */
    public function add_option(productinfo_option $attr)
    {
        $this->_options[] = $attr;
    }

    /**
     * Get an option by specifying the index.
     *
     * @return productinfo_option|null
     */
    public function get_option_by_idx($idx)
    {
        if ($idx < 0 || $idx > count($this->_options) - 1)
        {
            return;
        }

        return $this->_options[$idx];
    }

    /**
     * Get an option by it's option id.
     *
     * @param int $id
     * @return productinfo_option|null
     */
    public function get_option_by_id($id)
    {
        foreach ($this->_options as $opt)
        {
            if ($opt->id == $id)
            {
                return $opt;
            }
        }
    }

    /**
     * Get an option by it's SKU.
     *
     * @param string $sku
     * @return productinfo_option|null
     */
    public function get_option_by_sku($sku)
    {
        $sku = (string) $sku;
        foreach ($this->_options as $opt)
        {
            if ($opt->sku == $sku)
            {
                return $opt;
            }
        }
    }

    /**
     * Get the number of items on hand for this item by specifying it's SKU.
     * If the sku entered matches the item sku then it's qoh is returned.
     * if the sku entered matches an option sku then that qoh is returned.
     *
     * @return int
     */
    public function get_qoh_by_sku($sku)
    {
        $opt = $this->get_option_by_sku((string) $sku);
        if ($opt)
        {
            return $opt->qoh;
        }
        if ($sku == $this->get_sku())
        {
            return $this->get_qoh();
        }
    }

    /**
     * Get the HTML code for an options dropdown for this item.
     * This may be used by cart modules.
     *
     * @return string
     */
    public function get_options_dropdown()
    {
        if (is_array($this->_options) && count($this->_options))
        {
            $out = array();
            $smarty = \CmsApp::get_instance()->GetSmarty();
            $smarty->assign('currency_symbol', ecomm::get_currency_symbol());
            $smarty->assign('currency_code', ecomm::get_currency_code());
            $smarty->assign('weight_units', ecomm::get_weight_units());

            $mod = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
            foreach ($this->_options as $one)
            {
                $smarty->assign('opt', $one);
                $smarty->assign('attrib_sku', $one->sku);
                $smarty->assign('attrib_text', $one->text);
                $smarty->assign('attrib_adjust', $one->adjustment);
                $out[$one->sku] = $mod->ProcessTemplateFromData($mod->GetPreference('attrib_item_description'));
            }
            return $out;
        }
    }

    /**
     * Get the name for a particular option (or for the item itself) by supplying a SKU.
     *
     * @paramm string $sku
     * @return string
     */
    public function get_text_by_sku($sku)
    {
        if ($this->get_sku() == $sku)
        {
            return $this->get_name();
        }
        for ($i = 0; $i < count($this->_options); $i ++)
        {
            if ($this->_options[$i]->sku == $sku)
            {
                return $this->_options[$i]->text;
            }
        }
    }

} // end of class

#
# EOF
#
?>
