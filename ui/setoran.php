<?php

include_once 'connectdb.php';
session_start();



if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../index.php');
}


if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {

    include_once 'headeruser.php';
}

if (isset($_POST['btnsave'])) {

    $category = $_POST['txtcategory'];

    if (empty($category)) {

        $_SESSION['status'] = "Category Feild is Empty";
        $_SESSION['status_code'] = "warning";
    } else {

        $insert = $pdo->prepare("insert into tbl_setoran (category) values(:cat)");

        $insert->bindParam(':cat', $category);

        if ($insert->execute()) {
            $_SESSION['status'] = "Category Added successfully";
            $_SESSION['status_code'] = "success";
        } else {

            $_SESSION['status'] = "Category Added Failed";
            $_SESSION['status_code'] = "warning";
        }
    }
}


if (isset($_POST['btnupdate'])) {

    $category = $_POST['txtcategory'];
    $id = $_POST['txtsetoran_id'];

    if (empty($category)) {

        $_SESSION['status'] = "Category Feild is Empty";
        $_SESSION['status_code'] = "warning";
    } else {

        $update = $pdo->prepare("update tbl_setoran set category=:cat where setoran_id=" . $id);

        $update->bindParam(':cat', $category);

        if ($update->execute()) {
            $_SESSION['status'] = "Category Update successfully";
            $_SESSION['status_code'] = "success";
        } else {

            $_SESSION['status'] = "Category Update Failed";
            $_SESSION['status_code'] = "warning";
        }
    }
}


if (isset($_POST['btndelete'])) {

    $delete = $pdo->prepare("delete from tbl_setoran where setoran_id=" . $_POST['btndelete']);

    if ($delete->execute()) {
        $_SESSION['status'] = "Deleted";
        $_SESSION['status_code'] = "success";
    } else {

        $_SESSION['status'] = "Delete Failed";
        $_SESSION['status_code'] = "warning";
    }
} else {
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setoran Tunai</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h5 class="m-0">Setoran Tunai Form</h5>
                </div>


                <form action="" method="post">
                    <div class="card-body">


                        <div class="row">


                            <?php

                            if (isset($_POST['btnedit'])) {

                                $select = $pdo->prepare("select * from tbl_setoran where setoran_id =" . $_POST['btnedit']);

                                $select->execute();

                                if ($select) {
                                    $row = $select->fetch(PDO::FETCH_OBJ);

                                    echo '<div class="col-md-4">


               
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>

                      <input type="hidden" class="form-control" placeholder="Enter Category"  value="' . $row->setoran_id . '" name="txtsetoran_id" >

                      <input type="text" class="form-control" placeholder="Enter Category"  value="' . $row->category . '" name="txtcategory" >

                      
                    </div>

                    


                    <div class="card-footer">
                    <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
                    </div>



                    </div>';
                                }
                            } else {

                                echo '<div class="col-md-4">


                    <!--
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <input type="text" class="form-control" placeholder="Enter Category"  name="txtcategory" >
                    </div>
                    -->

                    <!-- Date and time -->
                    <div class="form-group">
                    <label>Tanggal Setor:</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" placeholder="mm/dd/yyyy"/>
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Moka</label>
                        <input type="number" min="1" step="any" class="form-control" placeholder="Total Uang Cash Aplikasi Moka" name="dTotMoka" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Total Laci</label>
                        <input type="number" min="1" step="any" class="form-control" placeholder="Total Uang Cash Laci" name="dTotLaci" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Total Belanja</label>
                        <input type="number" min="1" step="any" class="form-control" placeholder="Total Belanja Harian" name="dTotBelanja" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Total Ongkir Driver</label>
                        <input type="number" min="1" step="any" class="form-control" placeholder="Total Ongkir Driver" name="dTotOngkir" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Catatan Input</label>
                        <textarea class="form-control" placeholder="Catatan Input" name="txtNotes1" required></textarea>
                    </div>

                    <div class="icheck-success d-inline">
                        <input type="radio" name="rb" value="Cash" checked id="radioSuccess1">
                        <label for="radioSuccess1">
                            Approved
                        </label>
                    </div>

                    <div class="form-group">
                    </div>

                    <div class="form-group">
                        <label>Catatan Approve</label>
                        <textarea class="form-control" placeholder="Catatan Approve" name="txtNotes2" required></textarea>
                    </div>

                    <div class="card-footer">
                    <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
                    </div>



                    </div>';
                            }




                            ?>

                            <div class="col-md-8">

                                <table id="table_setoran" class="table table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Tanggal</td>
                                            <td>Moka</td>
                                            <td>Laci</td>
                                            <td>Action</td>
                                            <!--<td>Edit</td>
                                            <td>Delete</td> -->

                                        </tr>

                                    </thead>


                                    <tbody>

                                        <?php

                                        $select = $pdo->prepare("select * from tbl_setoran order by setoran_id DESC Limit 30");
                                        $select->execute();

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {

                                            echo '
<tr>
<td>' . $row->setoran_id . '</td>
<td>' . date('d-M-Y', strtotime($row->setoran_date))  . '</td>
<td>' . number_format($row->total_moka, 0, ',', '.') . '</td>
<td>' . number_format($row->total_laci, 0, ',', '.') . '</td>

<td>
    <div class="btn-group">
    <button type="submit" value="' . $row->setoran_id . '" class="btn btn-primary  btnEditNew" name="btnedit"><span class="fa fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit Setoran"></span></button>
    <button type="submit" value="' . $row->setoran_id . '" class="btn btn-danger  btndeleteNew"><span class="fa fa-trash" style="color:#ffffff" data-toggle="tooltip" title="Hapus Setoran"></span></button>
    </div>
</td>

<!--
<td>

<button type="submit" class="btn btn-primary" value="' . $row->setoran_id . '" name="btnedit">Edit</button>

</td>

<td>

<button type="submit" class="btn btn-danger" value="' . $row->setoran_id . '" name="btndelete">Delete</button>

</td>
-->

</tr>';
                                        }

                                        ?>

                                    </tbody>


                                    <tfoot>
                                        <tr>
                                            <td>#</td>
                                            <td>Tanggal</td>
                                            <td>Moka</td>
                                            <td>Laci</td>
                                            <td>Action</td>
                                            <!-- <td>Edit</td>
                                            <td>Delete</td>
                                            -->

                                        </tr>



                                    </tfoot>


                                </table>




                            </div>






                        </div>



                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php

include_once "footer.php";


?>

<?php

include_once "footer.php";


?>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

?>
    <script>
        Swal.fire({
            icon: '<?php echo $_SESSION['status_code']; ?>',
            title: '<?php echo $_SESSION['status']; ?>'
        });
    </script>
<?php
    unset($_SESSION['status']);
}
?>


<script>
    $(document).ready(function() {
        $('#table_setoran').DataTable();

        
    });

    $(function () {
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
            //Date and time picker
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
    })
</script>