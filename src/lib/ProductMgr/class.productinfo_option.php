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
 * A class to describe an option for a product.
 */
class productinfo_option
{

    /**
     *
     * @ignore
     */
    private static $_keys = array(
        'id',
        'sku',
        'text',
        'adjustment',
        'qoh',
        'discount'
    );

    /**
     *
     * @ignore
     */
    private $_data;

    /**
     *
     * @ignore
     */
    public function __construct()
    {
        $this->_data = array();
        foreach (self::$_keys as $key)
        {
            $this->_data[$key] = '';
        }
    }

    /**
     *
     * @ignore
     */
    public function __get($key)
    {
        if (! in_array($key, self::$_keys))
        {
            throw new \CmsException('Cannot get key ' . $key . ' from ' . __CLASS__);
        }

        return $this->_data[$key];
    }

    /**
     *
     * @ignore
     */
    public function __set($key, $value)
    {
        if (! in_array($key, self::$_keys))
        {
            throw new \CmsException('Cannot set key ' . $key . ' into ' . __CLASS__);
        }
        $this->_data[$key] = $value;
    }

    /**
     * Given a base price for an option, use the internal adjustment and return a proper value
     *
     * @return float
     */
    public function parse_adjustment($base_price)
    {
        $price = $base_price;
        $adjustment = trim($this->_data['adjustment']);
        if ($this->_data['adjustment'])
        {
            $k = $this->_data['adjustment'][0];
            switch ($k)
            {
                case '+':
                case '-':
                    $v = (float) substr($adjustment, 1);
                    $price = $base_price + $v;
                    break;

                case '=':
                    $v = (float) substr($adjustment, 1);
                    $price = $v;
                    break;

                case '*':
                    $v = (float) substr($adjustment, 1);
                    $price = $base_price * $v;
                    break;

                case '/':
                    $v = (float) substr($adjustment, 1);
                    $price = $base_price / $v;
                    break;

                default:
                    $v = (float) $adjustment;
                    if ($v > 0.0)
                    {
                        $price = $base_price + $v;
                    }
                    break;
            }
        }

        return $price;
    }

} // end of class

#
# EOF
#
?>
