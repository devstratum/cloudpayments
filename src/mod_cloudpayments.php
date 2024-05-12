<?php
/**
 * @package         Cloudpayments
 * @version         0.9.1a
 * @author          Sergey Osipov <info@devstratum.ru>
 * @website         https://devstratum.ru
 * @copyright       Copyright (c) 2024 Sergey Osipov. All Rights Reserved
 * @license         GNU General Public License v2.0
 * @report          https://github.com/devstratum/cloudpayments/issues
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;

$app = Factory::getApplication();
$doc = $app->getDocument();

/**
 * @param   \Joomla\CMS\WebAsset\WebAssetManager $wa
 * @since   1.0.0
 */
$wa = $doc->getWebAssetManager();
$wa->getRegistry()->addRegistryFile('media/mod_cloudpayments/joomla.asset.json');

$wa->useScript('cloudpayments.core');
$wa->useScript('cloudpayments.main');
$wa->useStyle('cloudpayments.main');

// Currency
$currency_symbol = '';
switch ($params->get('form_currency')) {
    case 'RUB':
        $currency_symbol = '₽';
        break;
    case 'EUR':
        $currency_symbol = '€';
        break;
    case 'USD':
        $currency_symbol = '$';
        break;
}

// Options JS
$options = [
    'alerts' => [
        'error_required' => Text::_('MOD_CLOUDPAYMENTS_ERROR_REQUIRED'),
        'error_email' => Text::_('MOD_CLOUDPAYMENTS_ERROR_EMAIL'),
        'error_fields' => Text::_('MOD_CLOUDPAYMENTS_ERROR_FIELDS'),
    ]
];

$doc->addScriptOptions('mod_cloudpayments', $options);

// Fields
$fields_list = $params->get('fields_list');

require ModuleHelper::getLayoutPath('mod_cloudpayments', $params->get('layout', 'default'));