<div class="container">
        <h1 class="mt-4 mb-3">Manage Products
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Admin</a>
        </li>
        <li class="breadcrumb-item active">Products</li>
      </ol>
    <div id="larry">
        <a href="products.php?page=new" class="btn btn-xs btn-success insert-product">Insert</a>
        <table class="table table-hover table-bordered table-striped"  id="tblSelect">
            <tr>
                <th>Name</th>
                <th>Manufacturer</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p->name ?></td>
                <td><?= $p->man_name ?></td>
                <td><?= $p->descr ?></td>
                <td><?= $p->price ?></td>
                <td><img height="300px" src="../app/assets/<?= $p->image ?>" alt="<?= $p->name ?>" class="img-responsive" width=""></td>
                <td><?= $p->cat_name ?></td>
                <td><a href="#" class="btn btn-xs btn-danger delete-product" data-id="<?= $p->id ?>">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" href="products.php?page=<?= isset($_GET['c']) ? "&c=". $c_id : "" ?>&number=<?= $number-1 == 0 ? 1 : $number-1  ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <?php for($i = 0; $i < $number_of_links; $i++): ?>
                    <li class="page-item"><a class="page-link" href="products.php?page=<?= $i+1?>"><?= $i+1 ?></a></li>
                <?php endfor ?>
                <li class="page-item">
                <a class="page-link" href="products.php?page=<?= $number_of_links ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</div>