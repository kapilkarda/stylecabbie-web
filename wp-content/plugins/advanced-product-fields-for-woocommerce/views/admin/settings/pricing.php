<?php
/* @var $model array */
?>

<div class="wapf-field__setting" data-setting="<?php echo $model['id']; ?>">

    <div class="wapf-setting__label">
        <label><?php _e($model['label'],'sw-wapf');?></label>
        <?php if(isset($model['description'])) { ?>
            <p class="wapf-description">
                <?php _e($model['description'],'sw-wapf');?>
            </p>
        <?php } ?>
    </div>

    <div class="wapf-setting__input">

        <div class="wapf-toggle" rv-unique-checkbox>
            <input rv-on-change="onChange" rv-checked="<?php echo $model['is_field_setting'] ? 'field' : 'settings'; ?>.pricing.enabled" type="checkbox" >
            <label class="wapf-toggle__label" for="wapf-toggle-">
                <span class="wapf-toggle__inner" data-true="<?php _e('Yes','sw-wapf'); ?>" data-false="<?php _e('No','sw-wapf'); ?>"></span>
                <span class="wapf-toggle__switch"></span>
            </label>
        </div>

        <div class="wapf-setting__pricing" rv-show="<?php echo $model['is_field_setting'] ? 'field' : 'settings'; ?>.pricing.enabled">
            <div>
                <select rv-on-change="onChange" rv-value="<?php echo $model['is_field_setting'] ? 'field' : 'settings'; ?>.pricing.type">
                    <?php
                    foreach(\SW_WAPF\Includes\Classes\Fields::get_pricing_options() as $k => $v) {
                        echo '<option ' . ($v['pro'] === true ? 'disabled' : '') . ' value="'.$k.'">'.$v['label'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <input rv-on-change="onChange" type="number" min="0" step="any" rv-value="<?php echo $model['is_field_setting'] ? 'field' : 'settings'; ?>.pricing.amount" />
            </div>
            <div style="text-align: right;width: 100%">
		        <?php \SW_WAPF\Includes\Classes\Html::help_modal("You can choose how an option should affect your product's pricing. The <b>flat fee</b> option increases the product price with a fixed fee, regardless of the quantity your customer enters. Quantity-based pricing and other options are available in <a href=\"https://studiowombat.com/plugin/advanced-product-fields-for-woocommerce/\" target=\"_blank\">the premium version</a>.", __('Help with pricing','sw-wapf'), __('help with pricing','sw-wapf')); ?>
            </div>
        </div>

    </div>
</div>