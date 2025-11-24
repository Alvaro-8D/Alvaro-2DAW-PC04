TYPE=VIEW
query=select `sakila`.`film`.`film_id` AS `FID`,`sakila`.`film`.`title` AS `title`,`sakila`.`film`.`description` AS `description`,`sakila`.`category`.`name` AS `category`,`sakila`.`film`.`rental_rate` AS `price`,`sakila`.`film`.`length` AS `length`,`sakila`.`film`.`rating` AS `rating`,group_concat(concat(`sakila`.`actor`.`first_name`,_utf8mb4\' \',`sakila`.`actor`.`last_name`) separator \', \') AS `actors` from ((((`sakila`.`film` left join `sakila`.`film_category` on((`sakila`.`film_category`.`film_id` = `sakila`.`film`.`film_id`))) left join `sakila`.`category` on((`sakila`.`category`.`category_id` = `sakila`.`film_category`.`category_id`))) left join `sakila`.`film_actor` on((`sakila`.`film`.`film_id` = `sakila`.`film_actor`.`film_id`))) left join `sakila`.`actor` on((`sakila`.`film_actor`.`actor_id` = `sakila`.`actor`.`actor_id`))) group by `sakila`.`film`.`film_id`,`sakila`.`category`.`name`
md5=2dff2dc33e98ee67627348358dc1b981
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2025-11-14 13:04:49
create-version=1
source=SELECT film.film_id AS FID, film.title AS title, film.description AS description, category.name AS category, film.rental_rate AS price,\n	film.length AS length, film.rating AS rating, GROUP_CONCAT(CONCAT(actor.first_name, _utf8mb4\' \', actor.last_name) SEPARATOR \', \') AS actors\nFROM film LEFT JOIN film_category ON film_category.film_id = film.film_id\nLEFT JOIN category ON category.category_id = film_category.category_id LEFT\nJOIN film_actor ON film.film_id = film_actor.film_id LEFT JOIN actor ON\n  film_actor.actor_id = actor.actor_id\nGROUP BY film.film_id, category.name
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `sakila`.`film`.`film_id` AS `FID`,`sakila`.`film`.`title` AS `title`,`sakila`.`film`.`description` AS `description`,`sakila`.`category`.`name` AS `category`,`sakila`.`film`.`rental_rate` AS `price`,`sakila`.`film`.`length` AS `length`,`sakila`.`film`.`rating` AS `rating`,group_concat(concat(`sakila`.`actor`.`first_name`,\' \',`sakila`.`actor`.`last_name`) separator \', \') AS `actors` from ((((`sakila`.`film` left join `sakila`.`film_category` on((`sakila`.`film_category`.`film_id` = `sakila`.`film`.`film_id`))) left join `sakila`.`category` on((`sakila`.`category`.`category_id` = `sakila`.`film_category`.`category_id`))) left join `sakila`.`film_actor` on((`sakila`.`film`.`film_id` = `sakila`.`film_actor`.`film_id`))) left join `sakila`.`actor` on((`sakila`.`film_actor`.`actor_id` = `sakila`.`actor`.`actor_id`))) group by `sakila`.`film`.`film_id`,`sakila`.`category`.`name`
