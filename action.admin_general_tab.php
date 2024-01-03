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

if (! isset($gCms))
{
    exit();
}
if (! $this->VisibleToAdminUser())
{
    exit();
}

$this->SetCurrentTab('general');

if (\xt_param::exists($params, 'submit'))
{
    $this->SetPreference('currency_symbol', \xt_param::get_string($params, 'currency_symbol'));
    $this->SetPreference('currency_code', strtoupper(\xt_param::get_string($params, 'currency_code')));
    $this->SetPreference('weight_units', \xt_param::get_string($params, 'weight_units'));
    $this->SetPreference('length_units', \xt_param::get_string($params, 'length_units'));
    $this->SetPreference('tax_shipping', \xt_param::get_bool($params, 'tax_shipping'));
    $this->RedirectToTab();
}

$smarty->assign('currency_symbol', $this->GetPreference('currency_symbol'));
$smarty->assign('currency_code', $this->GetPreference('currency_code'));
$smarty->assign('weight_units', $this->GetPreference('weight_units'));
$smarty->assign('length_units', $this->GetPreference('length_units', 'in'));
$smarty->assign('tax_shipping', $this->GetPreference('tax_shipping', 1));
$wunits = [
    'lbs' => $this->Lang('wunit_lbs'),
    'kg' => $this->Lang('wunit_kg'),
    'hg' => $this->Lang('wunit_hg'),
    'g' => $this->Lang('wunit_g')
];
$smarty->assign('weight_units_list', $wunits);
$units = array();
$units['in'] = $this->Lang('units_inches');
$units['cm'] = $this->Lang('units_centimeters');
$smarty->assign('units', $units);

echo $this->ProcessTemplate('admin_general_tab.tpl');

#
# EOF
#
?>
