<?php 
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> News and Events List</h2>
                    </div>
                    <div class="box-content">
                        <?php
                        if ($this->session->flashdata('su_message')) {
                            ?>
                            <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                            <?php
                        }
                        ?>
                        <?php
                        if (in_array('news_add', $allowed)) {
                            ?><a href="<?php echo site_url(ADMIN_PATH . 'news/addNews'); ?>" class="btn btn-primary">New</a>
                            <?php
                        }
                        ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="15%">Title</th>
                                    <th>Category</th>
                                    <th width="35%">Description</th>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Flash</th>
                                    <th>Status</th>
            
                                    <th>action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($newsList != 0 && count($newsList) > 0) {
                                    $count = 1;
                                    foreach ($newsList as $values) {
                                        ?>
                                        <tr class="item">
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $values->news_title; ?></td>
                                            <td><?php echo $values->category_name; ?></td>
                                            <td><?php echo word_limiter(strip_tags($values->news_details), 25) ?></td>
                                            <td style="margin-right:5px">
                                                <?php echo $values->news_order; ?>
                                                -<a href="<?php echo site_url(ADMIN_PATH . "news/updateStatus/$values->news_id/$values->news_order/1/".$values->news_category) ?>">
                                                    <img src="<?php echo base_url(); ?>/style/img/arrow-desc.png" /></a>
                                                <a href="<?php echo site_url(ADMIN_PATH . "news/updateStatus/$values->news_id/$values->news_order/2/".$values->news_category) ?>">
                                                    <img src="<?php echo base_url(); ?>/style/img/arrow-asc.png" />
                                                </a></td>
                                            <td><?php echo $values->news_date; ?></td>
                                            <td>
                                                <a href="<?php echo site_url(ADMIN_PATH . 'news/changeFlash/' . $values->news_id . "/" . $values->flash . ""); ?>">
                                                        <?php echo $values->flash; ?>
                                                    </a>                                                
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url(ADMIN_PATH . 'news/changeStatus/' . $values->news_id . "/" . $values->news_status . ""); ?>">
                                                        <?php echo $values->news_status; ?>
                                                    </a>                                                
                                            </td>
                                            <td class="action">
                                                <?php
                                                if (in_array('news_update', $allowed)) {
                                                    ?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'news/updateNews/' . $values->news_id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if (in_array('news_delete', $allowed)) {
                                                    ?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'news/deleteNews/' . $values->news_id); ?>"  onclick="return confirm('Make Sure Befor You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                                    <?php
                                                }
                                                ?>
            
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
        </div>
    </div>

</div>