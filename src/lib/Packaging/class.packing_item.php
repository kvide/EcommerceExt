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

class packing_item
{

    private $_sku;
    private $_description;
    private $_weight;
    // in grams
    private $_value;

    // in ecomm currency units.
    public function __construct(array $parms)
    {
        foreach ($parms as $key => $val)
        {
            switch ($key)
            {
                case 'sku':
                    $this->_sku = trim($val);
                    break;
                case 'description':
                    $this->_description = trim($val);
                    break;
                case 'weight':
                    $this->_weight = (int) $val;
                    break;
                case 'value':
                    $this->_value = (float) $val;
                    break;
            }
        }
    }

    public function __get($key)
    {
        switch ($key)
        {
            case 'sku':
                return trim($this->_sku);
                break;
            case 'description':
                return trim($this->_description);
                break;
            case 'weight':
                return (int) $this->_weight;
                break;
            case 'value':
                return (float) $this->_value;
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
