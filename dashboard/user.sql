CREATE TABLE `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

-- Insert sample data with hashed passwords
INSERT INTO `user` (`email`, `password`) VALUES
('user1@example.com', '$2y$10$wNvNncmfRM8jH1QxoLF9gO3WDfLe8/UAdCU3/k1s/JbKOspClSG4K'), -- password1
('user2@example.com', '$2y$10$ruRkhYMyMo7Ao8Jg9h9dcO9f6DNdg63sI.eCmFScX5vFuSw2Lq1Mm'); -- password2
