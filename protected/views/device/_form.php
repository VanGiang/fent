<script src='<?php echo Yii::app()->baseUrl; ?>/js/device_image.js'></script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'device-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>
        <div class="row">
            <p class="note">Fields with <span class="required">*</span> are required.</p>
        </div>
        
        <div class="row">
            <?php echo $form->errorSummary($model); ?>
            <div class="field">
                <?php echo $form->labelEx($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('class' => 'text input', 'placeholder' => 'Name')); ?>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <?php echo $form->labelEx($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('class' => 'textarea input', 'placeholder' => 'Description')); ?>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <?php echo $form->labelEx($model,'serial_number'); ?>
                <?php echo $form->textField($model,'serial_number',array('class' => 'text input', 'placeholder' => 'Serial number')); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="field">
                <?php echo $form->labelEx($model,'management_number'); ?>
                <?php echo $form->textField($model,'management_number',array('class' => 'text input', 'placeholder' => 'Management number')); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="field">
                <?php echo $form->labelEx($model,'model_number'); ?>
                <?php echo $form->textField($model,'model_number',array('class' => 'text input', 'placeholder' => 'Model number')); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="field">
                <?php echo $form->labelEx($model,'maker'); ?>
                <?php echo $form->textField($model,'maker',array('class' => 'text input', 'placeholder' => 'Maker')); ?>
            </div>
        </div>

        <div class="row">
            <div class="field four columns">
                <?php echo $form->labelEx($model,'status'); ?>
                <?php echo '<div class="wide picker">'; ?>
                <?php echo CHtml::activeDropDownList($model,'status',array(Constant::$DEVICE_NORMAL => 'Avalable', Constant::$DEVICE_UNAVALABLE => 'Unavalable')); ?>
                <?php echo '</div>'; ?>
            </div>
        </div>

        <div class="row">
            <div class="field four columns">
                <?php
                    if (isset($category_id)) {
                        $model->category_id = $category_id;
                    }
                    echo $form->labelEx($model,'category_id');
                    echo '<div class="picker">';
                    $categories = Category::model()->findAll();
                    $list = CHtml::listData($categories, 'id', 'name');
                    echo CHtml::activeDropDownList($model, 'category_id', $list);
                    echo '</div>';
                ?>
            </div>
        </div>
        
        <div class="row">
            All images:
        </div>
        
        <?php if(!$model->isNewRecord && basename($model->getMainImage()) != 'no-image.jpg') { ?>
            <div class="row">
                    <?php
                        $count = 0;
                        foreach ($model->getAllImages() as $image) {
                            $filename = basename($image);
                            echo '<div class="two columns" align="center"'."id={$count}>";
                            echo CHtml::image($image);
                            echo CHtml::button('Remove', array(
                                'class' => 'remove_btn',
                                'file_name' => $filename,
                                'device_id' => $model->id,
                                'div_id' => $count
                                )
                            );
                            echo '</div>';
                            $count += 1;
                            if ($count % 6 == 0) {
                                echo '</div>';
                                echo '<div class="row">';
                            }
                            
                        }
                    }?>
            </div>
        
        <div class="row buttons">
                <?php
                    echo "<div class='medium primary btn'>";
                    echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
                    echo '</div>';
                ?>
        </div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->