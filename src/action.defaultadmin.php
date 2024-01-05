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

require_once (dirname(__FILE__) . '/lib/class.ecomm.php');

try
{
    ecomm::validate_config();
}
catch (\Exception $e)
{
    echo $this->ShowErrors($e->GetMessage());
}

echo $this->StartTabHeaders();
echo $this->SetTabHeader('myinfo', $this->Lang('tab_myinfo_settings'));
echo $this->SetTabHeader('general', $this->Lang('tab_general_settings'));
echo $this->SetTabHeader('policy', $this->Lang('tab_policy'));
echo $this->SetTabHeader('shipping', $this->Lang('tab_shipping_policy'));
echo $this->SetTabHeader('suppliers', $this->Lang('tab_supplier_settings'));
echo $this->SetTabHeader('payment', $this->Lang('tab_payment_settings'));
echo $this->SetTabHeader('config', $this->Lang('tab_configuration'));
echo $this->EndTabHeaders();

echo $this->StartTabContent();
echo $this->StartTab('myinfo');
include dirname(__FILE__) . '/action.admin_myinfo_tab.php';
echo $this->EndTab();

echo $this->StartTab('general');
include dirname(__FILE__) . '/action.admin_general_tab.php';
echo $this->EndTab();

echo $this->StartTab('policy');
include dirname(__FILE__) . '/function.admin_policy_tab.php';
echo $this->EndTab();

echo $this->StartTab('shipping');
include dirname(__FILE__) . '/action.admin_shipping_tab.php';
echo $this->EndTab();

echo $this->StartTab('suppliers');
include dirname(__FILE__) . '/function.admin_suppliers_tab.php';
echo $this->EndTab();

echo $this->StartTab('payment');
include dirname(__FILE__) . '/function.admin_payments_tab.php';
echo $this->EndTab();

echo $this->StartTab('config');
include dirname(__FILE__) . '/action.admin_config_tab.php';
echo $this->EndTab();

echo $this->EndTabContent();

#
# EOF
#
?>
