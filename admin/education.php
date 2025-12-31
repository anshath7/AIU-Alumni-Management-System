<?php include('db_connect.php'); ?>

<div class="container-fluid">
<style>
	input[type=checkbox]
	{
	  /* Double-sized Checkboxes */
	  -ms-transform: scale(1.5); /* IE */
	  -moz-transform: scale(1.5); /* FF */
	  -webkit-transform: scale(1.5); /* Safari and Chrome */
	  -o-transform: scale(1.5); /* Opera */
	  transform: scale(1.5);
	  padding: 10px;
	}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Education List</b>
						<span class="">
							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_education">
								<i class="fa fa-plus"></i> New
							</button>
						</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Institution</th>
									<th class="">Program</th>
									<th class="">Posted By</th>
									<th class="">Link</th> <!-- New Column -->
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$education =  $conn->query("SELECT e.*, u.name FROM education e INNER JOIN users u ON u.id = e.user_id ORDER BY id DESC");
								while($row = $education->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><b><?php echo ucwords($row['institution']) ?></b></p>
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['program']) ?></b></p>
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										<?php if (!empty($row['link'])): ?>
											<a href="<?php echo $row['link'] ?>" target="_blank"><?php echo $row['link'] ?></a>
										<?php else: ?>
											<p>No Link</p>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_education" type="button" data-id="<?php echo $row['id'] ?>">View</button>
										<button class="btn btn-sm btn-outline-primary edit_education" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_education" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	td {
		vertical-align: middle !important;
	}
	td p {
		margin: unset
	}
	img {
		max-width: 100px;
		max-height: 150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_education').click(function(){
		uni_modal("New Entry", "manage_education.php", 'mid-large')
	})
	
	$('.edit_education').click(function(){
		uni_modal("Manage Education", "manage_education.php?id=" + $(this).attr('data-id'), 'mid-large')
	})
	$('.view_education').click(function(){
		uni_modal("Education Opportunity", "view_education.php?id=" + $(this).attr('data-id'), 'mid-large')
	})
	$('.delete_education').click(function(){
		_conf("Are you sure to delete this post?", "delete_education", [$(this).attr('data-id')], 'mid-large')
	})

	function delete_education($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_education',
			method: 'POST',
			data: {id: $id},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)
				}
			}
		})
	}
</script>
