<?php require_once "database_connection.php";?>
<style type="text/css">
	.btn-grey{
		background-color:#D8D8D8;
		color:#FFF;
	}
	.rating-block{
		background-color:#FAFAFA;
		border:1px solid #EFEFEF;
		padding:15px 15px 20px 15px;
		border-radius:3px;
	}
	.bold{
		font-weight:700;
	}
	.padding-bottom-7{
		padding-bottom:7px;
	}

	.review-block{
		background-color:#FAFAFA;
		border:1px solid #EFEFEF;
		padding:15px;
		border-radius:3px;
		margin-bottom:15px;
	}
	.review-block-name{
		font-size:12px;
		margin:10px 0;
	}
	.review-block-date{
		font-size:12px;
	}
	.review-block-rate{
		font-size:13px;
		margin-bottom:15px;
	}
	.review-block-title{
		font-size:15px;
		font-weight:700;
		margin-bottom:10px;
	}
	.review-block-description{
		font-size:13px;
	}
	.badge {
		font-size: 25px;
		font-weight: 200
	}

	.badge i {
		font-size: 20px;
		font-weight: 200
	}

	.about-rating {
		font-size: 15px;
		font-weight: 500;
		margin-top: 10px
	}

	.total-ratings {
		font-size: 12px
	}

	.bg-custom {
		background-color: #b7dd29 !important
	}

	.text-custom {
		color: #b7dd29 !important
	}

	.progress {
		margin-top: 2px;
		border-radius: 0px;
		padding-left: 0px
	}
</style>

<div class="container-fluid">

	<?php

global $connection;

$ratingDetails = "SELECT ratingNumber FROM tbl_product_rating";
$rateResult = mysqli_query($connection, $ratingDetails) or die("database error:" . mysqli_error($connection));

$ratingNumber = 0;
$count = 0;
$fiveStarRating = 0;
$fourStarRating = 0;
$threeStarRating = 0;
$twoStarRating = 0;
$oneStarRating = 0;

while ($rate = mysqli_fetch_assoc($rateResult)) {

	$ratingNumber += $rate['ratingNumber'];
	$count += 1;
	if ($rate['ratingNumber'] == 5) {
		$fiveStarRating += 1;
	} else if ($rate['ratingNumber'] == 4) {
		$fourStarRating += 1;
	} else if ($rate['ratingNumber'] == 3) {
		$threeStarRating += 1;
	} else if ($rate['ratingNumber'] == 2) {
		$twoStarRating += 1;
	} else if ($rate['ratingNumber'] == 1) {
		$oneStarRating += 1;
	}
}
$average = 0;

if ($ratingNumber && $count) {
	$average = $ratingNumber / $count;
}

$fiveStarRatingPercent = round(($fiveStarRating / 5) * 100);
$fiveStarRatingPercent = !empty($fiveStarRatingPercent) ? $fiveStarRatingPercent . '%' : '0%';

$fourStarRatingPercent = round(($fourStarRating / 5) * 100);
$fourStarRatingPercent = !empty($fourStarRatingPercent) ? $fourStarRatingPercent . '%' : '0%';

$threeStarRatingPercent = round(($threeStarRating / 5) * 100);
$threeStarRatingPercent = !empty($threeStarRatingPercent) ? $threeStarRatingPercent . '%' : '0%';

$twoStarRatingPercent = round(($twoStarRating / 5) * 100);
$twoStarRatingPercent = !empty($twoStarRatingPercent) ? $twoStarRatingPercent . '%' : '0%';

$oneStarRatingPercent = round(($oneStarRating / 5) * 100);
$oneStarRatingPercent = !empty($oneStarRatingPercent) ? $oneStarRatingPercent . '%' : '0%';

?>

<!--Write a Review -->
<div id="ratingSection" style="display:none;">
	<div class="container">
	<div class="card">
		<div class="row mt-4 ml-4">
			<div class="col-md-9">
				<form id="ratingForm" method="POST">
					<div class="form-group">
						<h4>Rate this product</h4>
						<button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
							<i class="fa fa-star" aria-hidden="true"></i></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
							<i class="fa fa-star" aria-hidden="true"></i></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
							<i class="fa fa-star" aria-hidden="true"></i></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
							<i class="fa fa-star" aria-hidden="true"></i></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
							<i class="fa fa-star" aria-hidden="true"></i></span>
						</button>
						<input type="hidden" class="form-control" id="rating" name="rating" value="1">
						<input type="hidden" class="form-control" id="product_id" name="product_id" value="12345678">
					</div>
					<div class="form-group">
						<label for="usr">Title*</label>
						<input type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="form-group">
						<label for="comment">Comment*</label>
						<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info" id="saveReview">Save Review</button>
						<button type="button" class="btn btn-info" id="cancelReview">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</div>
</div>


<!-- user's rating display-->
<div id="ratingDetails">
	<div class="container mt-4">
		<div class="card">
			<div class="row no-gutters">
				<div class="col-md-4 border-right">
					<div class="ratings text-center p-4 py-5"> <span class="badge bg-success"><?php printf('%.1f', $average);?>/5&nbsp;<i class="fa fa-star"></i></span>
					 <span class="d-block about-rating"><?php printf('%.1f', $average);?> Rating & <?php echo ($count); ?>&nbsp;Reviews</span>
					</div>
				</div>

				<div class="col-md-4">
					<div class="rating-progress-bars p-3 mt-2">
						<div class="d-flex align-items-center"> <span class="stars"> <span>5 <i class="fa fa-star text-success"></i></span> </span>
							<div class="col px-2">
								<div class="progress" style="height: 5px;">
									<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $fiveStarRatingPercent; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> <span class="percent"> <span>
								<?php echo $fiveStarRating; ?></span> </span>
							</div>
							<div class="d-flex align-items-center"> <span class="stars"> <span>4 <i class="fa fa-star text-custom"></i></span> </span>
								<div class="col px-2">
									<div class="progress" style="height: 5px;">
										<div class="progress-bar bg-custom" role="progressbar" style="width: <?php echo $fourStarRatingPercent; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div> <span class="percent"> <span><?php echo $fourStarRating; ?></span> </span>
							</div>
							<div class="d-flex align-items-center"> <span class="stars"> <span>3 <i class="fa fa-star text-primary"></i></span> </span>
								<div class="col px-2">
									<div class="progress" style="height: 5px;">
										<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $threeStarRatingPercent; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div> <span class="percent"> <span><?php echo $threeStarRating; ?></span> </span>
							</div>
							<div class="d-flex align-items-center"> <span class="stars"> <span>2 <i class="fa fa-star text-warning"></i></span> </span>
								<div class="col px-2">
									<div class="progress" style="height: 5px;">
										<div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $twoStarRatingPercent; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div> <span class="percent"> <span><?php echo $twoStarRating; ?></span> </span>
							</div>
							<div class="d-flex align-items-center"> <span class="stars"> <span>1 <i class="fa fa-star text-danger"></i></span> </span>
								<div class="col px-2">
									<div class="progress" style="height: 5px;">
										<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $oneStarRatingPercent; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div> <span class="percent"> <span><?php echo $oneStarRating; ?></span> </span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="p-3 mt-2 border-left">
							<h3>Review this product</h3>
							<label style="color: gray;">Share your thoughts with other customers</label>
							<br/>
							<button type="button" id="rateProduct" class="btn btn-primary">Write a product review</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- user's review display -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<hr/>
					<div class="review-block">
						<?php

$ratinguery = "SELECT rating_id, product_id, user_id, ratingNumber, title, comments, created_at, modified_at FROM tbl_product_rating";
$ratingResult = mysqli_query($connection, $ratinguery) or die("database error:" . mysqli_error($connection));

while ($rating = mysqli_fetch_assoc($ratingResult)) {
	$date = date_create($rating['created_at']);
	$reviewDate = date_format($date, "M d, Y");
	?>
							<div class="row">
								<div class="col-sm-2">
									<img src="image/default-user.png" class="img-rounded" height="50" width="50">
									<div class="review-block-name">By <a href="#">User</a></div>
									<div class="review-block-date"><?php echo $reviewDate; ?></div>
								</div>

								<div class="col-sm-9">
									<div class="review-block-rate">
										<?php
for ($i = 1; $i <= 5; $i++) {
		$ratingClass = "btn-default btn-grey";
		if ($i <= $rating['ratingNumber']) {
			$ratingClass = "btn-default";
		}

		?>
											<button type="button" class="btn btn-xs<?php echo $ratingClass; ?>" aria-label="Left Align">
												<span><i class="fa fa-star" aria-hidden="true"></i></span>
											</button>
										<?php } //end-of-for?>
									</div>
									<div class="review-block-title"><?php echo $rating['title']; ?></div>
									<div class="review-block-description"><?php echo $rating['comments']; ?></div>
								</div>
							</div>
							<hr/>
						<?php } //end-of-while?>
					</div>
				</div>
			</div><!--row-->
		</div>
	</div><!--"ratingDetails"-->

<script type="text/javascript">
	$(function() {
// rating form hide/show
$( "#rateProduct" ).click(function() {
	$("#ratingDetails").hide();
	$("#ratingSection").show();
});
$( "#cancelReview" ).click(function() {
	$("#ratingSection").hide();
	$("#ratingDetails").show();
});
// implement start rating select/deselect
$( ".rateButton" ).click(function() {
	if($(this).hasClass('btn-grey')) {
		$(this).removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
		$(this).prevAll('.rateButton').removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
		$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');
	} else {
		$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');
	}
	$("#rating").val($('.star-selected').length);
});
// save review using Ajax
$('#ratingForm').on('submit', function(event){
	event.preventDefault();
	var formData = $(this).serialize();
	$.ajax({
		type : 'POST',
		url : 'saveRating.php',
		data : formData,
		success:function(data, status, response){
			alert(data);
			$("#ratingForm")[0].reset();
			window.setTimeout(function(){window.location.reload()},1000)
		},error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus);
			alert("Error: " + errorThrown);
		}
	});
});
});
</script>