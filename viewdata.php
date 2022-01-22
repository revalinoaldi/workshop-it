<?php require 'lib/koneksi.php'; ?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<title>PAGES 1 | FESTIVAL IT</title>
	<style type="text/css"></style>
</head>
<body>
	<div class="container-fluid">
		<!-- Wajib ngoding di sini -->
		<div class="row">
			<div class="col-6 col-lg-4" style="background: red">
				<h3>Menu</h3>
			</div>

			<?php  
				$sql = "SELECT * FROM mahasiswa";
				// $sql -> Di fungsikan sebagai perintah untuk memanggil semua isi data di table mahasiswa

				$query = mysqli_query($con, $sql);
				// $query menampung hasil dari perintah SELECT / $sql

				$row = mysqli_fetch_array($query);
				// $row fungsinya buat nampilin data

				$num = mysqli_num_rows($query);
				// $num fungsinya buat nampilin jumlah record/row/baris yang ada.
			?>


			<div class="col-6 col-lg-8" style="background: skyblue">
				<h2>Content</h2>
				<div class="row" style="background: magenta; margin: 50px;">
					<div class="col-5" style="background: white;">
						<h4>
							<?= $row['nama_lengkap'] ?>
						</h4>
					</div>
					<div class="col-7" style="background: white;">
						<h4>
							<?= $row['nama_panggilan'] ?>
						</h4>
					</div>
				</div>
				<div class="row" style="background: magenta; margin: 50px;">
					<div class="col-5" style="background: white;">
						<h4>
							<?= $row['jenjang'] ?>/
							<?= $row['semester'] ?>/
							<?= $row['kelas'] ?>
						</h4>
					</div>
					<div class="col-7" style="background: white;">
						<h4><?= $row['jurusan'] ?></h4>
					</div>
				</div>
				<div class="row" style="background: pink; margin: 50px;">
					<div class="col" style="background: white;">
						<h4>STMIK Bani Saleh</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>