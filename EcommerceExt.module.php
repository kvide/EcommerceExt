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

define('EcommerceExt\COMB_ATTRIB_ITEM_DESCRIPTION', '{$attrib_text} ({$currency_symbol}{$attrib_adjust|number_format:2})');

include_once cms_join_path(__DIR__, 'lib', 'class.EcommModule.php');

class EcommerceExt extends \EcommerceExt\EcommModule
{

    function AllowAutoInstall()
    {
        return FALSE;
    }

    function AllowAutoUpgrade()
    {
        return FALSE;
    }

    function GetFriendlyName()
    {
        return $this->Lang('friendlyname');
    }

    function GetVersion()
    {
        return '0.98.0';
    }

    function GetAuthor()
    {
        return 'Christian Kvikant';
    }

    function GetAuthorEmail()
    {
        return 'kvide@kvikant.fi';
    }

    function IsPluginModule()
    {
        return false;
    }

    function HasAdmin()
    {
        return true;
    }

    function GetAdminSection()
    {
        return 'ecommerce';
    }

    function GetAdminDescription()
    {
        return $this->Lang('module_description');
    }

    function VisibleToAdminUser()
    {
        return $this->CheckPermission('Modify Site Preferences');
    }

    function GetDependencies()
    {
        return array(
            'CMSMSExt' => '1.4.5'
        );
    }

    function MinimumCMSVersion()
    {
        return '2.2.19';
    }

    function InstallPostMessage()
    {
        return $this->Lang('postinstall');
    }

    function UninstallPostMessage()
    {
        return $this->Lang('postuninstall');
    }

    function UninstallPreMessage()
    {
        return $this->Lang('ask_really_uninstall');
    }

    function GetEventHelp($event_name)
    {
        return $this->Lang('event_help_' . $event_name);
    }

    function GetEventDescription($event_name)
    {
        return $this->Lang('event_desc_' . $event_name);
    }

    function LazyLoadAdmin()
    {
        return TRUE;
    }

    function LazyLoadFrontend()
    {
        return FALSE;
    }

    function GetHeaderHTML()
    {
        $txt = parent::GetHeaderHTML();
        $obj = $this->GetModuleInstance('JQueryTools');
        if (is_object($obj))
        {
            $tmpl = <<<EOT
            {JQueryTools action='incjs' exclude='form'}
            {JQueryTools action='ready'}
            EOT;
            $txt .= $this->ProcessTemplateFromData($tmpl);
        }

        return $txt;
    }

    function SetParameters()
    {
        // TODO: Figure out why these have to be explisitely included
        parent::autoload('iShippingPolicy');
        parent::autoload('shipping_policy');
        parent::autoload('ecomm');
        // $this->RestrictUnknownParams();
        $this->RegisterModulePlugin();
        $this->AddImageDir('icons');

        EcommerceExt\smarty_plugins::init();
    }

    /**
     * A function to return an array of of country codes and country names.
     * This method returns data that is suitable for use in a list.
     * i.e: array( array('code'=>'AB','name'=>'Alberta'), array('code'=>'MB','code'=>'Manitoba'));
     *
     * @return array|null
     */
    public function get_state_list_options()
    {
        $xt = $this->get_xt();
        $fn = $xt->find_module_file('/etc/states.json');
        if ($fn)
        {
            return json_decode(file_get_contents($fn), TRUE);
        }
    }

}

// end of class

/**
 * Base e-commerce exception class
 */
class EcommerceExtException extends \CmsException
{

}

#
# EOF
#
?>
