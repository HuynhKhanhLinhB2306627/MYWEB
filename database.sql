CREATE TABLE sanpham (
    id VARCHAR(20) PRIMARY KEY,
    ten VARCHAR(255),
    loai VARCHAR(100),
    gia INT,
    mota TEXT,
    hinhanh1 VARCHAR(255), -- Đường dẫn hoặc tên file cho ảnh 1
    hinhanh2 VARCHAR(255), -- Đường dẫn hoặc tên file cho ảnh 2
    hinhanh3 VARCHAR(255), -- Đường dẫn hoặc tên file cho ảnh 3
    hinhanh4 VARCHAR(255)  -- Đường dẫn hoặc tên file cho ảnh 4
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address VARCHAR(255), -- Thêm cột địa chỉ
    password_hash VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'customer', -- 'customer' cho khách hàng, 'admin' cho quản trị
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE cart (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    product_id VARCHAR(20) NOT NULL,
    quantity INT NOT NULL,
    price INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES sanpham(id)
);

-- Bảng đơn hàng: mỗi đơn hàng 1 dòng
CREATE TABLE orders (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    order_code VARCHAR(20) NOT NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'Đang xử lý',
    total_price INT NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bảng chi tiết đơn hàng: mỗi sản phẩm 1 dòng, gắn với order_id
CREATE TABLE order_items (
    id SERIAL PRIMARY KEY,
    order_id INT NOT NULL,
    product_id VARCHAR(20) NOT NULL,
    quantity INT NOT NULL,
    price INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES sanpham(id)
);

INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB001', 'Bàn phím AULA F75', 'Keyboard',1189000, 'Bàn phím AULA F75 đã và đang thu hút sự chú ý của nhiều game thủ và những tín đồ công nghệ nhờ thiết kế ấn tượng và hiệu năng vượt trội. Sản phẩm không chỉ phù hợp cho việc chơi game mà còn phục vụ tốt cho nhu cầu làm việc hàng ngày.', 'kb001a.jpg','kb001b.jpg','kb001c.jpg','kb001d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB002', 'Bàn phím AKKO 5098B', 'Keyboard', 2890000, 'AKKO 5098B The King’s Avatar Ye Xiu là một chiếc bàn phím cơ độc đáo, lấy cảm hứng từ bộ truyện và phim hoạt hình nổi tiếng "Toàn Chức Cao Thủ" (The King’s Avatar). Với thiết kế bắt mắt, hiệu năng gõ phím tuyệt vời và nhiều tính năng hiện đại, sản phẩm này hứa hẹn sẽ làm hài lòng cả những game thủ và người dùng khó tính nhất. ', 'kb002a.jpg','kb002b.jpg','kb002c.jpg','kb002d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB003', 'Bàn phím cơ Asus ROG Azoth White NX Snow', 'Keyboard', 6990000, 'Asus ROG Azoth White NX Snow nổi bật với thiết kế 75% gọn gàng, Kết hợp gasket mount silicone với ba lớp bọt giảm chấn tạo ra trải nghiệm gõ bàn phím tuyệt vời.giúp tiết kiệm diện tích trên bàn làm việc của bạn. Với kiểu dáng này, bạn sẽ có nhiều không gian hơn để sắp xếp các thiết bị khác như màn hình, chuột, và các phụ kiện công nghệ khác.', 'kb003a.jpg','kb003b.jpg','kb003c.jpg','kb003d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB004', 'Bàn phím Razer Huntsman V3 Pro Mini', 'Keyboard', 4070000, 'Bàn phím Razer Huntsman V3 Pro Mini chính là vũ khí tối thượng dành cho những game thủ tinh túy, luôn khao khát bứt phá mọi ranh giới. Là sự kết hợp hoàn hảo giữa thiết kế nhỏ gọn đầy tinh tế, hiệu năng mạnh mẽ vượt trội và khả năng cá nhân hóa ấn tượng sẽ biến Razer Huntsman V3 Pro Mini trở thành người đồng hành lý tưởng, đưa bạn đến với những chiến thắng vang dội. ', 'kb004a.jpg','kb004b.jpg','kb004c.jpg','kb004d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB005', 'Bàn phím MonsGeek MG108B Bun Wonderland V3 Piano Pro switch', 'Keyboard', 2190000, 'Mẫu bàn phím MonsGeek MG108B Bun Wonderland V3 Piano Pro switch lấy cảm hứng từ những chiếc bánh ngọt tròn thơm, ngọt vị, tan chảy tỏng miệng, một số hình ảnh thực tế từ sản phẩm hứa hẹn sẽ để lại cho bạn nhiều ấn tượng bất ngờ. ', 'kb005a.jpg','kb005b.jpg','kb005c.jpg','kb005d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB006', 'Bàn phím Leobog A75 TM (Moon Cat hồng/ Rambo switch) A7503', 'Keyboard', 2190000, 'Bàn phím cơ Leobog A75 TM là một sản phẩm nổi bật trong dòng bàn phím gaming với thiết kế độc đáo và tính năng vượt trội. Đặc biệt, phiên bản tháng Mười “Moon Cat hồng” với switch Rambo đã thu hút sự chú ý của những ai yêu thích công nghệ và trò chơi điện tử. ', 'kb006a.jpg','kb006b.jpg','kb006c.jpg','kb006d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB007', 'Bàn phím Leobog Hi86 TM (Trắng đen/ Nimbus V3 switch) HI8602', 'Keyboard', 2190000, 'Bàn phím Leobog Hi86 TM là một sản phẩm nổi bật trong dòng bàn phím cơ gaming với thiết kế hiện đại và nhiều tính năng ưu việt. Với phiên bản màu trắng đen kết hợp với Nimbus V3 switch, sản phẩm này không chỉ thu hút ánh nhìn mà còn hỗ trợ người dùng một cách tối ưu nhất trong quá trình trải nghiệm game cũng như làm việc.', 'kb007a.jpg','kb007b.jpg','kb007c.jpg','kb007d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB008', 'Bàn phím Vortex 8700 MultiX Dolch Gateron Retro White Switch', 'Keyboard', 2390000, 'Bàn phím cơ luôn thiết bị không thể thiếu trong quá trình nhập và xử lý các dữ liệu từ người dùng lên hệ thống máy tính. Vortex 8700 MultiX Dolch sở hữu vẻ ngoài tươi sáng cùng những tính năng hấp dẫn mang lại trải nghiệm tuyệt vời. ', 'kb008a.jpg','kb008b.jpg','kb008c.jpg','kb008d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB009', 'Bàn phím Razer BlackWidow V4 X Green Switch - Minecraft Edition', 'Keyboard', 4790000, 'Bàn phím Razer BlackWidow V4 X Green Switch - Minecraft Edition không chỉ là công cụ hỗ trợ hoàn hảo cho game thủ, mà còn mang đến trải nghiệm phong cách sống động cho những fan hâm mộ Minecraft. Với thiết kế độc đáo và tính năng vượt trội, sản phẩm này hứa hẹn sẽ là lựa chọn hoàn hảo cho cả game thủ lẫn những người yêu thích công nghệ. ', 'kb009a.jpg','kb009b.jpg','kb009c.jpg','kb009d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('KB010', 'Bàn phím Logitech G915 X Lightspeed TKL Low-Profile Wireless Black', 'Keyboard', 4290000, 'Bàn phím Logitech G915 X Lightspeed TKL Low-Profile Wireless Black với tốc độ phản hồi nhanh và chính xác, thiết kế mới lạ, trải nghiệm gõ được nâng cấp ngay từ khi mới ra mắt, sản phẩm đã nhanh chóng được săn đón.', 'kb010a.jpg','kb010b.jpg','kb010c.jpg','kb010d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO001', 'Chuột Steelseries Aerox 3 Wireless Snow Edition', 'Mouse', 2490000, 'Lightweight hay mỏng nhẹ, xu hướng thiết kế mới dành cho chuột máy tính. Nay đã được Steelseries đã mang lên dòng sản phẩm chuột wireless Aerox 3 của mình. Chúng ta sẽ đến ngay với phiên bản Steelseries Aerox 3 Wireless Snow Edition thuần khiết với màu trắng ngay sau đây.', 'mo001a.jpg','mo001b.jpg','mo001c.jpg','mo001d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO002', 'Chuột Logitech G502 X Plus LightSpeed Black', 'Mouse', 3200000, 'Chuột Logitech G502 X PLUS Black là sản phẩm mới nhất của series G502 đình đám. Được thiết kế lại và cải tiến với công nghệ chơi game hiện đại, bao gồm công tắc Lightforce lai quang học - cơ học đầu tiên, Lightspeed không dây, LIGHT SYNC RGB và cảm biến quang học Hero 25K, Logitech G502 X PLUS chắc chắn là một trong những gaming gear đáng mua nhất cho game thủ thời gian sắp tới.', 'mo002a.jpg','mo002b.jpg','mo002c.jpg','mo002d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO003', 'Chuột Razer DeathAdder V3 Pro White Wireless', 'Mouse', 3190000, 'Razer DeathAdder V3 Pro Wireless được xem là một trong những dòng chuột máy tính không dây đáng sở hữu nhất hiện nay. Sở hữu thời lượng pin “Trâu” lên đến 90 tiếng sử dụng liên tục. Đặc biệt, Razer DeathAdder V3 Pro Wireless White sử dụng switch quang học tráng được tình trạng double click.', 'mo003a.jpg','mo003b.jpg','mo003c.jpg','mo003d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO004', 'Chuột Steelseries Rival 3', 'Mouse', 750000, 'Steelseries Rival 3 là một trong những dòng chuột máy tính sở hữu thiết kế đối xứng với các nút bấm được bố trí thông minh, hợp lý giúp người chơi dễ dàng sử dụng nhiều thác tác khi chơi game giải trí. Đặc biệt, với hệ thống LED chiếu sáng sinh động sẽ giúp góc máy gaming của bạn thêm phần nổi bật. Hứa hẹn đây sẽ là một trong những dòng chuột gaming dưới 1 triệu rất đáng trải nghiệm.', 'mo004a.jpg','mo004b.jpg','mo004c.jpg','mo004d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO005', 'Chuột không dây DareU LM115G Black', 'Mouse', 150000, 'DareU LM115G là một trong những dòng chuột không dây mang đến cho người dùng sự mới mẻ trong thiết kế. Với tông màu đen huyền bí và sang trọng cùng với đó mang trên mình thiết kế bo tròn cho cảm giác thoải mái khi dùng. Sản phẩm tương thích và dễ dàng kết nối với nhiều hệ điều hành.', 'mo005a.jpg','mo005b.jpg','mo005c.jpg','mo005d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO006', 'Chuột Razer Basilisk V3', 'Mouse', 990000, 'Razer mới vừa tung ra thị trường phiên bản mới của Razer Basilisk V3. Bạn hoàn toàn có thể tạo nên phong cách chơi game riêng cho bản thân, làm chủ và nâng cao phong độ trên mọi trận đấu. Đã đến lúc khuấy động những trận đấu theo cách riêng của bạn.', 'mo006a.jpg','mo006b.jpg','mo006c.jpg','mo006d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO007', 'Chuột Logitech G304 Wireless White', 'Mouse', 750000, 'G304 là một trong những dòng sản phẩm chuột gaming sở hữu công nghệ LIGHTSPEED, mang đến những trải nghiệm chơi game thú vị. Với thiết kế chuột không dây mang đến hiệu suất thực sự với các đột phá công nghệ mới nhất ở mức giá thành phù hợp. Đó là chơi game không dây thế hệ mới, hiện đã sẵn sàng cho mọi game thủ. ', 'mo007a.jpg','mo007b.jpg','mo007c.jpg','mo007d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO008', 'Chuột Logitech G502 Hero Gaming', 'Mouse', 950000, 'Ngoài hiệu suất cốt lõi và các tính năng cá nhân, nhiều chi tiết được thiết kế và chế tạo với sự tận tâm. Logitech G502 Hero là một trong những dòng chuột gaming giá rẻ so với các sản phẩm ở cùng phân khúc với dây bện với nút buộc dây có khóa nhám, phần cầm nắm bên có viền cao su, cửa từ vào khoang để khối nặng và nhiều hơn nữa.', 'mo008a.jpg','mo008b.jpg','mo008c.jpg','mo008d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO009', 'Chuột Razer Basilisk V3 Pro 35K White', 'Mouse', 4190000, 'Nâng tầm trải nghiệm chơi game với Razer Basilisk V3 Pro 35K – chuột chơi game không dây RGB công thái học với khả năng tùy chỉnh và công nghệ tiên tiến nhất. Với cảm biến chính xác hoàn hảo và con lăn chuột với các tùy chọn cấu hình chuyên sâu, chơi game theo cách của bạn chưa bao giờ thú vị đến thế.', 'mo009a.jpg','mo009b.jpg','mo009c.jpg','mo009d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MO010', 'Chuột Logitech G304 Wireless', 'Mouse', 740000, 'G304 là một trong những dòng chuột Logitech chơi game với công nghệ LIGHTSPEED được thiết kế cho hiệu suất thực sự với các đột phá công nghệ mới nhất ở mức giá thành phù hợp. Đó là chơi game không dây thế hệ mới, hiện đã sẵn sàng cho mọi game thủ. Hứa hẹn đây sẽ là một trong những phụ kiện chơi game của Logitech bên cạnh những dòng bàn phím cơ, tai nghe chơi game,...mang đến cho bạn cảm xúc thăng hoa cùng các tựa game yêu thích đấy nhé!', 'mo010a.jpg','mo010b.jpg','mo010c.jpg','mo010d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN001', 'Màn hình Asus TUF GAMING VG259Q3A 25" Fast IPS 180Hz Gsync chuyên game', 'Monitor', 3090000, 'Màn hình IPS 24.5 inch Full HD (1920x1080) với game màu 99% sRGB mang đến màu sắc chân thật, rõ nét, chính xác và sinh động, cùng độ tương phản cao giúp người dùng trải nghiệm hình ảnh một cách tốt nhất trong các trận chiến trong game hay xem video và hình ảnh giải trí.', 'mn001a.jpg','mn001b.jpg','mn001c.jpg','mn001d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN002', 'Màn hình Viewsonic VA2432-H 24" IPS 100Hz viền mỏng', 'Monitor', 1990000, 'ViewSonic VA2432-h là màn hình IPS có kích thước 24" với độ phân giải Full HD cùng cổng kết nối HDMI và VGA cho doanh nghiệp hoặc gia đình. Với công nghệ SuperClear® IPS và độ phân giải Full HD, màn hình đem lại hình ảnh chân thực và chi tiết từ mọi góc nhìn khác nhau. ', 'mn002a.jpg','mn002b.jpg','mn002c.jpg','mn002d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN003', 'Màn hình ASUS VY249HGR 24" IPS 120Hz viền mỏng', 'Monitor', 2290000, 'Độ phân giải Full HD 1920x1080, kết hợp với tần số quét 120Hz, mang đến những chuyển động mượt mà, không giật lag, lý tưởng cho game thủ và người dùng cần thao tác nhanh. Công nghệ Adaptive-Sync giúp loại bỏ hiện tượng xé hình, mang đến trải nghiệm chơi game mượt mà, chân thực.', 'mn003a.jpg','mn003b.jpg','mn003c.jpg','mn003d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN004', 'Màn hình ViewSonic VX2479A-HD-PRO 24" IPS 240Hz 1ms chuyên game', 'Monitor', 3690000, 'Nếu bạn đang cần một chiếc màn hình 24 inch với tốc độ phản hồi nhanh chóng, hình ảnh mượt mà trong phân khúc giá tốt thì bạn có thể tham khảo qua Màn hình ViewSonic VX2479A-HD-PRO 24" IPS 240Hz 1ms chuyên game. Với chiếc màn hình này, bạn có thể dễ dàng thực hiện các tác vụ văn phòng cũng như chơi game thỏa thích.', 'mn004a.jpg','mn004b.jpg','mn004c.jpg','mn004d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN005', 'Màn hình Acer KG240Y-X1 24" IPS 200Hz Gsync chuyên game', 'Monitor', 2850000, 'Acer KG240Y-X1 là một màn hình chơi game tầm trung đáng chú ý, được trang bị tấm nền IPS, tần số quét 200Hz và công nghệ G-Sync. Với mức giá phải chăng, chiếc màn hình này hứa hẹn mang đến trải nghiệm chơi game mượt mà, hình ảnh sắc nét và màu sắc sống động cho game thủ.', 'mn005a.jpg','mn005b.jpg','mn005c.jpg','mn005d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN006', 'Màn hình ASUS TUF GAMING VG27AQ1A 27" IPS 2K 170Hz G-Sync HDR chuyên game', 'Monitor', 5290000, 'Màn hình ASUS TUF GAMING VG27AQ1A là màn hình 27 inch, được trang bị công nghệ ELMB độc quyền kết hợp với công nghệ đồng bộ hóa thích ứng AMD Freesync giúp game thủ đắm chìm vào những trận game đầy gây cấn. Thiết kế màn hình đẹp và hiện đại làm cho không gian chơi game của bạn trở nên sang trọng và hút mắt hơn.', 'mn006a.jpg','mn006b.jpg','mn006c.jpg','mn006d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN007', 'Màn hình AOC Q27G11E 27" IPS 2K 180Hz chuyên game', 'Monitor', 4390000, 'Màn hình AOC Q27G11E là một trong những sản phẩm nổi bật trên thị trường màn hình gaming hiện nay. Với thiết kế hiện đại và nhiều tính năng nổi bật, đây là sự lựa chọn lý tưởng cho những game thủ chuyên nghiệp. ', 'mn007a.jpg','mn007b.jpg','mn007c.jpg','mn007d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN008', 'Màn hình LG 24GS65F-B 24" IPS 180Hz HDR10 Gsync ', 'Monitor', 3150000, 'LG 24GS65F-B trang bị tần số quét 180Hz, một con số ấn tượng mà không phải màn hình nào cũng có thể đạt được. Tần số quét 180Hz giúp bạn thưởng thức hình ảnh cực rõ nét và mượt mà với tốc độ làm mới 180 lần một giây, cho phép bạn nắm bắt mọi chuyển động nhanh chóng và chính xác, đưa bạn đến gần hơn với chiến thắng.', 'mn008a.jpg','mn008b.jpg','mn008c.jpg','mn008d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN009', 'Màn Hình Samsung LS27F320GAEXXV 27" IPS 120Hz', 'Monitor', 2990000, 'Màn hình LS27F320GAEXXV 27" IPS 120Hz không chỉ sở hữu kích thước lý tưởng 27 inch cùng tấm nền IPS cho màu sắc sống động và góc nhìn rộng, chiếc màn hình Samsung này còn gây ấn tượng mạnh mẽ với tần số quét 120Hz, hứa hẹn mang đến trải nghiệm mượt mà vượt trội trong mọi tác vụ, từ công việc hàng ngày, giải trí đa phương tiện đến những trận game đầy kịch tính. ', 'mn009a.jpg','mn009b.jpg','mn009c.jpg','mn009d.jpg');
INSERT INTO SanPham (ID, Ten, Loai, Gia, MoTa, HinhAnh1, HinhAnh2, HinhAnh3, HinhAnh4) VALUES ('MN010', 'Màn hình LG 27MR400-B 27" IPS 100Hz', 'Monitor', 2590000, 'Không hầm hố, không gai góc và không mạnh mẽ - đó chính là những yếu tố về mặt thiết kế được LG 27MR400-B mang trên chính chiếc màn hình máy tính. Mọi góc cạnh trên chiếc màn hình 27 inch được hoàn thiện để hướng đến một sản phẩm thân thiện cho mọi không gian sử dụng. Ba cạnh viền mỏng cho góc nhìn rộng hơn kết hợp cùng khả năng tùy chỉnh độ nghiêng thuận tiện giúp cho LG 27MR400-B trở thành một sự lựa chọn đáng cân nhắc trong dòng màn hình văn phòng.', 'mn010a.jpg','mn010b.jpg','mn010c.jpg','mn010d.jpg');
SELECT * FROM SanPham;


-- TẠO TÀI KHOẢN ADMIN MẪU
-- Mật khẩu là: admin123
INSERT INTO users (full_name, email, password_hash, role) VALUES
('Admin', 'admin@example.com', '$2y$12$EzA4mMtF6rUYMGjEtvNVcOKLbevNYbh7BDIUOJFjOPZ8Nh6lS8r6C', 'admin');
select * from users;
select * from sanpham;

