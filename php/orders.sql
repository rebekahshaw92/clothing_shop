CREATE TABLE orders(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`customer_id` INT NOT NULL,
`registered` INT NOT NULL,
`delivery_add_id` INT NOT NULL,
`payment_type` INT NOT NULL,
`date` DATETIME NOT NULL,
`status` TINYINT NOT NULL,
`session` VARCHAR(100) NOT NULL,
`total` FLOAT NOT NULL)
ENGINE = InnoDB;
