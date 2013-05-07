<h1><?php echo $h1 ?></h1>
<div class="table-results">
	<table>
		<tr>
			<th></th>
			<th>Known to Self</th>
			<th>Not Known to Self</th>
		</tr>
		<tr>
			<th>Known to Others</th>
			<td>
				<h4>Arena</h4>
				<?php echo $arena ?>
			</td>
			<td>
				<h4>Blind Spot</h4>
				<?php echo $blind_spot ?>
			</td>
		</tr>
		<tr>
			<th>Not Known to Others</th>
			<td>
				<h4>Facade</h4>
				<?php echo $facade ?>
			</td>
			<td>
				<h4>Unknown</h4>
				<?php echo $unknown ?>
			</td>
		</tr>
	</table>
	<br/>
	<p>A link to vote for <?php echo $name ?>: <a href="<?php echo $base ?>?name=<?php echo $name ?>"><?php echo $base ?>?name=<?php echo $name ?></a></p>
	<p>A link to view <?php echo $name ?>'s results: <a href="<?php echo $base ?>?view=<?php echo $name ?>"><?php echo $base ?>?view=<?php echo $name ?></a></p>
</div>
