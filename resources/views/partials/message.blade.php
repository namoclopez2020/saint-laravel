
@if ( session('status'))

    <script>
         display_msg(' {{ session('status')}} ' , 'success');
       
       
    </script>
   
@endif


    
@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
           
         
                display_msg(' {{ $error }} ' , 'error');
               
           
        @endforeach
        
    </script>
@endif