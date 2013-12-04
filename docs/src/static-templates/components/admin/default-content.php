<div class="large-9 column">
	<div class="box admin">
		<h2>Content</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rhoncus a nulla sed semper. Nulla sodales bibendum consequat. Ut aliquet risus arcu, ac ultrices erat porttitor quis. Aenean iaculis sit amet nunc sit amet faucibus. </p>
		<p>Donec pretium tristique erat, at porttitor dui viverra sit amet. Quisque venenatis sed mi at pulvinar. Curabitur ac faucibus mauris. Mauris adipiscing mi mauris, et accumsan enim malesuada non. Pellentesque vitae elementum metus. Mauris vel mattis purus, et posuere justo. Proin vitae cursus sapien. Vestibulum leo orci, pulvinar id justo sit amet, consectetur volutpat diam. In hac habitasse platea dictumst. In iaculis tellus turpis, vel elementum massa vehicula id. In sollicitudin urna sit amet sapien lobortis semper. Sed convallis lorem vel ipsum rutrum sagittis sit amet id quam.</p>
	</div>
	<div class="box admin">
		<h2>A table</h2>
		<table class="grid">
			<thead>
				<tr>
					<th><input type="checkbox"></th>
					<th>ID</th>
					<th>Username</th>
					<th>Title</th>
					<th>First name</th>
					<th>Last name</th>
					<th>Access level</th>
					<th>Doctor</th>
					<th>Active</th>
				</tr>
			</thead>
			<tbody>
				<tr class="clickable">
					<td><input type="checkbox"></td>
					<td>1</td>
					<td>admin</td>
					<td>Mr</td>
					<td>Admin</td>
					<td>User</td>
					<td>Full</td>
					<td>Yes</td>
					<td>Yes</td>
				</tr>
				<tr class="clickable">
					<td><input type="checkbox"></td>
					<td>1</td>
					<td>admin</td>
					<td>Mr</td>
					<td>Admin</td>
					<td>User</td>
					<td>Full</td>
					<td>Yes</td>
					<td>Yes</td>
				</tr>
				<tr class="clickable">
					<td><input type="checkbox"></td>
					<td>1</td>
					<td>admin</td>
					<td>Mr</td>
					<td>Admin</td>
					<td>User</td>
					<td>Full</td>
					<td>Yes</td>
					<td>Yes</td>
				</tr>
			</tbody>
			<tfoot class="pagination-container">
				<tr>
					<td colspan="3">
						<button class="small primary event-action">Add</button>
						<button class="small primary event-action">Delete</button>
					</td>
					<td colspan="6">
						<ul class="pagination" >
							<li class="first unavailable"><a href="#">&lt;&lt; First</a></li>
							<li class="previous unavailable"><a href="#">&lt; Previous</a></li>
							<li class="page current"><a href="#">1</a></li>
							<li class="page"><a href="#?page=2">2</a></li>
							<li class="page"><a href="#?page=3">3</a></li>
							<li class="page"><a href="#?page=4">4</a></li>
							<li class="page"><a href="#?page=5">5</a></li>
							<li class="page"><a href="#?page=6">6</a></li>
							<li class="page"><a href="#?page=7">7</a></li>
							<li class="page"><a href="#?page=8">8</a></li>
							<li class="page"><a href="#?page=9">9</a></li>
							<li class="page"><a href="#?page=10">10</a></li>
							<li class="page"><a href="#?page=11">11</a></li>
							<li class="page"><a href="#?page=12">12</a></li>
							<li class="page"><a href="#?page=13">13</a></li>
							<li class="next"><a href="#?page=2">Next &gt;</a></li>
							<li class="last"><a href="#?page=204">Last &gt;&gt;</a></li>
						</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>


	<div class="box admin">
		<h2>A form</h2>
		<form action="/admin/editUser/2" method="post">
			<div class="row field-row">
				<div class="large-2 column">
					<label for="">Username:</label>
				</div>
				<div class="large-4 column end">
					<input type="text" />
				</div>
			</div>
			<div class="row field-row">
				<div class="large-2 column">
					<label for="">Title:</label>
				</div>
				<div class="large-2 column end">
					<input type="text" />
				</div>
			</div>
			<div class="row field-row">
				<div class="large-2 column">
					<label for="">Email:</label>
				</div>
				<div class="large-4 column end">
					<input type="text" />
				</div>
			</div>
			<fieldset class="row field-row">
				<legend class="large-2 column">Active:</legend>
				<input type="hidden">
				<div class="large-4 column end">
					<label class="inline highlight">
						<input checked="checked" type="radio">
						Yes
					</label>
					<label class="inline highlight">
						<input type="radio">
						No
					</label>
				</div>
			</fieldset>
			<div class="row field-row">
				<div class="large-2 column">
					<label for="">Password:</label>
				</div>
				<div class="large-4 column end">
					<input password="1" type="password">
				</div>
			</div>
			<div class="row field-row">
				<div class="large-2 column">
					<label for="">Confirm:</label>
				</div>
				<div class="large-4 column end">
					<input label="Confirm" password="1" type="password">
				</div>
			</div>
			<div class="row field-row">
				<div class="large-2 column">
					<label for="">Access Level:</label>
				</div>
				<div class="large-4 column end">
					<select>
						<option>No access</option>
					</select>
				</div>
			</div>
			<div class="row field-row">
				<div class="large-10 large-offset-2 column">
					<button class="button small primary event-action" type="submit">Save</button>
					<button class="warning button small primary event-action" type="submit">Cancel</button>
					<img class="loader" src="/img/ajax-loader.gif" alt="loading..." style="display: none;">
				</div>
			</div>
		</form>
	</div>
</div>