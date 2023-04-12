
<?php
   // include "dataexcel.php";

?>
 <h2>Import Excel File into MySQL Database using PHP</h2>

	<div class="outer-container">
		<div class="row">
			<form class="form-horizontal" action="" method="post"
				name="frmExcelImport" id="frmExcelImport"
				enctype="multipart/form-data" onsubmit="return validateFile()">
				<div Class="input-row">
					<label>Choose your file. <a href="Template/import-template.xlsx"
						download>Download excel template</a></label>
					<div>
						<input type="file" name="file" id="file" class="file"
							accept=".ods,.xlsx">
					</div>
					<div class="import">
						<button type="submit" id="submit" name="import" class="btn-submit">Import
							Excel and Save Data</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="response"
		class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
<?php
$sqlSelect = "SELECT * FROM tbl_info";
$result = $db->select($sqlSelect);
if (! empty($result)) {
    ?>

    <table class='tutorial-table'>
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
			</tr>
		</thead>
<?php
    foreach ($result as $row) { // ($row = mysqli_fetch_array($result))
        ?>
        <tbody>
			<tr>
				<td><?php  echo $row['name']; ?></td>
				<td><?php  echo $row['description']; ?></td>
			</tr>
<?php
    }
    ?>
        </tbody>
	</table>
<?php
}
?>
