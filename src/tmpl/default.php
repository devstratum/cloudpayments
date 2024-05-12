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

use Joomla\CMS\Language\Text;

/**
 * @param object $module
 * @param object $fields_list
 * @param string $currency_symbol
 */

$disabled = '';

?>

<div class="mod-cloudpayments" id="mod_cloudpayments_<?php echo $module->id; ?>" data-form-id="<?php echo $module->id; ?>">
    <div class="mod-cloudpayments__form">

        <?php if ($params->get('form_title')): ?>
            <div class="mod-cloudpayments__title">
                <span><?php echo $params->get('form_title'); ?></span>
            </div>
        <?php endif; ?>

        <div class="mod-cloudpayments__sums">
            <?php $flag_active=true; foreach ($fields_list as $key => $item): ?>
                <div class="mod-cloudpayments__sum">
                    <div class="mod-button<?php if ($flag_active) echo ' active'; ?>" data-form-id="<?php echo $module->id; ?>" data-sum-val="<?php echo $item->field_sum; ?>" data-sum-desc="<?php echo $item->field_desc; ?>"><?php echo $item->field_sum; ?> <?php echo $currency_symbol; ?></div>
                </div>
            <?php $flag_active=false; endforeach; ?>
            <?php if ($params->get('form_sumother')): ?>
                <div class="mod-cloudpayments__sum">
                    <div class="mod-button other" data-form-id="<?php echo $module->id; ?>" data-sum-val="other" data-sum-desc="<?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_SUMINPUT'); ?>"><?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_SUMOTHER'); ?></div>
                </div>
            <?php endif; ?>
        </div>

        <div class="mod-cloudpayments__fields">
            <div class="mod-cloudpayments__desc">
                <?php echo $fields_list->fields_list0->field_desc; ?>
            </div>
        </div>

        <?php if ($params->get('form_monthpay') && $params->get('form_email')): ?>
            <div class="mod-cloudpayments__fields">
                <div class="mod-cloudpayments__monthpay" data-form-id="<?php echo $module->id; ?>">
                    <div class="monthpay-switch"></div>
                    <div class="monthpay-text"><?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_MONTHPAY'); ?></div>
                </div>
                <input class="mod-input mod-input-text" type="hidden" name="cloudpayments_monthpay" value="0"/>
            </div>
        <?php endif; ?>

        <div class="mod-cloudpayments__fields">
            <div class="mod-cloudpayments__field field-cloudpayments_sum hidden required">
                <div class="mod-cloudpayments__input">
                    <input class="mod-input mod-input-number" type="number" name="cloudpayments_sum" value="<?php echo $fields_list->fields_list0->field_sum; ?>" placeholder="<?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_SUMINPUT'); ?>"/>
                </div>
                <div class="mod-cloudpayments__error"></div>
            </div>
            <?php if ($params->get('form_name')): ?>
                <div class="mod-cloudpayments__field field-cloudpayments_name required">
                    <div class="mod-cloudpayments__input">
                        <input class="mod-input mod-input-text" type="text" name="cloudpayments_name" placeholder="<?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_NAME'); ?>"/>
                    </div>
                    <div class="mod-cloudpayments__error"></div>
                </div>
            <?php endif; ?>
            <?php if ($params->get('form_email')): ?>
                <div class="mod-cloudpayments__field field-cloudpayments_email required">
                    <div class="mod-cloudpayments__input">
                        <input class="mod-input mod-input-text" type="email" name="cloudpayments_email" placeholder="<?php echo Text::_('MOD_CLOUDPAYMENTS_TEXT_EMAIL'); ?>"/>
                    </div>
                    <div class="mod-cloudpayments__error"></div>
                </div>
            <?php endif; ?>
        </div>

        <div class="mod-cloudpayments__alert"></div>

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