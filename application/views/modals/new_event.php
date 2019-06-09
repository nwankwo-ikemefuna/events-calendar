<!-- New calendar event -->
<div class="modal fade" id="modal_new_event" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-left text-bold">New Events</h5>
                <div class="pull-right">
                    <button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
                </div>
            </div><!--/.modal-header--> 
            <div class="modal-body">
                
                <?php 
                $form_attributes = array("id" => "new_event_form");
                echo form_open(NULL, $form_attributes); ?>
                
                    <div class="form-group">
                        <label class="form-control-label">Event Date</label>
                        <input type="text" class="form-control datepicker_ymd" name="date" value="<?php echo set_value('date', date('Y/m/d')); ?>" required readonly />
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Event Time</label>
                        <input name="time" id="timepicker" type="text" class="form-control input-small" required readonly />
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label">Event Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo set_value('title'); ?>" required />
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label">Event Description</label>
                        <textarea name="description" class="form-control noresize" required maxlength="200"><?php echo set_value('description'); ?></textarea>
                    </div>
                    
                    <div class="status_msg"></div>
                    
                    <div>
                        <button class="btn btn-info">Submit</button>
                    </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>