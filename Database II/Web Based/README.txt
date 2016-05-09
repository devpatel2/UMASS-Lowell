Database II project 

This is a simple web based form that is for instructor use. This allows an instructor to search, add, update or delete student or course information.

The form runs on localhost using XAMPP with apache and MySQL features on. phpMyAdmin is used to manage the database.

Database holds the following tables and elements:
  - students (SID, name, IID, major, degreeHeld, career)
  - instructors (IID, name, rank)
  - courses (CID, name, credits, groupID)
  - section (CID, SecID, IID, yearID, semesterID)
  - prerequisite (PCID, CID)
  - conditions (SID, CID)
  - enrollment (SID, CID, SecID, yearID, semesterID, grade)
