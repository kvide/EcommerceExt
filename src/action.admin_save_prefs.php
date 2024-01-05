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

$the_tab = 'cart';
if (isset($params['thetab']))
{
    $the_tab = trim($params['thetab']);
}
echo $this->SetCurrentTab($the_tab);

$prefmap = array();
$prefmap['sel_payment_modules'] = array('sel_payment_modules', 'array_of_strings');
$prefmap['supplier_modules'] = array('supplier_modules', 'array_of_strings', '-1');
$prefmap['attrib_item_description'] = array('attrib_item_description', 'string');
$prefmap['lineitem_desc_template'] = array('lineitem_desc_template', 'template');

$buttons = array();
$buttons['reset_lineitem_desc'] = 'reset_lineitem_desc';

// process buttons
foreach ($buttons as $button_name => $method)
{
    if (isset($params[$button_name]))
    {
        if (method_exists('EcommerceExt\ecomm', $method))
        {
            call_user_func(array(
                'EcommerceExt\ecomm',
                $method
            ), $params);
            $this->RedirectToTab($id);
            return;
        }
    }
}

// assume submit was pressed.
foreach ($prefmap as $paramname => $data)
{
    $prefname = $data[0];
    $type = $data[1];

    switch ($type)
    {
        case 'array_of_strings':
            $none = isset($data[2]) ? $data[2] : '';
            $tmp = '';
            if (isset($params[$paramname]))
            {
                if (in_array($none, $params[$paramname]))
                {
                    $this->SetPreference($prefname, '');
                }
                else
                {
                    $tmp = implode(',', $params[$paramname]);
                    $this->SetPreference($prefname, trim($tmp));
                }
            }
            break;

        case 'template':
            if (! isset($params[$paramname]))
            {
                break;
            }
            $this->SetTemplate($prefname, trim($params[$paramname]));
            break;

        case 'ucstring':
            if (! isset($params[$paramname]))
            {
                break;
            }
            $this->SetPreference($prefname, strtoupper(trim($params[$paramname])));
            break;

        case 'string':
            if (! isset($params[$paramname]))
            {
                break;
            }
            $this->SetPreference($prefname, trim($params[$paramname]));
            break;

        case 'float':
            if (! isset($params[$paramname]))
            {
                break;
            }
            $this->SetPreference($prefname, \xt_param::get_float($params, $paramname));
            break;

        case 'int':
        default:
            if (! isset($params[$paramname]))
            {
                break;
            }
            $this->SetPreference($prefname, (int) $params[$paramname]);
            break;
    }
}

$this->SetMessage($this->Lang('msg_prefs_saved'));
$this->RedirectToTab($id);

#
# EOF
#
?>
