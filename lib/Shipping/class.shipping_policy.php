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

namespace EcommerceExt\Shipping;

class shipping_policy implements iShippingPolicy
{

    private $_shipto_countries = [];

    private $_allow_pickup = null;

    public function __construct(array $params = null)
    {
        if (! is_array($params))
        {
            return;
        }

        $countries = \xt_utils::get_param($params, 'countries');
        $countries = \xt_utils::get_param($params, 'shipto_countries', $countries);
        if (! is_array($countries) || ! count($countries))
        {
            throw new \LogicException('Invalid country data provided to ' . __METHOD__);
        }
        $this->_shipto_countries = $countries;

        $pickup = \xt_param::get_bool($params, 'allow_pickup');
        $pickup = \xt_param::get_bool($params, 'can_pickup', $pickup);
        $this->_allow_pickup = $pickup;
    }

    public function __get($key)
    {
        switch ($key)
        {
            case 'countries':
            case 'shipto_countries':
            case 'shipto':
                return $this->_shipto_countries;
                break;

            case 'allow_pickup':
            case 'can_pickup':
                return $this->_allow_pickup;
                break;

            default:
                throw new \LogicException("$key is not a gettable member of " . __CLASS__);
        }
    }

    public function __set($key, $val)
    {
        throw new \LogicException("$key is not a settable member of " . __CLASS__);
    }

    public function ships_to(\xt_address $addr)
    {
        $ctry = $addr->get_country();
        if (! $ctry)
        {
            return FALSE;
        }
        if (in_array(- 1, $this->_shipto_countries))
        {
            return TRUE;
        }
        if (in_array($ctry, $this->_shipto_countries))
        {
            return TRUE;
        }
    }

} // end of class

#
# EOF
#
?>
