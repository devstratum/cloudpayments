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

namespace Devstratum\Module\Cloudpayments\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Response\JsonResponse;

/**
 * Helper for mod_cloudpayments
 *
 * @since   1.0.0
 */
class CloudpaymentsHelper
{
    /**
     * Method set Response
     *
     * @param   array   $response
     * @param   array   $message
     * @throws
     * @since   1.0.0
     */
    public static function setResponse($response, $message)
    {
        $app = Factory::getApplication();
        header('Content-Type: application/json');
        echo new JsonResponse($response, $message);
        $app->close();
    }
}