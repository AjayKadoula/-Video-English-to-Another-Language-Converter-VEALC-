<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YouTube Video Downloader</title>
    
    <!-- Lato Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</head>
<body style="font-family: Lato; ">
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="padding: 0; border: 1px solid #CCC; ">
                <img src="https://goo.gl/3TsUGi" alt="Header Image" style="width: 100%">                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="border: 1px solid #CCC;">
                <p style="text-align: center; font-size: 35px; font-weight: 100;">DNS LookUp Tool</p>
                <hr>
                <form action="getting.php" method="get" autocomplete="off">
                    <label for="link">YouTube Video Link</label>
                    <input name="link"  style="border-radius: 0;" class="form-control" type="text">
                    <br>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Get Download Links</button>
                    <br><hr>
                </form>
            </div>
        </div>
    </div> 
</body>
</html>