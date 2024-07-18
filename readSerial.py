import serial
import time
import csv
import traceback
import datetime
import requests
import sys



headers = {'cache-control': 'no-cache'}

# read h and t from DHT11

#port = '/dev/ttyACM0'
#port = '/dev/ttyUSB0'
port = '/dev/tty.usbmodem14101'
baud = 9600

ser = serial.Serial(port, baud, timeout=1)
ser.flushInput()

print(ser.name)

oldline = []
a = 0
while (a == 0):
    try:
        line = ser.readline()                 # read bytes until line-ending
        line = line.decode('UTF-8','ignore')  # convert to string
        line = line.rstrip('\r\n')            # remove line-ending characters

        split_line = line.splitlines()

        if oldline != split_line:
            with open("test_data.csv","a") as f:
                for item in split_line:
                    print (item)
                    b = item.split(",")
                    temperature = b[0]
                   # humidity = b[1]
                    x = datetime.datetime.now()
                    print(b);
                    print(b[0])
                    # You can write to a text/CSV file.
                    writer = csv.writer(f,delimiter=",")
                    writer.writerow([x.strftime("%c"), item])
                    #URL = "http://pi400.local/readDataDHT.php"
                    # use intranet to avoid cross-site scripting errors
                    # allowing remote access to temple also works
                    URL = "http://temple.teacherjohn.org/readData.php"
                    # #You can also send the data to a website/database for processing elsewhere
                    PARAMS = {'temperature' : temperature}
                    r = requests.get(URL,PARAMS,headers = headers)
                    #post needs json
                    print(r.url)



                                      # payload)

                    # Show what the server responded with
                    print(r.text)
                    print(r.status_code)


        oldline = split_line


    except Exception:
        traceback.print_exc()
        print("exiting")
        print("Keyboard Interrupt")
        #break doesn't quit now on error.


