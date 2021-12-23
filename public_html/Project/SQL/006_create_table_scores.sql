CREATE TABLE IF NOT EXISTS `SCORES`
(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int,
    score int,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    check (score > 0)
)