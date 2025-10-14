-- Add foreign key constraints to orders table
ALTER TABLE orders 
ADD CONSTRAINT fk_orders_shopkeeper 
FOREIGN KEY (shopkeeper_id) REFERENCES shopkeeper(id);

ALTER TABLE orders 
ADD CONSTRAINT fk_orders_product 
FOREIGN KEY (product_id) REFERENCES products(id);

-- Add customer_id to orders table if it doesn't exist
ALTER TABLE orders ADD COLUMN customer_id INT;

-- Add foreign key for customer
ALTER TABLE orders 
ADD CONSTRAINT fk_orders_customer 
FOREIGN KEY (customer_id) REFERENCES customers(id);