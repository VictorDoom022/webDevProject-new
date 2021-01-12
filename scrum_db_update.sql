/* victor - add order status column to orders table */
ALTER TABLE orders ADD ord_status VARCHAR(10);

ALTER TABLE orders ADD COLUMN ord_discount VARCHAR(10);

/* move ord_discount to order_detail */
ALTER TABLE orders DROP COLUMN ord_discount;

ALTER TABLE order_detail ADD COLUMN ord_discount VARCHAR(10);

/* move ord_status to order_detail */
ALTER TABLE orders DROP COLUMN ord_status;

ALTER TABLE order_detail ADD COLUMN ord_status VARCHAR(10);

-- add cms_id to order_detail
ALTER TABLE `order_detail` ADD `cms_id` INT(10) NULL DEFAULT NULL AFTER `ord_status`;
ALTER TABLE `order_detail` ADD `seller_id` INT(10) AFTER `ord_product_id`;