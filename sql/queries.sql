/*How many likes does Professor Carl have? -- */
SELECT COUNT(*), last_name FROM profTable, hasLiked
  WHERE profTable.profID = hasLiked.profID
  AND   last_name = 'Carl'
 ;
  
  
  
 /*List all the professors in the English department. -- */
  SELECT first_name,last_name,dept FROM profTable, whoTeachesWhat, departments
    WHERE profTable.profID = whoTeachesWhat.profID 
    AND   whoTeachesWhat.deptID = departments.deptID
    AND   departments.dept = 'English'
	;
  
  
 /*What courses does Professor Duffee teach in Advent 2017? */
   SELECT first_name,last_name, dept, courseNo,period FROM profTable, whoTeachesWhat, whatIsTaughtWhen, departments, semester
    WHERE semester.period = 'Advent 2017'
    AND   last_name = 'Duffee'
    AND   whatIsTaughtWhen.semesterID = semester.semesterID	
    AND   profTable.profID = whoTeachesWhat.profID 
    AND   departments.deptID = whoTeachesWhat.deptID    
    AND   whoTeachesWhat.registerID = whatIsTaughtWhen.registerID
       
     ;
  
  
  
 /*Who teaches Physics 101 during Advent 2017?--*/
  SELECT first_name,last_name, period, dept, courseNo FROM profTable, whoTeachesWhat, whatIsTaughtWhen, departments, semester
    WHERE semester.period = 'Advent 2017'
    AND   departments.dept = 'Physics and Astronomy'
    AND   whoTeachesWhat.courseNo  = 101
    AND   whatIsTaughtWhen.semesterID = semester.semesterID	
    AND   profTable.profID = whoTeachesWhat.profID 
    AND   departments.deptID = whoTeachesWhat.deptID    
    AND   whoTeachesWhat.registerID = whatIsTaughtWhen.registerID
       
    ;

  
  
 /*What is the name of the professor who teaches Computer Science 157 
 in Advent 2017 and how many likes did he/she receive?*/
  SELECT first_name,last_name, period, dept, courseNo FROM profTable, whoTeachesWhat, whatIsTaughtWhen, departments, semester
    WHERE semester.period = 'Advent 2017'
    AND   departments.dept = 'Computer Science'
    AND   whoTeachesWhat.courseNo  = 157
    AND   whatIsTaughtWhen.semesterID = semester.semesterID	
    AND   profTable.profID = whoTeachesWhat.profID 
    AND   departments.deptID = whoTeachesWhat.deptID    
    AND   whoTeachesWhat.registerID = whatIsTaughtWhen.registerID
       
    ;
    /*name is obtained from above, then used to obtain the number of likes*/
  SELECT COUNT(*), first_name, last_name FROM profTable, hasLiked
  WHERE profTable.profID = hasLiked.profID
  AND   first_name = 'Lucia'                        /*Obtained from above*/
  AND   last_name = 'Dale'                          /*Obtained from above*/
 ;  
  
  
  
  
  
  /*Delete all the courses that a professor is going to teach in Advent 2017.*/
   SELECT first_name,last_name, dept, courseNo,period,whatIsTaughtWhen.semesterID, whatIsTaughtWhen.registerID FROM profTable, whoTeachesWhat, whatIsTaughtWhen, departments, semester
    WHERE semester.period = 'Advent 2017'
    AND   first_name = 'Stephen'
    AND   last_name = 'Carl'
    AND   whatIsTaughtWhen.semesterID = semester.semesterID	
    AND   profTable.profID = whoTeachesWhat.profID 
    AND   departments.deptID = whoTeachesWhat.deptID    
    AND   whoTeachesWhat.registerID = whatIsTaughtWhen.registerID
       
     ;
     
     /*The registerIDs and semesterID are obtained in the previous query, and then
	 they are deleted in the whatIsTaughtWhen table*/
  
    DELETE FROM whatIsTaughtWhen 
      WHERE semesterID = 2 AND registerID = 20526;
      ;
	DELETE FROM whatIsTaughtWhen 
      WHERE semesterID = 2 AND registerID = 20527;
      ;
  
  
  
  /*List all the courses that a professor has ever taught. -- */
  SELECT first_name,last_name,dept, courseNo FROM profTable, whoTeachesWhat, departments
    WHERE first_name = 'Lucia'
    AND   last_name = 'Dale'
    AND   profTable.profID = whoTeachesWhat.profID 
    AND   departments.deptID = whoTeachesWhat.deptID
    ;
  

