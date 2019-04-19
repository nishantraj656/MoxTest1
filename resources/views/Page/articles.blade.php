@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Articles</div>

                <div class="card-body">
                    <div class="row">
                   <input type="text" class="form-control"  id="article" name="article" placeholder="Enter Articles" required />
                    <input type="hidden" name="id" id="id" value="null" />
                    
                   
                    </div>
                    <div id="msg"></div>

                    <div class="row m-2">
                            <button id="save" class="btn btn-primary">Save</button>
                    </div>

                    <div class="row m-2">
                           <div class="table">
                               <table class="table">
                                   <thead>
                                       <tr>
                                           <th>Articles</th>
                                           <th>Action</th>
                                       </tr>
                                   </thead>
                                   <tbody id="viewArticle">
                                       @foreach ($data as $d)
                                       <tr>
                                           <td>
                                               {{$d->Articles}}
                                           </td>
                                           <td>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <button id="{{$d->articleID}}" class="btn  btn-primary m-5 edit">
                                                            Edit</button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                            <button id="{{$d->articleID}}" class="btn btn-danger m-5 delete">
                                                                Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                        <tr> 
                                       @endforeach
                                     
                                   </tbody>
                               </table>
                           </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

       refresh();
        function refresh(){

   $.ajax({
           url:"{{url('/article/v')}}",
        
          type:'GET'
      }) 
    .done(function(data){
        $('#viewArticle').empty();

        data.forEach(function(data){

            //console.log(data.data);
        $('#id').val(null);

      let  template = "<tr><td>"+
                          data.data+                     
                    '</td><td><div class="row"><div class="col-sm-2 m-2">'+
                      '<button id="'+data.id+'" class="btn  btn-primary edit">Edit</button>'+
                    '</div><div class="col-sm-2 m-2">'+
                     '<button id="'+data.id+'" class="btn btn-danger delete">Delete</button>'+
                    '</div></div></td><tr>'; 
                            $('#viewArticle').append(template);
        })
      
      });

        }
   

$('#save').click(function(){
    message('Wait in Process ....... ')
    var article =  $('#article').val();
    $("#save").attr("disabled", true);
    var id = $('#id').val();
   
    let body = {_token:"{{csrf_token()}}",data:article,id:id};
    console.log("body : ",body);

    $.ajax({
            url:"{{url('/')}}/articles/s",
           data:body,
           type:'POST',
           error: function (data) {
        console.log(data);
        alert(" Can't do because: " + data);
        $("#save").attr("disabled", false);
    },
           
       }) 
       .done(function(data){
           console.log("Return data ",data)
        refresh();
        var article =  $('#article').val('');
        $("#save").attr("disabled", false);
        var id = $('#id').val('null');
        message('Data saved.....') ;                 
          
       });
});

$('body').on('click','.edit',function(){
    $('#msg').empty();
    var id= $(this).attr('id')
    console.log("ID : ",id);
    if(id>=0)
    {
        let data = {_token:"{{csrf_token()}}",id:id};
       
        let url ="{{url('/articles')}}/"+id+"/edit";
       
       $.ajax({
          url:url,
          type:'GET',         
          error: function (data) {
        console.log(data);
        alert(" Can't do because: " + data);
        $("#save").attr("disabled", false);
    },        
       }) 
       .done(function(data){
         //  console.log("Data Edit : ",data);
           data.forEach(element=>{
                    console.log("Data Edit : ",element.data);
                    $('#article').val(element.data);                   
                    $('#id').val(element.id);
           });
          
       });
    }
  
});

$('body').on('click','.delete',function(){
    $('#msg').empty();
    let id = $(this).attr('id');
    console.log("Change This : ",id);

    if(id>=0)
    {
        let data = {_token:"{{csrf_token()}}",id:id};
        console.log("Body ",data)

        let url ="{{url('/article/d')}}/"+id;
        console.log("URL : ",url);

       $.ajax({
        url:url,
          type:'DELETE',
          data:data ,
          error: function (data) {
        console.log(data);
        alert(" Can't do because: " + data);
        $("#save").attr("disabled", false);
    },        
       }) 
       .done(function(data){
           console.log("Data Delete ", data);
           message('Data removed.....') ; 
           refresh();
       });
    }

});

function message(data){
    $('#msg').empty();
  var  template = '<div class="text-success">'+data+'</div>';
  $('#msg').append(template);
}


$('#article').click(function(){
    $('#msg').empty();
})
  
});
</script>


@endsection
