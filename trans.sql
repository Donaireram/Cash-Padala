CREATE TABLE transaction_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    s_firstname VARCHAR(255) NOT NULL,
    s_lastname VARCHAR(255) NOT NULL,
    s_middlename VARCHAR(255) NOT NULL,
    s_contact VARCHAR(15) NOT NULL,
    s_address VARCHAR(255) NOT NULL,
    r_firstname VARCHAR(255) NOT NULL,
    r_lastname VARCHAR(255) NOT NULL,
    r_middlename VARCHAR(255) NOT NULL,
    r_contact VARCHAR(15) NOT NULL,
    r_address VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    purpose VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
