/**
 * @package         Cloudpayments
 * @version         0.9.1a
 * @author          Sergey Osipov <info@devstratum.ru>
 * @website         https://devstratum.ru
 * @copyright       Copyright (c) 2024 Sergey Osipov. All Rights Reserved
 * @license         GNU General Public License v2.0
 * @report          https://github.com/devstratum/cloudpayments/issues
 */

document.addEventListener('DOMContentLoaded', function() {
    const cloudpayments_options = Joomla.getOptions('mod_cloudpayments');

    // Check privacy confirm
    let privacy_checkbox = document.querySelectorAll('.mod-cloudpayments__privacy .privacy-checkbox');
    privacy_checkbox.forEach(function(item) {
        item.addEventListener('click', function() {
            let id = this.getAttribute('data-form-id');
            let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
            let cloudpayments_submit = cloudpayments_form.querySelector('.mod-cloudpayments__submit .button-submit');

            if (this.classList.contains('checked')) {
                this.classList.remove('checked');
                cloudpayments_submit.classList.add('disabled');
                cloudpayments_submit.setAttribute('disabled', '1');
            } else {
                this.classList.add('checked');
                cloudpayments_submit.classList.remove('disabled');
                cloudpayments_submit.removeAttribute('disabled');
            }
        });
    });

    // Check month pay
    let monthpays = document.querySelectorAll('.mod-cloudpayments__monthpay');
    monthpays.forEach(function(item) {
        item.addEventListener('click', function() {
            let id = this.getAttribute('data-form-id');
            let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
            let cloudpayments_monthpay = cloudpayments_form.querySelector('input[name="cloudpayments_monthpay"]');

            if (this.classList.contains('active')) {
                this.classList.remove('active');
                cloudpayments_monthpay.value = 0;
            } else {
                this.classList.add('active');
                cloudpayments_monthpay.value = 1;
            }
        });
    });

    // Sum control
    let sum_buttons = document.querySelectorAll('.mod-cloudpayments__sums .mod-button');
    sum_buttons.forEach(function(item) {
        item.addEventListener('click', function() {
            let id = this.getAttribute('data-form-id');
            let sum_val = this.getAttribute('data-sum-val');
            let sum_desc = this.getAttribute('data-sum-desc');
            setInputSum(id, sum_val, sum_desc);
            clearActiveSum(id);
            item.classList.add('active');
        });
    });
    function setInputSum(id, sum_val, sum_desc) {
        let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
        let cloudpayments_field = cloudpayments_form.querySelector('.mod-cloudpayments__field.field-cloudpayments_sum');
        let cloudpayments_sum = cloudpayments_form.querySelector('input[name="cloudpayments_sum"]');
        let cloudpayments_desc = cloudpayments_form.querySelector('.mod-cloudpayments__desc');

        if (sum_val === 'other') {
            cloudpayments_field.classList.remove('hidden');
            cloudpayments_sum.value = '';
            cloudpayments_desc.innerHTML = 'Enter Sum';
        } else {
            cloudpayments_field.classList.add('hidden');
            cloudpayments_sum.value = sum_val;
            cloudpayments_desc.innerHTML = sum_desc;
        }
    }
    function clearActiveSum(id) {
        let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
        let sum_buttons = cloudpayments_form.querySelectorAll('.mod-cloudpayments__sums .mod-button');
        sum_buttons.forEach(function(item) {
            item.classList.remove('active');
        });
    }

    // Action Submit
    let cloudpayments_submits = document.querySelectorAll('.mod-cloudpayments__submit .button-submit');
    cloudpayments_submits.forEach(function(item) {
        item.addEventListener('click', function() {
            let id = this.getAttribute('data-form-id');
            if (!this.getAttribute('disabled')) collectData(id);
        });
    });

    // Collect Data
    function collectData(id) {
        let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
        let cloudpayments_fields = cloudpayments_form.querySelectorAll('.mod-input');
        let cloudpayments_data = {};

        cloudpayments_fields.forEach(function(item) {
            let type = item.getAttribute('type');
            if (type !== 'file') {
                cloudpayments_data[item.getAttribute('name')] = item.value;
            }
        });

        let valid = validData(id, cloudpayments_data);

        if (valid) cpRequest(id, cloudpayments_data, cloudpayments_options);
    }

    // Validation Data
    function validData(id, data) {
        let errors = {};
        if (data.hasOwnProperty('cloudpayments_sum')) {
            if (!data.cloudpayments_sum) errors.cloudpayments_sum = cloudpayments_options.alerts.error_required;
        }
        if (data.hasOwnProperty('cloudpayments_name')) {
            if (!data.cloudpayments_name) errors.cloudpayments_name = cloudpayments_options.alerts.error_required;
        }
        if (data.hasOwnProperty('cloudpayments_email')) {
            if (!data.cloudpayments_email) {
                errors.cloudpayments_email = cloudpayments_options.alerts.error_required;
            } else {
                let reg = /\S+@\S+\.\S+/;
                if (!reg.test(data.cloudpayments_email)) errors.cloudpayments_email = cloudpayments_options.alerts.error_email;
            }
        }

        fieldsClear(id);

        if (Object.keys(errors).length !== 0) {
            fieldsUpdate(id, errors);
            setAlert(id, {type: 'warning', text: cloudpayments_options.alerts.error_fields});
            return false;
        }

        return true;
    }

    // Fields update
    function fieldsUpdate(id, errors) {
        let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
        Object.keys(errors).forEach(function(key) {
            let cloudpayments_input = cloudpayments_form.querySelector('.field-' + key + ' .mod-cloudpayments__input');
            let cloudpayments_error = cloudpayments_form.querySelector('.field-' + key + ' .mod-cloudpayments__error');
            cloudpayments_input.classList.add('error');
            cloudpayments_error.textContent = errors[key];
        });
    }

    // Fields Alert clear
    function fieldsClear(id) {
        let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
        let cloudpayments_alert = cloudpayments_form.querySelector('.mod-cloudpayments__alert');
        let cloudpayments_fields = cloudpayments_form.querySelectorAll('.mod-cloudpayments__field');

        cloudpayments_alert.innerHTML = '';
        cloudpayments_fields.forEach(function(item) {
            item.querySelector('.mod-cloudpayments__input').classList.remove('error');
            item.querySelector('.mod-cloudpayments__error').textContent = '';
        });
    }

    // Alert message
    function setAlert(id, message) {
        let cloudpayments_form = document.getElementById('mod_cloudpayments_' + id);
        let cloudpayments_alert = cloudpayments_form.querySelector('.mod-cloudpayments__alert');
        cloudpayments_alert.innerHTML = '<div class="mod-alert mod-alert-' + message.type + '">' + message.text + '</div>';
    }

    // CP Request
    function cpRequest(id, data, options) {
        console.log('valid');
    }
});