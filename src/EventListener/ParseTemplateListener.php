<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-calculator-bundle
 */

namespace Trilobit\HeaderfootercodeBundle\EventListener;

use Contao\Controller;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\PageModel;
use Contao\Template;

class ParseTemplateListener
{
    /**
     * Class ParseTemplateListener.
     *
     * @Hook("parseTemplate")
     */
    public function __invoke(Template $template)
    {
        if ((isset($GLOBALS['hfc_stop']) && true === $GLOBALS['hfc_stop'])
            || TL_MODE !== 'FE'
            || 'fe_' !== substr($template->getName(), 0, 3)
        ) {
            return;
        }

        $bufferHead = '';
        $bufferFoot = '';

        global $objPage;

        // find all parents
        $parentPages = PageModel::findParentsById($objPage->id);

        // worker
        while ($parentPages->next()) {
            $row = PageModel::findWithDetails($parentPages->id);

            if ($row->id === $objPage->id
                && (\strlen($row->hfc_header) || \strlen($row->hfc_footer))
            ) {
                // add header- and footer code
                if ('0' === $row->hfc_mode) {
                    $bufferHead .= \PHP_EOL.$row->hfc_header;
                    $bufferFoot .= \PHP_EOL.$row->hfc_footer;
                }
                // only current header- and footer code
                else {
                    $bufferHead = $row->hfc_header;
                    $bufferFoot = $row->hfc_footer;
                    break;
                }
            }

            // parent page
            if ($row->id !== $objPage->id
                && '1' === $row->hfc_inheritance
                && (\strlen($row->hfc_header) || \strlen($row->hfc_footer))
            ) {
                // add header code
                if (\strlen($row->hfc_header)) {
                    $bufferHead .= \PHP_EOL.$row->hfc_header;
                }

                // add footer code
                if (\strlen($row->hfc_footer)) {
                    $bufferFoot .= \PHP_EOL.$row->hfc_footer;
                }
            }

            // current page
        }

        $GLOBALS['TL_HEAD'][] = Controller::replaceInsertTags($bufferHead);
        $GLOBALS['TL_BODY'][] = Controller::replaceInsertTags($bufferFoot);

        $GLOBALS['hfc_stop'] = true;
    }
}
