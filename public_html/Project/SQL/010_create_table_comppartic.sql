CREATE TABLE IF NOT EXISTS `Participants`
(
    id              int AUTO_INCREMENT PRIMARY KEY ,
    user_id         int,
    comp_id         int,
    created         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified        TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    UNIQUE KEY  (user_id, comp_id),
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (comp_id) REFERENCES Competitions(id)
)