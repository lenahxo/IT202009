CREATE TABLE IF NOT EXISTS `PointsHistory`
(
    id              int AUTO_INCREMENT PRIMARY KEY ,
    user_id         int,
    points_change   int,
    reason          varchar(40) not null COMMENT 'Enter reason',
    created         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id)
)