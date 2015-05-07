<?php $this->load->view('partial/header_page.php'); ?>
<div id="box">
      <h1>HRMS</h1>
      <div class="block" id="block-login">
        <h2>Login Box</h2>
        <div class="content login">
             <?php if(strlen($error) > 0){ ?>
             <div class="flash">
        <div class="message error">
            <p><?php echo $error;?></p>
         </div>
        <?php };?>
          <form action="<?php site_url('home');?>" class="form login" method= "post">
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Email</label>
              </div>
              <div class="right">
                <input type="text" class="text_field" name= "email" />
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Password</label>
              </div>
              <div class="right">
                <input type="password" class="text_field" name="password" />
              </div>
            </div>
            <div class="group navform wat-cf">
              <div class="right">
                <input type="submit" value = "Submit">
                  
              </div>
            </div>
          </form>
        </div>
      </div>