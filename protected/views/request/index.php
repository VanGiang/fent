<script src='<?php echo Yii::app()->baseUrl; ?>/js/request_list.js'></script> 

<div class="row">
    <h2>All requests</h2>
</div>
<div class='row'>
    <div class="medium primary btn two columns">
        <?php echo CHtml::button('Show search', array('id' => 'show_search'))?>
    </div>
</div>
<p>
<?php echo CHtml::beginForm(array('request/index'), 'get', array('id' => 'form_search', 'hidden' => 'hidden')); ?>
    <div class="row">
        <ul class="four columns">
            <li class="field">
                <div class="xxwide picker">
                    <?php
                        echo CHtml::dropDownList('status', $status, array(
                            'All' => 'All Requests',
                            Constant::$REQUEST_BEING_CONSIDERED => 'Being Considered Requests',
                            Constant::$REQUEST_UNEXPIRED => 'Un-expired Requests',
                            Constant::$REQUEST_EXPIRED => 'Expired Requests',
                            Constant::$REQUEST_FINISH => 'Finished Requests',
                            Constant::$REQUEST_REJECTED => 'Rejected Requests'
                            ));
                    ?>
                </div>
            </li>
        </ul>
    </div>

    <div class="row">
        <ul class="four columns">
            <li class="field">
                <div class="xxwide picker">
                    <?php
                        echo CHtml::dropDownList('type_search', $type_search, array(
                            'not_set' => 'No time field',
                            'request_end_time' => 'Request end time',
                            'request_start_time' => 'Request start time',
                            'end_time' => 'Borrow end time',
                            'start_time' => 'Borrow start time'
                            ));
                    ?>
                </div>
            </li>
        </ul>
        <div class="field three columns"> 
            <div class="field">
            <?php echo CHtml::textField('from', null, array('id' => 'from', 'placeholder' => 'From',
                'readonly' => 'readonly', 'date' => $from, 'class' => 'text input')); ?></div>        
        </div>

        <div class="field three columns"> 
            <?php echo CHtml::textField('to', null, array('id' => 'to', 
                'placeholder' => 'To', 'readonly' => 'readonly', 'date' => $to, 'class' => 'text input')); ?>        
        </div>
    </div>
    <div class="row">
        <div class="four columns">
            <label>
                <?php
                    echo CHtml::checkBox('no_time_given', $no_time_given, array('checked' => 'checked'));
                ?>
                Display no time given
            </label>
        </div>
    </div>
    <div class="row">
        <div class="medium primary btn two columns">
            <?php echo CHtml::submitButton('Search', array('id' => 'search-button1'));?>
        </div>
        <div class="medium danger btn two columns">
            <?php echo CHtml::Button('Reset', array('id' => 'reset_button'));?>
        </div>
    </div>

<?php echo CHtml::endForm(); ?>

<section class="sixteen colgrid">
    <div class="row">
        <div class="two columns">
            User
        </div>
        <div class="two columns">
            Device
        </div>
        <div class="two columns">
            Request start time
        </div>
        <div class="two columns">
            Request end time
        </div>
        <div class="two columns">
            Start time borrow
        </div>
        <div class="two columns">
            End time borrow
        </div>
        <div class="two columns devices">
            Status
        </div>
        <HR/>
    </div>
    
    <?php
        $timestamp = time();
        foreach ($requests as $request) {
            $this->renderPartial('/request/_view', array('request' => $request, 'timestamp' => $timestamp));
        }
    ?>
</section>
<div class="row">
    <?php
        if (isset($pages)) {
            $this->widget('CLinkPager', array(
                'pages' => $pages,
            )); 
        }
    ?>
</div>