<?php 
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

        <!-- CSS -->
        <link rel="stylesheet" href="style.css">
		<link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script>
	$(document).ready(function(){
		$('.dateFilter').datepicker({
			dateFormat: "yy-mm-dd"
		});
	});
	</script>
	<!--Script-->

</head>
<body>
	<!--Search Filter-->
	<div class="container">
	<form method='post' action=''>
        <div class="form-group pt-3">
            <input type='text' class='dateFilter' name='fromDate' value='<?php if(isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>' placeholder="Start Date">
            
            <input type='text' class='dateFilter' name='endDate' value='<?php if(isset($_POST['endDate'])) echo $_POST['endDate']; ?>' placeholder="End Date">
            <input type='submit' class="btn btn-outline-dark btn-sm" name='but_search' value='Search'>
            </div>
        </form>

	<!--Search Filter-->
	<!--for demo wrap-->
	<div class="tbl-header">
	  <table cellpadding="0" cellspacing="0" border="0">
		<thead>
		  <tr>
			<th>Followers Count</th>
			<th>Following Count</th>
			<th>Media Count</th>
			<th>Comments Count</th>
			<th>Likes Count</th>
			<th>Input Date</th>
		  </tr>
		</thead>
	  </table>
	</div>
	<div class="tbl-content">
	  <table cellpadding="0" cellspacing="0" border="0">
		<tbody>
		<?php
                $dat_query = "SELECT * FROM igwp WHERE 1 ";

                // Date filter
                if(isset($_POST['but_search'])){
                    $fromDate = $_POST['fromDate'];
                    $endDate = $_POST['endDate'];

                    if(!empty($fromDate) && !empty($endDate)){
                        $dat_query .= " and timestamp between '".$fromDate."' and '".$endDate."' ";
                    }
				}
				
				// Sort
				$dat_query .= "ORDER BY timestamp DESC";
				$dataRecords = mysqli_query($con,$dat_query);

				// Check records found or not
                if(mysqli_num_rows($dataRecords) > 1){
                    while($datRecord = mysqli_fetch_assoc($dataRecords)){
                        $followersCount = $datRecord['followers_count'];
                        $followsCount = $datRecord['follows_count'];
						$mediaCount = $datRecord['media_count'];
						$commentsCount = $datRecord['comments_count'];
						$likesCount = $datRecord['like_count'];
						$inputDate = $datRecord['timestamp'];
						
						echo "<tr>";
                        echo "<td>". $followersCount ."</td>";
                        echo "<td>". $followsCount ."</td>";
						echo "<td>". $mediaCount ."</td>";
						echo "<td>". $commentsCount ."</td>";
						echo "<td>". $likesCount ."</td>";
						echo "<td>". $inputDate ."</td>";
						echo "</tr>";
					}
                }else{
                    echo "<tr>";
                    echo "<td colspan='6'>No record found.</td>";
                    echo "</tr>";
                }
                ?>
		</tbody>
	  </table>
	</div>
</div>
  </section>
</body>
</html>
<section>
	