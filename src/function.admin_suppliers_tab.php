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

$module_list = \module_helper::get_modules_with_method('get_product_info');
if (! empty($module_list))
{
    $module_list = \xt_array::hash_prepend($module_list, - 1, $this->Lang('none'));
}
else
{
    $module_list = [-1 => $this->Lang('none')];
}

$tpl = $this->CreateSmartyTemplate('admin_suppliers_tab.tpl');
$tpl->assign('formstart', $this->XTCreateFormStart($id, 'admin_save_prefs', $returnid, array(
    'thetab' => 'suppliers'
)));
$tpl->assign('formend', $this->CreateFormEnd());
$tpl->assign('supplier_all_modules', $module_list);

$tmp = ecomm::get_supplier_modules();
$tpl->assign('supplier_modules', $tmp);

$tpl->assign('input_lineitem_desc_template', $this->CreateTextArea(false, $id,
                $this->GetTemplate('lineitem_desc_template'), 'lineitem_desc_template'));

$tpl->assign('attrib_item_description', $this->GetPreference('attrib_item_description',
                                                                \EcommerceExt\COMB_ATTRIB_ITEM_DESCRIPTION));

$tpl->display();

#
# EOF
#
?>
