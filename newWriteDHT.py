import serial # import Serial Library
import time
import csv
import mysql.connector
import traceback
import datetime

baud = 9600
port = '/dev/ttyACM0'

ser = serial.Serial(port, baud, timeout=1)
ser.flushInput()

print(ser.name)

oldline = []
# 24 hours at 10 minute intervals
maxRecords = 144


connection = mysql.connector.connect(
  host="mysql.au.cloudlogin.co",
  database='euclid_remote',
  user="euclid_remote",
  passwd="pythagoras"
)

                                    
if connection.is_connected():
    db_Info = connection.get_server_info()
    print("Connected to MySQL Server version ", db_Info)
    cursor = connection.cursor()
    cursor.execute("select database();")
    record = cursor.fetchone()
    print("You're connected to database: ", record)

print(connection)


clearTable = "DELETE FROM myData WHERE 1"
#Execute cursor 
cursor.execute(clearTable)
connection.commit()
print(" Table cleared before filling")

cnt = 0 ;
i = 1
while i < maxRecords:
    try:
        line = ser.readline()                 # read bytes until line-ending
        line = line.decode('UTF-8','ignore')  # convert to string
        line = line.rstrip('\r\n')            # remove line-ending characters
        split_line = line.splitlines()
        cnt = cnt + 1
        print(cnt,i,line,oldline,split_line)
        if oldline != split_line:      
            with open("test_data.csv","a") as f:
                for item in split_line:
                    b = item.split(",")
                    temperature = b[0]
                    humidity = b[1]
                    x = datetime.datetime.now()
                    print(b);
                    mySql_insert_query = """INSERT INTO myData (id, d1, d2, d3) 
                           VALUES 
                           (%s,%s,%s,%s) """

                    recordTuple = (i, b[0], b[1], 5)
                    cursor.execute(mySql_insert_query, recordTuple)
                    connection.commit()
                    print(i, "Record inserted successfully into table")
                    i = i + 1
                    cnt = 0
                    ser.flushInput()
        
    except Exception:
        traceback.print_exc()
        print("exiting")
        print("Keyboard Interrupt")        
        if (connection.is_connected()):
            connection.close()
            print("MySQL connection is closed")
    
    
 
