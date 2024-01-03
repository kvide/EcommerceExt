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

// class to abstract info about a shipment that was returend from a shipping carrier.
// objects of this type are never meant to be stored, but to return information from the shipping module to a handler that will then
// save the info.
class shipment_info
{

    private $_data = [
        'carrier' => null,
        'carrier_id' => null,
        'tracking_number' => null,
        'shipping_cost' => null,
        'label_file' => null,
        'manifest_file' => null
    ];

    public function __construct(array $params)
    {
        foreach ($params as $key => $val)
        {
            switch ($key)
            {
                case 'carrier': // the carrier name
                case 'carrier_id': // the carrier's unique identifier for the shipment
                case 'tracking_number': // the carrier's public tracking number for the shipment
                case 'label_file': // the complete file specification (can be temporay location) to a file containing a printable label
                case 'manifest_file': // the complete file specification (can be temporay location) to a file containing a printable shipping manifest/invoice.
                    $this->_data[$key] = trim($val);
                    break;
                case 'shipping_cost':
                    $this->_data[$key] = (float) $val;
                    break;
            }
        }

        if (! $this->carrier || ! $this->carrier_id)
        {
            throw new \LogicException('Attept to create a ' . __CLASS__ . ' with incomplete information');
        }
    }

    public function __get($key)
    {
        switch ($key)
        {
            case 'carrier':
            case 'carrier_id':
            case 'tracking_number':
            case 'label_file':
            case 'manifest_file':
                return trim($this->_data[$key]);
                break;

            case 'shipping_cost':
                return (float) $this->_data[$key];
                break;

            default:
                throw new \LogicException("$key is not a gettable member of " . get_class($this));
        }
    }

}

#
# EOF
#
?>
