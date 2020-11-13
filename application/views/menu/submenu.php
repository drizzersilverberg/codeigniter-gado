<?php if (validation_errors()) : ?>
    <div class="modal-opener" data-modal-id="#newSubmenuModal"></div>
<?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?? ''; ?></h1>

    <div class="row">
        <div class="col-lg">

            <?= $this->session->flashdata('message'); ?>

            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenuModal">
                Add New Submenu
            </a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th align="center" scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $sm['title'] ?? '-'; ?></td>
                            <td><?= $sm['menu'] ?? '-'; ?></td>
                            <td><?= $sm['url'] ?? '-'; ?></td>
                            <td align="center">
                                <i class="<?= $sm['icon'] ?? '-'; ?>" title="<?= $sm['icon'] ?? '-'; ?>"></i>
                            </td>
                            <td align="center">
                                <?php if ($sm['is_active'] ?? false) : ?>
                                    <i class="fas fa-check text-success"></i>
                                <?php else : ?>
                                    <i class="fas fa-times text-danger"></i>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a class="btn btn-sm btn-success" href="#">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="#">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="newSubmenuModal" tabindex="-1" aria-labelledby="newSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubmenuModalLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu/submenu'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" name="menu_id" id="menuIdInput">
                            <option class="text-muted" value="">Select menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option class="text-dark" value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('menu_id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="menuInput" name="submenu" placeholder="Submenu name">
                        <?= form_error('submenu', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="menuInput" name="url" placeholder="Submenu url">
                        <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="menuInput" name="icon" placeholder="Submenu icon">
                        <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="" id="isActiveInput" checked>
                            <label class="form-check-label" for="isActiveInput">
                                Active
                            </label>
                        </div>
                        <?= form_error('is_active', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>