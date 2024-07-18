import serial # import Serial Library
import time
import csv



maxRecords = 1000
import mysql.connector

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

 
ser = serial.Serial('/dev/cu.usbmodem14201')
ser.flushInput()

i = 1
while i < maxRecords:
        ser.reset_input_buffer()
        ser_bytes = ser.readline()
        ser.reset_input_buffer()
        decoded_bytes = float(ser_bytes[0:len(ser_bytes)-2].decode("utf-8"))
        print(decoded_bytes)
        mySql_insert_query = """INSERT INTO myData (id, d1, d2, d3) 
                           VALUES 
                           (%s,%s,%s,%s) """

        recordTuple = (i, 1, 2, decoded_bytes)
        cursor.execute(mySql_insert_query, recordTuple)
        connection.commit()
        print(i, "Record inserted successfully into table")
        i = i + 1
        
            
cursor.close()
print("Keyboard Interrupt")
if (connection.is_connected()):
    connection.close()
    print("MySQL connection is closed")
