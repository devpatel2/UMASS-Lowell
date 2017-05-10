/* Devang Patel
 ID# 01480944 */
 
-- 1
select name
from student
where ID = '113';

-- 2
select title
from course
where title like 'G%';

-- 3
select distinct ID
from instructor
where ID NOT IN (select distinct ID
                 from teaches
                 where semester = 'Fall' AND year = 2016);

-- 4
select dept_name, count(ID) as student_count
from student
group by dept_name
order by student_count;

-- 5
select I.name
from teaches T, takes R, instructor I
where T.course_id = R.course_id AND
      T.sec_id = R.sec_id AND
      T.semester = R.semester AND
      T.year = R.year AND
      T.ID = I.ID
group by I.name
having count(*) >= ALL (select count(*)
                        from teaches T, takes R, instructor I
                        where T.course_id = R.course_id AND
                              T.sec_id = R.sec_id AND
                              T.semester = R.semester AND
                              T.year = R.year AND
                              T.ID = I.ID
                        group by I.name);

-- 6
select name
from teaches T, instructor I
where T.ID = I.ID AND
      year IN (select distinct year
               from teaches T1, instructor I1
               where T1.ID = I1.ID AND name = 'McKinnon')
      AND name <> 'McKinnon'
group by name
having count(distinct year) IN (select count(distinct year)
                               from teaches T2, instructor I2
                               where T2.ID = I2.ID and name = 'McKinnon');

-- 7
select *
from (select name, salary
      from instructor
      where dept_name IN (select dept_name
                          from instructor
                          group by dept_name
                          having avg(salary) >= ALL (select avg(salary)
                                                     from instructor
                                                     group by dept_name))
      order by salary desc)
where ROWNUM <= 2;

-- 8
select *
from (select S.name, C.title, T.year, T.semester, C.credits, T.grade
      from student S, course C, takes T
      where T.course_id = C.course_id AND
            T.ID = S.ID
      order by name asc, year desc, semester desc)
where ROWNUM <= 5;

-- 9
update instructor
set salary = salary + 10000
where salary <= 50000;

-- 10
delete from takes
where ID IN (select ID
             from student
             where name = 'Tomason');