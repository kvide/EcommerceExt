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

use EcommerceExt\company_address;

if (! isset($gCms))
{
    exit();
}
if (! $this->VisibleToAdminUser())
{
    exit();
}

$this->SetCurrentTab('myinfo');

$tmp = $this->GetPreference('myinfo_address', '');
$my_address = '';
if ($tmp)
{
    $my_address = unserialize($tmp);
}
else
{
    $my_address = new company_address();
}

if (isset($params['submit']))
{
    $my_address->from_array($params, '');
    if ($my_address->is_valid())
    {
        $this->SetPreference('myinfo_address', serialize($my_address));
        $this->RedirectToTab();
    }
    else
    {
        echo $this->ShowErrors($this->Lang('error_invalidaddress'));
    }
}

//
// give everything to smarty
//
$smarty->assign('formstart', $this->XTCreateFormStart($id, 'admin_myinfo_tab'));
$smarty->assign('formend', $this->CreateFormEnd());
$smarty->assign('my_address', $my_address);
$state_list = \xt_array::hash_prepend($this->get_state_list_options(), '-1', $this->Lang('not_applicable'));
$smarty->assign('state_list', $state_list);
$smarty->assign('country_list', $this->get_country_list_options());

echo $this->ProcessTemplate('admin_myinfo_tab.tpl');

#
# EOF
#
?>
