delimiter //
CREATE TRIGGER `insert_ticket` BEFORE INSERT ON `ticket`
 FOR EACH ROW BEGIN
	
	declare max_allocated INT DEFAULT 0;
    declare max_seats INT default 0;
    declare tt int default 0;
    select count(*) into tt from train where train.train=new.train_number and train.date=new.date;
    if tt=0 then 
    	signal sqlstate '45000' set MESSAGE_TEXT="No such train exists";
       end if;
    select sum(num_passengers) into max_allocated from ticket t where t.train_number=new.train_number and t.date=new.date and t.coach_type=new.coach_type ;
    if max_allocated is null then set max_allocated = 0;
    end if;
    if new.coach_type='A' THEN
    	select ac into max_seats from train where train.train=new.train_number and train.date=new.date;
        set max_seats = max_seats* 18;
    ELSE
    	select sleeper into max_seats from train where train.train=new.train_number and train.date= new.date;
        set max_seats= max_seats * 24;
    end if;
    if max_allocated + new.num_passengers > max_seats THEN
    	signal SQLSTATE '45000' SET  MESSAGE_TEXT="Not enough seats";
    end if;
end //

delimiter ;