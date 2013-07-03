<?php
/* @var $this DeviceController */
/* @var $model Device */
?>
<div class="row centered">
    <h1>Create Device</h1>
    <?php echo $this->renderPartial('_form', array('model' => $model, 'category_id' => $category_id)); ?>
</div>