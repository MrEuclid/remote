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

   #global conneection timeout arguments
global_connect_timeout = 'SET GLOBAL connect_timeout=180'
global_wait_timeout = 'SET GLOBAL connect_timeout=180'
global_interactive_timeout = 'SET GLOBAL connect_timeout=180'

cursor.execute(global_connect_timeout)
cursor.execute(global_wait_timeout)
cursor.execute(global_interactive_timeout)
                                    
if connection.is_connected():
    db_Info = connection.get_server_info()
    print("Connected to MySQL Server version ", db_Info)
    cursor = connection.cursor()
    cursor.execute("select database();")
    record = cursor.fetchone()
    print("You're connected to database: ", record)

print(connection)


clearTable = "DELETE FROM myTempHumidity WHERE 1"
#Execute cursor 
cursor.execute(clearTable)
connection.commit()
print(" Table cleared before filling")

 
ser = serial.Serial('/dev/cu.usbmodem14101')
ser.flushInput()

i = 1
while i < maxRecords:
        ser.reset_input_buffer()
        ser_bytes = ser.readline()
        decoded_bytes = float(ser_bytes[0:len(ser_bytes)-2].decode("utf-8"))
        i = decoded_bytes
        print(i)
        ser_bytes = ser.readline()
        decoded_bytes = float(ser_bytes[0:len(ser_bytes)-2].decode("utf-8"))
        temperature = decoded_bytes
        print(temperature)
        ser_bytes = ser.readline()
        decoded_bytes = float(ser_bytes[0:len(ser_bytes)-2].decode("utf-8"))
        humidity = decoded_bytes
        print(humidity)
        mySql_insert_query = """INSERT INTO myTempHumidity (id, temperature, humidity) 
                           VALUES 
                           (%s,%s,%s) """

        recordTuple = (i, temperature, humidity)
        cursor.execute(mySql_insert_query, recordTuple)
        connection.commit()
        print(i, "Record inserted successfully into table")
        i = i + 1
        
            
cursor.close()
print("Keyboard Interrupt")
if (connection.is_connected()):
    connection.close()
    print("MySQL connection is closed")
