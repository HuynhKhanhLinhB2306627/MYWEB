<div class="row border border-secondary rounded-3">
    <div class="text-center text-white background rounded-top-3">
        <h3 class="my-1">Thông tin khách hàng</h3>
    </div>
    <table class="table table-striped">
        <tr class="me-2">
            <th class="ps-3">Họ Tên Khách Hàng</th>
            <td><?php echo htmlspecialchars($fullname ?? ''); ?></td>
        </tr>
        <tr>
            <th class="ps-3">Số điện thoại</th>
            <td><?php echo htmlspecialchars($phone ?? ''); ?></td>
        </tr>
        <tr>
            <th class="ps-3">Email đăng ký</th>
            <td><?php echo htmlspecialchars($email ?? ''); ?></td>
        </tr>
        <tr>
            <th class="ps-3">Địa chỉ giao hàng</th>
            <td><?php echo htmlspecialchars($address ?? ''); ?></td>
        </tr>
        <tr>
            <th class="ps-3">Vai trò</th>
            <td><?php echo htmlspecialchars($role ?? ''); ?></td>
        </tr>
    </table>
</div>

