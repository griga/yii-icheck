yii-icheck
==========

Wrapper arround [iCheck](http://fronteed.com/iCheck/) - customized checkboxes and radio buttons for jQuery

usage
-----
* unpack to <code>protected/extensions</code> folder

* inside <code>view</code>, <code>layout</code> or <code>controller</code>:

<pre>
$this->widget('ext.yii-icheck.ICheckWidget', array(
  'skin'=>'flat/red'
))
</pre>

* that's it =). All your checkboxes and radio buttons will be customized according to selected <code>skin</code>

options
-------

* <code>skin</code> - any of: 'minimal', 'minimal/red', 'minimal/blue' ... and so on skins. Full list of available skins you can find on [iCheck#skins](http://fronteed.com/iCheck/#skins) page.

* <code>selector</code> - jquery selector to apply widget. Default value is <code>input[type=checkbox], input[type=radio]</code>. Usefull when you need difrent styles for checkbox on same page:

<pre>
$this->widget('ext.yii-icheck.ICheckWidget', array(
  'skin'=>'square/yellow',
  'selector'=>'.yellow-form input[type=checkbox]',
));

$this->widget('ext.yii-icheck.ICheckWidget', array(
  'skin'=>'square/red',
  'selector'=>'.red-form input[type=checkbox]',
));
</pre>

* <code>options</code> - array of opions for widget. Full list of available options you can find on [iCheck#usage](http://fronteed.com/iCheck/#usage) page.

<pre>
$this->widget('ext.yii-icheck.ICheckWidget', array(
  'skin'=>'futurico',
  'options'=>array(
    'increaseArea'=>'50%',
  ),
));
</pre>
