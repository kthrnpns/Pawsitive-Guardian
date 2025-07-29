
-- Users Table 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0
);

INSERT INTO users (first_name, last_name, email, password_hash, user_type)
VALUES (
  'Admin',
  'User',
  'admin@example.com',
  '$2y$10$Ge3Ge8pyD9gGHVvTszPMnOlNRQL0YaUpwDE.MGO1MB8kEhcf8JxMu',
  'admin'
);
--Email: admin@example.com

--Password: admin123

--user_type: 'admin'

-- Cats Table 
CREATE TABLE cats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    dob DATE NULL,
    age INT NOT NULL,
    gender ENUM('Male','Female') NOT NULL,
    breed VARCHAR(100) NOT NULL,
    profile_photo VARCHAR(255) NOT NULL,
    additional_photos TEXT,
    status ENUM('Available','Pending Adoption','Medical Hold','Not Available') NOT NULL DEFAULT 'Available',
    description TEXT NOT NULL,
    color VARCHAR(50),
    coat_length ENUM('Short','Medium','Long'),
    size ENUM('Small','Medium','Large'),
    vaccinated TINYINT(1) DEFAULT 0,
    spayed_neutered TINYINT(1) DEFAULT 0,
    microchipped TINYINT(1) DEFAULT 0,
    dewormed TINYINT(1) DEFAULT 0,
    flea_treated TINYINT(1) DEFAULT 0,
    special_needs TINYINT(1) DEFAULT 0,
    special_needs_description TEXT,
    traits TEXT,
    adoption_fee DECIMAL(10,2) DEFAULT 2000.00,
    notes TEXT,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Admin Logs Table
CREATE TABLE admin_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action_type VARCHAR(50) NOT NULL,
    description TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_admin_id FOREIGN KEY (admin_id) REFERENCES users(id)
);

CREATE TABLE volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50),
    address TEXT,
    interests TEXT,
    skills TEXT,
    availability TEXT,
    reference_info TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Donations Table
CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_donation_user_id FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Adoption Requests Table
CREATE TABLE adoption_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pet_id INT NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_adoption_user_id FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_adoption_pet_id FOREIGN KEY (pet_id) REFERENCES cats(id)
);