<?php if ($this->session->has_userdata('success')) {
?>
    <div class="alert alert-success alert-dismissible">
        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! &nbsp; <?= $this->session->flashdata('success'); ?></strong>
    </div>
<?php } ?>

<?php if ($this->session->has_userdata('error')) {
?>
    <div class="alert alert-danger alert-dismissible">
        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error! &nbsp; <?= $this->session->flashdata('error'); ?></strong>
    </div>
<?php } ?>