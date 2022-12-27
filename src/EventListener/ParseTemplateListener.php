<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
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
        $request = \Contao\System::getContainer()
            ->get('request_stack')
            ->getCurrentRequest()
        ;

        $isBackend = false;
        if ($request && \Contao\System::getContainer()
                ->get('contao.routing.scope_matcher')
                ->isBackendRequest($request)
        ) {
            $isBackend = true;
        }

        if ((isset($GLOBALS['hfc_stop']) && true === $GLOBALS['hfc_stop'])
            || $isBackend
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

            // current page
            if ($row->id === $objPage->id) {
                if ('0' === $row->hfc_mode) {
                    if (\strlen($row->hfc_header)) {
                        $bufferHead .= \PHP_EOL.$row->hfc_header;
                    }

                    if (\strlen($row->hfc_footer)) {
                        $bufferFoot .= \PHP_EOL.$row->hfc_footer;
                    }
                } else {
                    if (\strlen($row->hfc_header)) {
                        $bufferHead = $row->hfc_header;
                    }

                    if (\strlen($row->hfc_footer)) {
                        $bufferFoot = $row->hfc_footer;
                    }
                    break;
                }
            }

            // parent page(s)
            if ($row->id !== $objPage->id
                && '1' === $row->hfc_inheritance
            ) {
                if (\strlen($row->hfc_header)) {
                    $bufferHead .= \PHP_EOL.$row->hfc_header;
                }

                if (\strlen($row->hfc_footer)) {
                    $bufferFoot .= \PHP_EOL.$row->hfc_footer;
                }
            }
        }

        $GLOBALS['TL_HEAD'][] = Controller::replaceInsertTags($bufferHead);
        $GLOBALS['TL_BODY'][] = Controller::replaceInsertTags($bufferFoot);

        $GLOBALS['hfc_stop'] = true;
    }
}
