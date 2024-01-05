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

namespace EcommerceExt;

final class utils
{

    private function __construct()
    {
        // Static class
    }

    static public function is_creditcard_number($str)
    {
        // uses the luhn/mod-10 algorithm.
        $number = preg_replace('/\D/', '', $str);
        $len = strlen($number);
        $parity = $len % 2;

        $total = 0;
        for ($i = 0; $i < $len; $i ++)
        {
            $digit = $number[$i];
            if ($i % 2 == $parity)
            {
                $digit *= 2;
                if ($digit > 9)
                    $digit -= 9;
            }
            $total += $digit;
        }

        return ($total % 10 == 0) ? TRUE : FALSE;
    }

    static public function convert_length_to_mm($val)
    {
        $val = (float) $val;
        if ($val < 0)
        {
            throw new \LogicException('Invalid length value passed to ' . __METHOD__);
        }

        $length_units = get_length_units();
        if (! $length_units)
        {
            $length_units = 'in';
        }
        $length_units = strtolower($length_units);

        switch ($length_units)
        {
            case 'in':
            case 'inches':
                $val = (int) ceil($val * 25.4);
                return $val;
                break;

            case 'cm':
                $val = (int) ceil($val * 10.0);
                return $val;
                break;

            case 'ft':
            case 'feet':
                $val = (int) ceil($val * 12 * 25.4);
                return $val;
                break;

            default:
                throw new \LogicException("invalid length units $length_units for use in " . __METHOD__);
        }
    }

    static public function convert_weight_to_grams($val)
    {
        $val = (float) $val;
        if ($val < 0)
        {
            throw new \LogicException('Invalid weight value passed to ' . __METHOD__);
        }

        $weight_units = get_weight_units();
        if (! $weight_units)
        {
            $weight_units = 'lbs';
        }
        $weight_units = strtolower($weight_units);

        switch ($weight_units)
        {
            case 'lb':
            case 'lbs':
                $val = \xt_units::LBS_TO_KG * $val * 1000;
                return (int) $val;
                break;

            case 'kg':
            case 'kgs':
                return (int) ($val * 1000);
                break;

            case 'hg':
                return (int) ($val * 100);
                break;

            case 'g':
            case 'grams':
                return (int) $val;
                break;

            default:
                throw new \LogicException("invalid weight units $weight_units for use in " . __METHOD__);
        }
    }

} // end of class

#
# EOF
#
?>
