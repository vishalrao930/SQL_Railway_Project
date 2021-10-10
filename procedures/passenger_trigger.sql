CREATE TRIGGER `insert_passenger` BEFORE INSERT ON `passenger`
 FOR EACH ROW begin
DECLARE count_inserted INT;
DECLARE max_allowed INT;

select count(*) into count_inserted from passenger where new.pnr=passenger.pnr;

if count_inserted is null THEN
	SET count_inserted = 0;
end if;

select num_passengers into max_allowed from ticket where ticket.pnr=new.pnr;
if max_allowed is null THEN
	SET max_allowed = 0;
end if;

if max_allowed<=count_inserted THEN
	SIGNAL SQLSTATE '45000' Set MESSAGE_TEXT="Number of Passengers Exceeded the limit";
end if;
end