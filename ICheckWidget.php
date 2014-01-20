<?php
/** Created by griga at 20.01.14 | 21:56.
 *
 * configurable plugin $options

// 'checkbox' or 'radio' to style only checkboxes or radio buttons, both by default
handle: '',

// base class added to customized checkboxes
checkboxClass: 'icheckbox',

// base class added to customized radio buttons
radioClass: 'iradio',

// class added on checked state (input.checked = true)
checkedClass: 'checked',

// if not empty, used instead of 'checkedClass' option (input type specific)
checkedCheckboxClass: '',
checkedRadioClass: '',

// if not empty, added as class name on unchecked state (input.checked = false)
uncheckedClass: '',

// if not empty, used instead of 'uncheckedClass' option (input type specific)
uncheckedCheckboxClass: '',
uncheckedRadioClass: '',

// class added on disabled state (input.disabled = true)
disabledClass: 'disabled',

// if not empty, used instead of 'disabledClass' option (input type specific)
disabledCheckboxClass: '',
disabledRadioClass: '',

// if not empty, added as class name on enabled state (input.disabled = false)
enabledClass: '',

// if not empty, used instead of 'enabledClass' option (input type specific)
enabledCheckboxClass: '',
enabledRadioClass: '',

// class added on indeterminate state (input.indeterminate = true)
indeterminateClass: 'indeterminate',

// if not empty, used instead of 'indeterminateClass' option (input type specific)
indeterminateCheckboxClass: '',
indeterminateRadioClass: '',

// if not empty, added as class name on determinate state (input.indeterminate = false)
determinateClass: '',

// if not empty, used instead of 'determinateClass' option (input type specific)
determinateCheckboxClass: '',
determinateRadioClass: '',

// class added on hover state (pointer is moved onto input)
hoverClass: 'hover',

// class added on focus state (input has gained focus)
focusClass: 'focus',

// class added on active state (mouse button is pressed on input)
activeClass: 'active',

// adds hoverClass to customized input on label hover and labelHoverClass to label on input hover
labelHover: true,

// class added to label if labelHover set to true
labelHoverClass: 'hover',

// increase clickable area by given % (negative number to decrease)
increaseArea: '',

// true to set 'pointer' CSS cursor over enabled inputs and 'default' over disabled
cursor: false,

// set true to inherit original input's class name
inheritClass: false,

// if set to true, input's id is prefixed with 'iCheck-' and attached
inheritID: false,

// set true to activate ARIA support
aria: false,

// add HTML code or text inside customized input
insert: ''


 Callbacks

ifClicked	user clicked on a customized input or an assigned label
ifChanged	input's checked, disabled or indeterminate state is changed
ifChecked	input's state is changed to checked
ifUnchecked	checked state is removed
ifToggled	input's checked state is changed
ifDisabled	input's state is changed to disabled
ifEnabled	disabled state is removed
ifIndeterminate	input's state is changed to indeterminate
ifDeterminate	indeterminate state is removed
ifCreated	input is just customized
ifDestroyed	customization is just removed

Methods

These methods can be used to make changes programmatically (any selectors can be used):

$('input').iCheck('check'); — change input's state to checked
$('input').iCheck('uncheck'); — remove checked state
$('input').iCheck('toggle'); — toggle checked state
$('input').iCheck('disable'); — change input's state to disabled
$('input').iCheck('enable'); — remove disabled state
$('input').iCheck('indeterminate'); — change input's state to indeterminate
$('input').iCheck('determinate'); — remove indeterminate state
$('input').iCheck('update'); — apply input changes, which were done outside the plugin
$('input').iCheck('destroy'); — remove all traces of iCheck
You may also specify some function, that will be executed on each method call:
$('input').iCheck('check', function(){
    alert('Well done, Sir');
});


 * @property array $defaultOptions
 */

class ICheckWidget extends CWidget
{
    public $skin = "minimal";

    public $selector = 'input[type=checkbox], input[type=radio]';

    public $options = array();

    public function run()
    {
        $this->registerScripts();
    }

    public function registerScripts()
    {
        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $url = Yii::app()->assetManager->publish(__DIR__ . '/assets');
        if (YII_DEBUG) {
            $cs->registerScriptFile($url . '/icheck.js');
        } else {
            $cs->registerScriptFile($url . '/icheck.min.js');
        }

        $options = CMap::mergeArray($this->defaultOptions, $this->options);

        if ($this->skin) {
            $cs->registerCssFile($url . '/skins/' . $this->getSkinUrl() . '.css');
            $options = CMap::mergeArray($options,
                array(
                    'checkboxClass' => 'icheckbox_' . $this->getThemedName(),
                    'radioClass' => 'iradio_' . $this->getThemedName(),
                ));
            $cs->registerScript(__CLASS__.$this->id, "$('".$this->selector."').iCheck(" . CJavaScript::encode($options) . ")", CClientScript::POS_READY);
        }
    }

    public function getNotColorizedSkins(){
        return array('minimal','square','flat','line','polaris','futurico');
    }

    public function getSkinUrl(){
        if(in_array($this->skin, $this->getNotColorizedSkins()))
            return $this->skin .'/'.$this->skin;
        else
            return $this->skin;
    }

    public function getThemedName()
    {
        return preg_replace('/\//', '-', $this->skin);
    }

    public function getDefaultOptions()
    {
        return array(
            'checkboxClass' => 'icheckbox_minimal',
            'radioClass' => 'iradio_minimal',
            'increaseArea'=>'20%'
        );
    }
}