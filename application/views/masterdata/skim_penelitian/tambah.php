<script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>

</script>


<?php echo validation_errors(); ?>

<section class="content" id="form">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Skim Penelitian : Tambah Data</h3>
            <!-- Card-Tools -->
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: block;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="<?php echo base_url('skim_penelitian/tambah') ?>">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" id="inputEmail3" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="keterangan" id="" cols="30" rows="2" class="form-control" placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Maksimal Pengajuan</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" id="unlimited" name="maksimal_pengajuan" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Unlimited</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" id="limited" name="maksimal_pengajuan" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Limited</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row jumlah_maksimal_pengajuan" id="jumlah_maksimal_pengajuan">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Maksimal Pengajuan</label>
                                <div class="col-sm-10">
                                    <input type="number" name="jumlah_maksimal_pengajuan" class="form-control" placeholder="Jumlah Maksimal Pengajuan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Syarat</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio12" name="syarat" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio12">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio22" name="syarat" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio22">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div class="jumlah_syarat">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Syarat</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="jumlah_syarat" class="form-control" id="jumlah_syarat" placeholder="Jumlah Syarat">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Input Syarat</label>
                                    <div class="col-sm-10" id="list_syarat">
                                        <!-- <input type="text" name="list_syarat" class="form-control" id="inputEmail3" placeholder="Input Syarat"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Lama Penyelesaian</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio13" name="lama_penyelesaian" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio13">1 Tahun</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio23" name="lama_penyelesaian" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio23">Lebih dari 1 Tahun</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Wajib Laporan Kemajuan</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio14" name="wajib_laporan_kemajuan" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio14">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio24" name="wajib_laporan_kemajuan" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio24">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="custom-select" class="col-sm-2 col-form-label">Luaran Wajib</label>
                                <div class="col-sm-10">
                                    <select id="paket" name="paket[]" class="form-control" multiple="multiple">
                                        <?php foreach ($luaran as $row) { ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Maksimal Dana</label>
                                <div class="col-sm-10">
                                    <input type="number" name="maksimal_dana" class="form-control" id="inputEmail3" placeholder="Maksimal Dana">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                    <button type="submit" class="btn btn-danger">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('input[name="maksimal_pengajuan"]').on('change', function() {
        $('.jumlah_maksimal_pengajuan')
            .toggle(+this.value === 1 && this.checked);
    }).change();

    $('input[name="syarat"]').on('change', function() {
        $('.jumlah_syarat')
            .toggle(+this.value === 1 && this.checked);
    }).change();

    $('#jumlah_syarat').change(function() {
        $('#list_syarat').html(''); //added this to clear the div before setting inputs
        var num = $(this).val();
        for (var i = 0; i < num; i++) {
            $('#list_syarat').append('<input type="text" name="list_syarat[]" class="form-control" id="inputEmail3" placeholder="Input Syarat"><br>');
        }
    });
</script>

<script>
    $(document).ready(function() {

        $("#paket").select2({

            placeholder: "Silahkan Pilih"

        });
    });
</script>