<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Data
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/'.$data['kelas_id'].'/update') ?>" method="post">
                        <input type="hidden" name="kelas_id" value="<?= $data['kelas_id'] ?>" />
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" name="kelas" class="form-control" placeholder="Kelas" required value="<?= $data['kelas'] ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="kelas">Keterangan</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10"
                                placeholder="Keterangan"><?= $data['deskripsi'] ?></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>