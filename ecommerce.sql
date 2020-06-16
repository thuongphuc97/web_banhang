-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 04, 2020 lúc 12:45 PM
-- Phiên bản máy phục vụ: 10.1.35-MariaDB
-- Phiên bản PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `CateID` int(11) NOT NULL,
  `CategoryName` varchar(150) NOT NULL,
  `Description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`CateID`, `CategoryName`, `Description`) VALUES
(1, 'Điện thoại', 'DT'),
(2, 'Máy tính bảng', 'MTB'),
(3, 'Laptop', 'LT'),
(4, 'Đồng hồ', 'watch');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oderdetail`
--

CREATE TABLE `oderdetail` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oderproduct`
--

CREATE TABLE `oderproduct` (
  `OrderID` int(11) NOT NULL,
  `OderDate` date NOT NULL,
  `ShipDate` date NOT NULL,
  `ShipName` varchar(150) NOT NULL,
  `ShipAddress` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(150) NOT NULL,
  `CateID` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `CateID`, `Price`, `Quantity`, `Description`, `Picture`) VALUES
(1, 'Đồng hồ 1', 4, 333, 1, '1', 'uploads/20190328085730wbe11b02871.100-ex1420.84a-dong-ho-nu-day-thep-khong-gi-chong-nuoc-citizen-1.png'),
(2, 'Đồng hồ 2', 4, 22, 1, '1', 'uploads/20190328085730wbe11b02871.100-ex1420.84a-dong-ho-nu-day-thep-khong-gi-chong-nuoc-citizen-1.png'),
(3, 'Đồng hồ 3', 4, 1111, 1, 'sdfsd', 'uploads/20190328085730wbe11b02871.100-ex1420.84a-dong-ho-nu-day-thep-khong-gi-chong-nuoc-citizen-1.png'),
(4, 'Đồng hồ', 4, 144444, 1, 'sada', 'uploads/20190328085730wbe11b02871.100-ex1420.84a-dong-ho-nu-day-thep-khong-gi-chong-nuoc-citizen-1.png'),
(5, 'Đồng hồ', 4, 155, 1, '1', 'uploads/20190328085730wbe11b02871.100-ex1420.84a-dong-ho-nu-day-thep-khong-gi-chong-nuoc-citizen-1.png'),
(6, 'Đồng hồ', 4, 1, 1, 'Laptop', 'uploads/20190328085730wbe11b02871.100-ex1420.84a-dong-ho-nu-day-thep-khong-gi-chong-nuoc-citizen-1.png'),
(7, 'Đồng hồ', 4, 10000, 1, 'Thương hiệu đồng hồ thời trang đầu tiên tại Việt Nam. Thiết kế tối giản và tinh tế.', 'uploads/20190328085730wbe11b02871.100-ex1420.84a-dong-ho-nu-day-thep-khong-gi-chong-nuoc-citizen-1.png'),
(8, 'Samsung', 1, 1, 1, 'đsa', 'uploads/20190404093455product-1.jpg'),
(9, 'HP', 1, 1, 0, '21', 'uploads/20190404093511product-5.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CateID`);

--
-- Chỉ mục cho bảng `oderdetail`
--
ALTER TABLE `oderdetail`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `oderproduct`
--
ALTER TABLE `oderproduct`
  ADD PRIMARY KEY (`OrderID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CateID` (`CateID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `CateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `oderproduct`
--
ALTER TABLE `oderproduct`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `oderdetail`
--
ALTER TABLE `oderdetail`
  ADD CONSTRAINT `oderdetail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `oderproduct` (`OrderID`),
  ADD CONSTRAINT `oderdetail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CateID`) REFERENCES `category` (`CateID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
