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

use EcommerceExt\Shipping;

if (! isset($gCms))
{
    exit();
}
if (! $this->VisibleToAdminUser())
{
    exit();
}

$this->SetCurrentTab('shipping');

$policy = new Shipping\shipping_policy();
$tmp = $this->GetPreference('shipping_policy');
if ($tmp)
{
    $policy = unserialize($tmp);
}

if (\xt_param::exists($params, 'submit'))
{
    $countries = \xt_utils::get_param($params, 'shipto');
    if (empty($countries) || in_array(- 1, $countries))
    {
        $countries = [
            - 1
        ];
    }
    $policy = new Shipping\shipping_policy([
        'countries' => $countries,
        'allow_pickup' => \xt_param::get_bool($params, 'allow_pickup')
    ]);
    $this->SetPreference('shipping_policy', serialize($policy));
    $this->SetMessage($this->Lang('msg_prefs_saved'));
    $this->RedirectToTab();
}

$countries = $this->get_country_list_options();
$countries = \xt_array::hash_prepend($countries, - 1, '-- ' . $this->Lang('any') . ' --');
$tpl = $this->CreateSmartyTemplate('admin_shipping_tab.tpl');
$tpl->assign('policy', $policy);
$tpl->assign('countries', $countries);
$tpl->assign('shipping_module', $this->GetPreference('shipping_module', - 1));

$tpl->display();

#
# EOF
#
?>
