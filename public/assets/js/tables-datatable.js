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
               {data: "nombre"},
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
         "ajax" : "/almacenes",
         "serverSide" : true,
         "processing" : true,
         "columns":[
            {data: "id"},
            {data: "nombre"},
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













   var table = $('#producto_compra_venta').DataTable({
      "language": {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         
      },
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
      'responsive': true
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

   
