<style type="text/css">
    <!--
    table { vertical-align: top; }
    tr    { vertical-align: top; }
    td    { vertical-align: top; }
    .midnight-blue{
        background:#2c3e50;
        padding: 4px 4px 4px;
        color:white;
        font-weight:bold;
        font-size:12px;
    }
    .silver{
        background:white;
        padding: 3px 4px 3px;
    }
    .clouds{
        background:#ecf0f1;
        padding: 3px 4px 3px;
    }
    .border-top{
        border-top: solid 1px #bdc3c7;
        
    }
    .border-left{
        border-left: solid 1px #bdc3c7;
    }
    .border-right{
        border-right: solid 1px #bdc3c7;
    }
    .border-bottom{
        border-bottom: solid 1px #bdc3c7;
    }
    table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
    }
    -->
    </style>
    
    <page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
            <page_footer>
            <table class="page_footer">
                <tr>
    
                    <td style="width: 50%; text-align: left">
                        
                    </td>
                    <td style="width: 50%; text-align: right">
                        &copy;
                    </td>
                </tr>
            </table>
        </page_footer>
        <table cellspacing="0" style="width: 100%;">
            <tr>
    
                <td style="width: 25%; color: #444444;">
                    <img style="width: 50px;" src="{{asset('assets/img/logo_login.png')}}" alt="Logo"><br>
                    
                </td>
                <td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                    <span style="color: #34495e;font-size:14px;font-weight:bold"></span>
                    <br><br> 
                    
                    
                    RUC:
                    
                </td>
                <td style="width: 25%;text-align:right">
                COMPROBANTE Nº 
                </td>
                
            </tr>
        </table>
        <br>
        
    
        
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
            <tr>
               <td style="width:100%;" class='midnight-blue'>PROVEEDOR</td>
            </tr>
            <tr>
               <td style="width:50%;" >
                
                {{$buy->provider->nombre}}
               </td>
            </tr>
            
       
        </table>
        
           <br>
            <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
            <tr>
               <td style="width:35%;" class='midnight-blue'>USUARIO</td>
              <td style="width:25%;" class='midnight-blue'>FECHA</td>
               <td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
            </tr>
            <tr>
               <td style="width:35%;">
                {{auth()->user()->name}}
               </td>
              <td style="width:25%;">
               {{$buy->created_at}}
              </td>
               <td style="width:40%;" >
                 {{ pago($buy->metodo_pago) }}   
               </td>
            </tr>
            
            
       
        </table>
        <br>
      
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
            <tr>
                <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
                <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
                <th style="width: 15%;text-align: right" class='midnight-blue'></th>
                <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
                
            </tr>
    
            @forelse($buy->details as $item)
            <tr>
                <td class='' style="width: 10%; text-align: center"> {{$item->cant_paq}} / {{$item->cant_und}} </td>
                <td class='' style="width: 60%; text-align: left"> {{$item->product->nombre}} </td>
                <td class='' style="width: 15%; text-align: right">&nbsp;</td>
                <td class='' style="width: 15%; text-align: right"> {{$item->costo}} </td>
                
            </tr>
            @empty
            @endforelse
            
    
      
          
            <tr>
                <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL $/. </td>
                <td style="widtd: 15%; text-align: right;"> </td>
            </tr>
            <tr>
                <td colspan="3" style="widtd: 85%; text-align: right;">IGV (<?php echo "18" ?>)%  </td>
                <td style="widtd: 15%; text-align: right;"> </td>
            </tr><tr>
                <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL $/.  </td>
                <td style="widtd: 15%; text-align: right;">{{$buy->costo_total_compra}}</td>
            </tr>
        </table>
        
        
        
        <br>
        
        
        
          
    
    </page>
    
    
    
    
    