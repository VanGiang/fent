<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs = array(
	'Profiles' => array('index'),
	$model->name,
);
?>

<div class="row">
    <h2>View Profile #<?php echo $model->id; ?></h2>
    </br>
    <div class="row">
        <div class="four column image photo">
            <?php echo CHtml::image(Yii::app()->baseUrl.'/images/'.$model->image,'No image', array('width' => 250)); ?>
        </div>
        
        <div class="six column push_one">
            <b><?php echo CHtml::encode('User'); ?>:</b>
                <?php
                    if ($model->user->username)
                        echo CHtml::encode($model->user->username);
                    else
                        echo CHtml::encode('No user');;
                ?>
            <br />

            <b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b>
            <?php echo CHtml::encode($model->email); ?>
            <br />

            <b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b>
            <?php echo CHtml::encode($model->name); ?>
            <br />

            <b><?php echo CHtml::encode($model->getAttributeLabel('phone')); ?>:</b>
            <?php echo CHtml::encode($model->phone); ?>
            <br />

            <b><?php echo CHtml::encode($model->getAttributeLabel('address')); ?>:</b>
            <?php echo CHtml::encode($model->address); ?>
            <br />

            <b><?php echo CHtml::encode($model->getAttributeLabel('employee_code')); ?>:</b>
            <?php echo CHtml::encode($model->employee_code); ?>
            <br />

            <b><?php echo CHtml::encode($model->getAttributeLabel('position')); ?>:</b>
            <?php echo CHtml::encode($model->position); ?>
            <br />

            <b><?php echo CHtml::encode($model->getAttributeLabel('date_of_birth')); ?>:</b>
            <?php echo CHtml::encode($model->date_of_birth); ?>
            <br />
            <?php 
            if (Yii::app()->user->isAdmin){
                echo '<span class="medium secondary btn">';
                echo CHtml::button('Update this profile', array('submit' => array('profile/update', 'id' => $model->id)));
                echo '</span>';
            }
            ?>
        </div>
    </div>
</div>