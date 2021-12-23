CREATE TABLE IF NOT EXISTS `Competitions`
(
    id                  int AUTO_INCREMENT PRIMARY KEY,
    user_id             int,
    compName            varchar(30) NOT NULL,
    duration            int DEFAULT 3,
    start_reward        int DEFAULT 1,
    curr_reward         int DEFAULT (start_reward),
    join_fee            int DEFAULT 1,
    curr_partic         int DEFAULT 0,
    min_partic          int DEFAULT 3,
    paid_out            tinyint(1) DEFAULT 0,
    min_score           int DEFAULT 1,
    first_place         int DEFAULT 70,
    second_place        int DEFAULT 20,
    third_place         int DEFAULT 10,
    create_cost         int DEFAULT 0,
    expires             TIMESTAMP DEFAULT (DATE_ADD(CURRENT_TIMESTAMP, INTERVAL duration DAY)),
    modified            TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    created             TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    check (min_score >= 1),
    check (start_reward >= 1),
    check (curr_reward >= start_reward),
    check (min_partic >= 3),
    check (curr_partic >= 0),
    check (join_fee >= 0),
    check (first_place + second_place + third_place = 100)
)