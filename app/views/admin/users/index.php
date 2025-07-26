<h1><i class="fas fa-users me-2"></i>Danh sách Người dùng</h1>

<table id="usersTable" class="table table-bordered table-striped" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Vai trò</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= html_escape($user['id']) ?></td>
                <td><?= html_escape($user['full_name']) ?></td>
                <td><?= html_escape($user['email']) ?></td>
                <td><?= html_escape($user['phone']) ?></td>
                <td><?= html_escape($user['address']) ?></td>
                <td><?= html_escape($user['role']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#usersTable').DataTable();
});
</script>