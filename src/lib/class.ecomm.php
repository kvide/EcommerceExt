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

use EcommerceExt\Cart;
use EcommerceExt\ProductMgr;

final class ecomm
{
    const CAPABILITY_SHOPPING_CART = 'shopping_cart';
    const CAPABILITY_PAYMENT_GATEWAY = 'payment_gateway';

    protected function __construct()
    {
        // static class... cannot be instantiated.
    }

    public static function validate_config()
    {
        // does a number of config tests, throws an exception on the first failure.
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);

        $addr = self::get_company_address();
        if (! $addr || ! $addr->is_valid())
        {
            throw new \RuntimeException($ecomm->Lang('err_config_address'));
        }
        if (! self::get_currency_symbol())
        {
            if (! self::get_currency_code())
            {
                throw new \RuntimeException($ecomm->Lang('err_config_currency'));
            }
        }
        if (! self::get_weight_units())
        {
            throw new \RuntimeException($ecomm->Lang('err_config_weight'));
        }
        if (! self::get_length_units())
        {
            throw new \RuntimeException($ecomm->Lang('err_config_length'));
        }
        if (empty(self::get_supplier_modules()))
        {
            throw new \RuntimeException($ecomm->Lang('err_config_suppliers'));
        }
        if (! self::get_cart_module())
        {
            throw new \RuntimeException($ecomm->Lang('err_config_cart'));
        }
        if (! self::get_system_shipping_policy())
        {
            throw new \RuntimeException($ecomm->Lang('err_config_shipping_policy'));
        }
    }

    public static function is_config_ok()
    {
        // does a number of tests, returns boolean if any fail
        try
        {
            self::validate_config();
            return TRUE;
        }
        catch (\Exception $e)
        {
            return FALSE;
        }
    }

    public static function get_currency_symbol()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);

        return $ecomm->GetPreference('currency_symbol', '$');
    }

    public static function get_currency_code()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);

        return $ecomm->GetPreference('currency_code', 'USD');
    }

    public static function format_currency($val)
    {
        $val = (float) $val;

        return sprintf('%s %.2F', self::get_currency_symbol(), $val);
    }

    public static function get_weight_units()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);

        return $ecomm->GetPreference('weight_units', 'lbs');
    }

    public static function get_length_units()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);

        return $ecomm->GetPreference('length_units', 'in');
    }

    public static function get_supplier_modules()
    {
        $res = FALSE;
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference('supplier_modules');
        if (! empty($tmp))
        {
            $res = explode(',', $tmp);
        }

        return $res;
    }

    public static function is_supplier_module($name)
    {
        $tmp = self::get_supplier_modules();
        if (! is_array($tmp))
        {
            return FALSE;
        }
        if (! in_array($name, $tmp))
        {
            return FALSE;
        }

        return TRUE;
    }

    public static function &get_supplier_module($source)
    {
        $res = null;
        if (self::is_supplier_module($source))
        {
            $res = \cms_utils::get_module($source);
        }

        return $res;
    }

    public static function get_tax_module()
    {
        $modname = setup_manager::get_tax_calculator_name();
        if (! $modname)
        {
            return;
        }

        $mod = \cms_utils::get_module($modname);
        if (! $mod)
        {
            return;
        }
        if (! method_exists($mod, 'get_tax_calculator'))
        {
            throw new \LogicException($modname . ' is an invalid tax calculator module');
        }
        $mgr = $mod->get_tax_calculator();
        if (! $mgr instanceof Tax\tax_calculator)
        {
            throw new \LogicException($modname . ' is an invalid tax calculator module');
        }

        return $mgr;
    }

    public static function get_packaging_module()
    {
        $modname = setup_manager::get_packaging_calculator_name();
        if (! $modname)
        {
            return;
        }

        $mod = \cms_utils::get_module($modname);
        if (! $mod)
        {
            return;
        }
        if (! method_exists($mod, 'get_packaging_calculator'))
        {
            throw new \LogicException($modname . ' is an invalid packaging module');
        }
        $mgr = $mod->get_packaging_calculator();
        if (! $mgr instanceof Packaging\packaging_calculator)
        {
            throw new \LogicException($modname . ' is an invalid packaging module');
        }

        return $mgr;
    }

    public static function get_shipping_module()
    {
        $modname = setup_manager::get_shipping_assistant_name();
        if (! $modname)
        {
            return;
        }

        $mod = \cms_utils::get_module($modname);
        if (! $mod)
        {
            return;
        }
        if (! method_exists($mod, 'get_shipping_assistant'))
        {
            throw new \LogicException($modname . ' is an invalid shipping module');
        }
        $mgr = $mod->get_shipping_assistant();
        if (! $mgr instanceof Shipping\shipping_assistant)
        {
            throw new \LogicException($modname . ' is an invalid shipping module');
        }

        return $mgr;
    }

    public static function get_system_shipping_policy()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference('shipping_policy');
        if (! $tmp)
        {
            return;
        }
        $tmp = unserialize($tmp);

        return $tmp;
    }

    public static function get_handling_module()
    {
        $modname = setup_manager::get_handling_calculator_name();
        if (! $modname)
        {
            return;
        }

        $mod = \cms_utils::get_module($modname);
        if (! $mod)
        {
            return;
        }
        if (! method_exists($mod, 'get_handling_calculator'))
        {
            throw new \LogicException($modname . ' is an invalid handling module');
        }
        $mgr = $mod->get_handling_calculator();
        if (! $mgr instanceof Handling\handling_calculator)
        {
            throw new \LogicException($modname . ' is an invalid handling module');
        }

        return $mgr;
    }

    public static function get_promotions_module()
    {
        $modname = setup_manager::get_promotion_assistant_name();
        if (! $modname)
        {
            return;
        }

        $mod = \cms_utils::get_module($modname);
        if (! $mod)
        {
            return;
        }
        if (! method_exists($mod, 'get_promotion_assistant'))
        {
            throw new \LogicException($modname . ' is an invalid promotion module');
        }
        $mgr = $mod->get_promotion_assistant();
        if (! $mgr instanceof Promotion\promotion_assistant)
        {
            throw new \LogicException($modname . ' is an invalid promotion module');
        }

        return $mgr;
    }

    public static function get_promotions_tester()
    {
        $mod = self::get_promotions_module();
        if ($mod)
        {
            $ob = $mod->get_test_object();
            return $ob;
        }
        $res = null;

        return $res;
    }

    public static function get_gateway_modules()
    {
        $mod = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $mod->GetPreference('sel_payment_modules');
        if ($tmp)
        {
            return explode(',', $tmp);
        }
    }

    public static function &get_payment_module()
    {
        stack_trace();
        die('__fixme__'); // FIXME

        $res = null;
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $modname = $ecomm->GetPreference('payment_module');
        if ($modname == '' || $modname == '-1')
        {
            return $res;
        }

        return \cms_utils::get_module($modname);
    }

    public static function &get_order_manager()
    {
        // todo: this can be changed.
        return \cms_utils::get_module('EcOrderMgr');
    }

    public static function reset_lineitem_desc()
    {
        $ecomm = null;
        {
            $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        }
        if (! $ecomm)
        {
            return;
        }

        $fn = $ecomm->GetModulePath() . '/templates/orig_lineitem_desc_template.tpl';
        if (file_exists($fn))
        {
            $data = @file_get_contents($fn);
            $ecomm->SetTemplate('lineitem_desc_template', $data);
        }
    }

    public static function get_product_info($source, $product_id)
    {
        $module = self::get_supplier_module($source);
        if ($module && method_exists($module, 'get_product_info'))
        {
            $tmp = $module->get_product_info($product_id);
            if (is_object($tmp) && ($tmp instanceof ProductMgr\productinfo))
            {
                return $tmp;
            }
        }

        throw new \Exception('Could not get product info for product ' . $product_id . ' from the ' . $source . ' module');
    }

    public static function find_product_by_sku($sku)
    {
        // find a product in all suppliers, by sku.
        if (! $sku)
        {
            return;
        }

        $suppliers = self::get_supplier_modules();
        if (is_array($suppliers) && count($suppliers))
        {
            foreach ($suppliers as $supplier)
            {
                try
                {
                    $res = self::get_product_by_sku($supplier, $sku);
                    if (is_object($res) && ($res instanceof ProductMgr\productinfo))
                    {
                        return $res; // was: $tmp ?
                    }
                }
                catch (\Exception $e)
                {
                    // skip it.
                }
            }
        }
    }

    public static function get_product_by_sku($source, $sku)
    {
        $module = self::get_supplier_module($source);
        if ($module)
        {
            if (method_exists($module, 'get_product_by_sku'))
            {
                $tmp = $module->get_product_by_sku($sku); // deprecated...
                if (is_object($tmp) && ($tmp instanceof ProductMgr\productinfo))
                {
                    return $tmp;
                }
            }
        }

        throw new \Exception('Could not get product info for sku ' . $sku . ' from the ' . $source . ' module');
    }

    public static function get_displayable_option(ProductMgr\productinfo_option $opt)
    {
        $smarty = cmsms()->GetSmarty();
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);

        $smarty->assign('currency_symbol', $ecomm->GetPreference('currency_symbol'));
        $smarty->assign('weight_units', $ecomm->GetPreference('weight_units'));
        $smarty->assign('currency_code', $ecomm->GetPreference('currency_code'));
        $template = $ecomm->GetPreference('attrib_item_description');

        $smarty->assign('option', $opt);
        $smarty->assign('attrib_text', $opt->get_text());
        $smarty->assign('attrib_adjust', $opt->get_adjustment());
        $smarty->assign('attrib_sku', $opt->get_sku());
        $str = $ecomm->ProcessTemplateFromData($template);

        return $str;
    }

    public static function get_company_address()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $tmp = $ecomm->GetPreference('myinfo_address');
        $res = null;
        if ($tmp)
        {
            $res = unserialize($tmp);
        }

        return $res;
    }

    public static function get_system_cartitem_policy()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);
        $policy = new Cart\cartitem_policy();
        $policy->set_max_services($ecomm->GetPreference('policy_maxservices', 1000000));
        $policy->set_max_products($ecomm->GetPreference('policy_maxproducts', 1000000));
        $policy->set_max_subscriptions($ecomm->GetPreference('policy_maxsubscriptions', 1000000));
        $policy->set_mixed_subscriptions($ecomm->GetPreference('policy_mixedsubscriptions', 1));

        return $policy;
    }

    public static function get_payment_cartitem_policy()
    {
        $policy = new Cart\cartitem_policy();

        $module_list = self::get_gateway_modules();
        if (! is_array($module_list) || ! count($module_list))
        {
            return $policy;
        }

        foreach ($module_list as $module_name)
        {
            $mod = \cms_utils::get_module($module_name);
            if (! $mod)
            {
                continue;
            }

            $m_policy = $mod->get_cartitem_policy();
            if (! is_object($policy))
            {
                return; // no policy.
            }

            $policy->merge($m_policy);
        }

        return $policy;
    }

    public static function can_tax_shipping()
    {
        $ecomm = \cms_utils::get_module(\MOD_ECOMMERCEEXT);

        return $ecomm->GetPreference('tax_shipping', 1);
    }

    public static function get_cart_module()
    {
        $modname = setup_manager::get_shopping_cart_mgr_name();
        if (! $modname)
        {
            return;
        }

        $mod = \cms_utils::get_module($modname);
        if (! $mod)
        {
            return;
        }
        if (! method_exists($mod, 'get_cart_manager'))
        {
            throw new \LogicException($modname . ' is an invalid shopping cart manager module');
        }
        $mgr = $mod->get_cart_manager();
        if (! $mgr instanceof Cart\shopping_cart_mgr)
        {
            throw new \LogicException($modname . ' is an invalid shopping cart manager module');
        }

        return $mgr;
    }

} // end of class

#
# EOF
#
?>
