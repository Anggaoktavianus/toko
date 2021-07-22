
                        <table>

                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Total</th>
                                    <th>Dibayar</th>
                                    <th>Total Harga</th>
                                </tr>

                            </thead>

                            <tbody>
                               <?php
                                if( ! empty($transaksi)){
                                    $no = 1;
                                    foreach($transaksi as $data){
                                        $created_at = date('d-m-Y', strtotime($data->created_at));

                                        echo "<tr>";
                                        echo "<td>".$created_at."</td>";
                                        echo "<td>". $data->jual_nofak."</td>";
                                        echo "<td>".number_format($data->jual_total)."</td>";
                                        echo "<td>".number_format($data->jual_jml_uang)."</td>";
                                        echo "<td>".number_format($data->jual_kembalian)."</td>";
                                        echo "</tr>";
                                        $no++;
                                    }
                                }
                                ?> 
                            </tbody>
                            




