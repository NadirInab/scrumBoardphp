<?php
	include "database.php" ;
    include('scripts.php');
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8" />
	<title>YouCode | Scrum Board</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN core-css ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<!-- ================== END core-css ================== -->
</head>
<body>
	<div id="app" class="app app-header-fixed app-sidebar-fixed">
		<div id="header" class="app-header">
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b class="me-1">YouCode</b> Projects</a>
				<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
		</div>

		<div class="app-sidebar-bg"></div>
		<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
		<div id="content" class="app-content" style="min-height: 100vh; background: url(assets/img/cover/cover-scrum-board.png) no-repeat fixed; background-size: 360px; background-position: right bottom;">
			<div class="d-flex align-items-center mb-3">
				<div>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
						<li class="breadcrumb-item active">Scrum Board </li>
					</ol>
					<h1 class="page-header mb-0">
						Scrum Board 
					</h1>
				</div>
				
				<div class="ms-auto">
				<a onClick="addTask()" href="#modal-task" data-bs-toggle="modal" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> Add Task</a>
				</div>
			</div>
			<?php if (isset($_SESSION['message'])): ?>
				<div class="alert alert-green alert-dismissible fade show">
				<strong>Success!</strong>
					<?php 
						echo $_SESSION['message']; 
						unset($_SESSION['message']);
					?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></span>
				</div>
			<?php endif ?>
			<div class="row">
					
				<div class="col-xl-4 col-lg-6">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">To do (<span id="to-do-tasks-count"><?= counter('1') ?></span>)</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="list-group list-group-flush rounded-bottom overflow-hidden panel-body p-0" id="to-do-tasks">
							<?php
								// to do
								getTasks('1');
							?>
						</div>
					</div>
				</div>

				<div class="col-xl-4 col-lg-6">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">In Progress (<span id="in-progress-tasks-count"><?= counter('2') ?></span>)</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="list-group list-group-flush rounded-bottom overflow-hidden panel-body p-0" id="in-progress-tasks">
							<?php
								// in progresse
								getTasks('2');
							?>
						</div>
					</div>
				</div>

				<div class="col-xl-4 col-lg-6">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Done (<span id="done-tasks-count"><?= counter('3') ?></span>)</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="list-group list-group-flush rounded-bottom overflow-hidden panel-body p-0" id="done-tasks">
							<?php
								// done .
								getTasks('3');
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<div class="modal fade" id="modal-task">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" id="form-task">
					<div class="modal-header">
						<h5 class="modal-title">Add Task</h5>
						<a href="#" class="btn-close" data-bs-dismiss="modal"></a>
					</div>
					<div class="modal-body">
							<!-- This Input Allows Storing Task Index  -->
							<input type="hidden" name="id" id="task-id">
							<div class="mb-3">
								<label class="form-label">Title</label>
								<input type="text" name="title" class="form-control" id="task-title"/>
							</div>
							<div class="mb-3">
								<label class="form-label">Type</label>
								<div class="ms-3">
									<div class="form-check mb-1">
										<input class="form-check-input" name="task-type" type="radio" value="1" id="task-type-feature"/>
										<label class="form-check-label" for="task-type-feature">Feature</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" name="task-type" type="radio" value="2" id="task-type-bug"/>
										<label class="form-check-label" for="task-type-bug">Bug</label>
									</div>
								</div>
								
							</div>
							<div class="mb-3">
								<label class="form-label">Priority</label>
								<select class="form-select" name="priority" id="task-priority">
									<option value="">Please select</option>
									<option value="1">Low</option>
									<option value="2">Medium</option>
									<option value="3">High</option>
									<option value="4">Critical</option>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Status</label>
								<select class="form-select" name="status" id="task-status">
									<option value="">Please select</option>
									<option value="1">To Do</option>
									<option value="2">In Progress</option>
									<option value="3">Done</option>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Date</label>
								<input type="date" name="date" class="form-control" id="task-date"/>
							</div>
							<div class="mb-0">
								<label class="form-label">Description</label>
								<textarea class="form-control" name="description" rows="10" id="task-description"></textarea>
							</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-white" data-bs-dismiss="modal" id="task-cancel-btn">Cancel</a>
						 <button type="submit" name="delete" class="btn btn-danger task-action-btn" id="task-delete-btn">Delete</button>
						<button type="submit" name="update" class="btn btn-warning task-action-btn" id="task-update-btn">Update</button> 
						<button type="submit" name="save" class="btn btn-primary task-action-btn" id="task-save-btn">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->
	<script src="scripts.js"></script>

	<script>
		//reloadTasks();
	</script>
</body>
</html>