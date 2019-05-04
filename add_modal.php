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
							<textarea style="width:100%" type="text" class="form-control" name="task_description"></textarea>
						</div>
					</div>
					<div style="height:5px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Task Status:</label>
						</div>
						<div class="col-lg-10">
							<select name="task_status" style="width:100%">
								<option value="volvo">On-track</option>
								<option value="saab">Not Started</option>
								<option value="mercedes">On Hold</option>
								<option value="audi">At Risk</option>
								<option value="audi">Delayed</option>
								<option value="audi">Completed</option>
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
							<textarea style="width:100%" type="text" class="form-control" name="comment"></textarea>
						</div>
					</div>
					
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>
