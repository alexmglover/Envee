<?= form_open($mcp->form_base.AMP.'method=dump'); ?>
	
	<p>
		<label>Filename</label>
		<input type="text" name="dump_file_name" value="{db}_%m-%d-%Y" id="dump_file_name" />
		<span class="note">The filename will be passed through strftime so you can use applicable format options.</span>
	</p>
	
	<p>
		<input type="checkbox" name="drop_table_if_exists" value="y" checked="checked" />
		<label>Include "DROP TABLE IF EXISTS" statements</label>
	</p>
	<br />
	<h4>Tables to exclude from the dump:</h4><br />
	<?php foreach($tables as $table): ?>
		<p>
			<input type="checkbox" name="ignore_tables[]" value="<?= $table ?>"  />
			<label><?= $table ?></label>
		</p>
	<?php endforeach; ?>

	<p>Depending on the size of the database and web server configuration this might not work.</p>
	<p>
		<input type="submit" name="dump" value="Dump" />
	</p>

</form>