INSERT INTO profTable (first_name, last_name, email, phone, password) VALUES
    ('Thomas', 'SOUP', 'youngblesser@sewanee.edu', '9310303333', 'jiofvjk');
    
    
    SELECT * FROM studentTable WHERE username='prororo' AND password='randomrandom';
    
    
    SELECT hasLiked.profID, first_name,last_name FROM profTable,hasLiked,studentTable 
            WHERE username = 'prororo'
            AND   hasLiked.profID = profTable.profID
            AND;
            
 SELECT * FROM profTable,hasLiked,studentTable 
            WHERE hasLiked.username = 'prororo'
            AND   hasLiked.profID = profTable.profID  
            AND   hasLiked.username = studentTable.username;         
            
            
            
INSERT INTO hasLiked(username, profID) VALUES 
             ('youngstunna', 1),
             ('youngstunna', 2);
             
 SELECT profTable.profID, first_name,last_name, whoTeachesWhat.registerID,abbr,courseNo,dept,period,year  
   FROM profTable,whoTeachesWhat,whatIsTaughtWhen, semester,departments
            WHERE whoTeachesWhat.profID = 2
            AND   period = 'Advent'
            AND   year = 2017
            AND   departments.deptID = whoTeachesWhat.deptID
            AND   whoTeachesWhat.profID = profTable.profID
            AND   whoTeachesWhat.registerID = whatIsTaughtWhen.registerID      
            AND   whatIsTaughtWhen.semesterID = semester.semesterID       ;
            
            
           SELECT * from hasLiked WHERE username =  
            
          SELECT * from hasLiked 
                 WHERE username = 'oldman'
                 AND   profID   = 2;
            
            
            
            
            SELECT whoTeachesWhat.registerID,abbr,courseNo,dept,period,year  
     FROM profTable,whoTeachesWhat,whatIsTaughtWhen, semester,departments
            WHERE whoTeachesWhat.profID = 2
            AND   period = 'Advent'
            AND   year = 2017
            AND   departments.deptID = whoTeachesWhat.deptID
            AND   whoTeachesWhat.profID = profTable.profID
            AND   whoTeachesWhat.registerID = whatIsTaughtWhen.registerID      
            AND   whatIsTaughtWhen.semesterID = semester.semesterID
