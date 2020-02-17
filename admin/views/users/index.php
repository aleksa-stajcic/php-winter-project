<div class="container">
        <h1 class="mt-4 mb-3">Manage Users
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Admin</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    <div id="larry">
        <table class="table table-hover table-bordered table-striped"  id="tblSelect">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Change</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u->username ?></td>
                <td><?= $u->email ?></td>
                <td><?= $u->name ?></td>
                <td><a href="<?= $_SERVER['PHP_SELF'] ?>?page=edit&id=<?= $u->token ?>" class="btn btn-xs btn-primary change-user" data-id="<?= $u->token ?>">Change</a></td>
                <td><a href="#" class="btn btn-xs btn-danger delete-user" data-id="<?= $u->token ?>">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" href="users.php" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <?php for($i = 0; $i < $number_of_links; $i++): ?>
                    <li class="page-item"><a class="page-link" href="users.php?page=<?= $i+1?>"><?= $i+1 ?></a></li>
                <?php endfor ?>
                <li class="page-item">
                <a class="page-link" href="users.php?page=<?= $number_of_links ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</div>