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

use Joomla\CMS\Language\Text;

/**
 * @param object $module
 * @param object $fields_list
 */

$disabled = '';

?>

<div class="mod-cloudpayments mod-cloudpayments-<?php echo $params->get('form_theme'); ?>" id="mod_cloudpayments_<?php echo $module->id; ?>" data-form-id="<?php echo $module->id; ?>">
    <div class="mod-cloudpayments__form">

        <?php if ($params->get('form_title')): ?>
            <div class="mod-cloudpayments__title">
                <span><?php echo $params->get('form_title'); ?></span>
            </div>
        <?php endif; ?>

        <div class="mod-cloudpayments__sums">
            <?php foreach ($fields_list as $key => $item): ?>
                <div class="mod-cloudpayments__sum">
                    <?php echo $item->field_sum; ?>
                </div>
            <?php endforeach; ?>
            <?php if ($params->get('form_sumother')): ?>
                <div class="mod-cloudpayments__sum">
                    <?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_SUMOTHER'); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($params->get('form_name')): ?>
            <div class="mod-cloudpayments__input">
                <input class="mod-input mod-input-text" type="text" name="cloudpayments_name" placeholder="<?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_NAME'); ?>"/>
            </div>
        <?php endif; ?>

        <?php if ($params->get('form_email')): ?>
            <div class="mod-cloudpayments__input">
                <input class="mod-input mod-input-text" type="text" name="cloudpayments_email" placeholder="<?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_EMAIL'); ?>"/>
            </div>
        <?php endif; ?>

        <?php if ($params->get('form_privacy')): ?>
            <?php $disabled = ' disabled'; ?>
            <div class="mod-cloudpayments__privacy">
                <div class="privacy-checkbox" data-form-id="<?php echo $module->id; ?>"></div>
                <?php if ($params->get('form_privacy_url')): ?>
                    <a class="privacy-link" href="<?php echo $params->get('form_privacy_url'); ?>" target="_blank"><?php echo $params->get('form_privacy_text'); ?></a>
                <?php else: ?>
                    <div class="privacy-link privacy-text"><?php echo $params->get('form_privacy_text'); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="mod-cloudpayments__submit">
            <button class="button-submit<?php echo $disabled; ?>"<?php echo $disabled; ?> data-form-id="<?php echo $module->id; ?>">
                <span><?php echo $params->get('form_submit'); ?></span>
            </button>
        </div>

    </div>
</div>