Database II project 

This is a simple web based form that is for instructor use. This allows an instructor to search, add, update or 
  delete student or course information.

The form currently runs on localhost using XAMPP with apache and MySQL features on. phpMyAdmin is used to manage 
  the database. The files are separated into HTML and php in this folder, but all files should be in one folder when run.

Database holds the following tables and elements:
  - students (SID, name, IID, major, degreeHeld, career)
  - instructors (IID, name, rank)
  - courses (CID, name, credits, groupID)
  - section (CID, SecID, IID, yearID, semesterID)
  - prerequisite (PCID, CID)
  - conditions (SID, CID)
  - enrollment (SID, CID, SecID, yearID, semesterID, grade)
