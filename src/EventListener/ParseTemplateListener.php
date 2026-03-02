<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\HeaderfootercodeBundle\EventListener;

use Contao\Controller;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\PageModel;
use Contao\System;
use Contao\Template;

class ParseTemplateListener
{
    /**
     * Class ParseTemplateListener.
     */
    #[\Contao\CoreBundle\DependencyInjection\Attribute\AsHook('parseTemplate')]
    public function __invoke(Template $template)
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ((isset($GLOBALS['hfc_stop']) && true === $GLOBALS['hfc_stop'])
            || ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
            || 'fe_' !== substr($template->getName(), 0, 3)
        ) {
            return;
        }

        $bufferHead = '';
        $bufferFoot = '';

        global $objPage;

        $trail = PageModel::findWithDetails($objPage->id)->trail;

        foreach ($trail as $id) {
            $page = PageModel::findWithDetails($id);

            // current page
            if ($page->id === $objPage->id) {
                if ('0' === $page->hfc_mode) {
                    if (null !== $page->hfc_header && \strlen($page->hfc_header)) {
                        $bufferHead .= \PHP_EOL.$page->hfc_header;
                    }

                    if (null !== $page->hfc_footer && \strlen($page->hfc_footer)) {
                        $bufferFoot .= \PHP_EOL.$page->hfc_footer;
                    }
                } else {
                    if (null !== $page->hfc_header && \strlen($page->hfc_header)) {
                        $bufferHead = $page->hfc_header;
                    }

                    if (null !== $page->hfc_footer && \strlen($page->hfc_footer)) {
                        $bufferFoot = $page->hfc_footer;
                    }
                    break;
                }
            }

            // parent page(s)
            if ($page->id !== $objPage->id
                && '1' === $page->hfc_inheritance
            ) {
                if (null !== $page->hfc_header && \strlen($page->hfc_header)) {
                    $bufferHead .= \PHP_EOL.$page->hfc_header;
                }

                if (null !== $page->hfc_footer && \strlen($page->hfc_footer)) {
                    $bufferFoot .= \PHP_EOL.$page->hfc_footer;
                }
            }
        }

        /*
        // find all parents
        $parentPages = PageModel::findParentsById($objPage->id);

        $current = PageModel::findWithDetails($objPage->id);

        // worker
        while ($parentPages->next()) {
            var_dump([$parentPages->id, $parentPages->title]);

            $page = PageModel::findWithDetails($parentPages->id);

            // current page
            if ($page->id === $objPage->id) {
                if ('0' === $page->hfc_mode) {
                    if (null !== $page->hfc_header && \strlen($page->hfc_header)) {
                        $bufferHead .= \PHP_EOL.$page->hfc_header;
                    }

                    if (null !== $page->hfc_footer && \strlen($page->hfc_footer)) {
                        $bufferFoot .= \PHP_EOL.$page->hfc_footer;
                    }
                } else {
                    if (null !== $page->hfc_header && \strlen($page->hfc_header)) {
                        $bufferHead = $page->hfc_header;
                    }

                    if (null !== $page->hfc_footer && \strlen($page->hfc_footer)) {
                        $bufferFoot = $page->hfc_footer;
                    }
                    break;
                }
            }

            // parent page(s)
            if ($page->id !== $objPage->id
                && '1' === $page->hfc_inheritance
            ) {
                if (null !== $page->hfc_header && \strlen($page->hfc_header)) {
                    $bufferHead .= \PHP_EOL.$page->hfc_header;
                }

                if (null !== $page->hfc_footer && \strlen($page->hfc_footer)) {
                    $bufferFoot .= \PHP_EOL.$page->hfc_footer;
                }
            }
        }
        */

        $version = (method_exists(ContaoCoreBundle::class, 'getVersion') ? ContaoCoreBundle::getVersion() : VERSION);

        if (version_compare($version, '5.0', '<')
            && version_compare($version, '5.x-dev', 'ne')
        ) {
            $GLOBALS['TL_HEAD'][] = Controller::replaceInsertTags($bufferHead);
            $GLOBALS['TL_BODY'][] = Controller::replaceInsertTags($bufferFoot);
        } else {
            $insertTag = System::getContainer()->get('contao.insert_tag.parser');

            $GLOBALS['TL_HEAD'][] = $insertTag->replace($bufferHead);
            $GLOBALS['TL_BODY'][] = $insertTag->replace($bufferFoot);
        }

        $GLOBALS['hfc_stop'] = true;
    }
}
