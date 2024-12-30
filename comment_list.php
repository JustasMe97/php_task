<?php
$link = mysqli_connect("localhost","root","","comments");
$result = mysqli_query($link,"SELECT * FROM comments ORDER BY id DESC");
if(mysqli_num_rows($result)>0)
{
    ?>
    <div class="fw bold mb-2"><?php echo mysqli_num_rows($result)?> rezultatų(-ai)</div> <?php
	while($row=mysqli_fetch_object($result))
	{
		?>
    <div class="bg-light rounded p-2 mt-2 mb-2">
        <div class="d-flex">
		<div class="fw-bold"><?php echo $row->name;?></div>
        <div class="mx-1"><?php echo $row->comment_date;?></div>
        </div>
		<div class="col-md-5"><?php echo $row->comment_text;?></div>
		<div class="clearfix"></div>
		<p>&nbsp;</p>
    </div>
		<?php
	}
}
?>