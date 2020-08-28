<style>
  .modal-xl {
    max-width: 100% !important;
}
</style>

<div class="modal fade" id="modalNuevaCompra" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl"   role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-light">
          <h5 class="modal-title">Nueva compra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="contenido">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-sm rounded" onclick="generar_compra()">Generar compra</button>
          <button type="button" class="btn btn-secondary btn-sm rounded" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>