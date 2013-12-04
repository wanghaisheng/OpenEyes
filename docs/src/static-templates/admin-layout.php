<? include 'components/common.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<? include 'components/admin/head.php'; ?>
</head>
<body>
	<div class="container main" role="main">

                <? include 'components/header-logged-in-no-patient.php'; ?>

		<div class="container content">
                        <h1 class="badge admin">Admin</h1>

                        <div class="box content admin">
				<div class="row">
					<? include 'components/admin/sidebar.php'; ?>
					<? include 'components/admin/default-content.php'; ?>
				</div>
			</div>
		</div>
		<? include 'components/footer.php'; ?>
	</div>
</body>
</html>