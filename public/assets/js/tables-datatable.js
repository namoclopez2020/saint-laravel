/*$(function () {
    var dataTable = $('#datatable1').DataTable({
        responsive: {
            details: false
        }
    }
    );
    var dataTable1 = $('#myTable').DataTable({
        responsive: {
            details: true
        }
    }
     
    );
    
   
		

    $(document).on('sidebarChanged', function () {
        
        dataTable.columns.adjust();
        dataTable.responsive.recalc();
        dataTable.responsive.rebuild();
    });
   /* $(document).on('sidebarChanged', function () {
        
        dataTable1.columns.adjust();
        dataTable1.responsive.recalc();
        dataTable1.responsive.rebuild();
    });
   
  
});

*/   
   function almacen (){
         var dataTable = $('#almacen').DataTable({
            "language": {
               url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
               
            },
            'responsive': true,
            "ajax" : "/almacenes",
            "serverSide" : true,
            "processing" : true,
               "columns":[
               {data: "id"},
               {data:"nombre"},
               {data: "codigo"},
               {render: function(data,type,row){
                  return row['office']['nombre']
               }},
               {render: function(data,type,row){
                  $botones = "<div class='btn-group'>";
                  $botones +="<a href='/warehouse/"+row['id']+"/edit'  class='btn  btn-warning mr-1'  >";
                  $botones +="<i class='fa fa-edit'></i></a>";
                  $botones +="<button onclick='elim("+row['id']+")' class='btn  btn-danger'> <span class='fa fa-trash'></span></button>";
                  $botones +="</div>";
                  
                  return $botones;
               }}
            ]
         })
   };

   function sucursal (){
      var dataTable = $('#sucursal').DataTable({
         "language": {
            url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            
         },
         'responsive': true,
         "ajax" : "/sucursal",
         "serverSide" : true,
         "processing" : true,
         "columns":[
            {data: "id"},
            {data: "nombre"},
            {data: "direccion"},
            {data: "ruc"},
            {data:"email"},
            {data: "logo"},
            {data: "created_at"},
            
            {render: function(data,type,row){
               $botones = "<div class='btn-group'>";
               $botones +="<a href='/office/"+row['id']+"/edit'  class='btn  btn-warning mr-1'  >";
               $botones +="<i class='fa fa-edit'></i></a>";
               $botones +="<button onclick='elim("+row['id']+")' class='btn  btn-danger'> <span class='fa fa-trash'></span></button>";
               $botones +="</div>";
               
               return $botones;
            }}
         ]
      })
};

function proveedor (){
   var dataTable = $('#proveedor').DataTable({
      "language": {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         
      },
      'responsive': true,
      "ajax" : "/proveedor",
      "serverSide" : true,
      "processing" : true,
      "columns":[
         {data: "id"},
         {data: "nombre"},
         {data: "representante"},
         {data: "telefono"},
         {data:"ruc"},
         {data: "direccion"},
         
         
         {render: function(data,type,row){
            $botones = "<div class='btn-group'>";
            $botones +="<a href='/provider/"+row['id']+"/edit'  class='btn  btn-warning mr-1'  >";
            $botones +="<i class='fa fa-edit'></i></a>";
            $botones +="<button onclick='elim("+row['id']+")' class='btn  btn-danger'> <span class='fa fa-trash'></span></button>";
            $botones +="</div>";
            
            return $botones;
         }}
      ]
   })
};

function usuario (){
   var dataTable = $('#usuario').DataTable({
      "language": {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         
      },
      'responsive': true,
      "ajax" : "/usuario",
      "serverSide" : true,
      "processing" : true,
      "columns":[
         {data: "id"},
         {data: "name"},
         {data: "email"},
         {render: function(data,type,row){
            if(row['status']){
               estilo = "btn-success";
               texto = "Activo";
            }
            else{
               estilo = "btn-secondary";
               texto = "Inactivo";
            }
            $boton="<button onclick='estado("+row['id']+")' class='btn "+estilo+" rounded btn-sm'>"+texto+"</button>";
            return $boton;
         }},
         {render:function(data,type,row){
            return row['user_level']['name']
         }},
         {data:"created_at"},
         {data: "updated_at"},
         
         
         {render: function(data,type,row){
            $botones = "<div class='btn-group'>";
            $botones +="<a href='/user/"+row['id']+"/edit'  class='btn  btn-warning mr-1'  >";
            $botones +="<i class='fa fa-edit'></i></a>";
            $botones +="<button onclick='elim("+row['id']+")' class='btn  btn-danger'> <span class='fa fa-trash'></span></button>";
            $botones +="</div>";
            
            return $botones;
         }}
      ]
   })
};

function tabla (){
   var table = $('#myTable').DataTable({
      'responsive':true,
      
   });
}



function producto (){
   var dataTable = $('#producto').DataTable({
      "language": {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         
      },
      'responsive': true,
      "ajax" : "/producto",
      "serverSide" : true,
      "processing" : true,
      "columns":[
         {data: "id"},
         {data: "nombre"},
         {data: "codigo"},
         {data: "created_at"},
         {data: "esSerialText"},

         {render: function(data,type,row){
            return row['medida_paq']+"/"+row['medida_und'];
         }},
         {data: "fraccion"},
         {render:function(data,type,row){
            return row['min_paq']+"/"+row['min_und'];
         }},
         {render: function(data,type,row){
            botones = "<div class='btn-group'>";
            botones +="<a class='btn btn-info mr-2' href='#' data-toggle='modal' data-target='#myModalmostrar' onclick='mostrar("+row['id']+")'> &nbsp;&nbsp;+ info&nbsp;&nbsp;</a>";
            botones +="<a href='/product/"+row['id']+"/edit'  class='btn  btn-warning mr-1'  >";
            botones +="<i class='fa fa-pencil'></i></a>";
            if(parseInt(row['es_serial']) === 1){
               botones += "<a class='btn btn-info mr-2' href='#' data-toggle='modal' data-target='#myModalseriales' onclick='ver_seriales("+row['id']+")'> Seriales</a>";
            }
            botones +="<button onclick='elim("+row['id']+")' class='btn  btn-danger'> <span class='fa fa-trash'></span></button>";
            botones +="</div>";
            
            return botones;
         }}
      ]
   })
};


function compra (){
   var dataTable = $('#compra').DataTable({
      "language": {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         
      },
      'responsive': true,
      "ajax" : "/compras",
      "serverSide" : true,
      "processing" : true,
      "columns":[
         {data: "id"},
         {data: "created_at"},
         {render: function(data,type,row){
            return row['provider']['nombre'];
         }},
         {render: function(data,type,row){
            var pago = "";
            switch (row['metodo_pago']) {
               case "1":
                  pago ="Efectivo";
                   break;
               case "2":
                  pago ="Cheque";
                   break;
               case "3":
                 pago ="Transferencia Bancaria";
                   break;
               case "4":
                   pago ="Credito";
                   break;
           }
           return pago;
            
         }},
         {render:function(data,type,row){
            var res = "<span class='badge badge-pill badge-warning'>Parcial</span>";;
            if(row['status_compra']){
               res = "<span class='badge badge-pill badge-success'>Pagado</span>";
            }
            return res;
           
         }},
         {render: function(data,type,row){
            return row['pagado'];
         }},
         {render:function(data,type,row){
            return row['costo_total_compra'];
         }},

         {render: function(data,type,row){
            $botones = "<div class='btn-group'>";
            $botones +="<a class=\"btn btn-info mr-1\" href=\"#\" data-toggle=\"modal\" data-target=\"#myModalcompras\" onclick=\"mostrar('"+row['id']+"')\">Detalles</a>";
            $botones +="<a href=\"#\" onclick=\"detalles('"+row['id']+"')\" class=\"btn btn-secondary\"><span class=\"fa fa-print\"> PDF</span></a>";
            $botones +="</div>";
            
            return $botones;
         }}
      ]
   })
};


function cuentasPorPagar (){
   var dataTable = $('#cuentas_por_pagar').DataTable({
      "language": {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         
      },
      'responsive': true,
      "ajax" : "/cuentasPorPagar",
      "serverSide" : true,
      "processing" : true,
      "columns":[
         {data: "id"},
         {data: "created_at"},
         {data: "id"},
         {data: "pagado"},
         {data: "costo_total_compra"},
         {render: function(data,type,row){
            $botones = "<div class='btn-group'>";
            $botones +="<a class=\"btn btn-info mr-1\" href=\"#\" data-toggle=\"modal\" data-target=\"#myModalpago\" onclick=\"mostrar('"+row['id']+"')\">Pagar</a>";
            $botones +="</div>";
            
            return $botones;
         }}
      ]
   })
};

function crear_compra(){
   var table = $('#producto_compra_venta').DataTable({
      "language": {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         
      },

      //agregado de prueba
      "ajax" : "/producto",
      "serverSide" : true,
      "processing" : true,
      "responsive":true,
      "columns":[
         {data: "codigo"},
         {data: "nombre"},
         {render:function(data,type,row){
            return row['categorie']['nombre']
         }},
         {render:function(data,type,row){
            return row['stock_paq']+"/"+row['stock_und'];
         }},
         {render: function(data,type,row){
            return row['medida_paq']+"/"+row['medida_und'];
         }},
         {data: "es_serial"},  

         {render:function(data,type,row){
            $inputs= "<div class='form-group row'>";
            if(row['usa_empaque']){
               $inputs +="<input type=\"number\" class=\"form-control form-control-sm col-2 col-lg-2\"  id=\"cantidad_paq_"+row['id']+"\"  value=\"0\" >";
               $inputs +="<span class=\"col-4 col-lg-2\"> "+row['medida_paq']+" </span>";
               $inputs +="<input type=\"number\" class=\"form-control form-control-sm col-2 col-lg-2\"   id=\"cantidad_und_"+row['id']+"\"  value=\"0\" >";
               $inputs +="<span class=\"col-4 col-lg-2\"> "+row['medida_und']+"</span>";
            }else{
               $inputs +="<input type=\"number\" class=\"form-control form-control-sm col-3 ml-3\"   id=\"cantidad_und_"+row['id']+"\"  value=\"1\" >";
               $inputs +="<span class=\"col-4\"></span>";
            }

            $inputs +="</div>";
            
            return $inputs;
         
         }},
         {render:function(data,type,row){
            $input ="<input type=\"number\" class=\"form-control form-control-sm col-5\" id=\"costo_prod_"+row['id']+"\"  >";
            return $input;
         }},
         
         
         {render: function(data,type,row){
            $botones="<a class='btn btn-info'href=\"#\" onclick=\"agregar('"+row['id']+"')\"><i class=\"fa fa-plus\"></i></a>";
            
            return $botones;
         }}
      ],
      //fin  
      





      'columnDefs': [
         {
            'targets': [6,7],
            'render': function(data, type, row, meta){
               if(type === 'display'){
                  var api = new $.fn.dataTable.Api(meta.settings);

                  var $el = $('input, select, textarea', api.cell({ row: meta.row, column: meta.col }).node());

                  var $html = $(data).wrap('<div/>').parent();

                  if($el.prop('tagName') === 'INPUT'){
                     $('input', $html).attr('value', $el.val());
                     if($el.prop('checked')){
                        $('input', $html).attr('checked', 'checked');
                     }
                  } else if ($el.prop('tagName') === 'TEXTAREA'){
                     $('textarea', $html).html($el.val());

                  } else if ($el.prop('tagName') === 'SELECT'){
                     $('option:selected', $html).removeAttr('selected');
                     $('option', $html).filter(function(){
                        return ($(this).attr('value') === $el.val());
                     }).attr('selected', 'selected');
                  }

                  data = $html.html();
               }

               return data;
            }
         }
      ],
      
   });

   // Update original input/select on change in child row
   $('#example tbody').on('keyup change', '.child input, .child select, .child textarea', function(e){
       var $el = $(this);
       var rowIdx = $el.closest('ul').data('dtr-index');
       var colIdx = $el.closest('li').data('dtr-index');
       var cell = table.cell({ row: rowIdx, column: colIdx }).node();
       $('input, select, textarea', cell).val($el.val());
       if($el.is(':checked')){
          $('input', cell).prop('checked', true);
       } else {
          $('input', cell).removeProp('checked');
       }
   });
}

  

   
