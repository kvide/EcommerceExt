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

namespace EcommerceExt\Packaging;

abstract class shipping_container
{

    /* this class contains values in units defined in EcommerceExt */
    private $_data = [
        'ref' => null,
        'outer_width' => null,
        'outer_length' => null,
        'outer_depth' => null,
        'inner_width' => null,
        'inner_length' => null,
        'inner_depth' => null,
        'empty_weight' => null,
        'max_weight' => null
    ];

    public function __construct(array $data = null)
    {
        if (! is_null($data))
        {
            foreach ($data as $key => $val)
            {
                $this->setValue($key, $val);
            }
        }
    }

    public function __get($key)
    {
        switch ($key)
        {
            case 'id':
                if ($this->_data[$key])
                {
                    return (int) $this->_data[$key];
                }
                break;
            case 'ref':
                return trim($this->_data[$key]);
                break;
            case 'outer_width':
            case 'outer_length':
            case 'outer_depth':
            case 'inner_width':
            case 'inner_length':
            case 'inner_depth':
            case 'empty_weight':
            case 'max_weight':
                return (float) $this->_data[$key];
                break;
            default:
                throw new \LogicException("$key is not a gettable member of " . __CLASS__);
        }
    }

    public function __set($key, $val)
    {
        throw new \LogicException("$key is not a settable member of " . __CLASS__);
    }

    protected function setValue($key, $val)
    {
        switch ($key)
        {
            case 'name':
                $key = 'ref';   // FIXME: Missing break?
            case 'ref':
                $this->_data[$key] = trim($val);
                break;
            case 'id':
            case 'outer_width':
            case 'outer_length':
            case 'outer_depth':
            case 'inner_width':
            case 'inner_length':
            case 'inner_depth':
            case 'empty_weight':
            case 'max_weight':
                $this->_data[$key] = max(0.0, (float) $val);
                break;
        }
    }

    public function is_valid()
    {
        if (! $this->outer_width || ! $this->outer_length || ! $this->outer_depth)
        {
            return FALSE;
        }
        if (! $this->inner_width || ! $this->inner_length || ! $this->inner_depth)
        {
            return FALSE;
        }
        if (! $this->empty_weight || ! $this->max_weight)
        {
            return FALSE;
        }
        if ($this->outer_width <= $this->inner_width)
        {
            return FALSE;
        }
        if ($this->outer_length <= $this->inner_length)
        {
            return FALSE;
        }
        if ($this->outer_depth <= $this->inner_depth)
        {
            return FALSE;
        }
        if ($this->max_weight <= $this->empty_weight)
        {
            return FALSE;
        }

        return TRUE;
    }

} // end of class

#
# EOF
#
?>
