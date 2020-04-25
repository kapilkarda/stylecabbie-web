<?php /* @var $model array */ ?>

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
        <div style="width: 100%;" rv-show="field.choices | isNotEmpty">
            <div class="wapf-options__header">
                <div class="wapf-option__sort"></div>
                <div class="wapf-option__flex"><?php _e('Option label','sw-wapf'); ?></div>
                <!--<td style="font-weight:500;text-align: left;"><?php _e('Unique key','sw-wapf'); ?></td>-->
                <?php if(isset($model['show_pricing_options']) && $model['show_pricing_options']) { ?>
                    <div class="wapf-option__flex"><?php _e('Adjust pricing','sw-wapf'); ?></div>
                    <div class="wapf-option__flex"><?php _e('Pricing amount','sw-wapf'); ?></div>
                <?php } ?>
                <div class="wapf-option__selected"><?php _e('Selected', 'sw-wapf'); ?></div>
                <div  class="wapf-option__delete"></div>
            </div>
            <div rv-sortable-options="field.choices" class="wapf-options__body">
                <div class="wapf-option" rv-each-choice="field.choices" rv-data-option-slug="choice.slug">
                    <div class="wapf-option__sort"><span rv-sortable-option class="wapf-option-sort">☰</span></div>
                    <div class="wapf-option__flex"><input class="choice-label" rv-on-keyup="onChange" type="text" rv-value="choice.label"/></div>
                    <?php if(isset($model['show_pricing_options']) && $model['show_pricing_options']) { ?>
                        <div class="wapf-option__flex">
                            <select rv-on-change="onChange" rv-value="choice.pricing_type">
                                <option value="none"><?php _e('No price change','sw-wapf'); ?></option>
                                <?php
                                foreach(\SW_WAPF\Includes\Classes\Fields::get_pricing_options() as $k => $v) {
                                    echo '<option ' . ($v['pro'] === true ? 'disabled' : '') . ' value="'.$k.'">'.$v['label'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="wapf-option__flex">
                            <input rv-on-change="onChange" type="number" min="0" step="any" rv-value="choice.pricing_amount" />
                        </div>
                    <?php } ?>
                    <div class="wapf-option__selected" style="text-align: right;"><input data-multi-option="<?php echo isset($model['multi_option']) ? $model['multi_option'] : '0' ;?>" rv-on-change="field.checkSelected" rv-checked="choice.selected" type="checkbox" /></div>
                    <div class="wapf-option__delete"><a href="#" rv-on-click="field.deleteChoice" class="wapf-button--tiny-rounded">&times;</a></div>
                </div>
            </div>
        </div>

        <div style="padding-top:12px;text-align: right;width: 100%;">
            <a href="#" rv-on-click="field.addChoice" class="button button-small"><?php _e('Add option','sw-wapf'); ?></a>
        </div>
        <div style="text-align: right;width: 100%">
		    <?php \SW_WAPF\Includes\Classes\Html::help_modal("You can choose how an option should affect your product's pricing. The <b>flat fee</b> option increases the product price with a fixed fee, regardless of the quantity your customer enters. Quantity-based pricing and other options are available in <a href=\"https://studiowombat.com/plugin/advanced-product-fields-for-woocommerce/\" target=\"_blank\">the premium version</a>.", __('Help with pricing','sw-wapf'), __('help with pricing','sw-wapf')); ?>
        </div>
    </div>
</div>