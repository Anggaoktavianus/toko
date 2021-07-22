<style>
    #invoice {
        padding: 10px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 100px;
        padding: 10px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 10px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 10px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 1em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 10px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>
<link rel="stylesheet" href="css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">


    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="">
                            <img src="" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="">
                                Barry
                            </a>
                        </h2>
                        <div>ALAMAT</div>
                        <div>Telepon</div>
                        <div>email@example.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">

                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE </h1>
                        <div class="date">Dicetak pada tanggal: <?= $row->created_at ?></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;

                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>Total Stock</td>
                            <td><?= number_format($row->t_stock)  ?></td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>Nilai Barang </td>
                            <td><?= indo_currency($row->nilai_barang)  ?></td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>Nilai Aset</td>
                            <td><?= indo_currency($row->nilai_aset) ?></td>
                            <td>RP</td>
                            <td>Nominal</td>
                        </tr>


                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?= indo_currency($row->sub_total) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Modal</td>
                            <td><?= indo_currency($row->modal) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?= indo_currency($row->income) ?></td>
                        </tr>
                    </tfoot>
                </table>

            </main>
            <footer>
                Invoice ini dicetak untuk keperluan stock opname toko barry
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>