<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
            <?php
            if (validation_errors()) {
                ?>
                <div class="message error"><?php echo validation_errors(); ?></div> 
                <?php
            }
            ?>
            <?php
            $attributes = array('class' => 'formular');
            echo form_open(ADMIN_PATH . 'content/add', $attributes);
            ?>
            <table class="form">
                <tr>
                    <td class="col1" >
                        <?php
                        $attributes = array(
                            'class' => 'left',
                        );
                        echo form_label('Title:', 'username', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        $data = array(
                            'name' => 'content_title',
                            'id' => 'content_title',
                            'value' => set_value('content_title'),
                            'class' => 'medium',
                        );
                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Description:</label>
                    </td>
                    <td>
                        <textarea class="ckeditor" id="description"  style="width:100%"  name="content_description" ></textarea>
                    </td>
                </tr>
                <tr>
                            <td>
                                <label>
                                    Status:</label>
                            </td>
                            <td>
                              <?php $extra = 'style="width:390px;" class="chzn-select medium select"';
                                $options = array('home' => 'Home', 'others' => 'Others', );
                                echo form_dropdown('type', $options, set_value('type'), $extra);
                                ?> 
                            </td>
                        </tr>
                <tr>
                <tr>
                    <td>
                        <label>
                            &nbsp;</label>
                    </td>
                    <td>
                        <?php
                        $data = array(
                            'name' => 'submit',
                            'id' => 'submit',
                            'value' => 'Save',
                            'class' => 'btn btn-primary',
                        );
                        echo form_submit($data);
                        $data = array(
                            'name' => 'reset',
                            'id' => 'reset',
                            'value' => 'Clear',
                            'class' => 'btn btn-primary',
                        );
                        echo form_reset($data);
                        ?>
                    </td>
                </tr>
            </table>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>
</div>