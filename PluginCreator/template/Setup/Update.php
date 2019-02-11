<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - FULL_PLUGIN_NAME
 *
 * @package   NAMESPACE_NAME
 *
 * @author    AUTHOR
 * @copyright YEAR Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace NAMESPACE_NAME\Setup;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;

class Update
{
    /**
     * Main bootstrap object.
     *
     * @var Plugin
     */
    protected $plugin;

    /**
     * ...
     *
     * @var InstallContext
     */
    protected $context;

    /**
     * ...
     *
     * @param Plugin         $plugin
     * @param InstallContext $context
     */
    public function __construct(Plugin $plugin, InstallContext $context)
    {
        // set params
        $this->plugin = $plugin;
        $this->context = $context;
    }

    /**
     * ...
     */
    public function install()
    {
        // install updates
        $this->update('0.0.0');
    }

    /**
     * ...
     *
     * @param string $version
     */
    public function update($version)
    {
    }
}
