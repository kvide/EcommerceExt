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

abstract class packing_profile
{
    // oversise handlers.
    const OSHANDLER_IGNORE = 'ignore';
    const OSHANDLER_ERROR = 'error';
    const OSHANDLER_USEWRAPPER = 'usewrapper';

    // no weight handlers
    const NWHANDLER_IGNORE = 'ignore';
    const NWHANDLER_ERROR = 'error';
    const NWHANDLER_USEDFLT = 'usedflt';

    // no dimensions handlers
    const NDHANDLER_IGNORE = 'ignore';
    const NDHANDLER_ERROR = 'error';
    const NDHANDLER_USEDFLT = 'usedflt';

    protected $_oversize_handler;
    protected $_oversize_wrapper;
    protected $_noweight_handler;
    protected $_noweight_dflt;

    // in EcommerceExt units
    protected $_nodimensions_handler;
    protected $_nodimensions_dflt;
    protected $_boxes;

    public function __construct(array $params = null)
    {
        $this->_oversize_handler = self::OSHANDLER_ERROR;
        $this->_oversize_wrapper = [
            'thickness' => 0,
            'weight' => 0
        ];
        $this->_noweight_handler = self::NWHANDLER_ERROR;
        $this->_noweight_dflt = 0;
        $this->_nodimensions_handler = self::NDHANDLER_ERROR;
        $this->_nodimensions_dflt = [
            'length' => 0,
            'width' => 0,
            'depth' => 0
        ];
    }

    public function __get($key)
    {
        switch ($key)
        {
            case 'oversize_handler':
            case 'oversize_wrapper':
            case 'noweight_handler':
            case 'noweight_dflt':
            case 'nodimensions_handler':
            case 'nodimensions_dflt':
                $key = '_' . $key;
                return $this->$key;
                break;
            case 'boxes':
                return $this->_boxes;
                break;
            default:
                throw new \LogicException("$key is not a gettable member of " . get_class($this));
        }
    }

    public function __set($key, $val)
    {
        throw new \LogicException("$key is not a settable member of " . get_class($this));
    }

    public function is_valid()
    {
        if ($this->_oversize_wrapper == self::OSHANDLER_USEWRAPPER)
        {
            if (! is_array($this->_oversize_wrapper))
            {
                return FALSE;
            }
            foreach (['length', 'width', 'depth', 'weight'] as $key)
            {
                if (\xt_param::get_float($this->_oversize_wrapper, $key) < 0.00001)
                {
                    return FALSE;
                }
            }
        }
        if ($this->_noweight_handler == self::NWHANDLER_USEDFLT)
        {
            if ($this->_noweight_dflt < 0.00001)
            {
                return FALSE;
            }
        }
        if ($this->_nodimensions_handler == self::NDHANDLER_USEDFLT)
        {
            if (! is_array($this->_nodimensions_dflt))
            {
                return FALSE;
            }
            foreach (['length', 'width', 'depth'] as $key)
            {
                if (\xt_param::get_float($this->_nodimensions_dflt, $key) < 0.00001)
                {
                    return FALSE;
                }
            }
        }
        if ((is_countable($this->_boxes) || is_array($this->_boxes)) && ! count($this->_boxes))
        {
            return FALSE; // no boxes.
        }
        foreach ($this->_boxes as $box)
        {
            if (! $box instanceof shipping_container)
            {
                return FALSE;
            }
            if (! $box->is_valid())
            {
                return FALSE;
            }
        }

        return TRUE;
    }

}

#
# EOF
#
?>
