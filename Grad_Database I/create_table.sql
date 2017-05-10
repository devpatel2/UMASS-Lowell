/* Devang Patel
 ID# 01480944 */

create table course (
    course_id varchar(2) not null primary key,
    title varchar(50),
    dept_name varchar(20),
    credits numeric(1,0)
);

create table instructor (
    ID varchar(3) not null primary key,
    name varchar(20) not null,
    dept_name varchar(20),
    salary numeric(8,2)
);

create table student (
    ID varchar(3) not null primary key,
    name varchar(20) not null,
    dept_name varchar(20),
    tot_cred numeric(3,0)
);

create table teaches (
    ID varchar(3) not null,
    course_id varchar(2),
    sec_id varchar(1),
    semester varchar(6),
    year numeric(4,0),
    CONSTRAINT pk_teaches primary key (ID, course_id, sec_id, semester, year),
    foreign key (course_id) references course,
    foreign key (ID) references instructor
);

create table takes (
    ID varchar(3) not null,
    course_id varchar(2),
    sec_id varchar(1),
    semester varchar(6),
    year numeric(4,0),
    grade varchar(2),
    CONSTRAINT pk_takes primary key (ID, course_id, sec_id, semester, year),
    foreign key (course_id) references course,
    foreign key (ID) references student
);