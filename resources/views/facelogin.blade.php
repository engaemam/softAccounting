<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <meta property="og:image"              content="{{url('upload/offers/'.$offer->image)}}" />
    <title>Login</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style>
.aligncenter {
    text-align: center;
}
</style>
<body>
    
     
 
    <div class="container">
        <br>
        <br>
        <br>
           <h2 class="aligncenter"><img  src="{{url('upload/offers/'.$offer->image)}}" style="max-width: 800px; max-height: 400px;float:center" alt="" /></h2>
            <div class="col-md-4 col-md-offset-4">
                      
          
                <div class="panel panel-default">
                                      
                      <div class="panel-heading">
                        <h3 class="panel-title">Login via soft Accounting</h3>
                         </div>
                       
                      <div class="panel-body">

                        <div class="form-group">
                       
                     
                        <fieldset>
                            <a href="{{ url('auth/facebook') }}" class="btn btn-lg btn-primary btn-block">
                                <strong>Login With Facebook</strong>
                            </a>  
                         </fieldset>
                         </div>
                          <hr/>
                     
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!------ Include the above in your HEAD tag ---------->

