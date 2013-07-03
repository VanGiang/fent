 <?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div style="height:50px"></div>
<div class="row">
   <div class="centered seven columns">
       <h1 class="page-title">Sign In</h1>
   </div>
</div>
<div class="none"></div>

<div class="row">
    <div class="centered seven columns">
      <?php if(Yii::app()->user->hasFlash('sucessful')): ?>
        <div class="success alert">
            <?php echo Yii::app()->user->getFlash('sucessful'); ?>
        </div>
     <?php endif; ?>
     <?php if(Yii::app()->user->hasFlash('fail')): ?>
        <div class="danger alert">
            <?php echo Yii::app()->user->getFlash('fail'); ?>
        </div>
     <?php endif; ?>
              
      <form method='post'>        
          <?php echo CHtml::errorSummary($form); ?>    
          <div class="row" style="color: blue; font-size: 1.3em">
              <div class="field">
                  <?php echo CHtml::activeTextField($form, 'username', array('class' => 'text input', 'placeholder' => 'Username')); ?>
              </div>
          </div>          
          <div class="row" style="color: blue; font-size: 1.3em">
              <div class="field">
                  <?php echo CHtml::activePasswordField($form, 'password', array('class' => 'password input', 'placeholder' => 'Password')); ?>
              </div>
          </div>      
          <div style="height:20px"></div>
          <div class="row" style="color: blue; font-size: 8px">
              <label>
                <input name='SignInForm[rememberMe]' type="checkbox">
                 Log on automatically
              </label>
          </div>
          <div class="row"><?php echo CHtml::link('Forget your password ?', array('user/forgetPassword')); ?></div>
          <div style="height:40px"></div>
          <div class="medium primary btn centered three columns"><?php echo CHtml::submitButton('Sign in');?></div>
      </form>
    </div>
  </div>
<div class="none"></div>
