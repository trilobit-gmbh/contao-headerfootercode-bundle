<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Trilobit\HeaderfootercodeBundle;

use Contao\Controller;
use Contao\PageModel;

/**
 * Class HeaderFooterCode
 * Contain methods to handle the the header code
 */
class HeaderFooterCode extends Controller
{

    /**
     * @param \Template $objTemplate
     */
    public function add(\Template $objTemplate)
    {
        if (   $GLOBALS['hfc_stop'] === true
            || TL_MODE !== 'FE'
            || 'fe_' !== substr ($objTemplate->getName (), 0, 3)
        )
        {
            return;
        }


        $strBufferHead = '';
        $strBufferFoot = '';


        global $objPage;

        // find all parents
        $objParentPages = PageModel::findParentsById($objPage->id);

        // worker
        while ($objParentPages->next())
        {
            $objRow = PageModel::findWithDetails($objParentPages->id);

            // current page
            if (   $objParentPages->id == $objPage->id
                && (   strlen($objRow->hfc_header)
                    || strlen($objRow->hfc_footer)
                )
            )
            {
                // add header- and footer code
                if ($objRow->hfc_mode == 1)
                {
                    $strBufferHead .= PHP_EOL . $objRow->hfc_header;
                    $strBufferFoot .= PHP_EOL . $objRow->hfc_footer;
                }
                // only current header- and footer code
                else
                {
                    $strBufferHead = $objRow->hfc_header;
                    $strBufferFoot = $objRow->hfc_footer;

                    break;
                }
            }

            // parent page
            if (   $objParentPages->id != $objPage->id
                && $objRow->hfc_inheritance == 1
                && (   strlen($objRow->hfc_header)
                    || strlen($objRow->hfc_footer)
                )
            )
            {
                // add header code
                if (strlen($objRow->hfc_header))
                {
                    $strBufferHead .= PHP_EOL . $objRow->hfc_header;
                }

                // add footer code
                if (strlen($objRow->hfc_footer))
                {
                    $strBufferFoot .= PHP_EOL . $objRow->hfc_footer;
                }
            }
        }


        $GLOBALS['TL_HEAD'][] = $this->replaceInsertTags($strBufferHead);
        $GLOBALS['TL_BODY'][] = $this->replaceInsertTags($strBufferFoot);


        $GLOBALS['hfc_stop'] = true;
    }
}
