<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/textGenerator/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/textgenerator')) {
            $cache->deleteTree(
                $dev . 'assets/components/textgenerator/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/textgenerator/', $dev . 'assets/components/textgenerator');
        }
        if (!is_link($dev . 'core/components/textgenerator')) {
            $cache->deleteTree(
                $dev . 'core/components/textgenerator/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/textgenerator/', $dev . 'core/components/textgenerator');
        }
    }
}

return true;