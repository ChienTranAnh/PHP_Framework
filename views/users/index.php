<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index User</title>
</head>
<body>
    <h2>User list</h2>
    <table>
        <tr>
            <th>Fullname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created</th>
        </tr>
        <?php foreach ($data as $value) {?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['fullname'] ?></td>
            <td><?= $value['email'] ?></td>
            <td><?= $value['created_at'] ?></td>
        </tr>
        <?php }?>
    </table>
</body>
</html>