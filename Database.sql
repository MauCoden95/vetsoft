
CREATE TABLE roles (
    id INT(100) AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(25) NOT NULL
) ENGINE=InnoDB;



CREATE TABLE users (
    id INT(100) AUTO_INCREMENT PRIMARY KEY,
    role_id INT(100) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone INT(255) NOT NULL,
    mail VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDB;



CREATE TABLE veterinaries (
    id INT(100) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone INT(255) NOT NULL,
    phone2 INT(255) NOT NULL,
    license INT(255) NOT NULL,
    specialty varchar(255) not null
) ENGINE=InnoDB;



CREATE TABLE owners (
    id INT(100) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    dni int(255) UNIQUE NOT NULL,
    phone INT(255) NOT NULL,
    phone2 INT(255) NOT NULL,
    mail VARCHAR(255) UNIQUE NOT NULL,
    address VARCHAR(255) NOT NULL
) ENGINE=InnoDB;



CREATE TABLE patients (
    id INT(100) AUTO_INCREMENT PRIMARY KEY,
    owner_id INT(100) NOT NULL,
    name VARCHAR(255) NOT NULL,
    animal varchar(255) NOT NULL,
    breed VARCHAR(255) NOT NULL,
    birth date NOT NULL,
    FOREIGN KEY (owner_id) REFERENCES owners(id)
) ENGINE=InnoDB;



CREATE TABLE turns (
    id INT(100) AUTO_INCREMENT PRIMARY KEY,
    patient_id INT(100) NOT NULL,
    `date` DATE NOT NULL,
    hour time NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(id)
) ENGINE=InnoDB;



CREATE TABLE histories (
    id INT(100) AUTO_INCREMENT PRIMARY KEY,
    patient_id INT(100) NOT NULL,
    history text NOT NULL,
    `date` date NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(id)
) ENGINE=InnoDB;