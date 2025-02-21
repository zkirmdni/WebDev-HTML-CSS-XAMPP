<!DOCTYPE>
<html>
 
<?php
	include "include/config.php";
	if(isset($_POST['Simpan']))
	{
		$barangKODE = $_POST['barangKODE'];
		$barangNAMA = $_POST['barangNAMA'];
        $barangHARGA = $_POST['barangHARGA'];
		$barangTYPE = $_POST['barangTYPE'];
		mysqli_query($connection, "insert into pusatoleh values ('$barangKODE','$barangNAMA','$barangHARGA','$barangTYPE')");
		header("location:dashboard11.php");
	}

    $kategoribarang = mysqli_query($connection, "select * from jenisbarang")
?>

<head>
<title>PENJUALAN</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
</head>

<body>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10">
<div>
<h1 class="display-7">Pembelian Barang</h1>
</div>
</div>
<div class="col-sm-1"></div>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10">
<form method="POST">
<div class="mb-3 row">
<label for="barangKODE" class="col-sm-2 col-form-label">Kode Barang</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="barangKODE" name="barangKODE">
</div>
</div>
<div class="mb-3 row">
<label for="barangNAMA" class="col-sm-2 col-form-label">Nama Barang</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="barangNAMA" name="barangNAMA" >
</div>
</div>
<div class="mb-3 row">
<label for="barangHARGA" class="col-sm-2 col-form-label">Barang Harga</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="barangHARGA" name="barangHARGA">
</div>
</div>
<div class="mb-3 row">
<label for="barangTYPE" class="col-sm-2 col-form-label">Type Barang</label>
<div class="col-sm-10">
<select class="form-control" id="barangTYPE" name="barangTYPE">
                <?php while($row = mysqli_fetch_array($kategoribarang)) { ?>
                    <option value="<?php echo $row["barangTYPE"]?>">
                        <?php echo $row["barangTYPE"]?>
                    </option>
                <?php } ?>				
</select>
</div>
</div>
<div class="form-group row">
<div class="col-sm-2"></div>
<div class="col-sm-10">
<input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
<input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
</div>
</div>
</form>
<form method="POST">
  <div class="form-group row mb-2">
    <label for="search" class="col-sm-3">Nama Barang</label>
    <div class="col-sm-6">
      <input type="text" name="search" class="form-control" id="search" value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Nama Barang">
    </div>
    <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
  </div>
</form>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div>
            <h1 class="display-7">Data Pusat Oleh-Oleh</h1>
        </div>
    </div>
    <div class="col-sm-1"></div>
<table class="table table-hover table-dark">
<thead>
<tr>
<th scope="col">No</th>
<th scope="col">Kode Barang</th>
<th scope="col">Nama Barang</th>
<th scope="col">Harga Barang</th>
<th scope="col">Type Barang</th>
<th colspan="2" style="tex-align: center">Aksi</th>
</tr>
</thead>
<tbody>
<?php
    if(isset($_POST["kirim"]))
    {
        $search = $_POST['search'];
        $query = mysqli_query($connection, "SELECT pusatoleh.*, jenisbarang.barangTYPE FROM pusatoleh, jenisbarang WHERE barangNAMA LIKE '%".$search."%' AND pusatoleh.barangTYPE = jenisbarang.barangTYPE");
    }   else 
        {
            $query = mysqli_query($connection, "SELECT pusatoleh.*, jenisbarang.barangTYPE FROM pusatoleh, jenisbarang WHERE pusatoleh.barangTYPE = jenisbarang.barangTYPE");
        }
		$nomor = 1;
		while($row = mysqli_fetch_array($query))
		{    
		?>  
<tr>
<td><?php echo $nomor; ?></td>
<td><?php echo $row['barangKODE']; ?></td>
<td><?php echo $row['barangNAMA']; ?></td>
<td><?php echo $row['barangHARGA']; ?></td>
<td><?php echo $row['barangTYPE']; ?></td>
<td width="5px">
    <a href="dashboard12.php?ubah=<?php echo $row["barangKODE"]?>"
    class="btn btn-success btn-sm" title="edit">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
</td>
<td width="5px">
<a href="pusatolehapus.php?hapus=<?php echo $row["barangKODE"]?>"
    class="btn btn-danger btn-sm" title="hapus">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
</svg>
</td>
</tr>
<?php 
$nomor = $nomor + 1; ?>
<?php } ?>
</tbody>
</table>

</div>
</div> <!--penutup div buat form-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</body>
</html>