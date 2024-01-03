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

use EcommerceExt\ecomm;

if (! isset($gCms))
{
    exit();
}
if (! $this->VisibleToAdminUser())
{
    exit();
}

$this->SetCurrentTab('config');

$rmmod = \xt_param::get_string($params, 'rmmod');
$type = \xt_param::get_string($params, 'type');
if ($rmmod && $type)
{
    switch ($type)
    {
        case 'shopping_cart':
            setup_manager::unset_shopping_cart_mgr($rmmod);
            break;
        case 'promotions':
            setup_manager::unset_promotion_assistant($rmmod);
            break;
        case 'packaging':
            setup_manager::unset_packaging_calculator($rmmod);
            break;
        case 'handling':
            setup_manager::unset_handling_calculator($rmmod);
            break;
        case 'shipping':
            setup_manager::unset_shipping_assistant($rmmod);
            break;
        case 'tax':
            setup_manager::unset_tax_calculator($rmmod);
            break;
        default:
        // do nothing
    }
    $this->RedirectToTab();
}

$report = [];
$report['shopping_cart']['name'] = setup_manager::get_shopping_cart_mgr_name();
$report['shopping_cart']['label'] = $this->Lang('cart_module');
$report['shopping_cart']['ok'] = false;
$obj = ecomm::get_cart_module();
if (is_object($obj) && $obj->IsConfigured())
{
    $report['shopping_cart']['ok'] = true;
}

$report['promotions']['name'] = setup_manager::get_promotion_assistant_name();
$report['promotions']['label'] = $this->Lang('promotions_module');
$report['promotions']['ok'] = false;
$obj = ecomm::get_promotions_module();
if (is_object($obj) && $obj->IsConfigured())
{
    $report['promotions']['ok'] = true;
}

$report['packaging']['name'] = setup_manager::get_packaging_calculator_name();
$report['packaging']['label'] = $this->Lang('packaging_module');
$report['packaging']['ok'] = false;
$obj = ecomm::get_packaging_module();
if (is_object($obj) && $obj->IsConfigured())
{
    $report['packaging']['ok'] = true;
}

$report['handling']['name'] = setup_manager::get_handling_calculator_name();
$report['handling']['label'] = $this->Lang('handling_module');
$report['handling']['ok'] = false;
$obj = ecomm::get_handling_module();
if (is_object($obj) && $obj->IsConfigured())
{
    $report['handling']['ok'] = true;
}

$report['shipping']['name'] = setup_manager::get_shipping_assistant_name();
$report['shipping']['label'] = $this->Lang('shipping_module');
$report['shipping']['ok'] = false;
$obj = ecomm::get_shipping_module();
if (is_object($obj) && $obj->IsConfigured())
{
    $report['shipping']['ok'] = true;
}

$report['tax']['name'] = setup_manager::get_tax_calculator_name();
$report['tax']['label'] = $this->Lang('tax_module');
$report['tax']['ok'] = false;
$obj = ecomm::get_tax_module();
if (is_object($obj) && $obj->IsConfigured())
{
    $report['tax']['ok'] = true;
}

$tpl = $this->CreateSmartyTemplate('admin_config_tab.tpl');
$tpl->assign('report', $report);

$tpl->display();

#
# EOF
#
?>
