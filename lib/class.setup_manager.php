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

final class setup_manager
{

    private function __construct()
    {
        // Static class
    }
    const PREF_SHOPPING_CART_MANAGER = 'shopping_cart_mgr';
    const PREF_TAX_CALCULATOR = 'tax_calculator';
    const PREF_HANDLING_CALCULATOR = 'handling_calculator';
    const PREF_PACKAGING_CALCULATOR = 'packaging_calculator';
    const PREF_SHIPPING_ASSISTANT = 'shipping_assistant';
    const PREF_PROMOTION_ASSISTANT = 'promotion_assistant';

    public static function set_shopping_cart_mgr($module_name)
    {
        // use a button in the cart module's admin console to set it as the preferred shopping cart manager.
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }
        $mod_obj = \cms_utils::get_module($module_name);
        if (! $mod_obj)
        {
            throw new \RuntimeException('Invalid module (cannot load) passed to ' . __METHOD__);
        }
        if (! method_exists($mod_obj, 'get_cart_manager'))
        {
            throw new \LogicException($module_name . ' is an invalid shopping cart manager module');
        }
        $mgr = $mod_obj->get_cart_manager();
        if (! $mgr instanceof Cart\shopping_cart_mgr)
        {
            throw new \LogicException('Invalid module (missing method) passed to ' . __METHOD__);
        }

        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->SetPreference(self::PREF_SHOPPING_CART_MANAGER, $module_name);
    }

    public static function unset_shopping_cart_mgr($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }
        if (self::get_shopping_cart_mgr_name() != $module_name)
        {
            throw new \LogicException('Cannot unset this shopping cart manager');
        }
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->RemovePreference(self::PREF_SHOPPING_CART_MANAGER);
    }

    public static function get_shopping_cart_mgr_name()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference(self::PREF_SHOPPING_CART_MANAGER);

        return $tmp;
    }

    public static function set_tax_calculator($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }
        $mod_obj = \cms_utils::get_module($module_name);
        if (! $mod_obj)
        {
            throw new \RuntimeException('Invalid module (cannot load) passed to ' . __METHOD__);
        }
        if (! method_exists($mod_obj, 'get_tax_calculator'))
        {
            throw new \LogicException($module_name . ' is an invalid tax module');
        }
        $mgr = $mod_obj->get_tax_calculator();
        if (! $mgr instanceof Tax\tax_calculator)
        {
            throw new \LogicException('Invalid module (missing method) passed to ' . __METHOD__);
        }

        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->SetPreference(self::PREF_TAX_CALCULATOR, $module_name);
    }

    public static function unset_tax_calculator($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }

        if (self::get_tax_calculator_name() != $module_name)
        {
            throw new \LogicException('Cannot unset this tax calculator');
        }
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->RemovePreference(self::PREF_TAX_CALCULATOR);
    }

    public static function get_tax_calculator_name()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference(self::PREF_TAX_CALCULATOR);

        return $tmp;
    }

    public static function set_handling_calculator($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }
        $mod_obj = \cms_utils::get_module($module_name);
        if (! $mod_obj)
        {
            throw new \RuntimeException('Invalid module (cannot load) passed to ' . __METHOD__);
        }
        if (! method_exists($mod_obj, 'get_handling_calculator'))
        {
            throw new \LogicException($module_name . ' is an invalid handling module');
        }
        $mgr = $mod_obj->get_handling_calculator();
        if (! $mgr instanceof Handling\handling_calculator)
        {
            throw new \LogicException('Invalid module (missing method) passed to ' . __METHOD__);
        }

        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->SetPreference(self::PREF_HANDLING_CALCULATOR, $module_name);
    }

    public static function unset_handling_calculator($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }

        if (self::get_handling_calculator_name() != $module_name)
        {
            throw new \LogicException('Cannot unset this handling calculator');
        }
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->RemovePreference(self::PREF_HANDLING_CALCULATOR);
    }

    public static function get_handling_calculator_name()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference(self::PREF_HANDLING_CALCULATOR);

        return $tmp;
    }

    public static function set_packaging_calculator($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }
        $mod_obj = \cms_utils::get_module($module_name);
        if (! $mod_obj)
        {
            throw new \RuntimeException('Invalid module (cannot load) passed to ' . __METHOD__);
        }
        if (! method_exists($mod_obj, 'get_packaging_calculator'))
        {
            throw new \LogicException($module_name . ' is an invalid packaging module');
        }
        $mgr = $mod_obj->get_packaging_calculator();
        if (! $mgr instanceof Packaging\packaging_calculator)
        {
            throw new \LogicException('Invalid module (missing method) passed to ' . __METHOD__);
        }

        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->SetPreference(self::PREF_PACKAGING_CALCULATOR, $module_name);
    }

    public static function unset_packaging_calculator($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }

        if (self::get_packaging_calculator_name() != $module_name)
        {
            throw new \LogicException('Cannot unset this packaging calculator');
        }
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->RemovePreference(self::PREF_PACKAGING_CALCULATOR);
    }

    public static function get_packaging_calculator_name()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference(self::PREF_PACKAGING_CALCULATOR);

        return $tmp;
    }

    public static function set_shipping_assistant($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }
        $mod_obj = \cms_utils::get_module($module_name);
        if (! $mod_obj)
        {
            throw new \RuntimeException('Invalid module (cannot load) passed to ' . __METHOD__);
        }
        if (! method_exists($mod_obj, 'get_shipping_assistant'))
        {
            throw new \LogicException($module_name . ' is an invalid packaging module');
        }
        $mgr = $mod_obj->get_shipping_assistant();
        if (! $mgr instanceof Shipping\shipping_assistant)
        {
            throw new \LogicException('Invalid module (missing method) passed to ' . __METHOD__);
        }

        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->SetPreference(self::PREF_SHIPPING_ASSISTANT, $module_name);
    }

    public static function unset_shipping_assistant($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }

        if (self::get_shipping_assistant_name() != $module_name)
        {
            throw new \LogicException('Cannot unset this shipping assistant');
        }
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->RemovePreference(self::PREF_SHIPPING_ASSISTANT);
    }

    public static function get_shipping_assistant_name()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference(self::PREF_SHIPPING_ASSISTANT);
        return $tmp;
    }

    public static function set_promotion_assistant($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }
        $mod_obj = \cms_utils::get_module($module_name);
        if (! $mod_obj)
        {
            throw new \RuntimeException('Invalid module (cannot load) passed to ' . __METHOD__);
        }
        if (! method_exists($mod_obj, 'get_promotion_assistant'))
        {
            throw new \LogicException($module_name . ' is an invalid packaging module');
        }
        $mgr = $mod_obj->get_promotion_assistant();
        if (! $mgr instanceof Promotion\promotion_assistant)
        {
            throw new \LogicException('Invalid module (missing method) passed to ' . __METHOD__);
        }

        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->SetPreference(self::PREF_PROMOTION_ASSISTANT, $module_name);
    }

    public static function unset_promotion_assistant($module_name)
    {
        $module_name = trim($module_name);
        if (! $module_name)
        {
            throw new \LogicException('Invalid module passed to ' . __METHOD__);
        }

        if (self::get_promotion_assistant_name() != $module_name)
        {
            throw new \LogicException('Cannot unset this promotion assistant');
        }
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $ecomm->RemovePreference(self::PREF_PROMOTION_ASSISTANT);
    }

    public static function get_promotion_assistant_name()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference(self::PREF_PROMOTION_ASSISTANT);

        return $tmp;
    }

} // end of class

#
# EOF
#
?>
