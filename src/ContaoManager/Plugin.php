<?php

declare(strict_types=1);

namespace Doublespark\ContaoCustomLoginBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Doublespark\ContaoCustomLoginBundle\DoublesparkContaoCustomLoginBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(DoublesparkContaoCustomLoginBundle::class)->setLoadAfter([ContaoCoreBundle::class])
        ];
    }
}
