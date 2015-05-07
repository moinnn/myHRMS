 <?php  $this->load->view('partial/header_page.php');?>
<body>

    
     <div id="wrapper" class="wat-cf"><!--start of the main wrappers-->
      <div id="main">
        
        
        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <?php echo $access_uri;?>
          </div>
          
           <div class="content">
            <h2 class="title">Benefits list</h2>
           
                     
            <div class="inner">
              <!--form tag attached here-->
                 <div class="group">
                  <?php echo form_open('benefit/add_new_benefit'); ?>
                      <label class="label">Benefit Name</label>
                      <input type="text" name="benefit_type" class="text_field" /> <input type="submit"  name = "submit" value = "Add Benefit"/>
                      <br/><br/>
                      <?php echo form_close();?>
                    </div>
                 <!--form tag ends here-->
             
                <table class="table">
                  <thead>
                  <tr>
                    
                    <th>&nbsp;</th>
                    <th>Benefit Name</th>
                    <th>&nbsp;</th>
                    <th>Number Of Employees Assigned</th>
                    <th class="last">&nbsp;</th>
                    
                  </tr>
                  
                  </thead>
                  <tbody>
                 
                 <?php foreach ($query as $row){
                 	
                 		$benefit_type = $row['benefit_type'];

                	echo 
                			"<tr>
      								<td>&nbsp</td>
      								<td>$benefit_type</td>
                					<td>&nbsp</td>
                					<td>$employees_assigned</td>
                					<td>&nbsp</td>
                			</tr>";
                 	
                 	
                 }?> 
                  
                               
                  </tbody>
                </table>
                 
                  <div class="pagination">
                    
                        <?php #echo "<a href =".site_url('employees/index')." >$pagination</a>";?>
                     
                  </div>
               
            </div>
          </div>
        </div>
         <?php $this->load->view('partial/footer_page.php'); ?>
 <!--<span class="disabled prev_page">� Previous</span><span>1</span><a rel="next" href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a rel="next" class="next_page" href="#">Next �</a>-->