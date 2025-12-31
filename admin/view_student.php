<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT s.*,c.course,Concat(s.lastname,', ',s.firstname,' ',s.middlename) as name from student_bio s inner join courses c on c.id = s.course_id where s.id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<style type="text/css">
	p{
		margin:unset;
	}
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: block
	}
</style>
<div class="container-field">
		<hr>
		<div class="row">
			<div class="col-md-6">
				<p>Name: <b><?php echo $name ?></b></p>
				<p>Email: <b><?php echo $email ?></b></p>
				<p>Cohort: <b><?php echo $cohort ?></b></p>
                <p>Student ID: <b><?php echo $s_id ?></b></p>
				<p>Course: <b><?php echo $course ?></b></p>
			</div>
			<div class="col-md-6">
				<p>Gender: <b><?php echo $gender ?></b></p>
				<p>Account Status: <b><?php echo $status == 1 ? '<span class="badge badge-primary">Verified</span>' : '<span class="badge badge-secondary">Unverified</span>' ?></b></p>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-lg-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
			<?php if($status == 1): ?>
			<button class="btn float-right btn-primary update mr-2" data-status = '0' type="button" data-dismiss="modal">Unverify Account</button>
			<?php else: ?>
				<button class="btn float-right btn-primary update mr-2" data-status = '1' type="button" data-dismiss="modal">Verify Account</button>
			<?php endif; ?>
		</div>
	</div>
</div>
<script>
	$('.update').click(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=update_student_acc',
			method:"POST",
			data:{id:<?php echo $id ?>,status:$(this).attr('data-status')},
			success:function(resp){
				if(resp == 1){
					alert_toast("Student account status successfully updated.")
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
	})
</script>
