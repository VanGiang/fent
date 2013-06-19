<script src='<?php echo Yii::app()->baseUrl; ?>/js/request_view_page.js'></script>  
<div class="row">
    <div class="row">
        <?php 
            echo CHtml::label('Username: ', null); 
            echo $request->user->createViewLink() ;
        ?>
    </div>
    <div class="row">
        <?php 
            echo CHtml::label('Device: ', null); 
            echo $request->device->createViewLink() ;
        ?>
    </div>
    <HR/>
    <div class="row">
        <div class="two columns">
            <?php
            echo CHtml::label('Detail Request: ', null);
            echo "</br>" ;
            ?>
        </div>
        <div class="six columns" style="word-wrap: break-word;">
            <div class="row">
            <?php echo CHtml::label('Status:', null); ?>
            <?php 
                if ($request->status == Constant::$REQUEST_BEING_CONSIDERED){
                    $status = 'Waiting';
                } elseif ($request->status == Constant::$REQUEST_FINISH) {
                    $status = 'Finished';
                } elseif ($request->status == Constant::$REQUEST_REJECTED) {
                    $status = 'Rejected';
                } else {
                    $timestamp = time();
                    if ($request->request_end_time < $timestamp){
                        $status = 'Expired';
                    } else {
                        $status = 'Un-expired';
                    }
                }
                echo '<span id="status">'.$status.'</span>';
                ?></div>
            <div class="row">
                <?php if (Yii::app()->user->isAdmin && $status == 'Waiting'){
                        echo '<div class="row" id="button_group">';
                        echo '<div class="two columns">';
                        echo '<span class="small pretty success btn">';
                        echo CHtml::button('Accept', array('class' => 'accept_request_btn', 'request_id' => $request->id));
                        echo '</span>';
                        echo '</div>';
                        echo '<div class="two columns">';
                        echo '<span class="small pretty danger btn">';
                        echo CHtml::button('Reject', array('class' => 'reject_request_btn', 'request_id' => $request->id));
                        echo '</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
            </div>
            <?php echo CHtml::label('Reason:', null); ?>
            <span class="textarea"><?php echo $request->reason; ?></span>
            <br />
            <br />
            <?php echo CHtml::label('Time user request:', null); ?><br />
            <div class="five columns">
                <?php echo CHtml::label('Start:', null); ?>
                <?php echo DateAndTime::returnTime($request->request_start_time); ?>
            </div>
            <div class="five columns">
                <?php echo CHtml::label('End:', null); ?>
                <?php echo DateAndTime::returnTime($request->request_end_time); ?>
            </div>
            <br />
            <br />
            <?php echo CHtml::label('Time request:', null); ?><br />
            <div class="five columns">
                <?php echo CHtml::label('Start:', null); ?>
                <span id="start_time"><?php echo DateAndTime::returnTime($request->start_time); ?></span>
            </div>
            <div class="five columns">
                <?php echo CHtml::label('End:', null); ?>
                <?php echo DateAndTime::returnTime($request->end_time); ?>
            </div>
        </div>
    </div>
</div>
