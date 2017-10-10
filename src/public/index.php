<?php
    require_once(__DIR__ . '/../app/app.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Data Sender</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <style>
            h1 {
                margin-bottom: 4rem;
            }
            
            .form-control-plaintext {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="display-3">Data Sender</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Usage</h2>
                    <p>
                        You can use this tool to send multiple requests of data to a data sink. You can specify concurrency, the data to send
                        or a predefined amount of data for each request.
                    </p>
                    <p>
                        Requests are submitted to <code>/send/</code> as a HTTP POST with the following parameters:
                    </p>
                    <ul>
                        <li><code>concurrency</code> - The number of concurrent requests to make.</li>
                        <li><code>size</code> - A size of predefined data to send in MB. Valid options are <code>1</code>, <code>5</code>, <code>10</code> and <code>20</code>.</li>
                        <li><code>data</code> - If present and not empty, is used instead of predefined data. Allows you to send custom content to the sink.</li>
                    </ul>
                    <p>
                        The response is JSON with details about the requests.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2>Try It</h2>
                    <form action="/send/" method="post">
                        <div class="form-group row">
                            <label for="endpoint" class="col-md-2">Endpoint</label>
                            <div class="col-md-10">
                                <input type="text" readonly name="endpoint" value="<?php echo htmlentities(env('PERFTEST_DATASINK')); ?>" class="form-control-plaintext" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="concurrency" class="col-md-2">Concurrent Requests</label>
                            <div class="col-md-1">
                                <input type="text" name="concurrency" value="1" class="form-control" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="endpoint" class="col-md-2">Data Size</label>
                            <div class="col-md-10">
                                <select class="custom-select" name="size">
                                    <option selected>Choose...</option>
                                    <option value="1">1 MB</option>
                                    <option value="5">5 MB</option>
                                    <option value="10">10 MB</option>
                                    <option value="20">20 MB</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="data" class="col-md-2">Data</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="data" rows="5"></textarea>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>