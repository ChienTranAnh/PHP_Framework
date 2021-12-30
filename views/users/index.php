<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css" integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="container">
    <hr>
    <div style="text-align: right">
        <h3 style="float: left">Users list</h3>
        <a href="/users/create" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Thêm mới</a>
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Control</th>
        </tr>
        <?php foreach ($data as $value) {?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['fullname'] ?></td>
            <td><?= $value['username'] ?></td>
            <td><?= $value['email'] ?></td>
            <td><?= $value['created_at'] ?></td>
            <td><?= $value['updated_at'] ?></td>
            <td>
                <a href="/users/detail/<?= $value['id'] ?>" class="btn btn-sm" title="Edit"><i class="fas fa-pencil-alt text-success text-active"></i></a>&nbsp;
                <a href="/delete-users/<?= $value['id'] ?>"><button class="btn btn-sm" onclick="return confirm('Are you sure to delete this user?')" title="Delete"><i class="fas fa-times text-danger text-active"></i></button></a>
            </td>
        </tr>
        <?php }?>
    </table>
</body>
</html>