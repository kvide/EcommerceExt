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

namespace EcommerceExt\Packaging;

class packing_box
{

    private $_name;
    private $_length_mm;
    private $_width_mm;
    private $_depth_mm;
    private $_total_weight_gg;
    private $_total_value;
    private $_items = [];

    public function __construct(array $params)
    {
        foreach ($params as $key => $val)
        {
            switch ($key)
            {
                case 'name':
                    $this->_name = trim($val);
                    break;
                case 'length':
                    $this->_length_mm = ceil((float) $val);
                    break;
                case 'width':
                    $this->_width_mm = ceil((float) $val);
                    break;
                case 'depth':
                    $this->_depth_mm = ceil((float) $val);
                    break;
                case 'total_weight':
                    $this->_total_weight_gg = ceil((float) $val);
                    break;
                case 'total_value':
                    $this->_total_value = (float) $val;
                    break;
            }
        }
        if (! $this->name || $this->length <= 0 || $this->width <= 0 || $this->depth <= 0)
        {
            throw new \LogicException('Invalid parameters provided to construct a packing_box');
        }
    }

    public function add_item(packing_item $item)
    {
        $this->_items[] = $item;
        $this->_total_weight_gg += $item->weight;
        $this->_total_value += $item->value;
    }

    public function get_items()
    {
        return array_values($this->_items);
    }

    public function has_items()
    {
        return (bool) count($this->_items);
    }

    public function is_valid()
    {
        if ($this->_width_mm < 1 || $this->_length_mm < 1 || $this->_depth_mm < 1 || $this->_total_weight_gg < 1)
        {
            return;
        }
        if ($this->_total_value < 0)
        {
            return;
        }
        if (! $this->has_items())
        {
            return;
        }

        return TRUE;
    }

    public function __get($key)
    {
        switch ($key)
        {
            case 'name':
                return trim($this->_name);
                break;
            case 'width':
                return (int) $this->_width_mm;
                break;
            case 'length':
                return (int) $this->_length_mm;
                break;
            case 'depth':
                return (int) $this->_depth_mm;
                break;
            case 'total_weight':
                return (int) $this->_total_weight_gg;
                break;
            case 'total_value':
                return (float) $this->_total_value;
                break;
            case 'item_count':
                return count($this->_items);
                break;
            default:
                throw new \LogicException("$key is not a gettable member of " . __CLASS__);
        }
    }

    public function __set($key, $val)
    {
        throw new \LogicException("$key is not a settable member of " . __CLASS__);
    }

} // end of class

?>
