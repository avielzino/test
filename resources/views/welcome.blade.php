<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400);
.user_alert{
  position: absolute!important;
  z-index: 10000;
  width: 100%
}
.container {
    width: 400px;
    padding: 10px;
}

.message-blue {
  display: flex;
  flex-direction: row-reverse;
  justify-content: space-between;
    margin-left: 20px;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #A8DDFD;
    min-height: fit-content;
    text-align: left;
    font: 400 .9em 'Open Sans', sans-serif;
    border: 1px solid #97C6E3;
    border-radius: 10px;
}
.message-content {
  display: flex;
  flex-wrap: wrap;
    padding: 0;
    margin: 0;
    word-wrap:break-word;
    width: 100%;
}

.new_comment{

}
.add_comment_wrpr{
  box-shadow: 
    position: -webkit-sticky;
  position: sticky;
  top: 0;
  animation-name:addcomment;
  animation-duration:2s;
  animation-iteration-count:infinite;
  animation-direction:reverse;
  /* box-shadow: 2px 2px 5px 2px green; */

}
@keyframes addcomment{
0%{
  box-shadow: 1px 1px 2px 1p#31ABB8;
}
15%{
  box-shadow: 2px 2px 5px 2p#31ABB8;

}
25%{
  box-shadow: 2px 2px 5px 2px white;
}
50%{

  box-shadow: 2px 2px 5px 2px white;
}
100%{
  box-shadow: 2px 2px 5px 2px #31ABB8;

}

}
.delete_comment{
  width: 100%
}
ol {
   list-style: none;

}
small{
  color: gray
}

    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/70b159db2a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Comment Test</title>

   
</head>
<body>


    <div class="alert bg-info text-center user_alert text-light" role="alert" id="alertbar">
      {{session('alert')}}
     </div> 
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="#">IPanel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
    </header>
<div class="main_wrpr">
<div class="add_comment_wrpr">
    <form action="newpost" method="POST"  class="">
        @csrf
        <div class="input-group mb-3">
            <input required   type="text" name="content" class=" form-control" placeholder="add your comment" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <input class="btn btn-outline-secondary" type="submit" id="button-addon2" value="submit">
            </div>
          </div>
    </form>

</div>

<div class="container">

    @foreach($comments as $key => $value)
    <div class="message-blue">
      <div class="actions">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapsid_{{$value['comment_id']}}" aria-expanded="false" aria-controls="collapseExample">
          <i class="fas fa-reply-all"></i>
            </button>
        
          <form action="del" method="post">
            @csrf
        <input type="hidden" name="delete" value="{{$value['comment_id']}}">
        <button class="delete_comment btn bg-danger" type="submit" value=""><i class="fas fa-trash-alt"></i></button>
        </form>
          
      </div>
     
    <div class="comeentaria">  
        <div class="message-content">{{$value['content']}}

      
           

        </div>
        <div class="collapse" id="collapsid_{{$value['comment_id']}}">
          <div class="input-group mb-3">
              <form action="newsubpost" method="post">
                  @csrf
              <input required  name="content" type="text" class="form-control" placeholder="comment on this post" aria-label="Recipient's username" aria-describedby="button-addon2">
              <input type="hidden" name="for_comment" value="{{$value['comment_id']}}">
              <div class="input-group-append">
                <input class="btn btn-outline-secondary" type="submit" id="button-addon2" value="add comment">
              </div>
          </form>
            </div>

        </div>
      
        <small class="message-timestamp-left">posted :{{ date('d/m/Y', strtotime($value['created_at']))}}  at : {{ date('H:i:s', strtotime($value['created_at']))}}</small>
        <hr>
   
       
       
        <div class="sub_comment_wrpr">

            <ol>          
@foreach($sub_comments as $key => $value_sub)


@if($value_sub['for_comment']==$value['comment_id'])
<li><i class="far fa-comments"> </i> &nbsp;  {{$value_sub['content']}}</li>
              
<small> replay :{{ date('d/m/Y', strtotime($value_sub['created_at']))}}  at : {{ date('H:i:s', strtotime($value_sub['created_at']))}}</small> 
<br>
<br>
@endif
@endforeach
           
                
      
            </ol>
            
            </div>
    </div>
  </div>  
    @endforeach

   
</div>




</div>
    <footer>


     




</div>

      
         </footer>
          <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.min.js"></script>


          <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>

$('#alertbar').ready(function(){
    $('#alertbar').delay(1800).fadeOut('slow');
  
  })
  
       </script>
</body>
</html>