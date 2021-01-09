/* victor - add order status column to orders table */
ALTER TABLE orders ADD ord_status VARCHAR(10);

ALTER TABLE orders ADD COLUMN ord_discount VARCHAR(10);