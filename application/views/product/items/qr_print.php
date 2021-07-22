<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRcode Item</title>
</head>

<body>

    <img src="<?= base_url('upload/QR/items-' . $row->barcode . '.png') ?>" style="width :200px">
    <br><br>
    <?= $row->barcode ?>
</body>

</html>