<div id="content" class="span10">
	<!-- content starts -->
	<div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title;?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                         
                      
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 30%;">Name</th>
                                <th style="width: 30%;">User Email</th>
                                <th style="width: 25%;">Comments</th>
                               <th style="width: 25%;">News </th>
                                <th style="width: 25%;">Poated Date </th>
                                <th style="width: 25%;">Publish </th>
                                <th style="width: 5%;">Action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($commentsList != 0 && count($commentsList) > 0) {
                        $count = 1;
                        foreach ($commentsList as $values) {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                  <td><?php echo $values->name; ?></td>
                                  <td><?php echo $values->email; ?></td>
                                    <td><?php echo $values->description; ?></td>
                                      <td><?php echo $values->news_title; ?></td>
                                        <td><?php echo $values->date; ?></td>
                                     
                                      <td>
                                    <?php  if($values->status == 'no'){ ?>
                                                                            <a href = "<?php echo base_url() . 'administrator/comments/updateAction' . '/' . $values->id . '/' . $values->status;?>"><?php echo $values->status; ?></a></td>

                                 <?php     } else{ ?>
<?php echo $values->status; ?>
                            <?php     }
                                  ?>
                                       
                                        <td><a href="<?php echo base_url() . 'administrator/comments/deleteAction' . '/' . $values->id ;?>"  onclick="return confirm('Make Sure Befor You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
</td>

                               
                            </tr>
                            <?php
                            $count++;
                            }
                            }
                    ?>
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
</div>