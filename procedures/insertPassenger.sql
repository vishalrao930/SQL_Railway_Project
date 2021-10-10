DELIMITER $$

CREATE PROCEDURE insertPassenger(
    IN pnr INT,
    IN coach_type CHAR(1),
    IN p_name VARCHAR(128),
    IN p_age INT,
    IN p_gender CHAR(1)
)
BEGIN
    DECLARE max_allocated INT DEFAULT 0;
    DECLARE train_no_var VARCHAR(5);
    DECLARE date_var DATE;
    DECLARE seat_number INT DEFAULT 0;
    DECLARE coach_number INT DEFAULT 0;
    DECLARE seat_type_var CHAR(2);

    SELECT ticket.train_number, ticket.date
    INTO train_no_var, date_var
    FROM ticket
    WHERE ticket.pnr=pnr;

    SELECT COUNT(*)
    INTO max_allocated
    FROM ticket as T, passenger as P
    WHERE T.pnr=P.pnr AND T.train_number=train_no_var 
            AND T.date=date_var AND T.coach_type=coach_type;

    IF coach_type='A' THEN
        SET coach_number = FLOOR(max_allocated/18) + 1;
        SET seat_number = (max_allocated%18) + 1;
        SELECT A.seat_type
        INTO seat_type_var
        FROM ac_coach as A
        WHERE A.seat_number=seat_number;
    END IF;
    IF coach_type='S' THEN
        SET coach_number = FLOOR(max_allocated/24) + 1;
        SET seat_number = (max_allocated%24) + 1;
        SELECT S.seat_type
        INTO seat_type_var
        FROM sleeper_coach as S
        WHERE S.seat_number=seat_number;
    END IF;

    INSERT INTO passenger VALUES (pnr, coach_number, seat_number, p_name, p_age, p_gender, seat_type_var);

END
$$