					<?php
     error_reporting(0);
     $b = $brg->row_array();
     ?>
					<!-- <table>
						<tr>
							<th style="width:200px;"></th>
							<th>Nama Barang</th>
							<th>Unit</th>
							<th>Stock</th>
							<th>Harga(Rp)</th>
							<th>Diskon(Rp)</th>
							<th>Jumlah</th>
						</tr>
						<tr>
							<td style="width:200px;margin-right:5px;">
							</td>

							<td><input type="text" name="name" value="<?php echo $b[
           'name'
       ]; ?>" style="width:300px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="unit_id" value="<?php echo $b[
           'unit_id'
       ]; ?>" style="width:100px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="stock" value="<?php echo $b[
           'stock'
       ]; ?>" style="width:100px;margin-right:5px;" class="form-control input-sm" readonly></td>
							<td><input type="text" name="harjul" value="<?php echo number_format(
           $b['price']
       ); ?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm" readonly></td>
							<td><input type="number" name="diskon" id="diskon" value="0" min="0" class="form-control input-sm" style="width:130px;margin-right:5px;" required></td>
							<td><input type="number" name="qty" id="qty" value="1" min="1" max="<?php echo $b[
           'qty'
       ]; ?>" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
							<td><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
						</tr>
					</table> -->


					<div class="col-md-3">
						<label for="name">Item Name</label>
						<input type="text" name="name" value="<?php echo $b[
          'name'
      ]; ?>" class="form-control" readonly>
					</div>
					 <div class="col-md-1">
						<label for="stock">Stock</label>
						<input type="text" name="stock" value="<?php echo $b[
          'stock'
      ]; ?>" class="form-control" readonly>
					</div>
					<div class="col-md-1">
						<div>
							<label for="unit">Unit</label>
						</div>
						<div class="form-group input-group">
							<input type="text" name="unit_id" value="<?php echo $b[
           'unit_id'
       ]; ?>" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-2">
						<div>
							<label for="price">Harga</label>
						</div>
						<div class="form-group input-group">
							<input type="text" required name="harjul" value="<?php echo number_format(
           $b['price']
       ); ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-2">
						<div>
							<label for="price">Diskon</label>
						</div>
						<div class="form-group input-group">
							<input type="number" name="diskon" id="diskon" value="0" min="0" class="form-control" placeholder="Diskon item">
						</div>
					</div>
					<div class="col-md-2">
						<div>
							<label for="jml">Jumlah</label>
						</div>
						<div class="form-group input-group">
							<input type="number" required name="qty" id="qty" value="1" min="1" max="<?php echo $b[
           'qty'
       ]; ?>" class="form-control" placeholder="Jumlah ">
						</div>
					</div>
					<div class="col-md-1">
						<div>
							<label for="">Proses</label>
						</div>
						<button type="submit" name="" class="btn btn-info text-white">
							<i class="fas fa-save">&nbsp; Pilih</i>
							</span>
					</div>