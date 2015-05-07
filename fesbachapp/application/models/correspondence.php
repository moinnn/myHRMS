<?php

    class Correspondence extends CI_Model
    {
        
        function __construct()
        {
            parent::__construct();            
        }
        
        function email_notification($email, $name, $type, $option = '', $option2 = '')
        {
            $this->load->library('email');
            
            switch($type)
            {
                case VERIFICATION:
                    
                    $subject = "AGT Verification";
                    $message = "<i>Dear <b>".$name."</b></i>,<br>
                    
                                <p>You are just a step away from completing your registration process. Below is your verification code.</p>
                                <br>
                                <p>Verification code: <b>".$option."</b></p>
                                <br>
                                <p>Thanks.</p>
                                <br><br>
                                <p>The Africa Ground Transport Team</p>";
                                
                    break;
                
                case REGISTRATION:
                    $subject = "AGT Successful Registration!";
                    $message = "<i>Dear <b>".$name."</b></i>,<br>
                    
                                <p>Welcome to Africa Ground Transport, your full featured ground transport system.
                                <br>
                                <p>You have just registered successfully and can now access your account with the Email Address and password you created.</p>
                                <br><br>
                                <p>The Africa Ground Transport Team</p>";
                    
                    break;
                case NOTIFICATION:
                    $subject = "AGT Booking Notification!";
                    $message = "<i>Dear <b>Administrator</b></i>,<br>
                    
                                <p>".ucwords(strtolower($name))." just made a booking. Login into the admin area to process the booking.
                                <br>

                                <p>The Africa Ground Transport Team</p>";
                    break;
            }
            
            //building html
            $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>AGT</title>
                    </head>
                    
                    <body>
                    <table width="700" border="0" cellspacing="0" cellpadding="0" style="margin-left:auto; margin-right:auto; font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif; font-size:18px;">
                      <tr style="background:url('.base_url().'assets/images/agt_logo.jpg) top right no-repeat #f0f0f0;">
                        <td colspan="2">
                            <div style="width:618px; display:block; border:1px solid #999; margin-top:53px; border-top:none; padding:40px; line-height:30px; " >';
                            
            $footer = '<div style="clear:both"></div>
                    </div>
                        </td>
                      </tr>
                    </table>
                    </body>
                    </html>';
            
            
            //setting the html format
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            
            //echo "here";
            $this->email->from('Africa Ground Transport', 'no-reply@agt.com');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($html.$message.$footer);
            
            $this->email->send();
        }
        
        function sms_notification($fone, $name, $type, $option = '', $option2 = '')
        {            
            switch($type)
            {                
                case NOTIFICATION:
                    
                    $message = "Dear ".$name.",
A new member has been added to your downliners.
Your total downline is now ".$option.".

We wish you success.";
                    
                    break;
                
                case COMPLETE_TREE_NOTIFICATION:
                    
                    $message = "Congratulations ".$name."!
You have successfully completed the tree children requirement for your plan.
Please check your mail for more information.";
                    break;
                
                case ADDED_PLAN:
                    
                    $message = "Dear ".$name.",
We have confirmed your payment for the plan '".$option."'.

Your plan Id is ".$option2."

Happy Networking!";
                                
                    break;
            }
            
            //send verification code as sms
            $this->config->load('sms');
            
            $sms_username = $this->config->item('username');
            $sms_password = $this->config->item('password');
            $sms_route = $this->config->item('route');
            $sms_url = $this->config->item('url');
            
            $sms_param = array('username' => $sms_username, 'password' => $sms_password, 'route' => $sms_route);
            
            $this->load->helper('sms_helper');
            
            send_sms(foneFormatToSendSMS($fone), $message, SMS_TYPE, SENDER_ID, $sms_param, $sms_url);
        }
        
        
          function email_notify($email, $fname, $uname, $pass)
        {
            $this->load->library('email');
            
         
                
                    
                    $subject = "User Registration";
                    $message = "<i>Dear <b>".$fname."</b></i>,<br>
                    
                                <p>You are now a Registered member of the Fesbach User Application, below are your login details; </p>
                                <br>
                                <p>Username: <b>".$uname."</b></p>
                                <br>
                                <p>Password: <b>".$pass."</b></p>
                                <br>
                                <p>Thanks.</p>
                                <br><br>
                                <p> The Fesbach Team</p>";
                                
                    
            
            //building html
            $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>AGT</title>
                    </head>
                    
                    <body>
                    <table width="700" border="0" cellspacing="0" cellpadding="0" style="margin-left:auto; margin-right:auto; font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif; font-size:18px;">
                      <tr style="background:url('.base_url().'assets/images/agt_logo.jpg) top right no-repeat #f0f0f0;">
                        <td colspan="2">
                            <div style="width:618px; display:block; border:1px solid #999; margin-top:53px; border-top:none; padding:40px; line-height:30px; " >';
                            
            $footer = '<div style="clear:both"></div>
                    </div>
                        </td>
                      </tr>
                    </table>
                    </body>
                    </html>';
            
            
            //setting the html format
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            
            //echo "here";
            $this->email->from('Fesbach', 'no-reply@fesbach.org');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($html.$message.$footer);
            
            $this->email->send();
        }
        
        
        
    }