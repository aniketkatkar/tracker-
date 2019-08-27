<?php
	
?>
<!-- Add New -->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add New</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnew.php">
					<div  class="row">
						<div  class="col-lg-2">
							<label  class="control-label" style="position:relative; top:7px;">Task Name:</label>
						</div>
						<div  class="col-lg-10">
							<input style="width:100%" type="text" class="form-control" name="task_name">
						</div>
					</div>
					<div style="height:5px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Task Description:</label>
						</div>
						<div class="col-lg-10">
							<textarea style="width:100%" type="text" class="form-control" name="task_description" maxlength="400"></textarea>
						</div>
					</div>
					<div style="height:5px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Task Status:</label>
						</div>
						<div class="col-lg-10">
							<select name="task_status" style="width:100%">
							<option style="color:darkblue" value="On Track">On-track</option>
								<option value="Not Started">Not Started</option>
								<option style="color:orange" value="On Hold">On Hold</option>
								<option style="color:red" value="At Risk">At Risk</option>
								<option style="color:#cccc00" value="Delayed">Delayed</option>
								<option style="color:green" value="Completed">Completed</option>
							</select>
						</div>
					</div>
					<div style="height:5px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Due Date:</label>
						</div>
						<div class="col-lg-10">
							<input style="width:100%" type="date" class="form-control" name="due_date">
						</div>
					</div>
					<div style="height:5px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Completed on:</label>
						</div>
						<div class="col-lg-10">
							<input style="width:100%" type="date" class="form-control" name="completed_date">
						</div>
					</div>
					<div style="height:5px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Comments:</label>
						</div>
						<div class="col-lg-10">
							<textarea style="width:100%" type="text" class="form-control" maxlength="400" name="comment"></textarea>
						</div>
					</div>
					
                </div> 
				</div><p style="color:lightgrey">Max limit : 400 characters</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>
