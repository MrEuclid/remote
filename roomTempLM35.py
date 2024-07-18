import serial
import time
import csv
import traceback
from datetime import datetime
import requests

url = "http://remote.teacherjohn.org/LM35_1737.html"

#port = '/dev/ttyACM0'
#port = '/dev/ttyUSB0'
port = '/dev/tty.usbmodem14101'
#port = "COM4"

baud = 9600

ser = serial.Serial(port, baud, timeout=1)
ser.flushInput()


while True:
    try:
        if ser.in_waiting:
            time.sleep(1)
            temp = ser.readline().strip()
            tempstring = str(temp)
            tempstring = temp.decode("utf-8")
            now = datetime.now()
            year = now.strftime("%Y")
            month = now.strftime("%m")
            day = now.strftime("%d")	
            yearMonthDay = str(year +"-"+month+"-"+day)

            hour = now.strftime("%H")
            minute = now.strftime("%M") 
            t = hour +'-'+minute
            hourMinute = str(t)
           
            print(url)
            print(t)

            if tempstring > "":
                url ="https://dweet.io/dweet/for/LM35_1737?temp=" + tempstring + "&ymd="  +yearMonthDay + "&hm="+hourMinute
                print(url)
                r = requests.get(url)
                    
        #Show what the server responded with
                print("response",r.text)
           
       
                          
              
    except Exception:
        traceback.print_exc()
        print("exiting")
        #print("Keyboard Interrupt")
        #break doesn't quit now on error.

