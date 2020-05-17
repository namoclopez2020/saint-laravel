@if ($empaque)
    
    <div class="form-group">
        <text class="h3"> Cantidad en empaque</text>
    </div>
    <div class="form-group">
        <div class="row">
			<div class="col-md-4">
                <div class="input-group">
					<input type="number" class="form-control" name="fraccion" placeholder="Cantidad" required>
                </div>
            </div>
            <div class="col-md-6">
                <select class="form-control" name="medida_paq" id="medida_paq"  required>
                    <option value="">Medida para empaque</option>
                    <option value="paq">paquete</option>
                    <option value="kg">Kilos</option>
                    <option value="lt">Litros</option>
                </select>
            </div>
        </div>
    </div>
@endif

