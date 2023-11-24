-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2023 lúc 07:39 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bcw`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_loai`
--

CREATE TABLE `tbl_loai` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `noiBat` tinyint(4) NOT NULL DEFAULT 0,
  `thuTu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_loai`
--

INSERT INTO `tbl_loai` (`id`, `ten`, `noiBat`, `thuTu`) VALUES
(1, 'điện thoại', 0, 1),
(2, 'phụ kiện điện thoại', 0, 2),
(4, 'sách', 0, 4),
(6, 'đồ uống có cồn', 0, 6),
(9, 'laptop', 0, 8),
(10, 'máy bay', 0, 9),
(11, 'thực phẩm', 0, 10),
(12, 'đồng hồ', 0, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `gia` int(11) NOT NULL,
  `hinh` varchar(255) NOT NULL,
  `mota` mediumtext NOT NULL,
  `loai` int(11) NOT NULL,
  `soluong` int(8) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id`, `ten`, `gia`, `hinh`, `mota`, `loai`, `soluong`) VALUES
(10, 'HIBIKI HARMONY', 3100000, 'ruou-hibiki-harmony.jpg', 'Hibiki Harmony lần đầu giới thiệu ra công chúng của hãng Suntory tháng 3/2015 là dòng thứ 5 của Hibiki ngoài các dòng trước gồm Hibiki 12, Hibiki 17, Hibiki 21 và Hibiki 30 year old. Hibiki Harmony là dòng trẻ tuổi nhất.\r\n\r\nRượu Hibiki Harmony là sự pha trộn phức tạp từ các thùng ủ khác nhau với tuổi rượu lâu năm và rượu trẻ của các dòng single malt nổ tiếng của Yamazaki, Hakushu và Grain whisky của nhà Chita.\r\n\r\nĐóng chai ở 43% độ cồn trong mẫu chai đặc trưng của nhà này với 24 cạnh tượng trưng cho 24 mùa (tiết khí) trong năm âm lịch của người Nhật.\r\n\r\nHibiki Japanese Harmony ủ thùng sherry cho ra các hương vị ngọt ngào và êm dịu hòa quyện lẫn vào nhau tạo ra một trải nghiệm độc đáo. Loại rượu này là một ví dụ điển hình của các loại Hibiki phối trộn: tinh tế, sang trọng, hài hòa phảng phất mùi thùng sherry Yamazaki. Phiên bản sản xuất giới hạn này sẽ làm hài lòng những người uống rượu whisky sành điệu.\r\n\r\nCuối năm 2019 hãng Suntotry có thay đổi hộp mới và công nghệ in hiện đại và phứt tạp hơn trên seal chai rượu làm cho chai rượu của hãng khó được làm giả hơn. Quý khách có thể liên hệ trực tiếp với các bạn tư vấn bên Sành rượu để biết sự thay đổi này.\r\n\r\nMột ngày Sài Gòn đẹp trời Sành rượu cùng chiến hữu trong một quán dê khá nổi tiếng ở Quận 2 đã khui chai Harmony. Hương vị ban đầu khá tốt tuy trẻ tuổi nhưng không cảm thấy sốc mà uống khá êm cho hậu vị vừa, cay của gia vị và mùi gỗ không lẫn vào đâu của các dòng Hibiki.', 6, 1),
(11, 'LARK BRANDY & PX SHERRY CASK', 4900000, 'Lark-Brandy---PX-Sherry-Cask.jpg', 'Rượu Lark Brandy & PX Sherry Cask - whisky single malt Úc.', 6, 904),
(12, 'đồng hồ baby g ba', 600000, 'baby-g-bga-270fl-7adr-nu-thumb-600x600.jpg', 'không', 12, 20),
(13, 'befit watch fit vang', 800000, 'befit-watch-fit-vang-tn-600x600.jpg', 'befit-watch-fit-vang-tn', 12, 10),
(14, 'casio mtp m100l 7avdf nam', 1000000, 'casio-mtp-m100l-7avdf-nam-thumb-600x600.jpg', 'm100l 7avdf nam', 12, 20),
(15, 'citizen em1070 83d nữ thumb', 900000, 'citizen-em1070-83d-nu-thumb-600x600.jpg', ' 83d nữ thumb', 12, 33),
(16, 'edifice ecb 40db ', 500000, 'edifice-ecb-40db-1adf-nam-thumb-600x600.jpg', '1adf nam thumb', 12, 20),
(17, 'g shock gm 5600', 900000, 'g-shock-gm-5600-1dr-nam-thumb-600x600.jpg', ' 1dr nam thumb', 12, 16),
(18, 'julius star js 027c', 600000, 'julius-star-js-027c-nu-thumb-1-600x600.jpg', 'dành cho nữ thumb 1', 12, 16),
(19, 'iphone 12 violet 1', 23000000, 'iphone-12-violet-1-600x600.webp', 'iphone 12 đời mới', 1, 6),
(20, 'masstel tab 10s', 6000000, 'masstel-tab-10s-đen-1-1-2-3-4-600x600.webp', 'color  đen', 1, 12),
(21, 'oppo a18 xanh', 5600000, 'oppo-a18-xanh-thumb-1-2-3-600x600 (1).webp', 'pin 4000', 1, 21),
(22, 'oppo reno10 ', 6700000, 'oppo-reno10-blue-thumbnew-600x600.webp', 'blue thumbnew', 1, 13),
(23, 'realme c53 ', 4999999, 'realme-c53-black-thumb-600x600.webp', 'black thumb ', 1, 34),
(24, 'samsung galaxy a05s', 8999000, 'samsung-galaxy-a05s-sliver-thumb-600x600.webp', ' sliver thumb ', 1, 11),
(25, 'samsung-galaxy-tab-a9', 7899000, 'samsung-galaxy-tab-a9-den-thumb-600x600.webp', '-den-thumb ', 1, 62),
(26, 'samsung-galaxy-z-flip5', 42990000, 'samsung-galaxy-z-flip5-xanh-mint-thumb-600x600.webp', 'color-xanh-mint-thumb ', 1, 6),
(27, 'samsung-galaxy-z-fold4', 21690000, 'samsung-galaxy-z-fold4-kem-256gb-600x600.webp', 'color-kem-256gb ', 1, 7),
(28, 'Xiaomi-12', 4600000, 'Xiaomi-12-xam-thumb-mau-600x600.webp', 'mau-xam-thumb-mau ', 1, 31),
(29, 'acer-aspire-7-gaming', 19900000, 'acer-aspire-7-gaming-a715-76g-59mw-i5-nhqmysv001-thumb-600x600.jpg', '-a715-76g-59mw-i5-nhqmysv001', 9, 12),
(30, 'acer-nitro-5', 23990000, 'acer-nitro-5-an515-58-769j-i7-nhqfhsv003-thumb-600x600.jpg', 'an515-58-769j-i7-nhqfhsv003', 9, 11),
(31, 'acer-nitro-5-', 25990000, 'acer-nitro-5-gaming-an515-57-5669-i5-11400h-8gb-512gb-144hz-4gb-gtx1650-win11-nhqehsv001-031221-100506-600x600.jpg', 'gaming-an515-57-5669-i5-11400h-8gb-512gb-144hz-4gb-gtx1650-win11-nhqehsv001-031221-100506', 9, 21),
(32, 'apple-macbook-air', 34000000, 'apple-macbook-air-15-inch-m2-2023-midnight-thumb-600x600.jpg', '15-inch-m2-2023-midnight', 9, 6),
(33, 'apple-macbook-air-m2', 37990000, 'apple-macbook-air-m2-2022-bac-600x600.jpg', 'nam sx 2022-bac', 9, 17),
(34, 'content__5_5-', 892000000, 'content__5_5-loai-may-bay-dan-dung-hien-dai-nhat-hien-nay.jpg', 'loai-may-bay-dan-dung-hien-dai-nhat-hien-nay', 10, 3),
(35, 'content__6_5', 781000000, 'content__6_5-loai-may-bay-dan-dung-hien-dai-nhat-hien-nay.jpg', '-loai-may-bay-dan-dung-hien-dai-nhat-hien-nay', 10, 4),
(36, 'content__9_5', 711000000, 'content__9_5-loai-may-bay-dan-dung-hien-dai-nhat-hien-nay.jpg', '-loai-may-bay-dan-dung-hien-dai-nhat-hien-nay', 10, 2),
(37, 'airpod', 200000, 'airpod.jpg', 'tai nghe', 2, 57),
(38, 'cáp sạc po', 200000, 'capsacoppo.jpg', 'cáp sạc dẹp', 2, 77),
(39, 'pin-sac-du-phong', 600000, 'pin-sac-du-phong-polymer-10000mah-ava-jp299-thumb-1-600x600.jpg', '-polymer-10000mah-ava-jp299-thumb-1-600x600', 2, 28),
(40, 'pin-sac-du-phong-polymer-', 700000, 'pin-sac-du-phong-polymer-10000mah-type-c-15w-ava-jp399-thumb-6-600x600.jpg', '10000mah-type-c-15w-ava-jp399-thumb-6-600x600', 2, 25),
(41, 'rựu xanh', 900000, '6-jpeg-524e5928-3670-429e-954e-0a8e47422593.webp', 'rựu thái', 6, 67),
(42, 'rựu asset', 300000, 'Asset-6-1-1.jpg', 'rựu chính hãng assey sản xuất', 6, 121),
(43, 'bia hà nội', 100000, 'bia-thumb-web-1697012374271-16970123744531816614441.webp', 'sản xuất ở hà nội 300k/ thùng', 6, 33),
(44, 'bia tiger', 70000, 'bia-tiger-lon-330ml-2023227.jpg', 'bia sư tử', 6, 224),
(45, 'Grappa-Bionda-01', 1600000, 'Grappa-Bionda-01.jpg', 'rựu đắt', 6, 31),
(46, 'rựu nho', 141000, 'images.jpg', 'rựu chính', 6, 167),
(47, 'ruou-absinthe-pere-kermann-s', 2200000, 'ruou-absinthe-pere-kermann-s.webp', 'rựu abssin', 6, 61),
(48, 'bản chất của dối trá', 160000, 'banchatcuadoitra.jpg', 'sách mới', 4, 77),
(49, 'chồng quỷ', 160000, 'chongquytuyetmy.jpg', 'câu truyện của quỷ ', 4, 121),
(50, 'every', 110000, 'every things.jpg', 'eve', 4, 16),
(51, 'sách lập trình ios', 199900, 'laptrinhiot.jpg', 'new', 4, 22),
(52, 'lập trình java', 270000, 'latrinhjava.jpg', 'hướng dẫn lập trình java', 4, 171),
(53, 'tịch tà kiếm pháp', 2000555, 'tịch tà kiếm pháp.jpg', 'sách tu chân luyện khí kì', 4, 2),
(54, 'gà chiên', 50000, 'gachien.jpg', 'gà ta', 11, 111),
(55, 'bánh goute', 200000, 'goute_8p_2103.png', 'bánh ngọt', 11, 22),
(56, 'humberger', 200000, 'humberger.jpg', 'new sanr pham', 11, 22);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(4) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `address`, `email`, `user`, `pass`, `role`) VALUES
(21, 'tien', 'số 165 đường tôn đức thắng ', 'admin1@gmail.com', 'admin12', '$2y$10$Z9GISuGef8Wlp35zssvTJOUetTcAovHmVe9DPKpUmFkmf1I2slOVK', 1),
(23, 'tiến', '154 trần nemo', 'nemojohnfynz@gmail.com', 'nemojohnfynz', '$2y$10$hP/GuThEFStUaKzBaQx8KuUPKylU0PcT.X2c6dwyE.owUeHa95pwe', 0),
(24, 'tiến', '563 hoàng dịu', 'tienyeuai2200@gmail.com', 'tienuser1', '$2y$10$DUQlPMJoSzqp0RsBdIA.nOT.jZtPUSfQIe2E.jqGiMfwrNOHkyvQK', 0),
(25, 'lehoangphuc', 'a', 'a', 'a', '$2y$10$3pAA/hTUZExIPE2Ai/2e6uOrZM0ttUm7uECBivwLU.G3sxFku.n36', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_loai`
--
ALTER TABLE `tbl_loai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loai` (`loai`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tbl_loai`
--
ALTER TABLE `tbl_loai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_sanpham` (`id`);

--
-- Các ràng buộc cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD CONSTRAINT `tbl_sanpham_ibfk_1` FOREIGN KEY (`loai`) REFERENCES `tbl_loai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
