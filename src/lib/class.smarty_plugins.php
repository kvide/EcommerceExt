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

class smarty_plugins
{

    protected function __construct()
    {
        // static class.. cannot be instantiated
    }

    public static function init()
    {
        $smarty = \CmsApp::get_instance()->GetSmarty();
        $smarty->register_function('ecomm_currency_code', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_currency_code'
        ));
        $smarty->register_function('ecomm_currency_symbol', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_currency_symbol'
        ));
        $smarty->register_function('ecomm_weight_units', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_weight_units'
        ));
        $smarty->register_function('ecomm_length_units', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_length_units'
        ));
        $smarty->register_function('ecomm_company_address', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_company_address'
        ));
        $smarty->register_function('ecomm_cartitem_exists', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_cartitem_exists'
        ));
        $smarty->register_function('ecomm_form_addtocart', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_form_addtocart'
        ));
        $smarty->register_function('ecomm_cart_module', array(
            '\\EcommerceExt\\smarty_plugins',
            'smarty_addtocart'
        ));
        $smarty->register_function('ecomm_erasecart', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_erasecart'
        ));
        $smarty->register_function('ecomm_get_productinfo', array(
            '\\EcommerceExt\\smarty_plugins',
            'ecomm_get_productinfo'
        ));
    }

    public static function smarty_addtocart($params, &$smarty)
    {
        $cart_module = ecomm::get_cart_module();
        if (! $cart_module)
        {
            return;
        }
        if (! \CmsApp::get_instance()->is_frontend_request())
        {
            return;
        }

        $action = \xt_param::get_string($params, 'action', 'default');

        return $cart_module->DoActionBase($action, 'cntnt01', $params, \cms_utils::get_current_pageid(), $smarty);
    }

    public static function ecomm_currency_code($params, &$smarty)
    {
        $code = ecomm::get_currency_code();
        if (isset($params['assign']))
        {
            $smarty->assign($params['assign'], $code);
            return;
        }

        return $code;
    }

    public static function ecomm_currency_symbol($params, &$smarty)
    {
        $code = ecomm::get_currency_symbol();
        if (isset($params['assign']))
        {
            $smarty->assign($params['assign'], $code);
            return;
        }

        return $code;
    }

    public static function ecomm_weight_units($params, &$smarty)
    {
        $code = ecomm::get_weight_units();
        if (isset($params['assign']))
        {
            $smarty->assign($params['assign'], $code);
            return;
        }

        return $code;
    }

    public static function ecomm_length_units($params, &$smarty)
    {
        $code = ecomm::get_length_units();
        if (isset($params['assign']))
        {
            $smarty->assign($params['assign'], $code);
            return;
        }

        return $code;
    }

    public static function ecomm_company_address($params, &$smarty)
    {
        $addr = ecomm::get_company_address();
        if (! $addr)
            $addr = new \EcommerceExt\company_address();

        if (isset($params['assign']))
        {
            $smarty->assign($params['assign'], $my_addr);
            return;
        }

        return $addr;
    }

    public static function ecomm_cartitem_exists($params, &$smarty)
    {
        $source = 'EcProductMgr';
        $product = '';
        $sku = '';
        $extra = null;
        if (isset($params['source']))
        {
            $source = trim($params['source']);
        }
        if (isset($params['product']))
        {
            $product = (int) $params['product'];
        }
        if (isset($params['sku']))
        {
            $sku = trim($params['sku']);
        }
        if (isset($params['extra']))
        {
            $extra = $params['extra'];
        }

        $res = 0;
        $cart = ecomm::get_cart_module();
        if ($source && ($product || $sku) && $cart)
        {
            if ($product && method_exists($cart, 'check_itemid_exists'))
            {
                $res = $cart->check_itemid_exists($source, $product, $extra);
            }
            else if ($sku && method_exists($cart, 'check_sku_exists'))
            {
                $res = $cart->check_sku_exists($source, $sku, $extra);
            }
            $res = ($res) ? 1 : 0;
        }

        if (isset($params['assign']))
        {
            $smarty->assign($params['assign'], $res);
            return;
        }

        return $res;
    }

    public static function ecomm_form_addtocart($params, &$smarty)
    {
        $cart = ecomm::get_cart_module();
        if (! method_exists($cart, 'get_addtocart_form'))
        {
            return;
        }

        $cart_name = $cart->GetName();
        $smarty = cmsms()->GetSmarty();
        $params['module'] = $cart_name;
        $txt = cms_module_plugin($params, $smarty);

        return $txt;
    }

    public static function ecomm_erasecart($params, &$smarty)
    {
        $cart = ecomm::get_cart_module();
        $cart->EraseCart();
    }

    public static function ecomm_get_productinfo($params, &$smarty)
    {
        $source = 'EcProductMgr';
        $entry_id = '';

        if (! isset($params['itemid']))
        {
            return;
        }
        if (isset($params['source']))
        {
            $source = trim($params['source']);
        }
        $item_id = (int) $params['itemid'];

        try
        {
            $info = ecomm::get_product_info($source, $item_id);
            if (is_object($info) && isset($params['assign']))
            {
                $smarty->assign(trim($params['assign']), $info);
                return;
            }
            return $info;
        }
        catch (\Exception $e)
        {
            // do nothing.
        }
    }

} // end of class

#
# EOF
#
?>
