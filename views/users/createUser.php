<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create user</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css" integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="container">
<hr>
   <form action="/users/create" method="post">
      <fieldset>
         <legend>Thêm mới user</legend>
          <div class="mb-3">
             <label for="" class="form-label">Full name</label>
             <input type="text" class="form-control" name="t_fullname" id="">
          </div>
          <div class="mb-3">
             <label for="" class="form-label">Username</label>
             <input type="text" class="form-control" name="t_username" id="">
          </div>
          <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Email address</label>
             <input type="email" class="form-control" name="t_email" id="exampleInputEmail1" aria-describedby="emailHelp">
             <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
             <label for="exampleInputPassword1" class="form-label">Password</label>
             <input type="password" class="form-control" name="t_password" id="exampleInputPassword1">
          </div>
          <button type="submit" name="btnSubmit" class="btn btn-sm btn-primary"><i class="fas fa-check-circle"></i> Submit</button>&nbsp;<a href="/users" class="btn btn-sm btn-secondary"><i class="fas fa-backward"></i> Back</a>
      </fieldset>
   </form>
</body>
</html>