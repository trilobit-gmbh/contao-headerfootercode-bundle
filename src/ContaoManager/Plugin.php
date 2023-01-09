<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\HeaderfootercodeBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Plugin for the Contao Manager.
 *
 * @author trilobit GmbH <https://github.com/trilobitgmbh>
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Trilobit\HeaderfootercodeBundle\TrilobitHeaderfootercodeBundle')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle']),
        ];
    }
}
