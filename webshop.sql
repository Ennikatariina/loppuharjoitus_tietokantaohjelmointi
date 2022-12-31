CREATE TABLE product(  
    id INTEGER NOT NULL PRIMARY KEY,
    pname VARCHAR(255) NOT NULL,
    price double (10,2) NOT NULL
    category_id int NOT NULL, 
    index category_id(category_id),
    FOREIGN KEY (category_id) REFERENCES category(id)
    on delete RESTRICT
     
);