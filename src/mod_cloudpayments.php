<?php
/**
 * @package         Cloudpayments
 * @version         1.0.0
 * @author          Sergey Osipov <info@devstratum.ru>
 * @website         https://devstratum.ru
 * @copyright       Copyright (c) 2024 Sergey Osipov. All Rights Reserved
 * @license         GNU General Public License v2.0
 * @report          https://github.com/devstratum/cloudpayments/issues
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

/**
 * @param   \Joomla\CMS\WebAsset\WebAssetManager $wa
 * @since   1.0.0
 */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->getRegistry()->addRegistryFile('media/mod_cloudpayments/joomla.asset.json');

$wa->useScript('cloudpayments.main');
$wa->useStyle('cloudpayments.main');

require ModuleHelper::getLayoutPath('mod_cloudpayments', $params->get('layout', 'default'));